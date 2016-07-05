<?php

namespace Pacman\lib\Uri;

use Pacman\lib\Singleton;

class Uri extends Singleton
{
	/**
	 * The URI segments array
	 * @var array
	 */
	private $segments = array();
	
	/**
	 * The system path to the Front-Controller index.php file
	 *
	 * @var string
	 */
	private $FC_PATH = '';
	
	/**
	 * Class constructor
	 * 
	 * @param $FC_PATH The absolute path to the Front-Controller file. This so we can
	 * built the relative path to the web root.
	 */
	public function __construct()
	{	
		// set Front-Controller path
		$this->setFC_PATH(FC_PATH);

		// create the uri segments array
		$this->setSegments();
	}
		
	/**
	 * Sets the uri segments array
	 *
	 * @return array
	 */
	private function setSegments()
	{
		// set documentRoot
		$documentRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
		
		// create path relative to front-controller, url decode to handle spaces and stuff
		$fcFullPath  = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . urldecode($_SERVER['REQUEST_URI']);

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
	public static function segments()
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
	
	/**
	 * Set the Front-Controller path
	 * URL Decodes the path, to handle special chars like spaces
	 * 
	 * @return string
	 */
	private function setFC_PATH($FC_PATH = '')
	{
		return $this->FC_PATH = urldecode($FC_PATH);
	}
}

