<?php

class Stars
{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;  //Pass in connection using the constructor so you don't have to repeatedly input it  into every function
    }
    function updateStars($mentor_id, $stars)
    {
        //Set or update star-rating in database
        $queryStarRating = 'UPDATE mentor_tbl SET star_rating =:stars WHERE id=:mentor_id';
        $statement4 = $this->conn->prepare($queryStarRating);
        $statement4->bindValue(':mentor_id', $mentor_id);
        $statement4->bindValue(':stars', $stars);
        $statement4->execute();
    }
}