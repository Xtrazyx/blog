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

class IndexController extends Controller
{
    public function action()
    {
        $formFactory = $this->getFormFactory();

        $form = $formFactory->create(ContactType::class);
        $form->handleRequest($this->request);

        if($form->isSubmitted() && $form->isValid())
        {
            $contact = $form->getData();
            $content ='';

            foreach ($contact as $key => $value)
            {
                $content .= '<p>' . $key . ': ' . $value . '<p/>';
            }

            $mailer = $this->getMailer();
            $message = (new Swift_Message('Blog - Contact'))
                ->setFrom(['xtrazyx@gmail.com' => 'Julien HABERT'])
                ->setTo(['xtrazyx@gmail.com'])
                ->setBody($content)
                ->setContentType('text/html')
                ->setCharset('utf-8')
            ;
            $mailer->send($message);

            $this->redirect('/');
        }

        $this->render('index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}