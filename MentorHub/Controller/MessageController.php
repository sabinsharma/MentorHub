<?php

class MessageController
{
    public function index(){
        require_once 'Views/Message/messageInbox.php';
    }
    public function create(){
        require_once 'Views/Message/messageCreate.php';
    }
    public function view(){
        require_once 'Views/Message/messageView.php';
    }
    public function send(){
        require_once 'Views/Message/messageSendbox.php';
    }


}