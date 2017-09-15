<?php
class EventInfo
{
    public $Id,$Title,$Description, $Host_id, $Date, $Time, $Location, $Enter_time, $Is_Private, $Apply_due_date, $Apply_max_people;

    public function getId()
    {
        return $this->Id;
    }
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    public function getTitle()
    {
        return $this->Title;
    }
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }

    public function getDesc()
    {
        return $this->Description;
    }
    public function setDesc($Description)
    {
        $this->Description = $Description;
    }

    public function getHostId()
    {
        return $this->Host_id;
    }
    public function setHostId($Host_id)
    {
        $this->Host_id = $Host_id;
    }

    public function getDate()
    {
        return $this->Date;
    }
    public function setDate($Date)
    {
        $this->Date = $Date;
    }

    public function getTime()
    {
        return $this->Time;
    }
    public function setTime($Time)
    {
        $this->Time = $Time;
    }

    public function setLocation($Location)
    {
        $this->Location = $Location;
    }

    public function getTimestamp()
    {
        return $this->Enter_time;
    }
    public function setTimestamp($Enter_time)
    {
        $this->Enter_time = $Enter_time;
    }
    public function getIsPrivate()
    {
        return $this->Is_Private;
    }
    public function setIsPrivate($Is_Private)
    {
        $this->Is_Private = $Is_Private;
    }

    public function getDueDate()
    {
        return $this->Apply_due_date;
    }
    public function setDueDate($Apply_due_date)
    {
        $this->Apply_due_date = $Apply_due_date;
    }

    public function getMaxPeople()
    {
        return $this->Apply_max_people;
    }
    public function setMaxPeople($Apply_max_people)
    {
        $this->Apply_max_people = $Apply_max_people;
    }
}