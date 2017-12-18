<?php

namespace Pacman\app\controllers;

use Pacman\lib\Auth\Auth;
use Pacman\lib\Input\Input;
use Pacman\lib\Session\Session;

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
		// in case of valid authentication, send user to dashboard
		if ( Auth::attempt(input('email'), input('password')) )
		{
			return redirect('dashboard');
		}
		
		// set session var
		Session::set('auth_incorrect', true);
		
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
