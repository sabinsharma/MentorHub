<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 11/04/2017
 * Time: 5:12 PM
 */
require_once 'Model/Chat.php';
class ChattingController
{
    public function chat(){
       // $chat=new Chat();
        //$chat->init("mentorship");

        require_once 'Views/Chat/chat.php';
    }
}