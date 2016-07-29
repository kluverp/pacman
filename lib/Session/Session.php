<?php

namespace Pacman\lib\Session;

use Pacman\lib\Singleton;

class Session extends Singleton
{
	/**
	 * The session key to store all data under
	 * @var string
 	 */
	private $sessionKey = '_PCMN';
	
	/**
	 * Singleton instance
	 * @var object
	 */
	protected static $instance = null;
	
	/**
	 * Returns true if requested $key is found 
	 *
	 * @param string $key
	 * @return bool
	 */
	public static function has($key = '')
	{
		return static::getInstance()->hasVar($key);
	}
	
	/**
	 * Set a session variable
	 *
	 * @param string $key
	 * @param mixed $var
	 *
	 * @return mixed
	 */
	public static function set($key = '', $var = '')
	{
		return static::getInstance()->setVar($key, $var);
	}

	/**
	 * Get a session variable
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */	
	public static function get($key = '')
	{
		return static::getInstance()->getVar($key);
	}
	
	/**
	 * Get a session variable and removes it
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */	
	public static function pull($key = '')
	{
		return static::getInstance()->pullVar($key);
	}
	
	/**
	 * Set a session variable
	 *
	 * @param string $key
	 * @param mixed $var
	 *
	 * @return mixed
	 */	
	public function setVar($key = '', $var = false)
	{
		if ( $key && $var )
		{
			return $_SESSION[$this->sessionKey][$key] = $var;
		}
		
		return false;
	}

	/**
	 * Get a session variable
	 *
	 * @param string $key
	 * @param mixed $var
	 *
	 * @return mixed
	 */	
	public function getVar($key = '')
	{
		if ( isset($_SESSION[$this->sessionKey][$key]) )
		{
			return $_SESSION[$this->sessionKey][$key];
		}
		
		return false;
	}
	
	/**
	 * Check if a session variable exists
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */	
	public function hasVar($key = '')
	{
		if ( !empty($_SESSION[$this->sessionKey][$key]) )
		{
			return true;
		}
		
		return false;
	}
	
	/**
	 * get a session variable and removes it
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */	
	public function pullVar($key = '')
	{
		if ( isset($_SESSION[$this->sessionKey][$key]) )
		{
			$msg = $_SESSION[$this->sessionKey][$key];
			
			unset($_SESSION[$this->sessionKey][$key]);
			
			return $msg;
		}
		
		return false;
	}
}