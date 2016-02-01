<?php

class Config
{
    // object instance
    private static $instance = null;
	
	private $tables = false;
	private $config = false;

    private function __clone() {}

	public function __construct()
	{
	}
	
	
	public static function getInstance()
	{
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }
	
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
			$config = include($file);
			
			// add the tablename to config file
			$config['table'] = $filename;
			
			return $instance->tables[$filename] = $config;
		}
		
		throw new Exception('Missing table configuration for: "'. $file .'"');
	}

	public static function get($filename = '')
	{
		$instance = self::getInstance();
		
		if ( isset($instance->config[$filename]) )
		{
			return $instance->config[$filename];
		}
		
		$file = CONFIG_PATH . $filename . '.php';
		
		if ( is_file($file) )
		{
			$config = include($file);
			return $instance->config[$filename] = $config;
		}
		
		throw new Exception('Config could not be found: "'. $file .'"');
		
	}
}