<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 4/04/2017
 * Time: 3:18 PM
 */
class TopicsDetail
{
    public $topic_id;
    public $reply;
    public $active;
    public $replied_by;
    /**
     * @return mixed
     */
    public function getTopicId()
    {
        return $this->topic_id;
    }

    /**
     * @param mixed $topic_id
     */
    public function setTopicId($topic_id)
    {
        $this->topic_id = $topic_id;
    }

    /**
     * @return mixed
     */
    public function getReply()
    {
        return $this->reply;
    }

    /**
     * @param mixed $reply
     */
    public function setReply($reply)
    {
        $this->reply = $reply;
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
    public function getRepliedBy()
    {
        return $this->replied_by;
    }

    /**
     * @param mixed $replied_by
     */
    public function setRepliedBy($replied_by)
    {
        $this->replied_by = $replied_by;
    }
}