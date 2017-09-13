<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 25/08/2017
 * Time: 13:01
 */

namespace JHD\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @ORM\Entity
 */
class Comment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=600)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     */
    private $post;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \datetime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param \datetime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
    }

}