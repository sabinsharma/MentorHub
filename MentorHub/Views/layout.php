<?php
require_once ('Views/requests/displayRequest.php');
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Mentor Hub</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="Assets/CSS/changes.css" />
    <link rel="stylesheet" type="text/css" href="Assets/CSS/style.css" />
    <link rel="stylesheet" href="Assets/CSS/font-awesome.css" /><!--fontawasome icon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" /><!--Google font-->
    <link rel="stylesheet" href="Assets/CSS/exchange.css" />
   <!-- <link rel="stylesheet" type="text/css" href="Assets/CSS/mymain.css" />-->
    <link rel="stylesheet" href="Assets/CSS/rating.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="Assets/CSS/similar_listings.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.css'>
</head>

<body>
<header id="header" class="container">
    <div class="row">
        <div id="header_logo" class="col-sm-4">
            <h1 class="hidden">Mentor Hub</h1>
            <a href=""><img src="Assets/Images/logo.png" id="header_logoImg" alt="Mentor Hub logo" ></a>
        </div><!--END header_logo-->
        <div id="header-xs_search" class="col-xs-12 visible-xs"><!--mobile saerchbox-->
            <div class="center-block">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                            <button type="button" class="btn btn-default">Search</button>
                        </span>
                </div>
            </div>
        </div><!--END header-xs_search-->
        <nav id="header_nav" class="col-sm-8 col-xs-12">
            <ul class="row">
                <li class="col-sm-2 col-sm-offset-2 hidden-xs"><a href="#"><i class="fa fa-magic fa-3x fa-fw" aria-hidden="true"></i></a></li>
                <li class="col-sm-2 hidden-xs"><a href="?controller=mentorsearch&action=index"><i class="fa fa-search fa-3x fa-fw" aria-hidden="true"></i></a></li>
                <li class="col-sm-2 col-xs-4"><?php echo $startRequest . $senderName . $endRequest; ?>
                <li class="col-sm-2 col-xs-4">
                    <div class="dropdown">
                        <a data-toggle="dropdown" href="#"><i class="fa fa-comments-o fa-3x fa-fw" aria-hidden="true"></i><span class="badge topright">5</span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="header_message"><i class="fa fa-comments fa-lg fa-fw" aria-hidden="true"></i>Message<span class="badge">2</span></li>
                            <li class="divider" role="presentation"></li>
                            <li class="header_message"><i class="fa fa-calendar-o fa-lg fa-fw" aria-hidden="true"></i>Event<span class="badge">3</span></li>
                        </ul>
                    </div>
                </li>
                <li class="col-sm-2 col-xs-4"><a href="#"><img id="header_nav_user" src="Assets/Images/user.png" alt="user Information"></a></li>
            </ul>
        </nav><!--END header_nav-->

        <nav id="header_main" class="col-xs-12">
            <div>
                <ul class="row">
                    <li class="col-sm-3"><a href=".aboutus" data-toggle="collapse">About us</a>
                        <ul class="header_main_second">
                            <li class="collapse aboutus"><a href="#">FAQ</a></li>
                            <li class="collapse aboutus"><a href="#">About us</a></li>
                            <li class="collapse aboutus"><a href="#">Contact us</a></li>
                        </ul>
                    </li>
                    <li class="col-sm-3"><a href=".mentormentee" data-toggle="collapse">Mentor/Mentee</a>
                        <ul class="header_main_second">
                            <li class="collapse mentormentee"><a href="?controller=review&action=index">Ratings and Reviews</a></li>
                            <li class="collapse mentormentee"><a href="#">Wite a Review</a></li>
                            <li class="collapse mentormentee"><a href="?controller=sharenote&action=index">Share Note</a></li>

                        </ul>
                    </li>
                    <li class="col-sm-3"><a  href=".trade" data-toggle="collapse">Trade</a>
                        <ul class="header_main_second">
                            <li class="collapse trade"><a href="?controller=exchange&action=index">Exchange Board</a></li>
                            <li class="collapse trade"><a href="?controller=offer&action=index">Coupons and Offers</a></li>
                        </ul>
                    </li>
                    <li class="col-sm-3"><a  href=".comunity" data-toggle="collapse">Comunity</a></a>
                        <ul class="header_main_second">
                            <li class="collapse comunity"><a href="?controller=discussionboard&action=index">Discussion Board</a></li>
                            <li class="collapse comunity"><a href="?controller=event&action=index">Meetup Event</a></li>
                            <li class="collapse comunity"><a href="?controller=chatting&action=chat">Chat</a></li>
                            <li class="collapse comunity"><a href="?controller=message&action=index">Message</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav><!-- END header_main -->

    </div><!--END header-->
</header>
<?php

if($controller=='default' && $action=='index'){

    require_once "quickmatch.php";
}
?>
<div  id="containerField" class="container">

    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <div id="error"><!--All error Message Goes here--></div>
    </div>

    <div class="row">

        <section id="main_field" class="col-sm-8">
            <!--<div id ="recent_title" class="row">
                <h2 class="col-xs-8">Discussion Board</h2>

            </div>-->
            <?php require_once('routes.php'); ?>
        </section><!--END recent-->

        <section id="right" class="col-sm-4">
            <aside id="right_userInfo" class="hidden-xs">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="Assets/Images/user.png" alt="userThumb">
                    </div>
                    <div class="col-sm-9">
                        <h4 id="right_userName">NoNameUser</h4>
                        <p><a href="?controller=default&action=editprofile">Edit your profile</a></p>
                    </div>
                </div>
            </aside><!--END userInfo-->
            <aside id="right_userRecent">
                <div id="right_title">
                    <h2>You recently</h2>
                </div>
                <div id="right_artBox">
                    <article class="row">
                        <div class="col-xs-3">
                            <a href="#"><img src="Assets/Images/user.png" alt="thumb01"></a>
                        </div>
                        <div class="col-xs-9">
                            <h3 class="right_art_title"><a href="#">"Mentor meeting"</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore ...</p>
                        </div>
                    </article><!--END article01-->
                    <article class="row">
                        <div class="col-xs-3">
                            <a href="#"><img src="Assets/Images/user.png" alt="thumb02"></a>
                        </div>
                        <div class="col-xs-9">
                            <h3 class="right_art_title"><a href="#">Do U need Textbook?</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore ...</p>
                        </div>
                    </article><!--END article02-->
                    <article class="row">
                        <div class="col-xs-3">
                            <a href="#"><img src="Assets/Images/user.png" alt="thumb03"></a>
                        </div>
                        <div class="col-xs-9">
                            <h3 class="right_art_title"><a href="#">MENTOR: Someone</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore ...</p>
                        </div>
                    </article><!--END article03-->
                    <p id="right_more"><a href="#">See more...</a></p>
                </div><!--END right_artBox-->

            </aside><!--END userRecent-->

        </section><!--END right-->

    </div>
</div><!--END containerField -->

<p id="page-top"><a href="#">PAGE TOP</a></p>

<footer id="footer" class="container sticky">
    <div class="row">
        <nav id="footer_nav" class="col-sm-8">
            <ul class="nav nav-pills">
                <li><a href="#">ABOUT</a></li>
                <li><a href="?controller=blog&action=index">BLOG</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="?controller=event&action=index">EVENT MEET UP</a></li>
                <li><a href="#">CONTACT US</a></li>
                <li><a href="#">PRIVACY POLICY</a></li>
            </ul>
        </nav><!--END footer_nav-->

        <div id="footer_sns" class="col-sm-4">
            <ul class="nav-pills pull-right">
                <li><a href="#"><i class="fa fa-facebook-official fa-lg fa-fw" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter fa-lg fa-fw" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram fa-lg fa-fw" aria-hidden="true"></i></a></li>
            </ul>
        </div><!--END footer_sns-->
    </div><!--END row-footer_nav & _sns-->
    <p><small>&copy; Copyright Mentor Hub, 2017.</small></p>
</footer><!--END footer-->

<script src="Assets/Script/jquery.min.js"></script>
<script src="Assets/Script/bootstrap.min.js"></script>
<script src="Assets/Script/gototop.js"></script>
<script src="Assets/Script/mentorhub.js"></script>
<script src="Assets/Script/quickmatchscript.js"></script>
<script src="Assets/Script/jump.js"></script>
<script src="Assets/Script/requestAJAX.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js'></script>
<script src="Assets/Script/similar_listings_script.js"></script> <!-- file full of JS functions -->

<!--<script src="Assets/Script/dist/rating.min.js"></script>
<script src="Assets/Script/script.js"></script>
-->
</body>
</html>

