<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 01/09/2017
 * Time: 14:49
 */

namespace JHD\Framework;

trait RenderTwig
{
    use Twig;

    // Twig rendering engine
    /**
     * @param $viewPath string
     * @param $vars array
     */
    public function render($viewPath, $vars)
    {
        $twig = $this->getTwig();

        $template = $twig->loadTemplate($viewPath);
        echo $template->render($vars);
    }
}