<?php

//require_once(ROOT_PATH . 'lib/Str.php');
use PacMan\lib\Str\Str;

if ( ! function_exists('dd'))
{
	function dd($var)
	{
		if ( func_num_args() > 1 )
		{		
			foreach ( func_get_args() as $arg )
			{
				var_dump($arg);
			}
		}
		else
		{
			var_dump($var);
		}
		
		exit;
	}
}

if ( ! function_exists('snake_case'))
{
	/**
	 * Convert a string to snake case.
	 *
	 * @param  string  $value
	 * @param  string  $delimiter
	 * @return string
	 */
	function snake_case($value, $delimiter = '_')
	{
		return Str::snake($value, $delimiter);
	}
}

if ( ! function_exists('app_path'))
{
}

/**
 * Returns full path to config directory
 *
 * @return string
 */
if ( ! function_exists('config_path'))
{
	function config_path($path = '')
	{
		return preg_replace('#/+#', '/', CONFIG_PATH . $path);
	}
}

if ( ! function_exists('public_path'))
{
}

if ( ! function_exists('lib_path'))
{
}

if ( ! function_exists('img'))
{
	function img($path = '')
	{
		return BASE_PATH . 'public/img/' . $path;
	}
}

/**
 * Format a full URL to given path or array. If 
 * an array is give, the parts are imploded to a string
 * 
 * @param $path mixed Array or String 
 *
 * @return string
 */
if ( ! function_exists('url'))
{
	function url($path = '')
	{
		if ( is_array($path) )
		{
			$path = implode('/', $path);
		}
		
		return BASE_PATH . $path;
	}
}

/**
 * Returns the path to the given view
 *
 * @param string $view
 * @return string
 */
if ( ! function_exists('view'))
{
	function view($path = '')
	{
		return APP_PATH . 'views/'. $path;
	}
}

/**
 * Get a variable from GET, or POST array
 *
 */
if ( ! function_exists('input') )
{
	function input($var = '', $default = false)
	{
		if ( isset($_GET[$var]) && $_GET[$var] )
		{
			return $_GET[$var];
		}
		elseif ( isset($_POST[$var]) && $_POST[$var])
		{
			return $_POST[$var];
		}
		
		return $default;
	}
}

/**
 * Returns a cookie var
 *
 */
if ( ! function_exists('cookie') )
{
	function cookie($var = '', $default = false)
	{
		if ( isset($_COOKIE[$var]) && $_COOKIE )
		{
			return $_COOKIE[$var];
		}
		
		return $default;
	}
}

/**
 * Redirects user to given URL
 *
 */
if ( ! function_exists('redirect') )
{
	function redirect($url = '', $statusCode = 302)
	{
		header(sprintf('Location: %s', url($url)), true, $statusCode);
		exit;
	}
}

if (! function_exists('trans'))
{
    function trans($key = false, $locale = false)
    {
		global $app;
				
		return $app->lib('translator')->translate($key, $locale);
    }
}