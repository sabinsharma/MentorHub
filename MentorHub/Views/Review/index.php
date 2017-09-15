<?php
require_once ('Model/CRUD.php');
$crud=new CRUD();
if(isset($_POST['add'])) {

    $mentor_id = filter_input(INPUT_POST, 'mentor_choice');
    $add_review = filter_input(INPUT_POST, 'add_review');
    $stars = $_COOKIE['rating'];


    //Add review to database

    $crud = new CRUD();
    $crud->addReview($mentor_id, $add_review);

    //Update or set star-rating in database

    //$mystars = new Stars($conn);
    $crud->updateStars($mentor_id, $stars);
}

if(isset($_POST['edit'])) {
    $review_id = filter_input(INPUT_POST, 'review_id');
    $mentor_id = filter_input(INPUT_POST, 'mentor_id');
    $new_review = filter_input(INPUT_POST, 'new_review');

//Edit review in database

//$myreview = new Review($conn);
    $crud->editReview($new_review, $review_id);
}

if(isset($_POST['delete_form'])) {
    $review_id = filter_input(INPUT_POST, 'review_id', FILTER_VALIDATE_INT);
    $mentor_id = filter_input(INPUT_POST, 'mentor_id', FILTER_VALIDATE_INT);
    $crud->deleteReview($review_id);
}
//require_once('database.php');
//require_once('models/mentor.php');
//require_once('models/Review.php');


//$dbc = new Dbconnect(); //Create an instance eof the Dbconnect class
//$conn = $dbc->getDb(); //Get the database using the method of the class

//Get mentor_id
if (!isset($mentor_id)){  //If $mentor_id has not been set by other files, grab its value from $_GET array
    $mentor_id = filter_input(INPUT_GET, 'mentor_id', FILTER_VALIDATE_INT); //Now check what it's equal to and set its value to 1; otherwise it has been set and everything works accordingly
    if ($mentor_id == NULL || $mentor_id == FALSE){
        $mentor_id = 1;
    }
}

//Get username and star-rating for selected mentor_id
//$mymentor = new Mentor($conn);
$mentoor = $crud->getAMentor($mentor_id);
$stars = $mentoor['star_rating'];

    //Mentor star rating with corresponding images

    if ($stars == 1){
        $star_image = "one-star.png";
    } elseif ($stars == 2){
        $star_image = "two-stars.png";
    } elseif ($stars == 3){
        $star_image = "three-stars.png";
    } elseif ($stars == 4){
        $star_image = "four-stars.png";
    } else {
        $star_image = "five-stars.png";
    }

    //var_dump($stars);
    //var_dump($star_image);

//Get reviews based on mentor_id
//$myreviews = new Review($conn);
$reviews = $crud->getReviews($mentor_id);


//var_dump ($reviews);

//Get all mentors
$mentors = $crud->getAllMentors();

?>
<!--<!DOCTYPE html>

<html>

<head>
    <title>Mentor Reviews</title>
    <link rel="stylesheet" type="text/css" href="css/mymain.css" />
    <link rel="stylesheet" href="css/rating.min.css" />
</head>-->

<!-- the body section -->
<!--<body>
<main>-->
    <h2>Select a Mentor</h2>
    <aside>
        <!-- display list of mentor usernames -->
        <nav>
            <ul>
                <?php foreach ($mentors as $mentor) : ?>
                    <li>
                        <a href="index.php?controller=review&action=index&mentor_id=<?php echo $mentor['id']; ?>">
                            <?php echo $mentor['username']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <h3><a href="?controller=review&action=addReview" class="btn btn-primary">Add a review or star-rating</a></h3>
    </aside>

    <section>
        <!-- display a table of mentor reviews -->
        <h1>Your Mentor Reviews</h1>
            <h3><?php echo $mentoor['username']; ?></h3>
            <img src="Assets/Images/<?php echo $star_image; ?>" height="50" width="300">

        <br />
        <br />

        <table>
            <col width="500">
            <tr>
                <th>Review</th>
            </tr>

                <?php foreach ($reviews as $review) : ?>
                <tr>
                    <td><?php echo $review['review'] ?>
                        <!-- EDIT REVIEW FORM -->
                        <form action="?controller=review&action=editReview" method="post">
                            <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                            <input type="hidden" name="mentor_id" value="<?php echo $review['mentor_id']; ?>">
                            <!--<a href="editreview.php">-->
                                <input type="submit" name="edit_form" value="Edit" class="btn btn-primary">
                            <!--</a>-->
                        </form>
                        <!-- DELETE REVIEW FORM -->
                        <form action="" method="post">
                            <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                            <input type="hidden" name="mentor_id" value="<?php echo $review['mentor_id']; ?>">
                            <input type="submit" name="delete_form" value="Delete">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>



        </table>

    </section>
<!-- star-rating JS functions -->
<!--<script src="js/dist/rating.min.js"></script>
<script src="js/script.js"></script> --><!-- file full of JS functions -->

