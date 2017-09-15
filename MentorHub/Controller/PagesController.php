<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 17/03/2017
 * Time: 5:37 PM
 */
class PagesController
{
    public function home(){
        $first_name='Sabin';
        $last_name='Snow';
        require_once('Views/pages/home.php');
    }

    public function error(){
        require_once ('Views/pages/error.php');
//        header('location:index.php');
//        exit;
    }
}