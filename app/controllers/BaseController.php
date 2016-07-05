<?php

namespace Pacman\app\controllers;

use Pacman\lib\Controller;
use Pacman\lib\Auth\Auth;

/**
 * BaseController
 *
 * Loads and initializes all defeault Controller actions
 */
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
