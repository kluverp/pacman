<?php

// Start session
session_start();

// Paths
define('ROOT_PATH', __DIR__ .'/../');
define('LIB_PATH', ROOT_PATH .'lib/');
define('APP_PATH', ROOT_PATH .'app/');
define('CONFIG_PATH', APP_PATH . 'config/');
define('CONTROLLER_PATH', APP_PATH .'controllers/');
define('BASE_PATH', 'http://' . $_SERVER['HTTP_HOST'] . dirname(dirname(str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']))) . '/');


// require the resources
if ( ! is_file(ROOT_PATH . '.env.php') )
{
	exit('".env.php" file not found! Please add to root of project!');
}

// require the resources
require_once(ROOT_PATH . '.env.php');
require_once(LIB_PATH . 'helpers.php');
require_once(LIB_PATH . 'DB.php');
require_once(LIB_PATH . 'Model.php');
require_once(LIB_PATH . 'Controller.php');
require_once(LIB_PATH . 'Menu.php');
require_once(LIB_PATH . 'Router.php');
require_once(LIB_PATH . 'App.php');

// start the app
$app = new App();
$app->init();
$app->run();


//$f = new Model();
//$f->title = 'HALLO WERELD';
//echo $f->title('<b>%s</b>');
//echo $f->title('<h1>%s</h1>');

