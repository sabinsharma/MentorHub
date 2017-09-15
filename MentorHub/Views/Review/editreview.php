<?php

/*require_once('database.php');
require_once('models/Review.php');

$dbc = new Dbconnect();
$conn = $dbc->getDb();*/

//require_once ('Model/CRUD.php');
//$crud=new CRUD();

//********** EDIT REVIEW ***************

//This was set in the index.php file and will be placed in the html below

if (isset($_POST['edit_form'])){
    $review_id = filter_input(INPUT_POST, 'review_id');
    $mentor_id = filter_input(INPUT_POST, 'mentor_id', FILTER_VALIDATE_INT);
}

//Get new Review data
//This data is retrieved after the form below is submitted and re-sent to the same page





?>

<!DOCTYPE html>

<html>
<head>
    <title>Mentor Reviews</title>
</head>
<body>
<header>
    <h1>Edit Your Review</h1>
</header>
<main>
    <form action="?controller=review&action=index&mentor_id=<?php echo $mentor_id ?>" method="post">
        <label for= "new_review"> New Review:</label> <br />
         <textarea name="new_review" rows="4" cols="50"></textarea><br />
        <input type="hidden" name="review_id" value="<?php echo $review_id; ?>"> <!--Note that the review_id was sent from the index.php file when clicked, check code at top-->
        <input type="hidden" name="mentor_id" value="<?php echo $mentor_id; ?>">
        <input type="submit" value="Submit" name="edit" />
    </form>
</main>


</body>

</html>
