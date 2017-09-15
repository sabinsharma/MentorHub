<?php

//session_start();
/*require_once "../../Model/Connection.php";
require_once "../../Controller/BlogCrud.php";*/
require_once "Model/BlogModel.php";
require_once "Model/CRUD.php";

/*require_once "mainheader.php";
require_once "banner.php";*/

/*$myconn = new Connection();
$conn = $myconn->dbConnect();*/

$blogobj = new BlogModel();

$blogcrud = new CRUD();
$res = $blogcrud->viewAllBlogs($blogobj);
$blogid = $_GET['id'];
$blogobj->setId($blogid);
//echo $blogid;
$myblog = $blogcrud->selectOneBlog($blogobj);
//var_dump($myblog);

$val = "";
?>



<div  id="containerField" class="container">
    <div class="row">

        <section id="recent" class="col-sm-8">
            <div id ="recent_title" class="row">
                <h2 class="col-xs-8">Blog Details</h2>
                <div class="col-xs-4">
                    <p id="recent_online">100 people online</p>
                </div>
            </div> <br>

<!--            <div><h2>Create Blog</h2></div>-->
            <div class="col-sm-offset-1 col-sm-3">
                <a href="?controller=blog&action=index"><button type="button" class="btn btn-default">View All Blogs</button></a>
            </div>
            <div class="col-sm-offset-5 col-sm-3">
                <a href="?controller=blog&action=myblog"><button type="button" class="btn btn-default">Show Me My Blogs</button></a>
            </div>
            <br><br><br>

<!--            <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                start blog view-->
                    <article id="recent_art01" class="row">
                        <div class="col-sm-12">
                            <?php
                            foreach ($myblog as $val){
                                echo "<h1>" . $val['heading'] . "</h1>";
                                echo "<br>";
                                echo "<p>" . $val['content'] . "</p>";
                            } ?>
                        </div>
                    </article>
<!--                end blog view-->

<!--            </div>-->
    <!-- END 2nd right -->


        </section><!--END recent-->



    </div>
</div><!--END containerField -->



