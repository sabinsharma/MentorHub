<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 18/03/2017
 * Time: 9:00 PM
 */
class DiscussionArea
{
    public $id;
    public $discussion_area;
    public $active;
    public $entered_by;

    public function __construct(/*$id,$discussion_area,$active,$entered_by*/)
    {
        /*$this->id=$id;
        $this->discussion_area=$discussion_area;
        $this->active=$active;
        $this->entered_by=$entered_by;*/
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDiscussionArea()
    {
        return $this->discussion_area;
    }

    /**
     * @param mixed $discussion_area
     */
    public function setDiscussionArea($discussion_area)
    {
        $this->discussion_area = $discussion_area;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getEnteredBy()
    {
        return $this->entered_by;
    }

    /**
     * @param mixed $entered_by
     */
    public function setEnteredBy($entered_by)
    {
        $this->entered_by = $entered_by;
    }
}