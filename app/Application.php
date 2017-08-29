<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 11/08/2017
 * Time: 15:21
 */

namespace JHD\app;

use JHD\Framework\Router;
use Symfony\Component\HttpFoundation\Request;


class Application
{
    protected $request;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }

    public function run()
    {
        // Setting routes from YML
        $router = new Router;
        $router->setRoutes();

        // Getting controller from matching url route
        $url = $this->request->getRequestUri();
        $controller = $router->getController($url);

        // Adding route vars to the request
        $this->request->request->add($router->getRoute($url)->getVars());

        // Actioning controller
        $controller->action($this->request);
    }
}