<?php

namespace Pacman\lib;

use Pacman\lib\DB\DB;
use Pacman\lib\Input\Input;
use Pacman\lib\Uri\Uri;
use Pacman\lib\Session\Session;
use Pacman\lib\Router\Router;

class App
{
	/**
	 * The libraries container
	 *
	 * @var array
	 */
	private $libraries = [];
	
	/**
	 * Application start time
	 *
	 * @var int
	 */
	private $startTime = null;
	
	/**
	 * Class Constructor
	 */
	public function __construct()
	{
		$this->startTime = microtime(true);
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
		$this->lib('uri', new Uri(FC_PATH));
		$this->lib('router', new Router(Uri::getInstance()));
		$this->lib('translator', new \Pacman\lib\Translator\Translator());
		$this->lib('input', Input::getInstance());
		$this->lib('session', Session::getInstance());
		
		// set old input
		$this->lib('input')->setOldInput();
		
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
	
		// show stats if in debug mode
		if ( defined('APP_DEBUG') && APP_DEBUG === true )
		{
			$this->stats();
		}
		
		return true;
	}
	
	/**
	 * Prints statistics to screen
	 *
	 * @return string
	 */
	private function stats()
	{
		$totalTime = round((microtime(true) - $this->startTime), 2);
		$memory = memory_get_usage() / 1024;
		
		printf('
		<pre>
		================================================================================
		*                                Stats                                         *
		================================================================================
		Execution time:		%s s
		--------------------------------------------------------------------------------
		Memory: 		%s kb		
		--------------------------------------------------------------------------------
		</pre>', $totalTime, $memory);
	}
}