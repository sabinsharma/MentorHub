<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 17/03/2017
 * Time: 5:06 PM
 */
//if(session_status()==PHP_SESSION_NONE){
//    session_start();
//}

session_start();



    if(isset($_GET['controller']) && isset($_GET['action'])){
        $controller=$_GET['controller'];//post
        $action=$_GET['action'];//index
    }
    else
    {
        $controller='default';
        $action='index';
    }

    if(isset($_SESSION['member_id']) && !empty($_SESSION['member_id'])) {
        require_once('Views/layout.php');
    }
    elseif (isset($_SESSION['manager_id']) && !empty($_SESSION['manager_id'])){
        require_once('Views/StoreLayout.php');
    }
    else
    {
//    echo '<script>alert("naviagate");</script>';
        header('location:welcome.php');
    }




