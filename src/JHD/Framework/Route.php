<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 16/08/2017
 * Time: 13:41
 */

namespace JHD\Framework;

class Route
{
    protected $name;
    protected $url;
    protected $controller;
    protected $bundle;
    protected $vars = array();

    public function __construct($name, $data)
    {
        if (isset($data))
        {
            $this->hydrate($name, $data);
        }
    }

    public function hydrate($name, $data)
    {
        $this->name = $name;
        foreach ($data as $key => $value)
        {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function hasVars()
    {
        return !empty($this->vars);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string$name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return array
     */
    public function getVars(): array
    {
        return $this->vars;
    }

    /**
     * @param array $vars
     */
    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }

    /**
     * @return string
     */
    public function getBundle()
    {
        return $this->bundle;
    }

    /**
     * @param String $bundle
     */
    public function setBundle($bundle)
    {
        $this->bundle = $bundle;
    }
}