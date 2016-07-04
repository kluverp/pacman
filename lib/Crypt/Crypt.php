<?php

class Crypt extends Singleton
{
	/**
	 * Encrypt the string
	 *
	 * @return string
	 */
	public static function encrypt($str = '')
	{
		$key = self::getCryptKey();
		
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $str, MCRYPT_MODE_CBC, md5(md5($key))));
	}

	/**
	 * Decrypt the string
	 *
	 * @return string
	 */
	public static function decrypt($str = '')
	{
		$key = self::getCryptKey();
		
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($str), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	}


	/**
	 * Return the en- decrypt key
	 *
	 * @return string
	 */
	private static function getCryptKey()
	{
		if ( !defined('CRYPT_KEY') )
		{
			throw new Exception('CRYPT_KEY not set!');
		}
		
		return CRYPT_KEY;
	}
}

