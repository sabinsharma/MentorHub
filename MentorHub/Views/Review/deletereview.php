<?php
//require_once('database.php');
//require_once('models/Review.php');

//require_once ('Model/CRUD.php');
//$crud=new CRUD();
/*$dbc = new Dbconnect();
$conn = $dbc->getDb();*/

if(isset($_POST['delete_form'])){
    $review_id = filter_input(INPUT_POST, 'review_id', FILTER_VALIDATE_INT);
    $mentor_id = filter_input(INPUT_POST, 'mentor_id', FILTER_VALIDATE_INT);

    //Delete review from database by review_id

    //$myreview = new Review($conn);
    $crud->deleteReview($review_id);

    //header("Location: index.php?mentor_id=$mentor_id" );
}

echo $mentor_id;