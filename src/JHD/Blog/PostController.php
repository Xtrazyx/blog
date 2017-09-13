<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 31/08/2017
 * Time: 15:31
 */

namespace JHD\Blog;

use JHD\Entity\Post;
use JHD\Framework\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function action(Request $request)
    {
        $em = $this->getEntityManager();

        $id = $request->request->get('id');
        $post = $em->getRepository(Post::class)->find($id);

        $this->render('post.html.twig', array(
            'post' => $post
        ));
    }
}