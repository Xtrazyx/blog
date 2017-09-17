<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 31/08/2017
 * Time: 15:31
 */

namespace JHD\Blog;

use JHD\Form\ContactType;
use JHD\Framework\Config;
use JHD\Framework\Controller;
use Swift_Message;
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
            $content = '';

            foreach ($contact as $key => $value)
            {
                $content .= '<p>' . $key . ': ' . $value . '<p/>';
            }

            $config = new Config();
            $email = $config->getConfigsByKey('swift_mailer')['setFrom'];
            $name = $config->getConfigsByKey('swift_mailer')['name'];

            $message = (new Swift_Message('Blog - Contact'))
                ->setFrom([$email => $name])
                ->setTo([$email])
                ->setBody($content)
                ->setContentType('text/html')
                ->setCharset('utf-8')
            ;

            $mailer = $this->getMailer();
            $mailer->send($message);

            $this->redirect('/');
        }

        $this->render('index.html.twig', array(
            'form' => $form->createView(),
            'home_page' => 'active'
        ));
    }
}