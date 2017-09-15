<?php

/**
 * Created by PhpStorm.
 * User: tejpa
 * Date: 19-Apr-17
 * Time: 11:03 AM
 */
class ShareNoteController
{
    public function index(){
        require_once 'Views/ShareNote/notes.php';
    }

    public function create(){
        require_once 'Views/ShareNote/createnewnote.php';
    }

    public function noteshare(){
        require_once 'Views/ShareNote/noteshare.php';
    }

    public function sharednote(){
        require_once 'Views/ShareNote/viewsharednote.php';
    }

}