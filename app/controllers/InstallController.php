<?php

namespace Pacman\app\controllers;

/**
 * Install Controller
 *
 */
class InstallController extends BaseController
{
	/**
	 * Class Constructor
	 */
	public function __construct()
	{
		// set template layout and page title
		$this->setLayout('empty');
		$this->setHTMLTitle('Installer');
	}
	
	public function getIndex()
	{
		echo 'Installing...';
		
		//return $this->output('test');
	}
	
	private function createCryptKey()
	{
		'FxDk51OfoEHeKxetudkKonEKURnqLDLJ';
	}
}