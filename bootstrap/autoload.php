<?php

function pacman_cms_autoload($classPath)
{
	exit($classPath);

  $filePath = dirname(__FILE__) . '/' . implode('/', $classPath) . '.php';
  
  
  
	// require the file if found
	if (is_file($filePath))
	{
		require_once($filePath);
	}
}

spl_autoload_register('pacman_cms_autoload');