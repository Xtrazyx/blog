<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 31/08/2017
 * Time: 15:31
 */

namespace JHD\Blog;

use JHD\Form\ContactType;
use JHD\Framework\Controller;
use Swift_Message;
use Symfony\Component\HttpFoundation\Request;

class BadRouteController extends Controller
{
    public function action(Request $request)
    {
        $this->render('error404.html.twig');
    }
}