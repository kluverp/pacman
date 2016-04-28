<?php

require_once(ROOT_PATH . 'lib/Auth.php');
require_once(ROOT_PATH . 'lib/Crypt.php');

class BaseController extends Controller
{
	protected $breadcrumb = null;
	
	/**
	 * Class Constructor
	 */
	public function __construct()
	{
		// protect with login
		Auth::protect();
	}
	
	/**
	 * Index function
	 */
	public function index()
	{
		exit('base index');
	}
}
