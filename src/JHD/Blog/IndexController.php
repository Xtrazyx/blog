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
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function action(Request $request)
    {
        $formFactory = $this->getFormFactory();

        $form = $formFactory->create(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $contact = $form->getData();

            header('Location: /'); //TODO
        }

        $this->render('index.html.twig', array(
            'form' => $form->createView()
        ));
    }
}