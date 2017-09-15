<?php
class EventDtl
{
    public $Id,$Event_id,$Member_id;

    public function getId()
    {
    return $this->Id;
    }
    public function setId($Id)
    {
    $this->Id = $Id;
    }
    public function getEvent_Id()
    {
        return $this->Event_Id;
    }
    public function setEvent_id($Event_id)
    {
        $this->Event_id = $Event_id;
    }
    public function getMember_id()
    {
        return $this->Member_id;
    }
    public function setMember_id($Member_id)
    {
        $this->Member_id = $Member_id;
    }
}