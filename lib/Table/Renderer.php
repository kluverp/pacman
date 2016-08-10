<?php

namespace Pacman\lib\Table;

/**
 * Different renderers
 *
 * For use in the table class to make up the overview columns
 *
 */
class Renderer
{
	/**
	 * Renders a Column value
	 *
	 * @return string
	 */
	public function render($value = '', $renderer = '')
	{
		// if renderer is a function (Closure)
		if ( is_callable($renderer) )
		{
			return $renderer($value);
		}
		
		// if renderer is a string
		if ( is_string($renderer) && $renderer )
		{
			// form the function name
			$fname = explode('|', $renderer);
			$options = isset($fname[1]) ? $fname[1] : false;
					
			$renderFunction = $fname[0] . 'Renderer';
			
			// check if the function exists and return its value
			if ( method_exists($this, $renderFunction) )
			{
				return $this->{$renderFunction}($value, $options);
			}
		}
				
		return $value;
	}
	
	/**
	 * Renders the datetime value
	 *
	 * @param string $value
	 * @param string $options
	 * @return string
	 */	
	public function dateTimeRenderer($value, $format = 'Y-m-d H:i:s')
	{
		return self::date($value);
	}
	
	/**
	 * Renders the value as money
	 *
	 * @param mixed $value
	 * @param string $format
	 * @return string
	 */
	public function moneyRenderer($value, $format = '')
	{
		return money_format($value);
	}
	
	public function colorRenderer($value, $colors)
	{
	
	}
	
	/**
	 * Renders a Boolean value as yes/no
	 */
	private function boolRenderer($value = '')
	{
		return '<span class="rndrr-active-'. ($value ? 'yes' : 'no') .'">'. ($value ? 'Ja' : 'Nee') .'</span>';
	}
	
	/**
	 * Renders a date value to the given Dateformat
	 *
	 * @return string
	 */
	private function dateRenderer($value = '', $format = '%d-%m-Y')
	{
		return strftime($format, strtotime($value));
	}
	
	/**
	 * Show a piece of text of given length. Adds ... to the string if it's longer than given length
	 * 
	 * @return string
	 */
	private function strRenderer($value = '', $limit = 50)
	{
		// strip off spaces and HTML
		$str = trim(strip_tags($value));
		
		// add ellipsis dots if str is longer than given length
		$str = ($limit && strlen($str) > $limit) ? substr($str, 0, $limit) . '...' : $str;
				
		return $str;
	}
	
	/**
	 * Renders text without HTML
	 
	 * @return string
	 */
	private function textRenderer($value = '')
	{
		return trim(strip_tags($value));
	}
}