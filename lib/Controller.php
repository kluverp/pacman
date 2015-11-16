<?php

class Controller
{
	protected $HTMLTitle = '';
	protected $layout = 'default';
	protected $template = '';
	protected $styles = array();
	protected $scripts = array();
	
	protected function getHTMLTitle()
	{
		return $this->HTMLTitle;
	}
	
	protected function setHTMLTitle($title = '')
	{
		return $this->HTMLTitle = $title;
	}
	
	protected function setLayout($layout = '')
	{
		return $this->layout = $layout;
	}
	
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
				
		// set global data
		$breadcrumbs    = $this->getBreadcrumbs();
		$menu = Menu::make();
		
		// set response code
		http_response_code($response_code);
		
		foreach ( $data as $k => $v )
		{
			$this->$k = $v;
		}
				
		include(view('_system/_layout.php'));
	}
		
	public function renderMenu()
	{
		return 'asfjskldfj';
	}
	
	/**
	 * Returns an array with key => value pairs where key 
	 * holds the url to where the crumb (value) points to.
	 *
	 * @return array
	 */
	public function getBreadcrumbs()
	{
		return array(
			'foobar' => 'Projecten',
			'1'      => 'Project X',
			'2'      => 'Dit is het item'
		);
	}
}