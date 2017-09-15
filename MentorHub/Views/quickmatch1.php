<section id="main" class="container">
    <h2 class="visible-xs">Hello, NoNameUser!!</h2>
    <ul id="main_user" class="row hidden-xs">
        <li class="col-md-2  col-md-offset-1 col-sm-3"><a href="#"><img src="Assets/Images/user.png" alt="user01"></a></li>
        <li class="col-md-2 col-sm-3" ><a href="#"><img src="Assets/Images/user.png" alt="user01"></a></li>
        <li class="col-md-2 col-sm-3"><a href="#"><img src="Assets/Images/user.png" alt="user01"></a></li>
        <li class="col-md-2 col-sm-3"><a href="#"><img src="Assets/Images/user.png" alt="user01"></a></li>
        <li class="col-md-2 hidden-sm"><a href="#"><img src="Assets/Images/user.png" alt="user01"></a></li>
    </ul><!--END main_user-->
    <nav id="main_nav" class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12 hidden-xs">
            <ul class="row">
                <li class="col-md-2 col-md-offset-1 col-sm-3"><a href="#"><button class="btn btn-link btn-lg">NEW</button></a></li>
                <li class="col-md-2 col-sm-3"><a href="#"><button class="btn btn-link btn-lg">ONLINE</button></a></li>
                <li class="col-md-2 col-sm-3"><a href="#"><button class="btn btn-link btn-lg">FEATURED</button></a></li>
                <li class="col-md-2 col-sm-3"><a href="#"><button class="btn btn-link btn-lg">NEARBY</button></a></li>
                <li class="col-md-2 col-sm-12"><a href="#"><button class="btn btn-link btn-lg">RANDOM</button></a></li>
            </ul>
        </div>
    </nav><!--END main_nav-->
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