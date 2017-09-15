<?php
if (isset($_POST['submit'])) {
//    if(!isset($_POST['event_title-input']) || !isset($_POST['event_desc-input']) || !isset($_POST['event_date-input'])
//        || !isset($_POST['event_time-input']) || !isset($_POST['event_location-input'])|| !isset($_POST['event_date-input'])
//        || !isset($_POST['max_people-input'])){
//        //header('Location:?controller=event&action=create');
//    //exit;
    $hostId = $_SESSION['member_id'];// who write it* ->Host_id
    $isPrivate = 1;
    $timeStamp = date('Y-m-d G:i:s', time());// timestamp -> YYYY-MM-DD hh:mm:ss
    require_once "Model/EventInfo.php";
    $eventInfo = new EventInfo();
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
    require_once "Model/CRUD.php";
    $crud = new CRUD();
    $crud->InsertInfo('tbl_event_info', $eventInfo);

    $URL="?controller=event&action=index";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

?>

<h2>Meet up Event Create Form</h2>


<form action="?controller=event&action=create" method="post">

<div class="form-group row">
  <label for="event_title-input" class="col-2 col-form-label">Event Title</label>
  <div class="col-10">
    <input class="form-control" type="text" name="event_title-input" required>
  </div>
</div>
<div class="form-group row">
  <label for="event_desc-input" class="col-2 col-form-label">Description</label>
  <div class="col-10">
    <input class="form-control" type="text"  name="event_desc-input" required>
  </div>
</div>
<!--<div class="form-group row">
  <label for="event_date-input" class="col-2 col-form-label">Date and time</label>
  <div class="col-10">
    <input class="form-control" type="datetime-local" value="2017-01-01 00:00:00" name="event_date-input">
  </div>
</div>-->
<div class="form-group row">
  <label for="event_date-input" class="col-2 col-form-label">Event Date</label>
  <div class="col-10">
    <input class="form-control" type="date" name="event_date-input" required>
  </div>
</div>
<!--<div class="form-group row">
  <label for="event_time-input" class="col-2 col-form-label">Start Time</label>
  <div class="col-10">
    <input class="form-control" type="time" value="13:45:00" name="event_time-input">
  </div>
</div>-->
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
    <input class="form-control" type="text" name="event_location-input" required>
  </div>
</div>
<div class="form-group row">
  <label for="due_date-input" class="col-2 col-form-label">Apply Due date</label>
  <div class="col-10">
    <input class="form-control" type="date" name="due_date-input" required>
  </div>
</div>
<div class="form-group row">
  <label for="max_people-input" class="col-2 col-form-label">Max people</label>
  <div class="col-10">
    <input class="form-control" type="number" min="1" name="max_people-input">
  </div>
</div>
<input class="btn btn-primary" type="submit" name="submit" value="Submit">
<input class="btn btn-primary" type="reset" name="reset" value="Reset"> 
</form>



