<?php

namespace Pacman\lib\Config;

use Pacman\lib\Singleton;
use Pacman\lib\Config\TableConfig;

class Config extends Singleton
{
	/**
	 * The tables array
	 * @var array
	 */
	private $tables = false;
	
	/**
	 * The config array
	 * @var array
	 */
	private $config = false;
	
	/**
	 * Instance
	 */
	protected static $instance = null;
	
	/**
	 * Returns the table configuration
	 *
	 * @return array
	 */
	public static function table($filename = '')
	{
		// get singleton instance
		$instance = self::getInstance();
		
		// check cache
		if ( isset($instance->tables[$filename]) )
		{
			return $instance->tables[$filename];
		}
		
		// get the filepath
		$file = CONFIG_PATH . 'tables/' . $filename . '.php';
		
		// check file
		if ( is_file($file) )
		{
			// create new TableConfig obj
			$tableConfig = new TableConfig($filename, include($file));
			
			return $instance->tables[$filename] = $tableConfig;
		}
		
		throw new Exception('Missing table configuration for: "'. $file .'"');
	}

	/**
	 * Returns the config for given filename
	 *
	 * @param string $filename
	 * @return array
	 */
	public static function get($filename = '')
	{
		$instance = self::getInstance();
		
		// check if we already cached this config
		if ( isset($instance->config[$filename]) )
		{
			return $instance->config[$filename];
		}
		
		// get filepath
		$file = CONFIG_PATH . $filename . '.php';
		
		if ( is_file($file) )
		{
			$config = include($file);
			return $instance->config[$filename] = $config;
		}
		
		throw new Exception('Config could not be found: "'. $file .'"');
		
	}
}