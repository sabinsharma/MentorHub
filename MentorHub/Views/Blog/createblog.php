<?php


//if(!empty($_SESSION['member_id'])){
//    echo $_SESSION['member_id'];
//}
//else{
//    echo "no session";
//}

//$_SESSION['member_id'] = 102;

//echo $_SESSION['member_id'];

/*require_once "mainheader.php";
require_once "banner.php";

require_once "../../Model/Connection.php";*/
require_once "Model/BlogModel.php";
require_once "Model/CRUD.php";
/*require_once "../../Controller/BlogCrud.php";*/

/*$myconn = new Connection();
$conn = $myconn->dbConnect();*/

$blogcrud = new CRUD();
$blogobj = new BlogModel();

//unset($heading);
$message = "";
$heading = "";
$content = "";
$summary = "";
$memberId = "";
$catid = "";
$date = "";
$err_msg = "";

$category = $blogcrud->getcategories();

//    var_dump($categoryval);
//    echo "<br><br>";
//    echo $categoryval['id'];
//   echo "<br>";
//}


$flag = true;
if(isset($_POST['submit'])){
    if($_POST['heading'] == "" || $_POST['heading'] == " " || $_POST['heading'] == null){
        $flag = false;
        $message = "Enter heading" . "<br>";
    }
    elseif ($_POST['content'] == "" || $_POST['content'] == " "){
        $flag = false;
        $message = "Enter content" . "<br>";
    }
    elseif ($_POST['summary'] == "" || $_POST['summary'] == " "){
        $flag = false;
        $message =  "Enter summary" . "<br>";
    }
    elseif ($_SESSION['member_id'] == "" || $_SESSION['member_id'] == " "){
        $flag = false;
        $message =  "Enter member id" . "<br>";
    }
    elseif ($_POST['catid'] == "0"){
        $flag = false;
        $message =  "Please select category" . "<br>";
    }
    else{
        $heading = $_POST['heading'];
        $blogobj->setHeading($heading);

        $content = $_POST['content'];
        $blogobj->setContent($content);

        $summary = $_POST['summary'];
        $blogobj->setSummary($summary);

        $memberId = $_SESSION['member_id'];
        $blogobj->setMemberId($memberId);

        $catid = $_POST['catid'];
        $blogobj->setCategoryId($catid);

        date_default_timezone_set('America/Toronto');
        $date = date('Y-m-d H:i:s');
        $blogobj->setDateCreated($date);
        $res = $blogcrud->createBlog($blogobj);
    }


//    if($flag == true && isset($_POST['submit'])){
//
//    }
}

?>

   <!-- <div  id="containerField" class="container">-->
        <div class="row">

            <section id="recent" class="col-md-12">
                <div id ="recent_title" class="row">
                    <h2 class="col-xs-8">Create Blog</h2>
                    <div class="col-xs-4">
                        <p id="recent_online">100 people online</p>
                    </div>
                </div>

<!--                <div><h2>Create Blog</h2></div>-->
                <br>
<!--                <div class="recent_iconList"><span class="label label-mentor"><a style="color: #fff;" href="allblogs.php">View All Blogs</a></span></div>-->
<!--                <br>-->
<!--                <div class="recent_iconList"><span class="label label-mentor"><a style="color: #fff;" href="myblogs.php">My Blogs</a></span></div>-->

                <div class="row">
                <div class="col-md-6">
                    <a href="?controller=blog&action=index"><button type="button" class="btn btn-default">Back To All Blogs</button></a>
                </div>
                <div class="col-md-6">
                    <a href="?controller=blog&action=myblog"><button type="button" class="btn btn-default">Show Me My Blogs</button></a>
                </div>
                </div>
                <br><br><br>

<!--///////////////////////////////////////////////blog form ///////////////////////////////////////////////-->
                <script src="ckeditor/ckeditor.js"></script>
                <div class="table-responsive">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="heading">Blog Heading</label>
                            <input class="form-control" type="text" name="heading" id="heading" value="<?php echo empty($_POST['heading']) ? '' : $_POST['heading']; ?>">

                        <br><br>

                        <label for="content">Blog Content</label>
<!--                        <input class="form-control" type="text" name="content" id="content" value="--><?php //echo empty($_POST['content']) ? '' : $_POST['content']; ?><!--">-->
                        <textarea class="form-control" rows="5" cols="20" id="content" name="content"><?php empty($_POST['catid']) ? '' : $_POST['catid']; ?></textarea>
                        <script>CKEDITOR.replace('content');</script>
                        <br><br>
                        </div>

                        <label for="summary">Blog Summary</label>
                        <input class="form-control" type="text" name="summary" id="summary" value="<?php echo empty($_POST['summary']) ? '' : $_POST['summary']; ?>">
                        <br><br>

<!--                        <label for="memberid">Memeber Id</label>-->
<!--                        <input class="form-control" type="text" name="memberid" id="memberid" value="--><?php //echo $_SESSION['member_id']; ?><!--" readonly>-->
<!--                        <br><br>-->
<!---->
                        <label for="catid">Category Id</label>
                        <select class="form-control" id="catid" name="catid">
                            <option value="0">Select Category</option>
                            <?php
                                foreach ($category as $categoryval){
                                    echo "<option value='" .$categoryval['id'] ."'>" . $categoryval['name']. "</option>";
                                }
                            ?>
                        </select>
<!--                        <input class="form-control" type="text" name="catid" id="catid" value="" readonly>-->
                        <br><br>
<!--                            --><?php //echo isset($_POST['catid']) ? $_POST['catid'] : ""; ?>
<!--                        <label for="date">Date Created</label>-->
<!--                        <input type="text" name="date" id="date" value="--><?php //echo empty($_POST['date']) ? '' : $_POST['date']; ?><!--">-->
<!--                        <br><br>-->

                        <input class="btn btn-default" type="submit" name="submit" value="Submit">
                        <span><?php echo $message; ?></span>
                    </form>

                    <?php
//                        header('location:createblog.php');
//                    $heading = "";
                        echo empty($res)? '' : $res . "row created";
//                    echo $res . "row created";
                    ?>
                </div>
            </section><!--END recent-->

            <?php /* include_once "right-section.php";*/?>

        </div>
    <!--</div>--><!--END containerField -->


<?php /*require_once "footer.php"; */?>