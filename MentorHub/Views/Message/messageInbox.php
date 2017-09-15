<?php
//$memberId =2;
//$_SESSION['memberId']=

$viewer_id=$_SESSION['member_id'];

require_once "Model/CRUD.php";
$crud=new CRUD();
$inbox=$crud->SelectAll("Select * FROM vw_inbox WHERE MessageRecipientId=".$viewer_id ." AND IsSend = 1 ");

//echo "Echo:\n";
//print_r($inbox);

?>


<h2>Message inbox</h2>

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
                <th>Sender</th>
                <th>Time stamp</th>
                <th>Is read</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($inbox as $inbox) : ?>
                <tr>
                    <th scope="row"><?php echo $inbox['MessageId']; ?> </th>
                    <td><?php echo $inbox['MessageSubject']; ?> </td>
                    <td><?php echo $inbox['MemberFirstName']; ?> </td>
                    <td><?php echo  $inbox['MessageTimeStamp']; ?> </td>
                    <td><?php echo  $inbox['IsRead']; ?> </td>
                    <td><a class="btn viewPost_btn btn-primary" href="?controller=message&action=view&Id=<?php echo $inbox['MessageId']; ?>" role="button">View</a></td>

                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>