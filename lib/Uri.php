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
	
	/**
	 * The system path to the Front-Controller php file
	 *
	 * @var string
	 */
	private $FC_PATH = '';
	
	/**
	 * Class constructor
	 * 
	 * @param $url The uri to parse
	 */
	public function __construct($FC_PATH = '')
	{	
		// set Front Controller Path
		$this->FC_PATH = $FC_PATH;
		
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
		// check for new instance
		if ( self::$instance === null )
		{
			self::$instance = new self(FC_PATH);
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
		// set documentRoot
		$documentRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
		
		// create path relative to front-controller
		$fcFullPath  = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . $_SERVER['REQUEST_URI'];

		// replace the system path with empty string, trim first "/"
		$segmentStr = ltrim(str_replace($this->FC_PATH, '', $fcFullPath), '/');

		// set segments
		return $this->segments = explode('/', trim($segmentStr, '/'));
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
		$instance = self::getInstance();

		// return segment if it exists, false otherwise
		return isset($instance->segments[$n]) ? $instance->segments[$n] : false;
	}
}

