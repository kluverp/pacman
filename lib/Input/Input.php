<?php

namespace Pacman\lib\Input;

use Pacman\lib\Singleton;

class Input extends Singleton
{
	/**
	 * Returns the input variable in order of precedence (GET, POST, COOKIE)
	 *
	 * @return mixed
	 */
	public static function get($key = '', $default = false)
	{
		if ( isset($_GET[$key]) )
		{
			return self::clean($_GET[$key]);
		}
		elseif ( isset($_POST[$key]) )
		{
			return self::clean($_POST[$key]);
		}
		elseif(isset($_COOKIE[$key]))
		{
			return self::clean($_COOKIE[$key]);
		}
		
		return $default;
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
	
	private static function clean($value = '')
	{
		return $value;
	}
}