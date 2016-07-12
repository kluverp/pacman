<?php

namespace Pacman\lib\Auth;

use Pacman\lib\Singleton;
use Pacman\lib\DB\DB;
use Pacman\lib\Crypt\Crypt;

class Auth extends Singleton
{
	/**
	 * The user record
	 * @var array
	 */
	private static $user = null;
	
	/**
	 * Retrieve the user record if set after successful login
	 *
	 * @return mixed
	 */
	public static function user()
	{
		// check if user is found
		if ( self::$user !== null)
		{
			return self::$user;
		}
		
		return false;
	}
	
	/**
	 * Attempt to login the user
	 *
	 * @param string username
	 * @param string password
	 * @return mixed
	 */
	public static function attempt($username = '', $password = '')
	{					
		// get a valid user record
		if ( ! $row = DB::fetch('SELECT * FROM `'. AUTH_TABLE .'` WHERE `'.AUTH_USERNAME_COL.'` = ? AND `'.AUTH_PASSWORD_COL.'` = ? LIMIT 1', array($username, sha1($password))) )
		{
			return self::$user = false;
		}
									
		// set session for later use
		$_SESSION['user'] = Crypt::encrypt($username);
		$_SESSION['pass'] = Crypt::encrypt($password);
		
		// set user and return
		return self::$user = $row[0];
	}
	
	/**
	 * Protect the current path
	 *
	 * @return mixed
	 */
	public static function protect()
	{
		// get email + user from cookie
		// decrypt the vars (add encryp/decrypt to this class)
		// set user if found
		if(isset($_SESSION['user']) && isset($_SESSION['pass']))
		{
			$user = Crypt::decrypt($_SESSION['user']);
			$pass = Crypt::decrypt($_SESSION['pass']);
						
			// attempt login
			self::attempt($user, $pass);
		}

		// get logged in user
		if ( ! self::user() )
		{
			return self::toLogin();
		}
		
		return true;
	}
	
	/**
	 * redirect the user to login screen
	 *
	 * @return void
	 */
	public static function toLogin()
	{
		redirect('login', 301);
		exit;
	}
	
	/**
	 * Logout the user by destroying the session
	 *
	 * @return void
	 */
	public static function logout()
	{
		// destroy session data
		session_destroy();
		
		// destroy cookie data
		// todo
		
		return self::toLogin();
	}
	
}