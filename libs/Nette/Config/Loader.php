<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 *
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 * @package Nette\Config
 */



/**
 * Configuration file loader.
 *
 * @author     David Grudl
 *
 * @property-read array $dependencies
 * @package Nette\Config
 */
class NConfigLoader extends NObject
{
	/** @internal */
	const INCLUDES_KEY = 'includes';

	private $adapters = array(
		'php' => 'NConfigPhpAdapter',
		'ini' => 'NConfigIniAdapter',
		'neon' => 'NConfigNeonAdapter',
	);

	private $dependencies = array();


	/**
	 * Reads configuration from file.
	 * @param  string  file name
	 * @param  string  optional section to load
	 * @return array
	 */
	public function load($file, $section = NULL)
	{
		if (!is_file($file) || !is_readable($file)) {
			throw new FileNotFoundException("File '$file' is missing or is not readable.");
		}
		$this->dependencies[] = $file = realpath($file);
		$data = $this->getAdapter($file)->load($file);

		if ($section) {
			if (isset($data[self::INCLUDES_KEY])) {
				throw new InvalidStateException("Section 'includes' must be placed under some top section in file '$file'.");
			}
			$data = $this->getSection($data, $section, $file);
		}

		// include child files
		$merged = array();
		if (isset($data[self::INCLUDES_KEY])) {
			NValidators::assert($data[self::INCLUDES_KEY], 'list', "section 'includes' in file '$file'");
			foreach ($data[self::INCLUDES_KEY] as $include) {
				$merged = NConfigHelpers::merge($this->load(dirname($file) . '/' . $include), $merged);
			}
		}
		unset($data[self::INCLUDES_KEY]);

		return NConfigHelpers::merge($data, $merged);
	}


	/**
	 * Save configuration to file.
	 * @param  array
	 * @param  string  file
	 * @return void
	 */
	public function save($data, $file)
	{
		if (file_put_contents($file, $this->getAdapter($file)->dump($data)) === FALSE) {
			throw new IOException("Cannot write file '$file'.");
		}
	}


	/**
	 * Returns configuration files.
	 * @return array
	 */
	public function getDependencies()
	{
		return array_unique($this->dependencies);
	}


	/**
	 * Registers adapter for given file extension.
	 * @param  string  file extension
	 * @param  string|IConfigAdapter
	 * @return self
	 */
	public function addAdapter($extension, $adapter)
	{
		$this->adapters[strtolower($extension)] = $adapter;
		return $this;
	}


	/** @return IConfigAdapter */
	private function getAdapter($file)
	{
		$extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
		if (!isset($this->adapters[$extension])) {
			throw new InvalidArgumentException("Unknown file extension '$file'.");
		}
		return is_object($this->adapters[$extension]) ? $this->adapters[$extension] : new $this->adapters[$extension];
	}


	private function getSection(array $data, $key, $file)
	{
		NValidators::assertField($data, $key, 'array|null', "section '%' in file '$file'");
		$item = $data[$key];
		if ($parent = NConfigHelpers::takeParent($item)) {
			$item = NConfigHelpers::merge($item, $this->getSection($data, $parent, $file));
		}
		return $item;
	}

}
