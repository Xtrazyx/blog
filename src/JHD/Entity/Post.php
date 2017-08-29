<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 25/08/2017
 * Time: 13:01
 */

namespace JHD\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @ORM\Entity
 */
class Post
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
    private $dateLastModif;

    /**
     * @ORM\Column(type="string", length=600)
     */
    private $intro;

    /**
     * @ORM\Column(type="string", length=3000)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     * @var ArrayCollection $comments
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

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
    public function getDateLastModif()
    {
        return $this->dateLastModif;
    }

    /**
     * @param \datetime $dateLastModif
     */
    public function setDateLastModif($dateLastModif)
    {
        $this->dateLastModif = $dateLastModif;
    }

    /**
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * @param string $intro
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
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
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment $comment
     */
    public function addComment(Comment $comment)
    {
        $this->comments->add($comment);
    }

}