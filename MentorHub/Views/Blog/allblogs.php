<?php

//session_start();
//if(!empty($_SESSION['member_id'])){
//    echo "session_member_id: " . $_SESSION['member_id'];
//}
//else{
//    echo "no session";
//}


////var_dump($_SESSION);
//if(!empty($_SESSION['member_id'])){
//    echo $_SESSION['member_id'];
//}
//else{
//    echo "no session";
//}

//$_SESSION['member_id'] = 102;
//echo $_SESSION['member_id'];
//echo "<br>";
//$mentorId = $_SESSION['memberId'];

//require_once "../../Model/Connection.php";
//require_once "../../Controller/BlogCrud.php";
require_once "Model/CRUD.PHP";
require_once "Model/BlogModel.php";

/*$myconn = new Connection();
$conn = $myconn->dbConnect();*/
//var_dump($conn);
$blogobj = new BlogModel();
//
//$blogcrud = new BlogCrud();
$blogcrud=new CRUD();
$res = $blogcrud->viewAllBlogs($blogobj);
//var_dump($res);
?>

<!--//undoit-->
<!--///////////////////////////////////////////container///////////////////////////////////////////-->
<div  id="containerField" class="container">
    <div class="row">
        <section id="recent" class="col-sm-8">
            <div id ="recent_title" class="row">
                <h2 class="col-xs-8">All Blogs</h2>
                <div class="col-xs-4">
                    <p id="recent_online">100 people online</p>
                </div>
            </div>
            <br>
<!--            <div class="recent_iconList"><h2 class="">All Blogs</h2></div>-->
<!--            <div><a href="allblogs.php">View All Blogs</a></div>-->
<!--            <div class="recent_iconList"><span class="label label-mentor"><a style="color: #fff;" href="myblogs.php">My Blogs</a></span></div>-->
            <div class="col-sm-offset-9 col-sm-3">
                <a href="?controller=blog&action=myblog"><button type="button" class="btn btn-default">Show Me My Blogs</button></a>
            </div>
            <br><br><br>

            <?php
            foreach ($res as $val) {
//                var_dump($val);
                echo "<article id=\"recent_art01\" class=\"row\">" .
                    "<div class=\"col-xs-1\">" .
//                    "<a href=\"#\"><img src=\"../../Assests/image/user.png\" alt=\"thumb01\"></a>" .
                    "</div>" .
                    "<div class=\"col-xs-10\">" .
                    "<h3 class=\"recent_art_title\">" .  substr($val['heading'],0,30) . "..." . "</h3>" .
                    "<p>" . substr($val['summary'],0,60) . "..." . "</p>" .
                    "<p class=\"recent_date\"><span class=\"recent_date-bold\">Memebr Name: </span>" . $val['first_name'] . "</p>" .
                    "<p class=\"recent_date\"><span class=\"recent_date-bold\">Posted: </span>" . $val['date_created'] . "</p>" .
                    "<p class=\"recent_date\"><span class=\"recent_date-bold\">Category: </span>" . $val['name'] . "</p>" .
                    "<a href=\"?controller=blog&action=view&id=" . $val['id'] . "\">View This Blog</a>" .
                    "</div>" .
                    "</article>".
                    "<br>";
            }
            ?>

<!--            <div id="recent_more_button" class="center-block">-->
<!--                <p><a href="#">See more</a></p>-->
<!--            </div><!--END recent_more_button-->

<!--            start pagination-->
<!--            <div class="row">-->
<!--                <div class="col-sm-offset-4 col-sm-8">-->
<!--                    <ul class="pagination">-->
<!--                        <li class="active"><a href="#">1</a></li>-->
<!--                        <li><a href="#">2</a></li>-->
<!--                        <li><a href="#">3</a></li>-->
<!--                        <li><a href="#">4</a></li>-->
<!--                        <li><a href="#">5</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!--            end pagination-->

        </section><!--END recent-->



    </div>
</div><!--END containerField-->


