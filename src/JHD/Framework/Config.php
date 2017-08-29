<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 22/08/2017
 * Time: 15:10
 */

namespace JHD\Framework;

use Symfony\Component\Yaml\Yaml;

class Config
{
    private $configs = array();

    const CONFIG_PATH = ROOT_DIR . 'app/Config/app_config.yml';
    const ROUTES_PATH = ROOT_DIR . 'app/Config/routes.yml';

    public function __construct()
    {
        // YAML config parsing
        $this->configs = Yaml::parse(file_get_contents(self::CONFIG_PATH));
    }

    /**
     * @return array
     * @param $key string
     */
    public function getConfigsByKey($key)
    {
        return $this->configs[$key];
    }

}