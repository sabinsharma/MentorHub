<?php



require_once "Model/CRUD.php";
$crud=new CRUD();
$address=$crud->FetchALL('tbl_member_mst');



if (isset($_POST['submit'])) {

    $sender_Id = 2;// who write it* ->Host_id

    $timeStamp = date('Y-m-d', time());// timestamp -> YYYY-MM-DD
    $isRead = 0;
    $isSend=1; // Save or Send??

    require_once "Model/Message.php";

    $message = new Message();

    var_dump($message);

    $message->setSubject($_POST['subject-input']);
    $message->setMessage($_POST['message-input']);

    $message->setTimestamp($timeStamp);
    $message->setSender_id($sender_Id);
    $message->setis_send($isSend);
    $message->setis_read($isRead);

    var_dump($message);

    require_once "Model/CRUD.php";
    $crud = new CRUD();
    $crud->InsertInfo('tbl_message', $message);

    require_once "Model/Messagedtl.php";

    $result=$crud->SelectAll("SELECT Id FROM tbl_message WHERE Id in (SELECT MAX(Id) FROM tbl_message)");

    $messaged = new MessageDtl();

    $messaged->setMessage_id($result[0]['Id']);
    $messaged->setRecipient_id($_POST['Recipientinput']);

    $crud->InsertInfo('tbl_message_dtl', $messaged);

    $URL="?controller=message&action=send";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
?>

<div id ="exchange_title" class="row">
    <h2>Send Message Form</h2>
</div>
<a class="btn viewPost_btn btn-primary" href="?controller=message&action=index" role="button">Back to Inbox</a>

<div id="exchange_field" class="row">
    <div>
        <form action="?controller=message&action=create" method="post">


            <div class="form-group">
                <label for="subject-input" class="col-form-label">Subject</label>

                <input class="form-control" type="text" name="subject-input" required>
            </div>

            <div class="form-group">
                <label for="message-input">Message</label>
                <textarea class="form-control" name="message-input" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="Recipientinput">Send to</label>
                <select class="form-control" name="Recipientinput" required>
                    <option>Select Person</option>
                    <?php foreach ( $address as $address ) : ?>
                        <option value="<?php echo $address['id'] ?>"><?php echo $address['first_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="addPost_btn">
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                <input class="btn btn-primary" type="reset" name="reset" value="Reset">
            </div>

        </form>
    </div>
</div>

