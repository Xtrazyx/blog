<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 31/08/2017
 * Time: 15:31
 */

namespace JHD\Blog;

use JHD\Entity\Post;
use JHD\Form\AddPostType;
use JHD\Framework\Controller;
use Swift_Message;

class AddPostController extends Controller
{
    public function action()
    {
        $formFactory = $this->getFormFactory();
        $em = $this->getEntityManager();

        $post = new Post();

        $form = $formFactory->create(AddPostType::class);
        $form->handleRequest($this->request);

        if($form->isSubmitted() && $form->isValid())
        {
            $post = $form->getData();
            $em->persist($post);
            $em->flush();

            $this->redirect('/posts');
        }

        $this->render('add_post.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}