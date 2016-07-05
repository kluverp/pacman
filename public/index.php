<?php

// start session
session_start();

// paths
define('FC_PATH', dirname(str_replace('\\', '/', __DIR__)));
define('ROOT_PATH', realpath(__DIR__ .'/../') . '\\');
define('LIB_PATH', ROOT_PATH .'lib/');
define('APP_PATH', ROOT_PATH .'app/');
define('CONFIG_PATH', APP_PATH . 'config/');
define('CONTROLLER_PATH', APP_PATH .'controllers/');

// determine the protocol used (we check for 'HTTPS' since 'REQUEST_SCHEME' is unreliable
$protocol = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
define('BASE_PATH', $protocol . preg_replace('/\/+/', '/', $_SERVER['HTTP_HOST'] .'/'. dirname(dirname(str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']))) . '/'));

// require the resources
if ( ! is_file(ROOT_PATH . '.env.php') )
{
	exit('".env.php" file not found! Please add to root of project!');
}

// register autoloader
require_once(ROOT_PATH . 'bootstrap/autoload.php');

// require the resources
require_once(ROOT_PATH . '.env.php');
require_once(LIB_PATH . 'helpers.php');

// start the app
$app = new Pacman\lib\App();
$app->init();
$app->run();