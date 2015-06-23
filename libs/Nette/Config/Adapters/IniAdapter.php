<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 *
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 * @package Nette\Config\Adapters
 */



/**
 * Reading and generating INI files.
 *
 * @author     David Grudl
 * @package Nette\Config\Adapters
 */
class NConfigIniAdapter extends NObject implements IConfigAdapter
{
	/** @internal */
	const INHERITING_SEPARATOR = '<', // child < parent
		KEY_SEPARATOR = '.', // key nesting key1.key2.key3
		ESCAPED_KEY_SEPARATOR = '..',
		RAW_SECTION = '!';


	/**
	 * Reads configuration from INI file.
	 * @param  string  file name
	 * @return array
	 * @throws InvalidStateException
	 */
	public function load($file)
	{
		set_error_handler(create_function('$severity, $message', ' // parse_ini_file returns FALSE on failure since PHP 5.2.7
			restore_error_handler();
			throw new InvalidStateException("parse_ini_file(): $message");
		'));
		$ini = parse_ini_file($file, TRUE);
		restore_error_handler();

		$data = array();
		foreach ($ini as $secName => $secData) {
			if (is_array($secData)) { // is section?
				if (substr($secName, -1) === self::RAW_SECTION) {
					$secName = substr($secName, 0, -1);
				} else { // process key nesting separator (key1.key2.key3)
					$tmp = array();
					foreach ($secData as $key => $val) {
						$cursor = & $tmp;
						$key = str_replace(self::ESCAPED_KEY_SEPARATOR, "\xFF", $key);
						foreach (explode(self::KEY_SEPARATOR, $key) as $part) {
							$part = str_replace("\xFF", self::KEY_SEPARATOR, $part);
							if (!isset($cursor[$part]) || is_array($cursor[$part])) {
								$cursor = & $cursor[$part];
							} else {
								throw new InvalidStateException("Invalid key '$key' in section [$secName] in file '$file'.");
							}
						}
						$cursor = $val;
					}
					$secData = $tmp;
				}

				$parts = explode(self::INHERITING_SEPARATOR, $secName);
				if (count($parts) > 1) {
					$secName = trim($parts[0]);
					$secData[NConfigHelpers::EXTENDS_KEY] = trim($parts[1]);
				}
			}

			$cursor = & $data; // nesting separator in section name
			foreach (explode(self::KEY_SEPARATOR, $secName) as $part) {
				if (!isset($cursor[$part]) || is_array($cursor[$part])) {
					$cursor = & $cursor[$part];
				} else {
					throw new InvalidStateException("Invalid section [$secName] in file '$file'.");
				}
			}

			if (is_array($secData) && is_array($cursor)) {
				$secData = NConfigHelpers::merge($secData, $cursor);
			}

			$cursor = $secData;
		}

		return $data;
	}


	/**
	 * Generates configuration in INI format.
	 * @return string
	 */
	public function dump(array $data)
	{
		$output = array();
		foreach ($data as $name => $secData) {
			if (!is_array($secData)) {
				$output = array();
				self::build($data, $output, '');
				break;
			}
			if ($parent = NConfigHelpers::takeParent($secData)) {
				$output[] = "[$name " . self::INHERITING_SEPARATOR . " $parent]";
			} else {
				$output[] = "[$name]";
			}
			self::build($secData, $output, '');
			$output[] = '';
		}
		return "; generated by Nette\n\n" . implode(PHP_EOL, $output);
	}


	/**
	 * Recursive builds INI list.
	 * @return void
	 */
	private static function build($input, & $output, $prefix)
	{
		foreach ($input as $key => $val) {
			$key = str_replace(self::KEY_SEPARATOR, self::ESCAPED_KEY_SEPARATOR, $key);
			if (is_array($val)) {
				self::build($val, $output, $prefix . $key . self::KEY_SEPARATOR);

			} elseif (is_bool($val)) {
				$output[] = "$prefix$key = " . ($val ? 'true' : 'false');

			} elseif (is_numeric($val)) {
				$output[] = "$prefix$key = $val";

			} elseif (is_string($val)) {
				$output[] = "$prefix$key = \"$val\"";

			} else {
				throw new InvalidArgumentException("The '$prefix$key' item must be scalar or array, " . gettype($val) ." given.");
			}
		}
	}

}
