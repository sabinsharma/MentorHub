<?php

class Match
{

    public function getRandom($conn){

        //Grab the five random mentors
        $query5Members = 'SELECT * FROM sample_quickmatch_tbl ORDER BY rand() LIMIT 5';
        $PDOstmt = $conn->prepare($query5Members);
        $PDOstmt->execute();
        $fivemembers = $PDOstmt->fetchAll();
        return $fivemembers;
    }

    public function getNew($conn){
        //Grab the five newest members
        $queryNewMembers = 'SELECT * FROM sample_quickmatch_tbl ORDER BY reg_date DESC LIMIT 5';
        $PDOstmt2 = $conn->prepare($queryNewMembers);
        $PDOstmt2->execute();
        $newmembers = $PDOstmt2->fetchAll();
        return $newmembers;
    }

    public function getOnline($conn){
        //Grab five random active members
        $queryOnlineMembers = 'SELECT * FROM sample_quickmatch_tbl WHERE active=1 ORDER BY rand() LIMIT 5';
        $PDOstmt3 = $conn->prepare($queryOnlineMembers);
        $PDOstmt3->execute();
        $onlinemembers = $PDOstmt3->fetchAll();
        return $onlinemembers;
    }


    public function getFeatured($conn){
        $queryFeaturedMembers = 'SELECT * FROM sample_quickmatch_tbl ORDER BY avg_star_rating DESC, rand() LIMIT 5';
        $PDOstmt4 = $conn->prepare($queryFeaturedMembers);
        $PDOstmt4->execute();
        $featuredmembers = $PDOstmt4->fetchAll();
        return $featuredmembers;
    }

    public function getNearby($conn, $username){

        //1) Find your location
        $queryMyLocation = 'SELECT city_name FROM sample_quickmatch_tbl WHERE username= :username';
        $PDOstmt5 = $conn->prepare($queryMyLocation);
        $PDOstmt5->bindValue(':username', $username);
        $PDOstmt5->execute();
        $mycity = $PDOstmt5->fetch();

        //var_dump($mycity);

        //2) Find a random list of members from the same city
        $queryNearbyMembers = 'SELECT * FROM sample_quickmatch_tbl WHERE city_name = :mycity ORDER BY rand() LIMIT 5';
        $PDOstmt6 = $conn->prepare($queryNearbyMembers);
        $PDOstmt6->bindValue(':mycity', $mycity['city_name']); //$mycity is an array with a key-value pair, grab the value
        $PDOstmt6->execute();
        $nearbymembers = $PDOstmt6->fetchAll();

        //var_dump($nearbymembers);

        return $nearbymembers;

    }



}