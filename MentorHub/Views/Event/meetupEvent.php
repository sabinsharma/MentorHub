<?php 
// Start Input
if (isset($_POST["submit"])) { 


$timeStamp = date('Y-m-d G:i:s', time());// timestamp

// validation form info
  if (isset($_POST["event_title-input"]) && $_POST["event_title-input"]) { 
    $title = $_POST["event_title-input"]; 
  } else { 
    $error_message[] = "Please input Event Title."; 
  } 
  if (isset($_POST["event_desc-input"]) && $_POST["event_desc-input"]) { 
    $desc = $_POST["event_desc-input"]; 
  } else { 
    $error_message[] = "Please input Event description"; 
  } 
  if (isset($_POST["event_date-input"]) && $_POST["event_date-input"]) { 
    $date = $_POST["event_date-input"]; 
  } else { 
    $error_message[] = "Please input Event date &amp; time"; 
  }
  if (isset($_POST["event_location-input"]) && $_POST["event_location-input"]) { 
    $location = $_POST["event_location-input"]; 
  } else { 
    $error_message[] = "Please input Event location."; 
  }  
  if (isset($_POST["due_date-input"]) && $_POST["due_date-input"]) { 
    $dueDate = $_POST["due_date-input"]; 
  } else { 
    $error_message[] = "Please input apply due date."; 
  }   
  if (isset($_POST["max_people--input"]) && $_POST["max_people--input"]) { 
    $maxPeople = $_POST["max_people--input"]; 
  } else { 
    $error_message[] = "Please input apply max people."; 
  }  


  if (!count($error_message)) { 
    // change <br> tag 
    $desc = str_replace(array("\r\n", "\r", "\n"), "<br>", $desc);

    // (2) 登録後、スケジュールの表示画面に移動したらいいのかな・・・ 
  } 
} 

// Output Error message
if (count($error_message)) {  
    foreach ($error_message as $message) {  
        print($message); 
    }  
} 

?>
<link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.min.css">
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>


<h2>Meet up Event AddForm</h2>

<form action="schedule_edit.php" method="post">

<div class="form-group row">
  <label for="event_title-input" class="col-2 col-form-label">Event Title</label>
  <div class="col-10">
    <input class="form-control" type="text" value="Please input event title." name="event_title-input">
  </div>
</div>
<div class="form-group row">
  <label for="event_desc-input" class="col-2 col-form-label">Description</label>
  <div class="col-10">
    <input class="form-control" type="text" value="Please input description." name="event_desc-input">
  </div>
</div>
<div class="form-group row">
  <label for="event_date-input" class="col-2 col-form-label">Date and time</label>
  <div class="col-10">
    <input class="form-control" type="datetime-local" value="2017-01-01 00:00:00" name="event_date-input">
  </div>
</div>
<div class="form-group row">
  <label for="event_location-input" class="col-2 col-form-label">Location</label>
  <div class="col-10">
    <input class="form-control" type="text" value="Please input Location." name="event_location-input">
  </div>
</div>
<div class="form-group row">
  <label for="due_date-input" class="col-2 col-form-label">Apply Due date</label>
  <div class="col-10">
    <input class="form-control" type="datetime-local" value="2017-01-01 23:59:00" name="due_date-input">
  </div>
</div>
<div class="form-group row">
  <label for="max_people-input" class="col-2 col-form-label">Max people</label>
  <div class="col-10">
    <input class="form-control" type="text" value="Please input Location." name="max_people--input">
  </div>
</div>
<input type="submit" name="submit" value="Submit">
<input type="reset" name="reset" value="Reset"> 
</form>
