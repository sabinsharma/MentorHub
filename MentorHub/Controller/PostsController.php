<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 18/03/2017
 * Time: 3:43 PM
 */
class PostsController
{
    public function index(){
        //$posts=Post::all();

        $list=[];
        //$db=DB::getInstance();
        require_once "Model/CRUD.php";
        $crud=new CRUD();
        $result=$crud->FetchALL('posts',1);
        foreach ($result as $post){
            $list[]=new Post($post['id'],$post['author'],$post['content']);
        }

        require_once('Views/posts/index.php');
    }

    public function show(){
        $list=[];
        if(!isset($_GET['id'])){
            return call('pages','error');
        }
        else
        {
            $id=intval($_GET['id']);
            require_once "Model/CRUD.php";
            $crud=new CRUD();
            $result=$crud->Find('posts',array('id'=>$id));
            //var_dump($result);
            foreach ($result as $post){
                $list[]=new Post($post['id'],$post['author'],$post['content']);
            }
            //var_dump($list);
           // return new Post($result['id'],$result['author'],$result['content']);

            require_once ('Views/posts/show.php');
        }


        //$posts=POST::find($_GET['id']);


    }
}