<?php

class NoteModel
{
    public $id;
    public $title;
    public $content;
    public $creator_id;
    public $image;
    public $date_created;


    public function setId($value){
        $this->id = $value;
    }
    public function getId(){
        return $this->id;
    }

    public function setTitle($value){
        $this->title = $value;
    }
    public function getTitle(){
        return $this->title;
    }

    public function setContent($value){
        $this->content = $value;
    }
    public function getContent(){
        return $this->content;
    }

    public function setCreatorId($value){
        $this->creator_id = $value;
    }
    public function getCreatorId(){
        return $this->creator_id;
    }

    public function setImage($value){
        $this->image = $value;
    }
    public function getImage(){
        return $this->image;
    }

    public function setDateCreated($value){
        $this->date_created = $value;
    }
    public function getDateCreated(){
        return $this->date_created;
    }
}