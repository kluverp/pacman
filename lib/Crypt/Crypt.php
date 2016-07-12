<?php

namespace Pacman\lib\Crypt;

final class Crypt
{
	/**
	 * Encrypt the string
	 *
	 * @param string $str 
	 * @return string
	 */
	public static function encrypt($str = '')
	{
		$key = static::getCryptKey();
		
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $str, MCRYPT_MODE_CBC, md5(md5($key))));
	}

	/**
	 * Decrypt the string
	 *
	 * @param string $str
	 * @return string
	 */
	public static function decrypt($str = '')
	{
		$key = static::getCryptKey();
		
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($str), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	}

	/**
	 * Return the en- decrypt key
	 *
	 * @return string
	 */
	private static function getCryptKey()
	{
		// check if the CRYPT_KEY constant is defined, if not throw error
		if ( !defined('CRYPT_KEY') )
		{
			throw new Exception('CRYPT_KEY not set!');
		}
		
		return CRYPT_KEY;
	}
}

