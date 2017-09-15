<?php

//session_start();
//echo $_SESSION['member_id'];
//echo "<br>";
//echo $_GET['id'];

//require_once "../../Model/Connection.php";
require_once "Model/CRUD.php";
require_once "Model/BlogModel.php";

//require_once "mainheader.php";
//require_once "banner.php";

//$myconn = new Connection();
//$conn = $myconn->dbConnect();
//var_dump($conn);
$blogobj = new BlogModel();
//var_dump($blogobj);

$blogcrud = new CRUD();
//echo "<br>";
//var_dump($blogobj);

$blogobj->setId($_GET['id']);
//echo $blogobj->id;
//echo "<br>";

$res = $blogcrud->selectOneBlog($blogobj);
//var_dump($res);
//echo "<br>";
//var_dump($blogobj->id);
//$blogobj->setHeading()

$val = "";
foreach ($res as $val){
//    var_dump($val['id']);
//    echo "<br><br>";
}

$heading = $val['heading'];
$content = $val['content'];
$summary = $val['summary'];
$memberId = $_SESSION['member_id'];
$categoryid = $val['name'];
//echo $categoryid;

$flag = true;
if(isset($_POST['submit'])){
    if(empty($_POST['heading']) || $_POST['heading'] == " " || $_POST['heading'] == null){
        $flag = false;
        echo "Enter heading" . "<br>";
//                            echo "no heading";
    }
    else{
        $heading = $_POST['heading'];
        $blogobj->setHeading($heading);
    }

    if ($_POST['content'] == "" || $_POST['content'] == " "){
        $flag = false;
        echo "Enter content" . "<br>";
    }
    else{
        $content = $_POST['content'];
        $blogobj->setContent($content);
    }

    if ($_POST['summary'] == "" || $_POST['summary'] == " "){
        $flag = false;
        echo "Enter summary" . "<br>";
    }
    else{
        $summary = $_POST['summary'];
        $blogobj->setSummary($summary);
    }

    if ($_SESSION['member_id'] == "" || $_SESSION['member_id'] == " "){
        $flag = false;
        echo "Enter member id" . "<br>";
    }
    else{
        $memberId = $_SESSION['member_id'];
        $blogobj->setMemberId($memberId);
    }

    if ($categoryid == "" || $categoryid == " "){
        echo "Enter category id" . "<br>";
    }
    else{
        $catid = $categoryid;
        $blogobj->setCategoryId($catid);
    }

    if($flag == true){
        date_default_timezone_set('America/Toronto');
        $date = date('Y-m-d H:i:s');

        $blogobj->setDateCreated($date);

        $res = $blogcrud->editMyBlog($blogobj);
        $count = $res->rowcount();

//        header('Location:myblogs.php');
    }
}

?>

    <div  id="containerField" class="container">
        <div class="row">

            <section id="recent" class="col-sm-8">
                <div id ="recent_title" class="row">
                    <h2 class="col-xs-8">Edit Blog</h2>
                    <div class="col-xs-4">
                        <p id="recent_online">100 people online</p>
                    </div>
                </div> <br>

<!--                <div><h2>Edit Blog</h2></div>-->
                <div class="col-sm-3">
                    <a href="?controller=blog&action=index"><button type="button" class="btn btn-default">View All Blogs</button></a>
                </div>
                <div class="col-sm-offset-6 col-sm-3">
                    <a href="?controller=blog&action=myblog"><button type="button" class="btn btn-default">Show Me My Blogs</button></a>
                </div>
                <br><br>
<!--                <div class="recent_iconList"><span class="label label-mentor"><a style="color: white" href="allblogs.php">View All Blogs</a></div>-->
<!--                <div class="recent_iconList"><span class="label label-mentor"><a style="color: #fff" href="myblogs.php">My Blogs</a></div>-->
                <br><br>
                <!--///////////////////////////////////////////////blog form ///////////////////////////////////////////////-->
                <script src="ckeditor/ckeditor.js"></script>
                <div class="table-responsive">
                    <form action="#" method="post">
                        <label for="heading">Blog Heading</label>
                        <input class="form-control" type="text" name="heading" id="heading" value="<?php echo $heading; ?>">
                        <br><br>

                        <label for="content">Blog Content</label>
<!--                        <input class="form-control" type="text" name="content" id="content" value="--><?php //echo $content; ?><!--">-->
                        <textarea class="form-control" rows="5" cols="20" id="content" name="content"><?php echo $content; ?></textarea>
                        <script>CKEDITOR.replace('content');</script>
                        <br><br>

                        <label for="summary">Blog Summary</label>
                        <input class="form-control" type="text" name="summary" id="summary" value="<?php echo $summary; ?>">
                        <br><br>

<!--                        <label for="memberid">Memeber Id</label>-->
<!--                        <input class="form-control" type="text" name="memberid" id="memberid" value="--><?php //echo $memberId ?><!--" readonly>-->
<!--                        <br><br>-->

                        <label for="catid">Category Id</label>
                        <input class="form-control" type="text" name="catid" id="catid" value="<?php echo $categoryid; ?>" readonly>
                        <br><br>

                        <input class="btn btn-default" type="submit" name="submit" value="Submit">
                    </form>

                    <?php
                        echo empty($count) ? '' : $count . " row updated";
                    ?>
                </div>
            </section><!--END recent-->

<!--            --><?php // include_once "right-section.php";?>

        </div>
    </div><!--END containerField -->


<?php //require_once "footer.php"; ?>