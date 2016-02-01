<?php

require_once(ROOT_PATH . 'lib/Auth.php');
require_once(ROOT_PATH . 'lib/Crypt.php');

class BaseController extends Controller
{
	public function __construct()
	{
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
