<?php

//namespace Pacman;

require_once(LIB_PATH . 'Config/Config.php');
require_once(LIB_PATH . 'Uri.php');
require_once(LIB_PATH . 'Input.php');

class App
{
	private $router = null;
	private $translator = null;
	private $input = null;
	
	/**
	 * Class Constructor
	 */
	public function __construct()
	{
		$this->startTime = microtime();
	}
	
	/**
	 * The router instance
	 *
	 * @var array
	 */
	private $container = array();
	
	/**
	 * Init the Application
	 *
	 */
	public function init()
	{
		// create new objects
		$this->lib('router', new Router());
		$this->lib('translator', new Translator());
		$this->lib('input', Input::getInstance());
		
		// set database
		DB::setInstance('default', MYSQL_HOST, MYSQL_SCHEMA, MYSQL_USERNAME, MYSQL_PASSWORD);
	}
	
	/**
	 * Gets or sets the required object
	 *
	 * @return mixed
	 */
	public function lib($key = '', $instance = null)
	{
		// set the given obj
		if (is_object($instance) )
		{
			return $this->container[$key] = $instance;
		}
		
		// returns the requested obj
		if ( isset($this->container[$key]) )
		{
			return $this->container[$key];
		}
		
		return false;
	}

	/**
	 * Run the Application
	 */
	public function run()
	{
		try
		{
			$this->lib('router')->route();
		}
		catch (Exception $e )
		{
			switch($e->getCode())
			{
				case 200:
					exit('Routing: '. $e->getMessage());
				break;
				default: 
					exit(sprintf('Error: "%s"', $e->getMessage()));
			}
		}
	}
}