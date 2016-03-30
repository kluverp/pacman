<?php

class Translator 
{
	/**
	 * The translations cache array
	 * @var array
	 */
	private $translations = [];
	
	/**
	 * Holds the locale (subfolder) in "translations" directory
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
			$this->setTranslationsCache($file);
		}
			
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
	private function setTranslationsCache($file = '')
	{
		// get translations array and set cache
		if ( $translations = $this->parseIniFile(APP_PATH . 'translations/'. $this->getLocale() .'/'. $file . '.ini') )
		{
			return $this->translations[$file] = $this->flattenArray($translations);
		}
		
		return false;
	}
			
	/**
	 * Check if file exists, and parses the *.ini file
	 *
	 * @param string $filePath		The path to the ini file
	 * 
	 * @return array
	 */
	private function parseIniFile($filePath = '')
	{
		// check for file and parse .ini
		if ( is_file($filePath) )
		{
			return parse_ini_file($filePath, true);
		}
		
		Throw new Exception('Cannot locate translations file: "'. $filePath .'"');
	}
	
	/**
	 * Recursively iterates over the array and creates a flat array with
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