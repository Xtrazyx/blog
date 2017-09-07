<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 16/08/2017
 * Time: 12:59
 */

namespace JHD\Framework;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

class Router
{
    protected $routes;
    protected $request;

    const NO_ROUTE = 1;

    public function __construct(Request $request)
    {
        $this->routes = new ArrayCollection;
        $this->request = $request;
    }

    public function setRoutes()
    {
        $routes = Yaml::parse(file_get_contents(Config::ROUTES_PATH));

        // Ajout des routes au routeur
        /**
         * @var $route array
         */
        foreach ($routes as $name => $data)
        {
            $newRoute = new Route($name, $data);
            $this->addRoute($newRoute);
        }
    }

    /**
     * @param Route $route
     */
    public function addRoute(Route $route)
    {
        if (!$this->routes->contains($route))
        {
            $this->routes->add($route);
        }
    }

    public function getController($url)
    {
        $matchedRoute = $this->getRoute($url);
        $controllerClass = $matchedRoute->getBundle() . '\\' . $matchedRoute->getController() . 'Controller';

        if(!class_exists($controllerClass)){
            throw new \Exception('Le contrôleur class: ' . $controllerClass . ' n\'existe pas !');
        }

        return new $controllerClass($this->request);
    }

    /**
     * @param $url string
     * @return Route
     * @throws \Exception
     */
    public function getRoute($url)
    {
        /**
         * @var Route $route
         */
        foreach ($this->routes as $route)
        {
            if (!empty($matches = $this->match($route, $url)))
            {
                if($route->hasVars())
                {
                    $vars = $route->getVars();
                    $varNames = array_keys($vars);

                    // On crée le tableau de variables contenues dans $matches
                    foreach ($matches as $key => $match)
                    {
                        // La première occurence contient la chaîne complète, les suivantes les groupes
                        if ($key !== 0)
                        {
                            $vars[$varNames[$key - 1]] = $match;
                        }
                    }

                    $route->setVars($vars);
                }
                return $route;
            }
        }

        return new Route('no_route',array(
            'url' => '/no_route',
            'controller' => 'BadRoute',
            'bundle' => 'JHD\\Blog',
            'vars' => array('url' => $url)));
    }

    public function match(Route $route, $url)
    {
        $regex = preg_replace('/[\/]/', '\/', $route->getUrl());
        if (preg_match('/^' . $regex . '$/', $url, $matches))
        {
            return $matches;
        }
        else
        {
            // Pas de match sur la route
            return $matches = array();
        }
    }

}