<?php

//namespace PacMan\Cookie;

//use PacMan\Singleton;

require_once('/../Singleton.php');
require_once('/../Crypt/Crypt.php');

class Cookie extends Singleton
{
	/**
	 * Name of the cookie in the browser
	 * @var string
	 */
	private $cookieName = 'pcmn';
	
	/**
	 * Array containing cookie values (acts as container)
	 * @var array
	 */
	private $cookieValues = [];
	
	/**
	 * Class Constructor
	 */
	protected function __construct()
	{	
		$cookieName = $this->getCookieName();
	
		// set cookie values if found
		if (!empty($_COOKIE[$cookieName]))
		{
			$this->cookieValues = unserialize(Crypt::decrypt($_COOKIE[$cookieName]));
		}
	}
	
	/**
	 * Set a cookie value
	 *
	 * @param string $key 
	 * @param string $value
	 * @return bool
	 */
	public static function set($key = '', $value = false)
	{
		// check for valid array key
		if ( empty($key) )
		{
			return false;
		}
		
		// get the instance
		$instance = static::getInstance();
		
		// add value to cookie array
		$instance->addCookieValue($key, $value);
		
		// set the cookie
		return setcookie($instance->getCookieName(), $instance->getCookieValues(), $instance->getExpireTime(), '/');
	}
	
	/**
	 * Returns the Cookie value requested
	 *
	 * @return mixed
	 */
	public static function get($key = '', $default = false)
	{
		// get singleton instance
		$obj = static::getInstance();
		
		// return value if array key is set
		if ( isset($obj->cookieValues[$key]) )
		{
			return $obj->cookieValues[$key];
		}
		
		return $default;
	}
	
	/**
	 * Returns all cookie values at once
	 *
	 * @return array
	 */
	public static function all()
	{
		$obj = static::getInstance();
		
		return $obj->cookieValues;
	}
	
	/**
	 * Add cookie value to the stack
	 *
	 * @return mixed
	 */
	private function addCookieValue($key = '', $value = false)
	{
		return $this->cookieValues[$key] = $value;
	}
	
	/**
	 * Returns the cookie values as serialized array
	 * 
	 * @return string
	 */
	private function getCookieValues()
	{
		return Crypt::encrypt(serialize($this->cookieValues));
	}
	
	/**
	 * Returns the cookie name as is visible in browser
	 * 
	 * @return string
	 */
	private function getCookieName()
	{
		return $this->cookieName;
	}
	
	/**
	 * Returns the Expiration time in seconds
	 * 
	 * @return int
	 */
	private function getExpireTime()
	{
		return time() + 3600 * 24 * 60;
	}
}