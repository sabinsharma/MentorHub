<?php

// Database queries from quickmatch.php
/*require_once('database.php');
require_once('match.php');*/

require_once ('../Model/CRUD.php');

//Grab YOUR username and store it in a session; this can be started on login
session_start();
$_SESSION['username'] = 'math_wiz';
//$SESSION['username'] = $username;
$username = $_SESSION['username'];
$crud=new CRUD();
//Connect to DB and create Match object to access methods
/*$dbc = new Dbconnect();
$conn = $dbc->getDb();

$mymatch = new Match();*/


//Grab the five random members
$fivemembers = $crud->getRandom();


//Grab the five newest members
$newmembers = $crud->getNew();


//Grab five random online (active) members
$onlinemembers = $crud->getOnline();

//Grab five random featured members
$featuredmembers = $crud->getFeatured();

//Grab five nearby members based on YOUR location
$nearbymembers = $crud->getNearby($username);


/*********************************************************************************************************/


if (isset($_POST['job'])){
    switch($_POST['job']){
        case "randomize":
            grabRandom($fivemembers); //Uses randommembers() function with the $fivemembers parameter and ajax
            break;
        case "new":
            grabNew($newmembers);
            break;
        case "online":
            grabOnline($onlinemembers);
            break;
        case "featured":
            grabFeatured($featuredmembers);
            break;
        case "nearby":
            grabNearby($nearbymembers);
            break;

    }
}


//Functions used in the switch a bove

function grabRandom($fivemembers){

    //echo "Randomized!";
    echo "<li class='col-md-2  col-md-offset-1 col-sm-3'><a href=" . $fivemembers[0]['profile_path'] . "><img src='Assets/Images/user/" . $fivemembers[0]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $fivemembers[1]['profile_path'] . "><img src='Assets/Images/user/" . $fivemembers[1]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $fivemembers[2]['profile_path'] . "><img src='Assets/Images/user/" . $fivemembers[2]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $fivemembers[3]['profile_path'] . "><img src='Assets/Images/user/" . $fivemembers[3]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 hidden-sm\"><a href=" . $fivemembers[4]['profile_path'] . "><img src='Assets/Images/user/" . $fivemembers[4]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";

}

function grabNew($newmembers){
    //echo "Newest!";
    echo "<li class='col-md-2  col-md-offset-1 col-sm-3'><a href=" . $newmembers[0]['profile_path'] . "><img src='Assets/Images/user/" . $newmembers[0]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $newmembers[1]['profile_path'] . "><img src='Assets/Images/user/" . $newmembers[1]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $newmembers[2]['profile_path'] . "><img src='Assets/Images/user/" . $newmembers[2]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $newmembers[3]['profile_path'] . "><img src='Assets/Images/user/" . $newmembers[3]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 hidden-sm\"><a href=" . $newmembers[4]['profile_path'] . "><img src='Assets/Images/user/" . $newmembers[4]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";

}


function grabOnline($onlinemembers){
    //echo "Online!";
    echo "<li class='col-md-2  col-md-offset-1 col-sm-3'><a href=" . $onlinemembers[0]['profile_path'] . "><img src='Assets/Images/user/" . $onlinemembers[0]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $onlinemembers[1]['profile_path'] . "><img src='Assets/Images/user/" . $onlinemembers[1]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $onlinemembers[2]['profile_path'] . "><img src='Assets/Images/user/" . $onlinemembers[2]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $onlinemembers[3]['profile_path'] . "><img src='Assets/Images/user/" . $onlinemembers[3]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 hidden-sm\"><a href=" . $onlinemembers[4]['profile_path'] . "><img src='Assets/Images/user/" . $onlinemembers[4]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";

}

function grabFeatured($featuredmembers){
    //echo "Featured!";
    echo "<li class='col-md-2  col-md-offset-1 col-sm-3'><a href=" . $featuredmembers[0]['profile_path'] . "><img src='Assets/Images/user/" . $featuredmembers[0]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $featuredmembers[1]['profile_path'] . "><img src='Assets/Images/user/" . $featuredmembers[1]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $featuredmembers[2]['profile_path'] . "><img src='Assets/Images/user/" . $featuredmembers[2]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $featuredmembers[3]['profile_path'] . "><img src='Assets/Images/user/" . $featuredmembers[3]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 hidden-sm\"><a href=" . $featuredmembers[4]['profile_path'] . "><img src='Assets/Images/user/" . $featuredmembers[4]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";

}

function grabNearby($nearbymembers){
    //echo "Nearby!";
    echo "<li class='col-md-2  col-md-offset-1 col-sm-3'><a href=" . $nearbymembers[0]['profile_path'] . "><img src='Assets/Images/user/" . $nearbymembers[0]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $nearbymembers[1]['profile_path'] . "><img src='Assets/Images/user/" . $nearbymembers[1]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $nearbymembers[2]['profile_path'] . "><img src='Assets/Images/user/" . $nearbymembers[2]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 col-sm-3\" ><a href=" . $nearbymembers[3]['profile_path'] . "><img src='Assets/Images/user/" . $nearbymembers[3]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";
    echo "<li class=\"col-md-2 hidden-sm\"><a href=" . $nearbymembers[4]['profile_path'] . "><img src='Assets/Images/user/" . $nearbymembers[4]['pic_path'] . "' height='180' width='200' alt='user01'></a></li>";

}



