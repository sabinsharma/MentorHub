<?php
class MessageDtl
{
    public $Id, $Message_id, $Recipient_id;

    public function getId()
    {
        return $this->Id;
    }

    public function setId($Id)
    {
        $this->Id = $Id;
    }

    public function getMessage_id()
    {
        return $this->Message_id;
    }

    public function setMessage_id($Message_id)
    {
        $this->Message_id = $Message_id;
    }
    public function getRecipient_id()
    {
        return $this->Recipient_id;
    }

    public function setRecipient_id($Recipient_id)
    {
        $this->Recipient_id = $Recipient_id;
    }
}