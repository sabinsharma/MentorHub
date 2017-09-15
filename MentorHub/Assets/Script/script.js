/*** STAR RATING **/
//target element
var stars = document.querySelector('#star_rating');

//current rating or initial rating
var currentRating = 0

//max rating or number of stars you want
var maxRating = 5;

//callback to run after setting rating
var callback = function(rating){
    alert(rating);
};

//rating instance

var myRating = rating(stars, currentRating, maxRating, callback);