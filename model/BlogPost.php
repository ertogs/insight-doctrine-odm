<?php

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;


/** @ODM\Document */
class BlogPost
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $title;

    /**
     * BlogPost constructor.
     * @param $title
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

}