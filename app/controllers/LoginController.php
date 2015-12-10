<?php

require_once(APP_PATH . 'controllers/BaseController.php');

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
		$this->output('login');
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
}
