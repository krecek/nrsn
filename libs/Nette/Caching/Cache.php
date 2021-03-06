<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 *
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 * @package Nette\Caching
 */



/**
 * Implements the cache for a application.
 *
 * @author     David Grudl
 *
 * @property-read ICacheStorage $storage
 * @property-read string $namespace
 * @package Nette\Caching
 */
class NCache extends NObject implements ArrayAccess
{
	/** dependency */
	const PRIORITY = 'priority',
		EXPIRATION = 'expire',
		EXPIRE = 'expire',
		SLIDING = 'sliding',
		TAGS = 'tags',
		FILES = 'files',
		ITEMS = 'items',
		CONSTS = 'consts',
		CALLBACKS = 'callbacks',
		ALL = 'all';

	/** @internal */
	const NAMESPACE_SEPARATOR = "\x00";

	/** @var ICacheStorage */
	private $storage;

	/** @var string */
	private $namespace;

	/** @var string  last query cache used by offsetGet() */
	private $key;

	/** @var mixed  last query cache used by offsetGet()  */
	private $data;


	public function __construct(ICacheStorage $storage, $namespace = NULL)
	{
		$this->storage = $storage;
		$this->namespace = $namespace . self::NAMESPACE_SEPARATOR;
	}


	/**
	 * Returns cache storage.
	 * @return ICacheStorage
	 */
	public function getStorage()
	{
		return $this->storage;
	}


	/**
	 * Returns cache namespace.
	 * @return string
	 */
	public function getNamespace()
	{
		return (string) substr($this->namespace, 0, -1);
	}


	/**
	 * Returns new nested cache object.
	 * @param  string
	 * @return NCache
	 */
	public function derive($namespace)
	{
		$derived = new self($this->storage, $this->namespace . $namespace);
		return $derived;
	}


	/**
	 * Reads the specified item from the cache or generate it.
	 * @param  mixed key
	 * @param  callable
	 * @return mixed|NULL
	 */
	public function load($key, $fallback = NULL)
	{
		$data = $this->storage->read($this->generateKey($key));
		if ($data === NULL && $fallback) {
			return $this->save($key, new NCallback($fallback));
		}
		return $data;
	}


	/**
	 * Writes item into the cache.
	 * Dependencies are:
	 * - NCache::PRIORITY => (int) priority
	 * - NCache::EXPIRATION => (timestamp) expiration
	 * - NCache::SLIDING => (bool) use sliding expiration?
	 * - NCache::TAGS => (array) tags
	 * - NCache::FILES => (array|string) file names
	 * - NCache::ITEMS => (array|string) cache items
	 * - NCache::CONSTS => (array|string) cache items
	 *
	 * @param  mixed  key
	 * @param  mixed  value
	 * @param  array  dependencies
	 * @return mixed  value itself
	 * @throws InvalidArgumentException
	 */
	public function save($key, $data, array $dependencies = NULL)
	{
		$this->release();
		$key = $this->generateKey($key);

		if ($data instanceof NCallback || $data instanceof Closure) {
			$this->storage->lock($key);
			$data = NCallback::create($data)->invokeArgs(array(& $dependencies));
		}

		if ($data === NULL) {
			$this->storage->remove($key);
		} else {
			$this->storage->write($key, $data, $this->completeDependencies($dependencies, $data));
			return $data;
		}
	}


	private function completeDependencies($dp, $data)
	{
		if (is_object($data)) {
			$dp[self::CALLBACKS][] = array(array(__CLASS__, 'checkSerializationVersion'), get_class($data),
				NClassReflection::from($data)->getAnnotation('serializationVersion'));
		}

		// convert expire into relative amount of seconds
		if (isset($dp[NCache::EXPIRATION])) {
			$dp[NCache::EXPIRATION] = NDateTime53::from($dp[NCache::EXPIRATION])->format('U') - time();
		}

		// convert FILES into CALLBACKS
		if (isset($dp[self::FILES])) {
			//clearstatcache();
			foreach (array_unique((array) $dp[self::FILES]) as $item) {
				$dp[self::CALLBACKS][] = array(array(__CLASS__, 'checkFile'), $item, @filemtime($item)); // @ - stat may fail
			}
			unset($dp[self::FILES]);
		}

		// add namespaces to items
		if (isset($dp[self::ITEMS])) {
			$dp[self::ITEMS] = array_unique(array_map(array($this, 'generateKey'), (array) $dp[self::ITEMS]));
		}

		// convert CONSTS into CALLBACKS
		if (isset($dp[self::CONSTS])) {
			foreach (array_unique((array) $dp[self::CONSTS]) as $item) {
				$dp[self::CALLBACKS][] = array(array(__CLASS__, 'checkConst'), $item, constant($item));
			}
			unset($dp[self::CONSTS]);
		}

		if (!is_array($dp)) {
			$dp = array();
		}
		return $dp;
	}


	/**
	 * Removes item from the cache.
	 * @param  mixed  key
	 * @return void
	 */
	public function remove($key)
	{
		$this->save($key, NULL);
	}


	/**
	 * Removes items from the cache by conditions.
	 * Conditions are:
	 * - NCache::PRIORITY => (int) priority
	 * - NCache::TAGS => (array) tags
	 * - NCache::ALL => TRUE
	 * @return void
	 */
	public function clean(array $conditions = NULL)
	{
		$this->release();
		$this->storage->clean((array) $conditions);
	}


	/**
	 * Caches results of function/method calls.
	 * @param  mixed
	 * @return mixed
	 */
	public function call($function)
	{
		$key = func_get_args();
		return $this->load($key, create_function('', 'extract($GLOBALS[0]['.array_push($GLOBALS[0], array('function'=>$function,'key'=> $key)).'-1], EXTR_REFS);
			return NCallback::create($function)->invokeArgs(array_slice($key, 1));
		'));
	}


	/**
	 * Caches results of function/method calls.
	 * @param  mixed
	 * @param  array  dependencies
	 * @return NClosure
	 */
	public function wrap($function, array $dependencies = NULL)
	{
		$cache = $this;
		return create_function('', 'extract($GLOBALS[0]['.array_push($GLOBALS[0], array('cache'=>$cache,'function'=> $function,'dependencies'=> $dependencies)).'-1], EXTR_REFS);
			$_args=func_get_args(); $key = array($function, $_args);
			$data = $cache->load($key);
			if ($data === NULL) {
				$data = $cache->save($key, NCallback::create($function)->invokeArgs($key[1]), $dependencies);
			}
			return $data;
		');
	}


	/**
	 * Starts the output cache.
	 * @param  mixed  key
	 * @return NCachingHelper|NULL
	 */
	public function start($key)
	{
		$data = $this->load($key);
		if ($data === NULL) {
			return new NCachingHelper($this, $key);
		}
		echo $data;
	}


	/**
	 * Generates internal cache key.
	 *
	 * @param  string
	 * @return string
	 */
	protected function generateKey($key)
	{
		return $this->namespace . md5(is_scalar($key) ? $key : serialize($key));
	}


	/********************* interface ArrayAccess ****************d*g**/


	/**
	 * Inserts (replaces) item into the cache (ArrayAccess implementation).
	 * @param  mixed key
	 * @param  mixed
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function offsetSet($key, $data)
	{
		$this->save($key, $data);
	}


	/**
	 * Retrieves the specified item from the cache or NULL if the key is not found (ArrayAccess implementation).
	 * @param  mixed key
	 * @return mixed|NULL
	 * @throws InvalidArgumentException
	 */
	public function offsetGet($key)
	{
		$key = is_scalar($key) ? (string) $key : serialize($key);
		if ($this->key !== $key) {
			$this->key = $key;
			$this->data = $this->load($key);
		}
		return $this->data;
	}


	/**
	 * Exists item in cache? (ArrayAccess implementation).
	 * @param  mixed key
	 * @return bool
	 * @throws InvalidArgumentException
	 */
	public function offsetExists($key)
	{
		$this->release();
		return $this->offsetGet($key) !== NULL;
	}


	/**
	 * Removes the specified item from the cache.
	 * @param  mixed key
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function offsetUnset($key)
	{
		$this->save($key, NULL);
	}


	/**
	 * Discards the internal cache used by ArrayAccess.
	 * @return void
	 */
	public function release()
	{
		$this->key = $this->data = NULL;
	}


	/********************* dependency checkers ****************d*g**/


	/**
	 * Checks CALLBACKS dependencies.
	 * @param  array
	 * @return bool
	 */
	public static function checkCallbacks($callbacks)
	{
		foreach ($callbacks as $callback) {
			if (!call_user_func_array(array_shift($callback), $callback)) {
				return FALSE;
			}
		}
		return TRUE;
	}


	/**
	 * Checks CONSTS dependency.
	 * @param  string
	 * @param  mixed
	 * @return bool
	 */
	private static function checkConst($const, $value)
	{
		return defined($const) && constant($const) === $value;
	}


	/**
	 * Checks FILES dependency.
	 * @param  string
	 * @param  int
	 * @return bool
	 */
	private static function checkFile($file, $time)
	{
		return @filemtime($file) == $time; // @ - stat may fail
	}


	/**
	 * Checks object @serializationVersion label.
	 * @param  string
	 * @param  mixed
	 * @return bool
	 */
	private static function checkSerializationVersion($class, $value)
	{
		return NClassReflection::from($class)->getAnnotation('serializationVersion') === $value;
	}

}
