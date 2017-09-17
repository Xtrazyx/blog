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

class PostListController extends Controller
{
    public function action(Request $request)
    {
        $em = $this->getEntityManager();
        $posts = $em->getRepository(Post::class)->findBy(
            array(),
            array('dateLastModif' => 'DESC')
        );

        $this->render('posts_list.html.twig', array(
            'posts' => $posts,
            'posts_page' => 'active'
        ));
    }
}