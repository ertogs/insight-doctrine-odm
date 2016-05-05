<?php

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ODM\Document */
class User
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
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
}
