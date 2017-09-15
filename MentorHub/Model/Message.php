<?php
class Message
{
    public $Id,$Sender_id,$Message,$Subject,$Timestamp,$is_send,$is_read;

    public function getId()
    {
        return $this->Id;
    }
    public function setId($Id)
    {
        $this->Id = $Id;
    }
    public function getSender_Id()
    {
        return $this->Sender_Id;
    }
    public function setSender_id($Sender_id)
    {
        $this->Sender_id = $Sender_id;
    }
    public function getMessage()
    {
        return $this->Message;
    }
    public function setMessage($Message)
    {
        $this->Message = $Message;
    }
    public function Subject()
    {
        return $this->Subject;
    }
    public function setSubject($Subject)
    {
        $this->Subject = $Subject;
    }
    public function getTimestamp()
    {
        return $this->Timestamp;
    }
    public function setTimestamp($Timestamp)
    {
        $this->Timestamp = $Timestamp;
    }
    public function getis_send()
    {
        return $this->is_send;
    }
    public function setis_send($is_send)
    {
        $this->is_send = $is_send;
    }
    public function getis_read()
    {
        return $this->is_read;
    }
    public function setis_read($is_read)
    {
        $this->is_read = $is_read;
    }
}