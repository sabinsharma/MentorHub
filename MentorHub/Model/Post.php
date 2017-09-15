<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 18/03/2017
 * Time: 3:31 PM
 */
class Post
{
    public $id;
    public $author;
    public $content;

    public function __construct($id,$author,$content)
    {
        $this->id=$id;
        $this->author=$author;
        $this->content=$content;
    }


}