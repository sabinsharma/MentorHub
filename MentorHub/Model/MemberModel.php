<?php

class MemberModel
{
    public $id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $is_mentor;
    public $gender;
    public $dob;
    public $image;

    public function setId($value){
        $this->id = $value;
    }
    public function getId(){
        return $this->id;
    }

    public function setFirstName($value){
//        echo ("from BLogModel: ".$value);
        $this->first_name = $value;
    }
    public function getFirstName(){
        return $this->first_name;
    }

    public function setMiddleName($value){
        $this->middle_name = $value;
    }
    public function getMiddleName(){
        return $this->middle_name;
    }

    public function setLastName($value){
        $this->last_name = $value;
    }
    public function getLastName(){
        return $this->last_name;
    }

    public function setIsMentor($value){
        $this->is_mentor = $value;
    }
    public function getIsMentor(){
        return $this->is_mentor;
    }

    public function setGender($value){
        $this->gender = $value;
    }
    public function getGender(){
        return $this->gender;
    }

    public function setDob($value){
        $this->dob = $value;
    }
    public function getDob(){
        return $this->dob;
    }

    public function setImage($value){
        $this->image = $value;
    }
    public function getImage(){
        return $this->image;
    }
}