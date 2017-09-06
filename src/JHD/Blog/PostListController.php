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

class PostListController extends Controller
{
    public function action()
    {
        $em = $this->getEntityManager();
        $posts = $em->getRepository(Post::class)->findAll();

        $this->render('posts_list.html.twig', array(
            'posts' => $posts
        ));
    }
}