<?php
//session_start();

//require_once 'mainheader.php';
//require_once 'banner.php';
require_once "Model/CRUD.php";
//require_once "Controller/NoteCrud.php";

//$myconn = new Connection();
//$conn = $myconn->dbConnect();

//if(isset($_SESSION['member_id'])){
//    echo $_SESSION['member_id'];
//}else{
//    echo "session value not available";
//}

$noteCrud = new CRUD();
$allNotesById = $noteCrud->viewAllNotes($_SESSION['member_id']);

//    var_dump($notesval['title']);
//}

?>



<div  id="containerField" class="container">
    <div class="row">

        <section id="recent" class="col-sm-8">
            <div id ="recent_title" class="row">
                <h2 class="col-xs-8">My Notes</h2>
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

<!--            section content starts here-->
            <section id="content">
                <div class="row">
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=create"><button type="button" class="btn btn-default">Add New Note</button></a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=noteshare"><button type="button" class="btn btn-default">Share Notes</button></a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=sharednote"><button type="button" class="btn btn-default">View Shared Notes</button></a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=index"><button type="button" class="btn">Show Me My Notes</button></a>
                    </div>
<!--                    <div class="col-sm-3">-->
<!--                        <a href="?controller=sharenote&action=index"><button type="button" class="btn btn-default">Show Me My Note</button></a>-->
<!--                    </div>-->
                </div> <!--end of mentor name row-->
                <br>


                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped">
<!--                            <tr><th>All Notes</th></tr>-->
<!--                            <tr><td id = "mentor-topics">-->

                            <?php
                                foreach ($allNotesById as $notesval) {
                                    echo "<tr><td>" . $notesval['title'] . "<br>&emsp;&emsp;";
                                    echo "<i style='font-size: smaller;color: #757575;'>" . date("y-m-d",strtotime($notesval['date_created'])) . "</i></td></tr>";
//                                    echo $notesval['title'];
                                }
                            ?>
<!--                                </td></tr>-->
                        </table>
                    </div>
                </div> <!--end of mentor/mentee row-->
            </section>

        </section><!--END of recent section-->

<!--        --><?php //require_once "right-section.php";?>

    </div>
</div><!--END of containerField -->



<?php //require_once 'footer.php';?>
