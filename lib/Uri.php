<?php


class Uri
{
	private static $instance = null;
	
	private $segments = array();
	
	private $parsedUrl = '';
	
	public function __construct($url = '')
	{
		$this->parsedUrl = parse_url($url);		
		$this->setSegments();

		/*
		parse_url()
		rawurldecode();
		http_build_query();
		segments() // gebruik parse_url()
		*/
		
	}
	
	
	
	public static function getInstance()
	{
		if ( self::$instance === null )
		{
			$uri = new self($_SERVER['REQUEST_URI']);
			
			self::$instance = $uri;
		}
		
		return self::$instance;
	}
	
	public function setSegments()
	{
		$documentRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
		$rootPath = str_replace('\\', '/', realpath(ROOT_PATH));

		$root = str_replace($documentRoot, '',  $rootPath);
						
		$foo = str_replace($root, '', trim($_SERVER['REQUEST_URI'], '/'));
		
		$foo = parse_url ($foo, PHP_URL_PATH);
			
		$segments = explode('/', trim($foo, '/'));
								
		$this->segments = $segments;
	}
	
	public static function getSegments()
	{
		return self::getInstance()->segments;
	}

	public static function segment($n = 0)
	{
		$uri = self::getInstance();

		return isset($uri->segments[$n]) ? $uri->segments[$n] : false;
	}
}

