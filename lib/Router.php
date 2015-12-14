<?php

class Router 
{	
	/**
	 * Returns the controller instance
	 * 
	 * @return object
	 */
	public function getController()
	{
		// check for controller name, or default to Base
		if ( ! $controllerName = ucfirst(Uri::segment(0)) )
		{
			$controllerName = 'Base';
		}

		// get path to controller class
		$controllerName .= 'Controller';
		$controllerPath = CONTROLLER_PATH . $controllerName . '.php';

		// check if the controller file exists
		if ( ! is_file($controllerPath) )
		{
			$controllerName = 'BaseController';
			$controllerPath = CONTROLLER_PATH . $controllerName . '.php';
			
			throw new Exception('Controller not found', 200);
		}

		// require the Controller class
		require_once($controllerPath);

		return new $controllerName();
	}
	
	/**
	 * Route the call to the correct Controller and
	 * method if available
	 * If method does not exist, show a 404 page.
	 */
	public function route()
	{
		$controller = $this->getController();
		$method     = $this->getMethod();

		// check for valid method
		if ( method_exists( $controller, $method ) )
		{
			$reflection = new ReflectionMethod($controller, $method);
			
			if ($reflection->isPublic())
			{
				return $controller->$method();				
			}
		}
		
		return $controller->show404();
	}
	
	/**
	 * Returnes the first uri segment as method name
	 *
	 * @return string
	 */
	public function getMethod()
	{
		$method = 'index';
		$prefix = 'get';
		
		// if a method is found overwrite default
		if ( Uri::segment(1) !== false) 
		{
			$method = strtolower(Str::ascii(Uri::segment(1)));
		}

		// prefix each controller function with the request method
		if ( in_array($_SERVER["REQUEST_METHOD"], array('GET', 'POST', 'PUT')) )
		{
			$prefix = strtolower($_SERVER["REQUEST_METHOD"]);
		}
		
		return $prefix . ucfirst($method);
	}
}