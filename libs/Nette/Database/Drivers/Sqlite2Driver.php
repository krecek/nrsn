<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 *
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 * @package Nette\Database\Drivers
 */



/**
 * Supplemental SQLite2 database driver.
 *
 * @author     David Grudl
 * @package Nette\Database\Drivers
 */
class NSqlite2Driver extends NSqliteDriver
{

	/**
	 * Encodes string for use in a LIKE statement.
	 */
	public function formatLike($value, $pos)
	{
		throw new NotSupportedException;
	}


	/**
	 * Returns metadata for all foreign keys in a table.
	 */
	public function getForeignKeys($table)
	{
		throw new NNotSupportedException; // @see http://www.sqlite.org/foreignkeys.html
	}

}
