<?php

//namespace Pacman;

require_once(LIB_PATH . 'Config/Config.php');
require_once(LIB_PATH . 'Uri.php');
require_once(LIB_PATH . 'Input.php');

class App
{
	/**
	 * The router instance
	 */
	public $router;
	public $translator;
	public $input;
	
	/**
	 * Init the Application
	 *
	 */
	public function init()
	{
		// create new router obj
		$this->router     = new Router();
		$this->translator = new Translator();
		$this->input      = Input::getInstance();
		
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