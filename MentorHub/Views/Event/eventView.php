<?php
require_once "Model/CRUD.php";
$crud=new CRUD();
$event=$crud->FetchALL('tbl_event_info');



?>
<div id ="event_title" class="row">
    <h2>Meet up Event View</h2>
</div>
<div id="event_field" class="row">
    <div class="col-xs-12">
        <div id="addPost_btn">
            <a class="btn btn-primary btn-lg" href="?controller=event&action=create" role="button">Add New Event</a>
        </div>
        <table class="post-table table table-striped"">
            <thead class="post-thead">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Event Date</th>
                <th>Apply Due</th>
                <th>Host by</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($event as $event) : ?>
                <tr>
                    <th scope="row"><?php echo $event['Id']; ?> </th>
                    <td><?php echo $event['Title']; ?> </td>
                    <td><?php echo $event['Date']; ?> </td>
                    <td><?php echo  $event['Apply_due_date']; ?> </td>
                    <td><?php echo  $event['Host_id']; ?> </td>
                    <td><a class="btn viewPost_btn btn-primary" href="?controller=event&action=view&Id=<?php echo $event['Id']; ?>" role="button">View</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
