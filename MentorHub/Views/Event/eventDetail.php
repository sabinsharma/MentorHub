<?php
$event_id='';
if (isset($_GET['Id'])){
//    echo "event id is=".$_GET['Id'];
    $event_id= filter_input(INPUT_GET, 'Id', FILTER_VALIDATE_INT);
    $_SESSION['event_id']=$event_id;
    if ($event_id == NULL || $event_id == FALSE){
        $event_id =1;//defalt
    }
}
if (isset($_POST['delete']) || isset($_POST['apply']) ||isset($_POST['submit'])) {
    $event_id = $_SESSION['event_id'];
}
$memberId = $_SESSION['member_id']; // who view it* ->member_id
$_SESSION['memberId']=$memberId;

require_once "Model/CRUD.php";
require_once "Model/EventInfo.php";
require_once "Model/Eventdtl.php";

$crud=new CRUD();
$event_id=array('Id'=>$event_id);
$viewCount=$crud->Find('tbl_event_info',$event_id);

$hostId=$viewCount[0]['Host_id'];
$_SESSION['hostId']=$hostId;
$_host=array('Id'=>$hostId);
$viewCount2=$crud->Find('tbl_member_mst',$_host);


//$stillApply=array('Event_id'=>$stillApply);
//$viewCount3=$crud->Find('tbl_event_dtl', ($_SESSION['event_id']));
//$stillApply=$viewCont3[0]['Event_id'];

//var_dump($event_id);
//echo "memberId is" . $memberId;
//echo "Hostid is" . $hostId;
//var_dump($stillApply);

if(isset($_POST['apply'])) {
    $eventdtl = new EventDtl();
    $eventdtl->setEvent_id($_SESSION['event_id']);
    $eventdtl->setMember_id($memberId);
    $crud->InsertInfo('tbl_event_dtl', $eventdtl);
//    var_dump ($eventdtl);
    $URL = "?controller=event&action=index";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}


if (isset($_POST['delete'])) {
    $rows = $crud->DeleteInfo('tbl_event_info', $event_id);
    $URL="?controller=event&action=index";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if (isset($_POST['submit'])) {
    $isPrivate = 1;

    $timeStamp = date('Y-m-d G:i:s', time());// timestamp -> YYYY-MM-DD hh:mm:ss
    $eventInfo = new EventInfo();

    $eventInfo->setId($_SESSION['event_id']);
    $eventInfo->setTitle($_POST['event_title-input']);
    $eventInfo->setDesc($_POST['event_desc-input']);

    $eventInfo->setHostId($hostId);

    $eventInfo->setIsPrivate($isPrivate);
    $eventInfo->setDate($_POST['event_date-input']);
    $eventInfo->setTime($_POST['event_time-input'] . ":00");
    $eventInfo->setLocation($_POST['event_location-input']);
    $eventInfo->setTimestamp($timeStamp);
    $eventInfo->setDueDate($_POST['due_date-input']);
    $eventInfo->setMaxPeople($_POST['max_people-input']);

    $crud->UpdateInfo('tbl_event_info', $eventInfo);
//    var_dump($eventInfo);
    $URL="?controller=event&action=index";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

?>
<div id ="exchange_title" class="row">
    <h2>Event :<?php echo $viewCount[0]['Title'] ?></h2>
</div>
<div id="exchange_field" class="row">
    <div class="col-xs-12 row">
        <div class="col-md-3">
            <?php echo '<img style="width: 100%;" src="data:image/jpeg;base64,'.base64_encode( $viewCount2[0]['pic_path'] ).'"/>'; ?>
        </div>
        <div class="col-md-9">
            <h3>Event Information</h3>
            <p>Hosted by  <?php echo $viewCount2[0]['first_name']. " ".$viewCount2[0]['last_name']  ?></p>
            <p>Event Date: <?php echo $viewCount[0]['Date'] ?></p>
            <p>Start Time: <?php echo $viewCount[0]['Time'] ?></p>
            <p>Location: <?php echo $viewCount[0]['Location'] ?></p>
            <p>Max people: <?php echo $viewCount[0]['Apply_max_people'] ?></p>
        </div>
    </div>
    <div class="col-xs-12">
        <h5>Event Description</h5>
        <p><?php echo $viewCount[0]['Description'] ?></p>
    </div>
    <div class="col-mb-7">
        <p>Apply Due: <?php echo $viewCount[0]['Apply_due_date'] ?></p>
    </div>
    <div class="col-mb-5">

        <?php if ($hostId != $memberId) :?>
            <form action="?controller=event&action=view" method="post" name="applyform">
                <input class="btn btn-primary" type="submit" name="apply" value="Apply now" id="apply">
            </form>

        <?php else :?>
            <a class="btn btn-primary" data-toggle="modal" data-target="#editModal">Edit</a>
            <form action="?controller=event&action=view" method="post" name="deleteform">
                <input class="btn btn-primary" type="submit" name="delete" value="Delete" id="delete">
            </form>
        <?php endif; ?>
    </div>
            <!-- editModal -->
            <div class="modal fade" id="editModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="?controller=event&action=view" method="post" name="editform">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                            <h4 class="modal-title">Event Edit Form</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="event_title-input" class="col-2 col-form-label">Event Title</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" name="event_title-input" value="<?php echo $viewCount[0]['Title'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="event_desc-input" class="col-2 col-form-label">Description</label>
                                <div class="col-10">
                                    <input class="form-control" type="text"  name="event_desc-input" value="<?php echo $viewCount[0]['Description'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="event_date-input" class="col-2 col-form-label">Event Date</label>
                                <div class="col-10">
                                    <input class="form-control" type="date" name="event_date-input" value="<?php echo $viewCount[0]['Date'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="event_time-input">Start Time</label>
                                <select class="form-control" name="event_time-input">
                                    <option>8:00</option>
                                    <option>8:30</option>
                                    <option>9:00</option>
                                    <option>9:30</option>
                                    <option>10:00</option>
                                    <option>10:30</option>
                                    <option>11:00</option>
                                    <option>11:30</option>
                                    <option>12:00</option>
                                    <option>12:30</option>
                                    <option>13:00</option>
                                    <option>13:30</option>
                                    <option>14:00</option>
                                    <option>14:30</option>
                                    <option>15:00</option>
                                    <option>15:30</option>
                                    <option>16:00</option>
                                    <option>16:30</option>
                                    <option>17:00</option>
                                    <option>17:30</option>
                                    <option>18:00</option>
                                    <option>18:30</option>
                                    <option>19:00</option>
                                    <option>19:30</option>
                                    <option>20:00</option>
                                    <option>20:30</option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <label for="event_location-input" class="col-2 col-form-label">Location</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" name="event_location-input" value="<?php echo $viewCount[0]['Location'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="due_date-input" class="col-2 col-form-label">Apply Due date</label>
                                <div class="col-10">
                                    <input class="form-control" type="date" name="due_date-input" value="<?php echo $viewCount[0]['Apply_due_date'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="max_people-input" class="col-2 col-form-label">Max people</label>
                                <div class="col-10">
                                    <input class="form-control" type="number" min="1" name="max_people-input" value="<?php echo $viewCount[0]['Apply_max_people'] ?>" >
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
