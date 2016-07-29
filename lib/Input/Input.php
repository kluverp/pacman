<?php

namespace Pacman\lib\Input;

use Pacman\lib\Singleton;

class Input extends Singleton
{
    /**
	 * The reference to *Singleton* instance of this class
	 *
     * @var Singleton
     */
    protected static $instance = null;
	
	/**
	 * Returns the input variable in order of precedence (GET, POST, COOKIE)
	 *
	 * @return mixed
	 */
	public static function get($key = '', $default = false)
	{
		$inst = static::getInstance();
		
		return $inst->getInput($key, $default);
	}
	
	/**
	 * Returns all Request data
	 *
	 * @return array
	 */
	public static function all()
	{
		return $_REQUEST;	
	}
	
	public static function old($key = '', $default = false)
	{
		$inst = static::getInstance();
		
		return $inst->getOldInput($key, $default);
	}
	
	/**
	 * Returns the input for given key
	 *
	 * @return mixed
	 */
	private function getInput($key, $default)
	{
		// look in GET, POST and COOKIE
		if ( isset($_REQUEST [$key]) )
		{
			return self::clean($_REQUEST [$key]);
		}
		
		return $default;
	}	
	
	/**
	 * Returns the old input field and clears the session entry
	 * after getting it.
	 *
	 * @return mixed
	 */
	public function getOldInput($key = '', $default = false)
	{
		// check if the entry exists
		if ( empty($_SESSION['__input_old']) )
		{
			return $default;
		}

		// get the old input		
		if ( !empty($_SESSION['__input_old'][$key]) )
		{
			// get the value
			$value = $_SESSION['__input_old'][$key];
			
			// remove the entry 
			unset($_SESSION['__input_old'][$key]);
			
			return $value;
		}
				
		return $default;
	}
	
	/**
	 * Store the old input values
	 *
	 * @return array
	 */
	public function setOldInput()
	{
		if (!empty($_REQUEST) )
		{
			return $_SESSION['__input_old'] = $_REQUEST;
		}
		
		return false;
	}
	
	/**
	 * Clean up the input value
	 *
	 */
	private static function clean($value = '')
	{
		return $value;
	}
}