<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 18/04/2017
 * Time: 6:23 PM
 */
class BlogController
{
     public function index(){
         require_once 'Views/Blog/allblogs.php';
     }

     public function view(){
         require_once 'Views/Blog/blogview.php';
     }

    public function create(){
        require_once 'Views/Blog/createblog.php';
    }

     public function myblog(){
         require_once 'Views/Blog/myblogs.php';
     }

    public function edit(){
        require_once 'Views/Blog/editblog.php';
    }

    public function delete(){
        require_once 'Views/Blog/deleteblog.php';
    }
}