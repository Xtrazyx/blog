<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 24/08/2017
 * Time: 14:24
 */

namespace JHD\Framework;

trait Twig
{
    // Twig rendering engine
    /**
     * @param $viewPath string
     * @param $vars array
     */
    public function render($viewPath, $vars)
    {
        $config = new Config();
        $twigTemplatePath = ROOT_DIR . $config->getConfigsByKey('twig')['templatePath'];
        $twigOptions = $config->getConfigsByKey('twig')['options'];
        $loader = new \Twig_Loader_Filesystem($twigTemplatePath);
        $twig = new \Twig_Environment($loader, $twigOptions);

        $template = $twig->loadTemplate($viewPath);
        echo $template->render($vars);
    }
}