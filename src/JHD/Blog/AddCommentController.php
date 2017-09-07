<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 31/08/2017
 * Time: 15:31
 */

namespace JHD\Blog;

use JHD\Entity\Comment;
use JHD\Entity\Post;
use JHD\Form\AddCommentType;
use JHD\Framework\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddCommentController extends Controller
{
    public function action(Request $request)
    {
        $formFactory = $this->getFormFactory();
        $em = $this->getEntityManager();

        $postId = $request->request->get('post_id');
        $post = $em->getRepository(Post::class)->find($postId);

        $comment = new Comment();

        $form = $formFactory->create(AddCommentType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $comment = $form->getData();
            $post->addComment($comment);

            $em->persist($comment);
            $em->flush();

            $this->redirect('/post-' . $post->getId() . '-' . $this->slug($post->getTitle()));
        }

        $this->render('add_comment.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}