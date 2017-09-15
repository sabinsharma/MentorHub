<?php
//require_once "session.php";

//if(!empty($_SESSION['member_id'])){
//    echo "session_member_id: " . $_SESSION['member_id'];
//}
//else{
//    echo "no session";
//}

/*require_once "../../Model/Connection.php";
require_once "../../Controller/BlogCrud.php";*/
require_once "Model/CRUD.php";
//require_once "Model/BlogModel.php";
//require_once "Model/MemberModel.php";

//require_once "mainheader.php";
//require_once "banner.php";

//$myconn = new Connection();
//$conn = $myconn->dbConnect();
//var_dump($conn);

//$blogobj = new BlogModel();

$blogcrud = new CRUD();

//$memberobj = new MemberModel();
//$memberobj->setId($_SESSION['member_id']);
//var_dump($_SESSION['member_id']);
$mem = $_SESSION['member_id'];

$res = $blogcrud->viewMyBlog($_SESSION['member_id']);
//var_dump($res);

?>


<!--///////////////////////////////////////////container///////////////////////////////////////////-->
<div  id="containerField" class="container">
    <div class="row">

        <section id="recent" class="col-sm-8">
            <div id ="recent_title" class="row">
                <h2 class="col-xs-8">My Blogs</h2>
                <div class="col-xs-4">
                    <p id="recent_online">100 people online</p>
                </div>
            </div>
            <br>
<!--            <div class="recent_iconList"><span class="label label-mentor"><a style="color: #fff;" href="allblogs.php">View All Blogs</a></span></div>-->
            <div class="col-sm-3">
                <a href="?controller=blog&action=index"><button type="button" class="btn btn-default">Back To All Blogs</button></a>
            </div>
            <div class="col-sm-offset-6 col-sm-3">
                <a href="?controller=blog&action=create"><button type="button" class="btn btn-default">Create Blog</button></a>
            </div>
            <br>
<!--            <div class="recent_iconList"><span class="label label-mentor"><a style="color: #fff;" href="create-blog.php">Create Blog</a></span></div>-->

            <br><br>

    <?php
        foreach ($res as $val) {
//            var_dump($val['id']);
            $blid = $val['id'];
            echo
            "<article id=\"recent_art01\" class=\"row\">" .
            "<div class=\"col-xs-1\">" .
//            "<a href=\"#\"><img src=\"../../Assests/image/user.png\" alt=\"thumb01\"></a>" .
            "</div>" .
            "<div class=\"col-xs-10\">" .
            "<h3 class=\"recent_art_title\"><span >" .  substr($val['heading'],0,30) . "..." . "</span></h3>" .
            "<p>" . substr($val['summary'],0,50) . "..." . "</p>" .
            "<p class=\"recent_date\"><span class=\"recent_date-bold\">Memebr Name: </span>" . $val['first_name'] . "</p>" .
            "<p class=\"recent_date\"><span class=\"recent_date-bold\">Posted: </span>" . $val['date_created'] . "</p>" .
            "<p class=\"recent_date\"><span class=\"recent_date-bold\">Category: </span>" . $val['name'] . "</p>" .
            "<a href=\"?controller=blog&action=edit&id=" . $val['id'] . "\">Edit</a>" . "  |  " .
//            "<a href=\"delete.php?id=" . $val['id'] . "\" onclick=\"confirm('Are you sure you want to delete this?')\">Delete</a>" . "  |  ".
//            "<a href=\"#?id=" . $val['id'] . "\" onclick=\"myconfirm('" . $val['id'] . "');\">Delete</a>" . "  |  ".
            "<a href=\"\" onclick=\"myfunction(" . $val['id'] . ");\">Delete</a>" . "  |  ".
            "<a href=\"?controller=blog&action=view&id=" . $val['id'] . "\">View</a>" .
            "</div>" .
            "</article>".
            "<br>";
        }
    ?>
<!--            <a href="#" onclick="myconfirm();">Delete</a>-->
<!--            echo-->
<!--//            "<script>" .-->
<!--//                "function myconfirm(" . $val['i'] .") {" .-->
<!--//                    "$con = confirm('Are you sure want to delete this ?');" .-->
<!--//                    "if($con==true){" .-->
<!--//                        "alert('yes' + blogid);" .-->
<!--//-->
<!--//                    "}" .-->
<!--//                    "else{" .-->
<!--//                        "alert('no');" .-->
<!--//                    "}" .-->
<!--//                "}" .-->
<!--//            "</script>";-->


<?php
//var_dump(json_encode($mem));
//echo "<br>";
//var_dump(json_encode($mem,JSON_FORCE_OBJECT)); ?>

<!--            <div id="recent_more_button" class="center-block">-->
<!--                <p><a href="#">See more</a></p>-->
<!--            </div>-->
            <!--END recent_more_button-->

<!--            <a href="myblogs.php?id=1" onclick="confirm('Are you sure you want to delete this?')">Confirm Delete</a>-->

        </section><!--END recent-->



    </div>
</div><!--END containerField
<!--///////////////////////////////////////////container///////////////////////////////////////////-->

<script>

    function myfunction(blogid) {
        var con=confirm('Are yo sure want to delete blog ?');
        if(con===true){
            $.post('Factory/factory.php',{factory:'deleteBlog',blogid:blogid},function (response) {

            }).fail(function (data) {
                alert(data.message);
            });

        }
        else
        {

        }
    }

</script>
