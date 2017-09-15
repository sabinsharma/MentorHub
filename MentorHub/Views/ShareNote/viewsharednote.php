<?php
//session_start();

//require_once 'mainheader.php';
//require_once 'banner.php';
//require_once "../../Model/Connection.php";
require_once "Model/CRUD.php";
require_once "Model/NoteShareModel.php";

//$myconn = new Connection();
//$conn = $myconn->dbConnect();
$noteShare = new NoteShareModel();
$noteCrud = new CRUD();

//if(isset($_SESSION['member_id'])){
//echo $_SESSION['member_id'];
//}else{
//    echo "session value not available";
//}

$sharenotes = $noteCrud->viewSharedNotes($_SESSION['member_id']);
//var_dump($sharenotes);

//foreach ($sharenotes as $sharenoteval) {
//    var_dump($sharenoteval);
//}
echo isset($_GET['id']) ? $_GET['id'] : "";

?>


<div  id="containerField" class="container">
    <div class="row">

        <section id="recent" class="col-sm-8">
            <div id ="recent_title" class="row">
                <h2 class="col-xs-8">View Shared Notes</h2>
                <div class="col-xs-4">
                    <p id="recent_online">100 people online</p>
                </div>
            </div>
            <br>

            <!--            section content starts here-->
            <section>
                <div class="row">
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=create"><button type="button" class="btn btn-default">Add New Note</button></a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=noteshare"><button type="button" class="btn btn-default">Share Notes</button></a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=sharednote"><button type="button" class="btn">View Shared Notes</button></a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=index"><button type="button" class="btn btn-default">Show Me My Notes</button></a>
                    </div>
                </div> <!--end of mentor name row-->
                <br>

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>All Notes</th>
                            </tr>
                                <?php
                                    foreach ($sharenotes as $sharenoteval) {
                                        echo "<tr><td><a href='?id=" . $sharenoteval['id'] . "'>" . $sharenoteval['title'] . "</a></td></tr>";
                                    }

//                                    echo $_GET['id'];
                                ?>

                        </table>
                    </div>
                </div> <!--end of mentor/mentee row-->
            </section>
        </section><!--END of recent section-->

<!--        --><?php //require_once "right-section.php";?>
    </div>
</div><!--END of containerField -->

<?php //require_once 'footer.php';?>


