<?php
/*if(isset($_SESSION['member_id'])){
    session_destroy();
}*/

if(isset($_GET['controller']) && isset($_GET['action'])){
    $controller=$_GET['controller'];//post
    $action=$_GET['action'];//index
}
else
{
    $controller='welcome';
    $action='login';
}

require_once ('Model/CRUD.php');
/*require_once ('Controller/WelcomeController.php');*/

session_start();

/*$dbc = new Dbconnect();
$conn = $dbc->getDb();*/

$message = '';

if(isset($_POST['btn_login'])) {
    /*echo '<script>alert("button clicked");</script>';*/
    //Get login fields
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once ('Model/CRUD.php');
    $loginInfo = new CRUD();
    $loginResult = $loginInfo->getLogin($email, $password);

    $countLogin = count($loginResult);

    if($countLogin > 0){
        //$confirmationInfo = new login();
        $confirmResult = $loginInfo->checkConfirmation($email);

        $countConfirm = count($confirmResult);

        if($countConfirm > 0){
            $_SESSION['member_id']=$loginResult[0]['id'];
            echo '<script>window.location="index.php?controller=default&action=index";</script>';
            /// echo'<script>window.location="user-index.php";</script>';
        }else{
            echo'<script>window.location="welcome.php?controller=welcome&action=confirm";</script>';
        }
    }else{
        $message = 'Incorrect email or password.';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Mentor Hub</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Assets/CSS/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="Assets/CSS/style.css" />
    <link rel="stylesheet" href="Assets/CSS/font-awesome.css" /><!--fontawasome icon-->
    <link rel="stylesheet" type="text/css" href="Assets/CSS/login.css" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" /><!--Google font-->
</head>

<body>
<header id="header" class="container">
    <div class="row">
        <div id="header_logo" class="col-xs-8">
            <h1 class="hidden">Mentor Hub</h1>
            <a href=""><img src="Assets/Images/logo.png" id="header_logoImg" alt="Mentor Hub logo" ></a>
        </div><!--END header_logo-->

        <div id="header_login" class="col-xs-4">
            <button type="button" class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-target="#login_window"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login</button>
        </div><!--END header_login-->
    </div><!--END header-->
</header>

<div class="modal fade" id="login_window" tabindex="-1"><!--login_window-->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p id="profile-name" class="profile-name-card"></p>
                <form class="form-login" action="welcome.php" method="post">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="email" name="email" id="input-email" class="form-control" placeholder="Email address" required autofocus>
                    <input type="password" name="password" id="input-password" class="form-control" placeholder="Password" required>
                    <div id="message"><?php if(isset($message)){echo $message;} ?></div>
                    <div id="remember" class="checkbox">
                        <label><input type="checkbox" value="remember-me"> Remember me</label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" name="btn_login" type="submit">Sign in</button>
                </form><!-- END form-login -->
                <a href="#" class="forgot-password">Forgot the password?</a>
            </div>
        </div><!-- END modal-content -->
    </div>
</div>
<!--Sabin's Store Manager Registration Modal Window-->
<div class="modal fade" id="Register_store" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Store Manager Registration Form</h4>
            </div>
            <div class="modal-body">

                <form>
                    <div class="form-group">
                        <label for="txtFirstName">First Name</label>
                        <input type="text" class="form-control" id="txtFirstName" placeholder="Enter First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="txtMiddleName">Middle Name</label>
                        <input type="text" class="form-control" id="txtMiddleName" placeholder="Enter Middle Name">
                    </div>
                    <div class="form-group">
                        <label for="txtLastName">Last Name</label>
                        <input type="text" class="form-control" id="txtLastName" placeholder="Enter Last Name" required>
                    </div>
                    <div class="form-group">
                        <fieldset>
                            <legend>Gender</legend>
                            <label for="rdFemale">Female</label>
                            <input type="radio" name="gender" value="Female" id="rdFemale" >
                            <label for="rdmale">Male</label>
                            <input type="radio" name="gender" value="male" id="rdmale">
                        </fieldset>

                    </div>
                    <div class="form-group">
                        <label for="txtDoB">Date of Birth</label>
                        <input type="date" id="txtDoB" required class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="txtUnit">Unit Number</label>
                        <input type="text" class="form-control" id="txtUnit" placeholder="Enter Unit Number">
                    </div>
                    <div class="form-group">
                        <label for="txtAddress">Street Address</label>
                        <input type="text" class="form-control" id="txtAddress" placeholder="Enter Address" required>
                    </div>
                    <div class="form-group">
                        <label for="txtUserName">User Name</label>
                        <input type="text" class="form-control" id="txtUserName" placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group">
                        <label for="txtpsd">Password</label>
                        <input type="password" class="form-control" id="txtpsd"  required>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveStoreManager">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End of Sabin's Store Manager Registration Modal Window-->

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
<!--This is Sabin's Login Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="login_store">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Store Manager Login</h4>
            </div>
            <div class="modal-body">
                <div id="InvalidMessage" style="color: red; text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: .9rem;"></div>
                <form>
                    <div class="form-group">
                        <label for="txtUserName">User Name</label>
                        <input type="text" class="form-control" id="txtUserName" placeholder="Enter User Name" required>
                    </div>
                    <div class="form-group">
                        <label for="txtpsd">Password</label>
                        <input type="password" class="form-control" id="txtpsd"  required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btnManagerLogin">Sign In</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--This is END of Sabin's Login Modal-->
</div>

<?php
/*if(isset($_POST['login'])){
    session_start();
    $_SESSION['login']='success';
    $_SESSION['memberid']='1';
    header('location:index.php');
    exit;
}*/
?>
</div><!--END login_window-->

<?php require_once('routes.php'); ?>

<footer id="footer" class="container sticky">
    <div class="row">
        <nav id="footer_nav" class="col-sm-8">
            <ul class="nav nav-pills">
                <li><a href="#">ABOUT</a></li>
                <li><a href="#">BLOG</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">EVENT MEET UP</a></li>
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
</body>
</html>




