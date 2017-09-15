<?php

class BlogModel
{
    public $id;
    public $heading;
    public $content;
    public $summary;
    public $member_id;
    public $category_id;
    public $date_created;

    public function setId($value){
        $this->id = $value;
    }
    public function getId(){
        return $this->id;
    }

    public function setHeading($value){
//        echo ("from BLogModel: ".$value);
        $this->heading = $value;
    }
    public function getHeading(){
        return $this->heading;
    }

    public function setContent($value){
        $this->content = $value;
    }
    public function getContent(){
        return $this->content;
    }

    public function setSummary($value){
        $this->summary = $value;
    }
    public function getSummary(){
        return $this->summary;
    }

    public function setMemberId($value){
        $this->member_id = $value;
    }
    public function getMemberId(){
        return $this->member_id;
    }

    public function setCategoryId($value){
        $this->category_id = $value;
    }
    public function getCategoryId(){
        return $this->category_id;
    }

    public function setDateCreated($value){
        $this->date_created = $value;
    }
    public function getdateCreated(){
        return $this->date_created;
    }
}