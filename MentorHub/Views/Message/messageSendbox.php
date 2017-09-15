<?php
//$memberId =2;
//
//$_SESSION['memberId']=$memberId;
$viewer_id=$_SESSION['member_id'];

require_once "Model/CRUD.php";
$crud= new CRUD();
$sendbox=$crud->Find('vw_sendbox', array('MessageSenderID'=>$viewer_id));

?>


<h2>Message Sendbox</h2>





<a class="btn btn-primary btn-lg" href="?controller=message&action=send" role="button">Send BOX</a>

<div class="row">
    <div class="col-xs-12">
        <div style="text-align:right;">
            <a class="btn btn-primary btn-lg" href="?controller=message&action=create" role="button">Send New Message</a>
        </div>
        <table class="table table-striped">
            <thead class="thead-inverse">
            <tr>
                <th>Id</th>
                <th>Subject</th>
                <th>Recipient</th>

                <th>Time stamp</th>
                <th>IsSend</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($sendbox as $sendbox) : ?>
                <tr>
                    <th scope="row"><?php echo $sendbox['MessageId']; ?> </th>
                    <td><?php echo $sendbox['MessageSubject']; ?> </td>
                    <td><?php echo $sendbox['MemberFirstName']; ?> </td>
                    <td><?php echo $sendbox['MessageTimeStamp']; ?> </td>
                    <td><?php echo $sendbox['IsSend']; ?> </td>
                    <td><a class="btn viewPost_btn btn-primary" href="?controller=message&action=view&Id=<?php echo $sendbox['MessageId']; ?>" role="button">View</a></td>

                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
        </table>

    </div>
</div>