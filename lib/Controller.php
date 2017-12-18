<?php

namespace Pacman\lib;

use Pacman\lib\View\View;
use Pacman\lib\Menu\Menu;

class Controller
{
	protected $HTMLTitle = '';
	protected $layout    = 'default';
	protected $template  = '';
	protected $styles    = array();
	protected $scripts   = array();
	protected $data      = array();
	
	/**
	 * Returns page HTML Title
	 *
	 * @return string
	 */
	protected function getHTMLTitle()
	{
		return $this->HTMLTitle;
	}
	
	/**
	 * Set page HTML Title
	 *
	 * @return string
	 */
	protected function setHTMLTitle($title = '')
	{
		return $this->HTMLTitle = $title;
	}

	/**
	 * Returns the current layout
	 *
	 * @return string
	 */
	public function getLayout()
	{
		return $this->layout;
	}	
	
	/**
	 * Set layout template
	 *
	 * @return string
	 */
	protected function setLayout($layout = '')
	{
		return $this->layout = $layout;
	}
		
	/**
	 * Loads a 404 error page
	 *
	 */
	public function show404()
	{
		$this->setHTMLTitle('Page not found');
		$this->output('404', array(), 404);
	}

	/**
	 * Output the view to screen
	 *
	 */
	protected function output($template = '', $data = array(), $response_code = 200)
	{
		// set template
		$this->template = realpath(view($template . '.php'));
		
		if ( ! is_file($this->template) )
		{
			throw new Exception(__FILE__ . ' => template file \''. $this->template .'\' does not exists!');
		}
					
		// set response code
		http_response_code($response_code);
				
		// load the view
		$html = View::make(view('_system/_layout.php'), array(
			'template'    => $this->template,
			'styles'      => $this->getStyles(),
			'scripts'     => $this->getScripts(),
			'layout'      => $this->getLayout(),
			'HTMLTitle'   => $this->getHTMLTitle(),
			'breadcrumbs' => $this->getBreadcrumbs(),
			'menu'        => $this->getMenu(),
			'data'        => $data
		));
				
		echo $html;
	}
		
	/**
	 * Returns the styles array
	 *
	 * @return array
	 */
	public function getStyles()
	{
		return $this->styles;
	}
	
	/**
	 * Returns the scripts array
	 *
	 * @return array
	 */
	public function getScripts($loc = 'header')
	{
		// check if entry exists
		if ( isset($this->scripts[$loc]) )
		{
			return $this->scripts;
		}
		
		return $this->scripts;
	}
		
	/**
	 * Returns an array with key => value pairs where key 
	 * holds the url to where the crumb (value) points to.
	 *
	 * @return array
	 */
	public function getBreadcrumbs()
	{
		return [];
	}
	
	/**
	 * Returns the menu
	 *
	 */
	public function getMenu()
	{
		return Menu::make();
	}
}