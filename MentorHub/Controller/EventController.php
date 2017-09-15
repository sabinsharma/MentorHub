<?php

/**
 * Created by PhpStorm.
 * User: Asuka
 * Date: 2017/03/24
 * Time: 16:07
 */
class EventController
{
    public function index(){
        require_once 'Views/Event/eventView.php';
    }
    public function create(){
        require_once 'Views/Event/eventCreate.php';
    }
    public function view(){
        require_once 'Views/Event/eventDetail.php';
    }
}