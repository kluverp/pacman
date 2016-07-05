<?php

namespace Pacman\lib;

use Pacman\lib\DB\DB;

class App
{
	/**
	 * The router instance
	 */
	private $router = null;
	
	/**
	 * The translator instance
	 */
	private $translator = null;
	
	/**
	 * The input instance
	 */
	private $input = null;
	
	/**
	 * Application start time
	 */
	private $startTime = null;
	
	/**
	 * Class Constructor
	 */
	public function __construct()
	{
		$this->startTime = microtime();
	}
	
	/**
	 * The instance container
	 *
	 * @var array
	 */
	private $container = array();
	
	/**
	 * Init the Application
	 *
	 * @return void
	 */
	public function init()
	{
		// create new objects
		$this->lib('router', new \Pacman\lib\Router\Router());
		$this->lib('translator', new \Pacman\lib\Translator\Translator());
		//$this->lib('input', Input::getInstance());
		
		// set database connection
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
			// try to route the page
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