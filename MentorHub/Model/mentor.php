<?php

class Mentor {

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;  //Pass in connection using the constructor so you don't have to repeatedly input it  into every function
    }

    public function getAMentor($mentor_id){

        //Get username for selected mentor_id
        $queryMentor = 'SELECT * FROM mentor_tbl WHERE id =:mentor_id';
        $PDOstmt1 = $this->conn->prepare($queryMentor);
        $PDOstmt1->bindValue(':mentor_id', $mentor_id);
        $PDOstmt1->execute();
        $mentoor = $PDOstmt1->fetch();
        return $mentoor;

    }

    public function getAllMentors(){

        //Get all mentors
        $queryAllMentors = 'SELECT * FROM mentor_tbl ORDER BY id';
        $PDOstmt2 = $this->conn->prepare($queryAllMentors);
        $PDOstmt2->execute();
        $mentors = $PDOstmt2->fetchAll();
        return $mentors;
    }

}