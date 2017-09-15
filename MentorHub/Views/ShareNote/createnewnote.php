<?php
//session_start();

//$mentorId = $_SESSION['member_id'];
//echo $mentorId;

//require_once 'mainheader.php';
//require_once 'banner.php';

//require_once "../../Model/Connection.php";
require_once "Model/CRUD.php";
require_once "Model/NoteModel.php";

//$myconn = new Connection();
//$conn = $myconn->dbConnect();
$noteCrud = new CRUD();
$noteModel = new NoteModel();

$flag = true;
if(isset($_POST['submit'])){
    if(empty($_POST['title'])) {
        $flag = false;
        $message = "Please Enter Title";
    }
    elseif (empty($_POST['notecontent'])){
        $flag = false;
        $message = "Please Enter Content";
    }
    elseif (empty($_POST['image'])){
        $flag = false;
        $message = "Please Upload Image";
    }
    elseif (empty($_SESSION['member_id'])){
        $flag = false;
        $message = "Please Login Again";
    }
    else{
        $noteModel->setTitle($_POST['title']);
        $noteModel->setContent($_POST['notecontent']);
        $noteModel->setImage($_POST['image']);
        $noteModel->setCreatorId($_SESSION['member_id']);

        date_default_timezone_set('America/Toronto');

        $date = date('Y-m-d H:i:s');
        $noteModel->setDateCreated($date);
        $result = $noteCrud->createNewNote($noteModel);
        $message = "Your note has been created";
    }

}

//if($flag == true && isset($_POST['submit'])){
//    header('Location:notes.php');
//    header("Location:notes.php");
//    var_dump($result);
//}


?>

<!--<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>-->
<!--<script>-->
<!--    tinymce.init({-->
<!--        selector: '#notecontent'-->
<!--    });-->
<!--</script>-->

<div  id="containerField" class="container">
    <div class="row">

        <section id="recent" class="col-sm-8">
            <div id ="recent_title" class="row">
                <h2 class="col-xs-8">Create New Note</h2>
                <div class="col-xs-4">
                    <p id="recent_online">100 people online</p>
                </div>
            </div>
            <!--            <br><br>-->

            <!--            form starts-->
            <div class="row">
                <!--                <div class="col-sm-1"></div>-->

            </div>
            <br>
            <!--            form ends-->
<!--            <div class="col-sm-offset-9 col-sm-3">-->
<!--                <a href="?controller=sharenote&action=index"><button type="button" class="btn btn-default">Back to my notes</button></a>-->
<!--            </div>-->
            <div class="col-sm-3">
                <a href="?controller=sharenote&action=create"><button type="button" class="btn">Add New Note</button></a>
            </div>
            <div class="col-sm-3">
                <a href="?controller=sharenote&action=noteshare"><button type="button" class="btn btn-default">Share Notes</button></a>
            </div>
            <div class="col-sm-3">
                <a href="?controller=sharenote&action=sharednote"><button type="button" class="btn btn-default">View Shared Notes</button></a>
            </div>
            <div class="col-sm-3">
                <a href="?controller=sharenote&action=index"><button type="button" class="btn btn-default">Show Me My Notes</button></a>
            </div>
            <!--            section content starts here-->
            <section>
                <div class="row">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3">
<!--                        <button type="button" class="btn btn-danger" onclick="location.href='addnewnote.php';">Add New Note</button>-->
                    </div>
                </div> <!--end of mentor name row-->
                <br>


                <div class="row">
                    <div class="col-sm-12">
<!--                        form starts here-->
                        <section>
                            <script src="ckeditor/ckeditor.js"></script>
<!--                            <h2>Horizontal form</h2>-->
                            <form class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="title">Title:</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="notecontent">Content:</label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" name="notecontent" class="form-control" id="notecontent" placeholder="Enter Content"></textarea>
                                        <script>CKEDITOR.replace('notecontent');</script>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="image">Image:</label>
                                    <div class="col-sm-10">
<!--                                        <img src="../../Assests/image/profile.png" alt="profile" width="100" height="100">-->
                                        <input type="file" name="image" class="form-control" id="image"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" name="submit" class="btn btn-default"/>
                                    </div>
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <span><?php echo isset($message) ? $message : ''; ?></span>
                                </div>
                            </form>
                        </section>

<!--                                                form ends here-->
                    </div>
                </div> <!--end of mentor/mentee row-->
            </section>

        </section><!--END of recent section-->

<!--        --><?php //require_once "right-section.php";?>

    </div>
</div><!--END of containerField -->

<?php //require_once 'footer.php';?>
