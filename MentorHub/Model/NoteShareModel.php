<?php


class NoteShareModel
{
    public $id;
    public $sender_id;
    public $receiver_id;
    public $note_id;
    public $share_date;


    public function setId($value){
        $this->id = $value;
    }
    public function getId(){
        return $this->id;
    }

    public function setSenderId($value){
        $this->sender_id = $value;
    }
    public function getSenderId(){
        return $this->sender_id;
    }

    public function setReceivererId($value){
        $this->receiver_id = $value;
    }
    public function getReceiverId(){
        return $this->receiver_id;
    }

    public function setNoteId($value){
        $this->note_id = $value;
    }
    public function getNoteId(){
        return $this->note_id;
    }

    public function setShareDate($value){
        $this->share_date = $value;
    }
    public function getShareDate(){
        return $this->share_date;
    }
}