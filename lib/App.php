<?php

namespace Pacman\lib;

use Pacman\lib\DB\DB;
use Pacman\lib\Input\Input;
use Pacman\lib\Uri\Uri;
use Pacman\lib\Session\Session;
use Pacman\lib\Router\Router;

class App
{
    /**
     * Application start time
     *
     * @var int
     */
    private $startTime = null;

    /**
     * Instance container
     *
     * @var array
     */
    private $container = array();

    /**
     * Class Constructor
     */
    public function __construct()
    {
        // set start time
        $this->startTime = microtime(true);
    }

    /**
     * Init the Application
     *
     * @return void
     */
    public function init()
    {
        // set exception handler
        set_exception_handler([$this, 'handleException']);

        // create new objects
        $this->lib('uri', new Uri(FC_PATH));
        $this->lib('router', new Router($this->lib('uri')));
        $this->lib('translator', new \Pacman\lib\Translator\Translator());
        $this->lib('input', Input::getInstance());
        $this->lib('session', Session::getInstance());

        // set old input
        $this->lib('input')->setOldInput();

        // set database connection
        DB::setInstance('default', MYSQL_HOST, MYSQL_SCHEMA, MYSQL_USERNAME, MYSQL_PASSWORD);
    }

    /**
     * Get or set library instance
     *
     * @param string $key
     * @param null $instance
     * @return bool|mixed|null
     */
    public function lib($key = '', $instance = null)
    {
        // set the given obj
        if (is_object($instance)) {
            return $this->container[$key] = $instance;
        }

        // returns the requested obj
        if (isset($this->container[$key])) {
            return $this->container[$key];
        }

        return false;
    }

    /**
     * Handle exception
     *
     * @param \Throwable $e
     */
    public function handleException(\Throwable $e)
    {
        echo sprintf("<h1>Exception</h1><p>(%s) %s</p>", $e->getCode(), $e->getMessage());
    }

    /**
     * Run the Application
     */
    public function run()
    {
        // try to route the page
        echo $this->lib('router')->route();
                
        // show stats if in debug mode
        if (defined('APP_DEBUG') && APP_DEBUG === true) {
            $this->stats();
        }

        return true;
    }

    /**
     * Prints statistics to screen
     *
     * @return string
     */
    private function stats()
    {
        $seconds = (microtime(true) - $this->startTime);
        $unit = 's';
        if($seconds < 1) {
            $seconds = $seconds * 1000;
            $unit = 'ms';
        }
        $memory = memory_get_usage() / 1024;

        printf('
		<pre>
		================================================================================
		*                                Stats                                         *
		================================================================================
		Execution time:		%s %s
		--------------------------------------------------------------------------------
		Memory: 		%s kb
		--------------------------------------------------------------------------------
		</pre>', $seconds, $unit, $memory);
    }
}