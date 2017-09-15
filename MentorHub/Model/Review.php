<?php

class Review
{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;  //Pass in connection using the constructor so you don't have to repeatedly input it  into every function
    }

    function getReviews($mentor_id){
        //Get reviews based on mentor_id
        $queryReviews = 'SELECT R.id, mentor_id, username, review 
                     FROM reviews_tbl R INNER JOIN mentor_tbl M
                     ON M.id = R.mentor_id
                     WHERE M.id = :mentor_id';
        $PDOstmt3 = $this->conn->prepare($queryReviews);
        $PDOstmt3->bindValue(':mentor_id', $mentor_id);
        $PDOstmt3->execute();
        $reviews = $PDOstmt3->fetchAll();
        return $reviews;
    }

    function addReview($mentor_id, $add_review){
        //Add review to database
        $queryNewReview = 'INSERT INTO reviews_tbl
            (mentor_id, review)
          VALUES
            (:mentor_id, :add_review)';
        $statement3 = $this->conn->prepare($queryNewReview);
        $statement3->bindValue(':mentor_id', $mentor_id);
        $statement3->bindValue(':add_review', $add_review);
        $statement3->execute();
    }

    function editReview($new_review, $review_id){
        //Edit review in database
        $queryEditReview = 'UPDATE reviews_tbl
                      SET review = :new_review
                      WHERE id = :review_id';
        $statement4 = $this->conn->prepare($queryEditReview);
        $statement4->bindValue(':new_review', $new_review);
        $statement4->bindValue(':review_id', $review_id);
        $statement4->execute();
    }

    function deleteReview($review_id){
        //Delete review from database by review_id
        $query = "DELETE FROM reviews_tbl WHERE id = :review_id";
        $PDOstmt = $this->conn->prepare($query);
        $PDOstmt->bindValue(':review_id', $review_id);
        $PDOstmt->execute();
    }

}