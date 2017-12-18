<?php

namespace Pacman\lib\Router;

use Pacman\lib\Str\Str;
use Pacman\lib\Uri\Uri;

class Router
{
    /**
     * The uri segments
     *
     * @var array
     */
    private $uriSegments = [];

    /**
     * The URI class
     *
     * @var obj
     */
    private $uri = null;

    /**
     * The controller namespace too look in
     *
     * @var const
     */
    const CONTROLLER_NS = '\Pacman\app\controllers\\';

    /**
     * Class Constructor
     */
    public function __construct(Uri $uri)
    {
        // set uri class
        $this->uri = $uri;
    }

    /**
     * Route the call to the correct Controller and
     * method if available
     * If method does not exist, show a 404 page.
     */
    public function route()
    {
        $controller = $this->getController();
        $method = $this->getMethod();

        // check for valid method
        if (method_exists($controller, $method)) {
            $reflection = new \ReflectionMethod($controller, $method);

            if ($reflection->isPublic()) {
                return $controller->$method();
            }
        }

        return $controller->show404();
    }

    /**
     * Returns the controller instance
     *
     * @return object
     */
    private function getController()
    {
        // check for controller name, or default to Base
        if (!$controllerName = ucfirst($this->uri->segment(0))) {
            $controllerName = 'Base';
        }

        // get path to controller class
        $controllerName = $controllerName . 'Controller';
        $controllerPath = CONTROLLER_PATH . $controllerName . '.php';

        // check if the controller file exists
        if (!is_file($controllerPath)) {
            throw new \Exception('Controller "' . $controllerName . '" not found', 200);
        }

        // create full qualified path to controller
        $controller = self::CONTROLLER_NS . $controllerName;

        // return new instance of controller
        return new $controller();
    }

    /**
     * Returnes the first uri segment as method name
     *
     * @return string
     */
    private function getMethod()
    {
        // init
        $method = 'index';
        $prefix = 'get';

        // if a method is found overwrite default
        if ($this->uri->segment(1) !== false) {
            $method = strtolower(Str::ascii($this->uri->segment(1)));
        }

        // prefix each controller function with the request method
        if (in_array($_SERVER["REQUEST_METHOD"], array('GET', 'POST', 'PUT'))) {
            $prefix = strtolower($_SERVER["REQUEST_METHOD"]);
        }

        return $prefix . ucfirst($method);
    }
}