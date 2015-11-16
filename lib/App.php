<?php

require_once(ROOT_PATH . 'lib/Config.php');
require_once(ROOT_PATH . 'lib/Uri.php');

class App
{
	public $router;
	
	function init()
	{
		$this->router = new Router();
		
		// set database
		DB::setInstance('default', MYSQL_HOST, MYSQL_SCHEMA, MYSQL_USERNAME, MYSQL_PASSWORD);
	}
		
	function run()
	{	
		try
		{
			$this->router->route();
		}
		catch (Exception $e )
		{
			exit(sprintf('Routing error: "%s"', $e->getMessage()));
		}
	}
}