<?php

/*require_once('database.php');
require_once('match.php');

$dbc = new Dbconnect();
$conn = $dbc->getDb();*/
require_once ('Model/CRUD.php');

//Grab the five random mentors
$crud = new CRUD();
$fivemembers = $crud->getRandom();


?>

<section id="main" class="container">
    <h2 class="visible-xs">Hello, NoNameUser!!</h2>
    <ul id="main_user" class="row hidden-xs">
        <li class="col-md-2  col-md-offset-1 col-sm-3"><a href="<?php echo $fivemembers[0]['profile_path'] ?>"><img src="Assets/Images/user/<?php echo $fivemembers[0]['pic_path'] ?>" height="180" width="200" alt="user01"></a></li>
        <li class="col-md-2 col-sm-3" ><a href="<?php echo $fivemembers[1]['profile_path'] ?>"><img src="Assets/Images/user/<?php echo $fivemembers[1]['pic_path'] ?>" height="180" width="200" alt="user01"></a></li>
        <li class="col-md-2 col-sm-3"><a href="<?php echo $fivemembers[2]['profile_path'] ?>"><img src="Assets/Images/user/<?php echo $fivemembers[2]['pic_path'] ?>" height="180" width="200" alt="user01"></a></li>
        <li class="col-md-2 col-sm-3"><a href="<?php echo $fivemembers[3]['profile_path'] ?>"><img src="Assets/Images/user/<?php echo $fivemembers[3]['pic_path'] ?>" height="180" width="200" alt="user01"></a></li>
        <li class="col-md-2 hidden-sm"><a href="<?php echo $fivemembers[4]['profile_path'] ?>"><img src="Assets/Images/user/<?php echo $fivemembers[4]['pic_path'] ?>" height="180" width="200" alt="user01"></a></li>
    </ul><!--END main_user-->


    <nav id="main_nav" class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12 hidden-xs">
            <ul class="row">
                <form action="#" method="post" id="myform">
                    <li class="col-md-2 col-md-offset-1 col-sm-3"><a href="#">
                            <input id="newBtn" type="button" class="btn btn-link btn-lg" value="NEW"/>
                        </a></li>
                    <li class="col-md-2 col-sm-3"><a href="#">
                            <input id="onlineBtn" type="button" class="btn btn-link btn-lg" value="ONLINE"/>
                        </a></li>
                    <li class="col-md-2 col-sm-3"><a href="#">
                            <input id="featuredBtn" type="button" class="btn btn-link btn-lg" value="FEATURED"/>
                        </a></li>
                    <li class="col-md-2 col-sm-3"><a href="#">
                            <input id="nearbyBtn" type="button" class="btn btn-link btn-lg" value="NEARBY"/>
                        </a></li>
                    <li class="col-md-2 col-sm-12"><a href="#">
                            <input id="randomBtn" type="button" class="btn btn-link btn-lg" value="RANDOM"/>
                        </a></li>
                </form>
            </ul>
        </div>
    </nav><!--END main_nav-->

   <!-- <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js" type="text/javascript"></script>-->


    <div id="main-xs_top" class="visible-xs"><!--mobile main-->
        <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#mainModal">
            <p>Find what you're <span class="br">looking for.</span></p>
        </a>
        <!-- modal daialog -->
        <div class="modal fade" id="mainModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body main_nav_modal">
                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                        <ul>
                            <li><a href="#">NEW</a></li>
                            <li><a href="#">ONLINE</a></li>
                            <li><a href="#">FEATURED</a></li>
                            <li><a href="#">NEARBY</a></li>
                            <li><a href="#">RANDOM</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- END modal daialog -->
    </div><!--END main-xs_top-->
</section><!--END main-->

<!--<script src="../Assets/Script/jquery.min.js"></script>-->
<!--<script src="../Assets/Script/bootstrap.min.js"></script>-->
<!--<script src="../Assets/Script/gototop.js"></script>-->
<!--<script src="../Assets/Script/quickmatchscript.js"></script>-->
