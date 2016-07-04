<?php

class Auth extends Singleton
{
	private static $user = null;
	
	private static $table = 'cms_users';
	private static $usernameCol = 'email';
	private static $passwordCol = 'password';
	
	public static function user()
	{
		// check if user is found
		if ( self::$user !== null)
		{
			return self::$user;
		}
		
		return false;
	}
	
	public static function attempt($username = '', $password = '')
	{					
		// get a valid user record
		if ( ! $row = DB::fetch('SELECT * FROM '. AUTH_TABLE .' WHERE '.AUTH_USERNAME_COL.' = ? AND '.AUTH_PASSWORD_COL.' = ? LIMIT 1', array($username, sha1($password))) )
		{
			return self::$user = false;
		}
									
		// set session for later use
		$_SESSION['user'] = Crypt::encrypt($username);
		$_SESSION['pass'] = Crypt::encrypt($password);
		
		// set user and return
		return self::$user = $row[0];
	}
	
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
	
	public static function toLogin()
	{
		redirect('login', 301);
		exit;
	}
	
	public static function logout()
	{
		// destroy session data
		session_destroy();
		
		// destroy cookie data
		// todo
		
		return self::toLogin();
	}
	
}