<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 16/08/2017
 * Time: 15:07
 */

namespace JHD\Framework;

use Symfony\Component\HttpFoundation\Request;

abstract class Controller
{
    use Twig, DoctrineEntityManager, SymfonyForm, SwiftMailer;

    /**
     * @param Request $request
     */
    abstract function action(Request $request);
}