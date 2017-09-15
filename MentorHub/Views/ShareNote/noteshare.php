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

$allNotesById = $noteCrud->viewAllNotes($_SESSION['member_id']);
$allMembers = $noteCrud->getAllMembers($_SESSION['member_id']);

$flag = true;
if(isset($_POST['sendnote']) && $flag == true){
    if($_POST['selectreceiver'] == '0'){
        $flag = false;
       echo "Please select reciever";
    }
    elseif ($_POST['selectnote'] == '0'){
        $flag = false;
        echo "Please select reciever";
    }
    else{
        date_default_timezone_set('America/Toronto');
        $date = date('Y-m-d H:i:s');

//        echo $_SESSION['member_id'];
        $noteShare->setSenderId($_SESSION['member_id']);

//        echo $_SESSION['member_id'];
        $noteShare->setReceivererId($_POST['selectreceiver']);
        $noteShare->setNoteId($_POST['selectnote']);
        $noteShare->setShareDate($date);

        $result = $noteCrud->noteShare($noteShare);
        $message = $result . " note has been shared.";
//        $count = $result->rowcount();
//        var_dump($count);
    }
}
//else{
//    echo "not set";
//}

?>


<div  id="containerField" class="container">
    <div class="row">

        <section id="recent" class="col-sm-8">
            <div id ="recent_title" class="row">
                <h2 class="col-xs-8">Share Notes</h2>
                <div class="col-xs-4">
                    <p id="recent_online">100 people online</p>
                </div>
            </div>
            <br>

            <!--            section content starts here-->
            <section>
                <div class="row">
<!--                    <div class="col-sm-3">-->
<!--                        <a href="?controller=sharenote&action=noteshare"><button type="button" class="btn btn-default">Share Notes</button></a>-->
<!--                    </div>-->
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=create"><button type="button" class="btn btn-default">Add New Note</button></a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=noteshare"><button type="button" class="btn">Share Notes</button></a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=sharednote"><button type="button" class="btn btn-default">View Shared Notes</button></a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?controller=sharenote&action=index"><button type="button" class="btn btn-default">Show Me My Notes</button></a>
                    </div>
                </div> <!--end of mentor name row-->
                <br>

                <div class="row">
<!--                    <div class="col-sm-12">-->
<!--                        <table class="table table-bordered table-striped">-->
<!--                            --><?php
//                            foreach ($allNotesById as $notesval) {
//                                echo "<tr><td>" . $notesval['title'] . "<br>&emsp;&emsp;";
//                                echo "<i style='font-size: smaller;color: #757575;'>" . date("y-m-d",strtotime($notesval['date_created'])) . "</i></td></tr>";
//                            }
//                            ?>
<!--                        </table>-->
<!--                    </div>-->
                    <div class="col-sm-12">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="sel1">Select a member to share onte with:</label>
                                <select class="form-control" id="selectreceiver" name="selectreceiver">
                                    <option value="0">Select Member</option>
                                    <?php
                                    foreach ($allMembers as $membersval) {
                                        echo "<option value='" . $membersval['id'] . "'>" . $membersval['first_name'] . $membersval['last_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <br>
                            </div>

                            <div class="form-group">
                                <label for="sel1">Select a note to share:</label>
                                <select class="form-control" id="selectnote" name="selectnote">
                                    <option value="0">Select Note</option>
                                    <?php
                                    foreach ($allNotesById as $notesval) {
                                        echo "<option value='" . $notesval['id'] . "'>" . $notesval['title'] . "</option>";
                                    }
                                    ?>
                                    
                                </select>
                                <br>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-default" name="sendnote">Send</button>
                                </div>
                            </div>
                            <br><br>
                            <span><?php echo isset($message) ? $message : ''; ?></span>
                        </form>
                    </div>
                </div> <!--end of mentor/mentee row-->
            </section>
        </section><!--END of recent section-->

<!--        --><?php //require_once "right-section.php";?>
    </div>
</div><!--END of containerField -->

<?php //require_once 'footer.php';?>



<!--<script>-->
<!--    $(document).ready(function () {-->
<!--        $("#selectreceiver").change(function () {-->
<!--            var receiverid = $(this).val();-->
<!--            console.log(receiverid);-->
<!---->
<!--            $.ajax({-->
<!--                url:'../../Factory/noteajax.php',-->
<!--                type:'post',-->
<!--                data:{-->
<!--                    mem:'recieveid',-->
<!--                    memberid:receiverid-->
<!--                },-->
<!--                catche:false-->
<!--//                success:function (response) {-->
<!--//                    console.log(response);-->
<!--//                }-->
<!--            });-->
<!--        });//end of selectmember-->
<!---->
<!--        $("#selectnote").change(function () {-->
<!--            var noteid = $(this).val();-->
<!--            console.log(noteid);-->
<!---->
<!--            $.ajax({-->
<!--                url:'../../Factory/noteajax.php',-->
<!--                type:'post',-->
<!--                data:{-->
<!--                    notename:'notenam',-->
<!--                    noteidname:noteid-->
<!--                },-->
<!--                catche:false-->
<!--            });//ajax ends-->
<!--        });//end of selectnote-->
<!---->
<!---->
<!--    });-->
<!--</script>-->