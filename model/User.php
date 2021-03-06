<?php

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This is a test
 * 
 * @ODM\Document
 */
class User
{
    /** @ODM\Id */
    private $id;

    /** @ODM\String */
    private $name;


    /**
     * @ODM\ReferenceMany(targetDocument="BlogPost", cascade="all")
     * @var $posts ArrayCollection;
     */
    private $posts;

    /**
     * User constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param BlogPost $blogPost
     * @return $this
     */
    public function addPost(BlogPost $blogPost)
    {
        $this->posts = new ArrayCollection();
        $this->posts->add($blogPost);
        return $this;
    }
    
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }
    

}
