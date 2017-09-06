<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 16/08/2017
 * Time: 15:07
 */

namespace JHD\Framework;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    use RenderTwig, DoctrineEntityManager, SymfonyForm, SwiftMailer;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    abstract function action();

    /**
     * @param $url string
     */
    public function redirect($url)
    {
        $response = new RedirectResponse($url);
        $response->send();
    }
}