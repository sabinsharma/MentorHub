<?php
?>

<section id="main_login" class="container">
    <div id="main_login_text">
        <h1>Registration Confirmation</h1>
        <p>Enter your email and the confirmation code sent to your email</p>
        <form class="form-login" action="welcome.php?controller=welcome&action=confirm" method="post">
            <input type="email" name="email" id="input-email" class="form-control" placeholder="Email address" required autofocus>
            <input type="text" name="confirm_key" id="input-confirm" class="form-control" placeholder="Confirmation Code" required autofocus>
            <button class="btn btn-lg btn-primary btn-block btn-signin" name="btn_confirm" type="submit">Confirm</button>
        </form><!-- END form-CONFIRMATION-->
    </div>
    <div id="message"><?php if(isset($message)){echo $message;}?></div>
</section>