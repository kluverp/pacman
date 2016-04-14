<?php

class Translator 
{
	/**
	 * The translations cache array
	 *
	 * @var array
	 */
	private $translations = [];
	
	/**
	 * Holds the locale (subfolder) in "translations" directory
	 *
	 * @var string
	 */
	private $locale = 'nl';
	

	/**
	 * Class Constructor
	 *
	 * @param string $locale
	 */
	public function __construct($locale = false)
	{
		// set locale
		if ( $locale )
		{
			$this->setLocale($locale);
		}
	}
		
	/**
	 * Returns the translation for given label
	 *
	 * @return string
	 */
	public function translate($path = '')
	{
		$parts = explode('.', $path);
		$file  = array_shift($parts);
		$path  = implode('.', $parts);
								
		// set cache if not already present
		if ( !isset($this->translations[$file]) )
		{
			$this->setTranslations($file);
		}
			
		return $this->getTranslation($file, $path);
	}
	
	/**
	 * Check if the given translation key exists and 
	 * return it's value
	 *
	 * @param string $path
	 * @return string
	 */
	private function getTranslation($file = '', $path = '')
	{
		// return the translation
		if ( isset($this->translations[$file][$path]) )
		{
			return $this->translations[$file][$path];
		}
		
		return $path;
	}
	
	/**
	 * Set the locale folder
	 * 
	 * @return string
	 */
	public function setLocale($locale = '')
	{
		return $this->locale = $locale;
	}
	
	/**
	 * Returns the current locale folder
	 *
	 * @return string
	 */
	public function getLocale()
	{
		return $this->locale;
	}
	
	/**
	 * Set the translations array
	 *
	 * @return array
	 */
	private function setTranslations($filename = '')
	{
		// get translations array and set cache
		if ( $translations = $this->parseFile($this->getFilePath($filename)) )
		{
			return $this->translations[$filename] = $translations;
		}
		
		return false;
	}
	
	/**
	 * Returns the path to translations file
	 *
	 * @return string
	 */
	private function getFilePath($filename = '')
	{
		return APP_PATH . 'translations/'. $this->getLocale() .'/'. $filename . '.php';
	}
			
	/**
	 * Check if file exists, and parses the *.ini file
	 *
	 * @param string $filePath		The path to the ini file
	 * 
	 * @return array
	 */
	private function parseFile($filePath = '')
	{
		// check for file and parse .ini
		if ( is_file($filePath) )
		{
			return $this->flattenArray(include($filePath));
		}
		
		throw new Exception(__CLASS__ . ': Cannot locate translations file: "'. $filePath .'"');
	}
	
	/**
	 * Recursively iterates over the array and creates a flat array with keys
	 * 
	 * @param array $array 
	 * @param string $separator
	 * 
	 * @return array
	 */
	private function flattenArray($array, $separator = '.')
	{
		$result = [];
		
		// init recursive iterator
		$arrayIterator = new RecursiveArrayIterator($array);
		$iterator = new RecursiveIteratorIterator($arrayIterator, RecursiveIteratorIterator::SELF_FIRST);

		// create flat array separated by $separator
		foreach($iterator as $key => $value)
		{
			// reset the key if depth is 0
			$strKey = ( $iterator->getDepth() === 0 ) ? '' : $strKey;

			// if value is array, increase key level
			// otherwise add the last key and set the value
			if ( is_array($value) )
			{
				$strKey .= $key . $separator;
			}
			else
			{
				$result[strtolower($strKey . $key)] = $value;
			}
		}
		
		return $result;
	}
}