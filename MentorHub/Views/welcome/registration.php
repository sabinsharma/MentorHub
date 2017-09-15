<?php
?>

<section id="main_login" class="container">
    <div id="main_login_text">
        <h1>Registration</h1>
        <p>Please fill in the fields to register an account</p>
        <form class="form-login" action="welcome.php?controller=welcome&action=registration" method="post">
            <input type="text" name="first_name" id="input-name" class="form-control" placeholder="First Name" required autofocus>
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" name="email" id="input-email" class="form-control" placeholder="Email address" required autofocus>
            <input type="text" name="username" id="input-username" class="form-control" placeholder="Username" required autofocus>
            <input type="password" name="password" id="input-password" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block btn-signin" name="btn_reg" type="submit">Register an account</button>
        </form><!-- END form-REGISRATION-->
    </div>
    <div id="message"><?php if(isset($message)){echo $message;} ?></div>
</section>

