<?php
$message_id='';
if (isset($_GET['Id'])){
//  echo "message id is=".$_GET['Id'];
    $message_id= filter_input(INPUT_GET, 'Id', FILTER_VALIDATE_INT);
    $_SESSION['message_id']=$message_id;
    if ($message_id == NULL || $message_id == FALSE){
        $message_id =1;//defalt
    }
}
if (isset($_POST['submit'])) {
    $message_id = $_SESSION['message_id'];
}
$memberId = 2; // who view it* ->member_id
$_SESSION['member_id']=$memberId;

require_once "Model/CRUD.php";
require_once "Model/Message.php";
require_once "Model/Messagedtl.php";

$crud = new CRUD();
$messageid=array('Id'=>$message_id);
$viewCount=$crud->Find('tbl_message',$messageid);

$viewCount2=$crud->SelectAll("SELECT * FROM tbl_message_dtl WHERE Message_id=". $message_id );

//var_dump($viewCount2);

$senderId=$viewCount[0]['Sender_id'];
$_SESSION['senderId']=$senderId;
$_sender=array('Id'=>$senderId);
$viewCount3=$crud->Find('tbl_member_mst',$_sender);

$recipientId=$viewCount2[0]['Recipient_id'];
//echo "recipientId is". $recipientId;
$_SESSION['recipientId']=$recipientId;
$_recipient=array('Id'=>$recipientId);
$viewCount4=$crud->Find('tbl_member_mst',$_recipient);

//echo $viewCount[0]['Sender_id'];
?>
<div id ="exchange_title" class="row">
    <h2>Message</h2>
</div>

<h2>
    <?php if ($viewCount[0]['Sender_id']  == $_SESSION['member_id'] ):?>
    <?php else :?>
        <a class="btn viewPost_btn btn-primary" href="?controller=message&action=create" role="button">Reply</a>
    <?php endif; ?>
</h2>

<div id="exchange_field" class="row">
    <div class="col-xs-12">
            <h3><?php echo $viewCount[0]['Subject'] ?></h3>
            <p>Send by  <?php echo $viewCount3[0]['first_name']. " ".$viewCount3[0]['last_name']  ?></p>
            <p>Recipient  <?php echo $viewCount4[0]['first_name']. " ".$viewCount4[0]['last_name']  ?></p>

            <p>Send Time: <?php echo $viewCount[0]['Timestamp'] ?></p>
        </div>
    <div class="col-xs-12">
        <h5>Message:</h5>
        <p><?php echo $viewCount[0]['Message'] ?></p>
    </div>
</div>
<a class="btn viewPost_btn btn-primary" href="?controller=message&action=index" role="button">Back to Inbox</a>
