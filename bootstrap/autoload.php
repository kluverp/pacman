<?php

/**
 * Register the autoloader for the CMS classes.
 *
 * @param string $classPath The fully-qualified class name.
 *
 * @return void
 */
spl_autoload_register(function($classPath)
{
	$prefix = 'Pacman';
	
	// does the class use the namespace prefix?
    $len = strlen($prefix);	
    if (strncmp($prefix, $classPath, $len) !== 0)
	{	
        // no, move to the next registered autoloader
        return false;
    }

    // get the relative class name
    $relativePath = substr($classPath, $len);
 
    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = rtrim(ROOT_PATH, '/\\') . str_replace('\\', '/', $relativePath) . '.php';
  
	// require the file if found
	if (is_file($file))
	{
		require_once($file);
	}
});

