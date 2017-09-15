<?php

class WelcomeController
{
    public function login(){
        require_once  'Views/welcome/login.php';
    }

    public function registration(){

        $message = '';

        if(isset($_POST['btn_reg'])){
            //get form inputs
            $first_name = $_POST['first_name'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $crud = new CRUD();
            $checkEmail = $crud->getEmail($email);


            $checkUsername = $crud->getUsername($username);

            $countEmail = count($checkEmail);
            $countUsername = count($checkUsername);

            if($countEmail > 0){
                $message = 'Email already in use';
            }elseif ($countUsername > 0){
                $message = 'Username already in use';
            }else{
                $confirm_key = mt_rand(10000000, 99999999);


                $crud->inputMst($first_name, $email);

                $idResult = $crud->getId($email);

                $member_id = $idResult[0]['id'];

                $crud->inputProfile($username, $password, $confirm_key, $member_id);

                //sends the confirmation key to the user's email
                //mail($email,"HumberHub Confirm Your Account", "This is your confimation code: " . $confirm_key);

                echo'<script>window.location="welcome.php?controller=welcome&action=confirm";</script>';
            }
        }
        require_once 'Views/welcome/registration.php';
    }

    public function confirm(){
        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }

        $message = '';

        if(isset($_POST['btn_confirm'])){
            $confirm_key = $_POST['confirm_key'];
            $email = $_POST['email'];

            $info = new CRUD();
            $infoResult = $info->confirmEmail($email);

            $countEmail = count($infoResult);

            if($countEmail > 0){
                // getting username
                $username = $infoResult[0]['username'];

                $codeInfo = new CRUD();
                $codeResult = $codeInfo->confirmCode($username, $confirm_key);

                $countCode = count($codeResult);

                if($countCode > 0){
                    $confirm = new CRUD();
                    $confirm->setConfirm($username);

                    $message = 'Confirmation successful, please login.';
                } else{
                    $message = 'invalid confirmation code';
                }
            } else {
                $message = 'invalid email';
            }
        }
        require_once 'Views/welcome/confirm.php';
    }
}