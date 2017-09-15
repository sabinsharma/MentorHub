<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Mentor Hub</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="Assets/CSS/style.css" />
    <link rel="stylesheet" href="Assets/CSS/font-awesome.css" /><!--fontawasome icon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" /><!--Google font-->
    <link rel="stylesheet" href="Assets/CSS/exchange.css" />
    <!-- <link rel="stylesheet" type="text/css" href="Assets/CSS/mymain.css" />-->
    <link rel="stylesheet" href="Assets/CSS/rating.min.css" />
</head>

<body>
<header id="header" class="container">
    <div class="row">
        <div id="header_logo" class="col-sm-4">
            <h1 class="hidden">Mentor Hub</h1>
            <a href=""><img src="Assets/Images/logo.png" id="header_logoImg" alt="Mentor Hub logo" ></a>
        </div><!--END header_logo-->
        <!--<div id="header-xs_search" class="col-xs-12 visible-xs">
            <div class="center-block">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                            <button type="button" class="btn btn-default">Search</button>
                        </span>
                </div>
            </div>
        </div>--><!--END header-xs_search-->
        <!--<nav id="header_nav" class="col-sm-8 col-xs-12">
            <ul class="row">
                <li class="col-sm-2 col-sm-offset-2 hidden-xs"><a href="#"><i class="fa fa-magic fa-3x fa-fw" aria-hidden="true"></i></a></li>
                <li class="col-sm-2 hidden-xs"><a href="#"><i class="fa fa-search fa-3x fa-fw" aria-hidden="true"></i></a></li>
                <li class="col-sm-2 col-xs-4"><a href="#"><i class="fa fa-users fa-3x fa-fw" aria-hidden="true"></i></a></li>
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
        </nav>--><!--END header_nav-->


    </div><!--END header-->
</header>

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
                        <h4 id="right_userName"><?php echo $_SESSION['manager_name'] ?></h4>
                        <!--<p><a href="#">Edit your plofire</a></p>-->
                    </div>
                </div>
            </aside><!--END userInfo-->
        </section>

    </div>
</div><!--END containerField -->

<!--This is Sabin's Alert Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="alertWindow">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mentor Hub</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--This is END OF  Sabin's Alert Modal-->

<p id="page-top"><a href="#">PAGE TOP</a></p>

<footer id="footer" class="container sticky">
    <div class="row">
        <nav id="footer_nav" class="col-sm-8">
            <ul class="nav nav-pills">
                <li><a href="#">ABOUT</a></li>
                <li><a href="#">BLOG</a></li>
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

<!--<script src="Assets/Script/dist/rating.min.js"></script>
<script src="Assets/Script/script.js"></script>
-->
</body>
</html>




<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 14/04/2017
 * Time: 8:46 PM
 */