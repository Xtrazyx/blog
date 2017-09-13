<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 31/08/2017
 * Time: 15:31
 */

namespace JHD\Blog;

use JHD\Entity\Post;
use JHD\Form\EditPostType;
use JHD\Framework\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditPostController extends Controller
{
    public function action(Request $request)
    {
        $formFactory = $this->getFormFactory();
        $em = $this->getEntityManager();

        $post = $em->getRepository(Post::class)->find($request->request->get('id'));

        $form = $formFactory->create(EditPostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $post = $form->getData();
            $post->setdateLastModif(new \DateTime());

            $em->flush();

            $this->redirect('/post-' . $post->getId() . '-' . $this->slug($post->getTitle()));
        }

        $this->render('edit_post.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}