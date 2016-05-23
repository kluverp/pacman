<?php

namespace Pacman\app\controllers;

/**
 * Login Controller
 *
 * Shows the login- and password forgotten screens
 */
class LoginController extends BaseController
{	
	/**
	 * Class Constructor
	 */
	public function __construct()
	{
		// set template layout and page title
		$this->setLayout('empty');
		$this->setHTMLTitle('Login');
	}

	/**
	 * Show login page
	 *
	 * @return view
	 */
	public function getIndex()
	{	
		return $this->output('login/login');
	}
	
	/**
	 * Handles the login POST
	 *
	 * @return redirect
	 */
	public function postIndex()
	{
		if ( Auth::attempt(input('email'), input('password')) )
		{
			return redirect('dashboard');
		}
		
		return Auth::toLogin();
	}
	
	/**
	 * Logout the user
	 */
	public function getLogout()
	{
		return Auth::logout();
	}
	
	/**
	 * Show password-forgotten form
	 *
	 * @return view
	 */
	public function getForgotten()
	{
		return $this->output('login/forgotten');
	}
	
	/**
	 * Handles the password forgotten form
	 *
	 * @return view
	 */
	public function postForgotten()
	{
		
	}
}
