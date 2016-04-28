<?php

class Breadcrumb
{
	/**
	 * The Crumbs
	 *
	 * @var array
	 */
	private $breadcrumbs = array();

	/**
	 * Class Constructor
	 */
	public function __construct($config)
	{
		// add first item
		$this->add(url('dashboard'), 'Dashboard');
	}
	
	
	public function getTrail()
	{
		return $this->breadcrumbs;
		
		return array(
			'foobar' => 'Projecten',
			'1'      => 'Project X',
			'2'      => 'Dit is het item'
		);
	}
	
	/**
	 * Add a breadcrumb
	 * 
	 * @return string
	 */
	public function add($url = '#', $title = '')
	{
		return $this->breadcrumbs[$url] = $title;
	}


}

