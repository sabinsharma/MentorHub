<?php

//require_once ('Model/CRUD.php');
//require_once('database.php');
//require_once('models/mentor.php');
//require_once('Model/Review.php');
//require_once('models/stars.php');

//$dbc = new Dbconnect();
//$conn = $dbc->getDb();

//Get all mentors
//$mymentors = new Mentor($conn);
//$crud=new CRUD();
//$mentors = $crud->getAllMentors();



//************** ADD REVIEW **************

//Get review data



?>
<script src="Assets/Script/dist/rating.min.js"></script>
<script src="Assets/Script/script.js"></script>

<!--<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="css/rating.min.css" />
    <script src="js/dist/rating.min.js"></script>
    <script src="js/script.js"></script>

    <title>Mentor Reviews</title>
</head>
<body>
<header>-->
    <h1>Add a Review</h1>
<!--</header>
<main>-->
    <form action="index.php?controller=review&action=index" method="post"> <!--Note that the inputs are sent back to the addreview.php file and processed before being redirected to the index.php file -->

        Select a Mentor:

        <select name="mentor_choice">
            <?php foreach ($mentors as $mentor) : ?>
                <option value="<?php echo $mentor['id']; ?>"><?php echo $mentor['username']; ?></option>
            <?php endforeach; ?>
        </select>

        <br />
        <br />

        <div class="o-content">
            <div class="o-container">
                <div class="o-section">
                    <div id="stars"></div>
                </div>
                <div class="o-section">
                    <div id="github-icons"></div>
                </div>
            </div>
        </div>

        <script>
            (function() {

                'use strict';
                //alert("hey i am here");
                // STARS ELEMENT
                var stars = document.querySelector('#stars');

                // DUMMY DATA
                var data = [
                    {
                        title: "Star-rating",
                        description: "Please rate your mentor.",
                        rating: 0
                    }
                ];

                // INITIALIZE
                (function init() {
                    for (var i = 0; i < data.length; i++) {
                        addRatingWidget(buildStarsItem(data[i]), data[i]);
                    }
                })();

                // BUILD STARS ITEM
                function buildStarsItem(data) {
                    var starsItem = document.createElement('div');

                    var html = '<div class="c-stars-item__img"></div>' +
                        '<div class="c-stars-item__details">' +
                        '<h3 class="c-stars-item__title">' + data.title + '</h3>' +
                        '<p class="c-stars-item__description">' + data.description + '</p>' +
                        '<ul class="c-rating"></ul>' +
                        '</div>';

                    starsItem.classList.add('c-stars-item');
                    starsItem.innerHTML = html;
                    stars.appendChild(starsItem);

                    return starsItem;
                }

                // ADD RATING WIDGET
                function addRatingWidget(starsItem, data) {
                    var ratingElement = starsItem.querySelector('.c-rating');
                    var currentRating = data.rating;
                    var maxRating = 5;
                    var callback = function(rating) {
                        //alert(rating);
                        document.cookie = 'rating=' + rating;

                    };
                    var r = rating(ratingElement, currentRating, maxRating, callback);
                }

            })();

        </script>
<!--
        <div>
            <input type="radio" name="stars" value="1"/>
            <img src="img/one-star.png" height="50" width="300">
            <br />
            <input type="radio" name="stars" value="2"/>
            <img src="img/two-stars.png" height="50" width="300">
            <br />
            <input type="radio" name="stars" value="3"/>
            <img src="img/three-stars.png" height="50" width="300">
            <br />
            <input type="radio" name="stars" value="4"/>
            <img src="img/four-stars.png" height="50" width="300">
            <br />
            <input type="radio" name="stars" value="5"/>
            <img src="img/five-stars.png" height="50" width="300">
            <br />
        </div>
-->
        <br />

        <label for= "add_review"><strong>Review:</strong></label> <br />

        <p>Please add a review.</p>

        <textarea name="add_review" rows="4" cols="50"></textarea><br />
        <input type="submit" value="Submit" name="add" />
    </form>
<!--</main>


</body>

</html>-->