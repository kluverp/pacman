<?php

require_once(APP_PATH . 'controllers/BaseController.php');

class LoginController extends BaseController
{	
	public function __construct()
	{
		$this->setLayout('empty');
		$this->setHTMLTitle('Login');
	}

	/**
	 * Show login page
	 *
	 * @return view
	 */
	public function index()
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
	
	public function logout()
	{
		return Auth::logout();
	}
}
