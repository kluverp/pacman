<?php

/**
 * Different renderers
 *
 * For use in the table class to make up the overview columns
 *
 */
class Renderer()
{
	public static str($value, $length = 10)
	{
		$str = substr($value, 0, $lenght);
		return (strlen($value) > $lenght) ? $str . '...' : $str;
	}
	
	public static date($value, $format = 'Y-m-d')
	{
		return date($format, strtotime($value));	
	}
	
	public function dateTime($value, $format = 'Y-m-d H:i:s')
	{
		return self::date($value);
	}
	
	public function money($value, $format = '')
	{
		return money_format($value);
	}
	
	public function color($value, $colors)
	{
	
	}
}