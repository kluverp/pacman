<?php


class Uri
{
	/**
	 * Holds our Singleton obj
	 * @var obj
	 */
	private static $instance = null;
	
	/**
	 * The URI segments array
	 * @var array
	 */
	private $segments = array();
	
	private $parsedUrl = '';
	
	/**
	 * Class constructor
	 * 
	 * @param $url The uri to parse
	 */
	public function __construct()
	{
		// create the uri segments array
		$this->setSegments();
	}
	
	/**
	 * Returns the Singleton instace
	 *
	 * @return Obj
	 */
	public static function getInstance()
	{
		if ( self::$instance === null )
		{
			$uri = new self();
			
			self::$instance = $uri;
		}
		
		return self::$instance;
	}
	
	/**
	 * Sets the uri segments array
	 *
	 * @return array
	 */
	public function setSegments()
	{
		$documentRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
		$rootPath = str_replace('\\', '/', realpath(ROOT_PATH));

		$root = rawurlencode(ltrim(str_replace($documentRoot, '',  $rootPath), '/'));

		$foo = str_replace($root, '', trim($_SERVER['REQUEST_URI'], '/'));

		$foo = parse_url ($foo, PHP_URL_PATH);

		$segments = explode('/', trim($foo, '/'));
										
		return $this->segments = $segments;
	}
	
	/**
	 * Returns the uri segments array
	 *
	 * @return array
	 */
	public static function getSegments()
	{
		return self::getInstance()->segments;
	}

	/**
	 * Retrieves segment n from URI
	 *
	 * @return mixed string/bool
	 */
	public static function segment($n = 0)
	{
		// get singleton
		$uri = self::getInstance();

		// return segment if it exists, false otherwise
		return isset($uri->segments[$n]) ? $uri->segments[$n] : false;
	}
}

