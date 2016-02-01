<?php

require_once(LIB_PATH . 'Config/Config.php');
require_once(LIB_PATH . 'Uri.php');

class App
{
	/**
	 * The router instance
	 */
	public $router;
	
	/**
	 * Init the Application
	 *
	 */
	public function init()
	{
		// create new router obj
		$this->router = new Router();
		
		// set database
		DB::setInstance('default', MYSQL_HOST, MYSQL_SCHEMA, MYSQL_USERNAME, MYSQL_PASSWORD);
	}
		
	/**
	 * Run the Application
	 */
	public function run()
	{	
		try
		{
			$this->router->route();
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