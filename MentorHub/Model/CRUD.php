<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 18/03/2017
 * Time: 3:08 PM
 */
require_once "ConnectDB.php";
class CRUD
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection=ConnectDB::dbConnect();
    }



    public function Find($table,$id){
        $query='';

        if($id[key($id)]=='id'){
            $query='SELECT * FROM '. $table;
            $stmt=$this->dbConnection->prepare($query);
            $stmt->execute();
            $rows=$stmt->fetchAll();
            $stmt->closeCursor();
            //var_dump($rows);
            return $rows;
        }
        else{
            $query='SELECT * FROM '. $table.' WHERE '.key($id).'=:Id';
            //echo $query."<br/>";
            $stmt=$this->dbConnection->prepare($query);
            //echo key($id).$id[key($id)];
            $stmt->bindValue(":Id",$id[key($id)]);
            $stmt->execute();
            $rows=$stmt->fetchAll();
            $stmt->closeCursor();
            //var_dump($rows);
            return $rows;
        }

    }

    public function SelectAll($qry){
        $stmt=$this->dbConnection->prepare($qry);
        $stmt->execute();
        $rows=$stmt->fetchAll();
        $stmt->closeCursor();
        //var_dump($rows);
        return $rows;
    }

    public function Save($qry){
        $pdostmt=$this->dbConnection->prepare($qry);
        return $pdostmt->execute();
    }

    public function FetchALL($table,$orderby=1){
        $query="SELECT * FROM $table ORDER BY $orderby";
        //echo $query;
        $statement = $this->dbConnection->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function InsertInfo($tableName,$obj){

        $query="INSERT INTO $tableName (";
        //loop for column name
        foreach ($obj as $key => $value)
        {
            $query.=$key.',';
        }
        $query= rtrim($query,','); //trim the last ","
        $query.=") Values(";
        //loop for values
        foreach ($obj as $key =>$value)
        {
            $query.=":".$key.',';
        }
        $query= rtrim($query,',');//trim the last ","
        $query.=")";
        //echo $query;
        $pdostmt=$this->dbConnection->prepare($query);

        foreach ($obj as $key=>$value){
            //echo $key."=".$value;
            $pdostmt->bindValue(':'.$key,$value);
        }

        return $pdostmt->execute();
    }

    public  function UpdateInfo($tableName,$obj){
        $query="UPDATE $tableName set ";
        foreach ($obj as $key=>$value){
            $query.=$key."=:".$key.",";
        }
        $objvalue=current(get_object_vars($obj)); //get the single value
        $objkey=key(get_object_vars($obj));//get the key

        $query=rtrim($query,",")." WHERE $objkey=:$objkey";

        $stmt=$this->dbConnection->prepare($query);

        foreach ($obj as $key=>$value){
            $stmt->bindValue(":".$key,$value);
        }
        $stmt->bindValue(":".$objkey,$objvalue);
        //echo $query."<br/>";
        return $stmt->execute();

    }

    public function DeleteInfo($tblname,$id){
        $query = 'DELETE FROM '.$tblname. ' WHERE '. KEY($id).'= :id';
        //echo $query;
        $statement = $this->dbConnection->prepare($query);
        $statement->bindValue(':id', $id[Key($id)]);
        $delrcords=$statement->execute();
        $statement->closeCursor();
        return $delrcords;
    }

    public function UpdateColumn($tablename,$id,$colName){
        // UPDATE `tbl_topics` SET `view_count`=(SELECT view_count+1 WHERE id=1) WHERE id=1
        //$query="UPDATE $tablename as a SET a.$colName=(SELECT t.$colName+1 FROM $tablename t WHERE t.id=:id ) WHERE a.id=:id";
        $query="UPDATE $tablename SET ".Key($colName)."=:colName WHERE id=:id";
//        echo $query;
        $stmt=$this->dbConnection->prepare($query);
        $stmt->bindValue(":id",$id);
        $stmt->bindValue(":colName",$colName[key($colName)]);
        return $stmt->execute();

    }

    public function getMaxValue($tblname,$colName,$id){
        $query="SELECT $colName FROM $tblname WHERE id=:id";

        $stmt=$this->dbConnection->prepare($query);
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        //var_dump($rows);
        return $rows;
        //return $query;
    }

    public function Select($query,$class){
        require_once ($class);
        return $this->dbConnection->query($query)->fetchAll(PDO::FETCH_CLASS,'DiscussionArea');
    }

    /*This is from Caelia*/

    public function getLogin($email, $password){
        //Get email and password
        $queryLogin = 'SELECT id, email, password FROM login WHERE email =:email and password =:password';
        $PDO = $this->dbConnection->prepare($queryLogin);
        $PDO->bindValue(':email', $email);
        $PDO->bindValue(':password', $password);
        $PDO->execute();
        $loginResult = $PDO->fetchAll();
        $PDO->closeCursor();
        return $loginResult;
    }

    public function checkConfirmation($email){
        //check if user has confirmed their account
        $queryConfirm = 'SELECT confirmation FROM login WHERE email=:email and confirmation=:yes';
        $PDO1 = $this->dbConnection->prepare($queryConfirm);
        $PDO1->bindValue(':email', $email);
        $PDO1->bindValue(':yes', 'yes');
        $PDO1->execute();
        $confirmResult = $PDO1->fetchAll();
        $PDO1->closeCursor();
        return $confirmResult;
    }


    public function getEmail ($email){
        $queryCheckEmail = 'SELECT email FROM tbl_member_mst WHERE email =:email';
        $PDO = $this->dbConnection->prepare($queryCheckEmail);
        $PDO->bindValue(':email', $email);
        $PDO->execute();
        $checkEmail = $PDO->fetchAll();
        $PDO->closeCursor();
        return $checkEmail;
    }

    public function getUsername ($username){
        $queryCheckUsername = 'SELECT username FROM tbl_member_profile WHERE username =:username';
        $PDO1 = $this->dbConnection->prepare($queryCheckUsername);
        $PDO1->bindValue(':username', $username);
        $PDO1->execute();
        $checkUsername = $PDO1->fetchAll();
        $PDO1->closeCursor();
        return $checkUsername;
    }

    public function inputMst ($first_name, $email){
        //inputting the first set of values into the database
        $queryRegisterOne = 'INSERT INTO `tbl_member_mst` (`first_name`, `email`) VALUES (:first_name, :email)';
        $PDO2 = $this->dbConnection->prepare($queryRegisterOne);
        $PDO2->bindValue(':first_name', $first_name);
        $PDO2->bindValue(':email', $email);
        $PDO2->execute();
        $PDO2->closeCursor();
    }

    public function getId ($email){
        //getting member_id
        $queryId = 'SELECT id FROM tbl_member_mst WHERE email =:email';
        $PDO4 = $this->dbConnection->prepare($queryId);
        $PDO4->bindValue(':email', $email);
        $PDO4->execute();
        $idResult = $PDO4->fetchAll();
        $PDO4->closeCursor();
        return $idResult;
    }

    public function inputProfile ($username, $password, $confirm_key, $member_id){
        //inputting the second set of values into the database
        $queryRegisterTwo = 'INSERT INTO `tbl_member_profile` (`username`, `password`, `confirm_key`, `member_id`) VALUES (:username, :password, :confirm_key, :member_id)';
        $PDO3 = $this->dbConnection->prepare($queryRegisterTwo);
        $PDO3 ->bindValue(':username', $username);
        $PDO3->bindValue(':password', $password);
        $PDO3->bindValue(':confirm_key', $confirm_key);
        $PDO3->bindValue(':member_id', $member_id);
        $PDO3->execute();
        $PDO3->closeCursor();
    }

    public function confirmEmail($email){
        //checking if email in database
        $queryConfirmInfo = 'SELECT email, username FROM confirm_account WHERE email=:email';
        $PDO1 = $this->dbConnection->prepare($queryConfirmInfo);
        $PDO1->bindValue(':email', $email);
        $PDO1->execute();
        $infoResult = $PDO1->fetchAll();
        $PDO1->closeCursor();
        return $infoResult;
    }

    public function confirmCode($username, $confirm_key){
        //checking if confirmation key is correct
        $queryConfirm = 'SELECT confirm_key FROM confirm_account WHERE username=:username and confirm_key=:confirm_key';
        $PDO = $this->dbConnection->prepare($queryConfirm);
        $PDO->bindValue(':username', $username);
        $PDO->bindValue(':confirm_key', $confirm_key);
        $PDO->execute();
        $codeResult = $PDO->fetchAll();
        $PDO->closeCursor();
        return $codeResult;
    }

    public function setConfirm($username){
        //set confirmation to YES
        $queryUpdate = 'UPDATE `tbl_member_profile` SET confirmation=:yes WHERE username=:username';
        $PDO3 = $this->dbConnection->prepare($queryUpdate);
        $PDO3->bindValue(':yes', 'yes');
        $PDO3->bindValue(':username', $username);
        $PDO3->execute();
        $PDO3->closeCursor();
    }

    public function getProfileInfo($profileId){
        //Get name, gender, dob, email, limit, rating
        $queryProfile = 'SELECT id, first_name, middle_name, last_name, gender, dob, city_id, street_name, postal_code, email, experience, mentorship_limit, average_star_rating, pic_path FROM tbl_member_mst WHERE id =:id';
        $PDO = $this->dbConnection->prepare($queryProfile);
        $PDO->bindValue(':id', $profileId);
        $PDO->execute();
        $profileResult = $PDO->fetchAll();
        $PDO->closeCursor();
        return $profileResult;
    }

    public function getAddress($cityId){
        //Get address
        $queryCity = 'SELECT province_id, city_name FROM tbl_city WHERE id =:cityId';
        $PDOO = $this->dbConnection->prepare($queryCity);
        $PDOO->bindValue(':id', $cityId);
        $PDOO->execute();
        $cityResult = $PDOO->fetchAll();
        $PDOO->closeCursor();
        return $cityResult;
    }

    public function getDescription($profileId){
        //Get description
        $queryDescription = 'SELECT member_description FROM tbl_member_profile WHERE member_id =:id';
        $PDO1 = $this->dbConnection->prepare($queryDescription);
        $PDO1->bindValue(':id', $profileId);
        $PDO1->execute();
        $descriptionResult = $PDO1->fetchAll();
        $PDO1->closeCursor();
        return $descriptionResult;
    }

    public function getHobbies($profileId){
        //Get  hobbies
        $queryHobbies = 'SELECT hobby FROM tbl_member_hobbies WHERE member_id =:id';
        $PDO2 = $this->dbConnection->prepare($queryHobbies);
        $PDO2->bindValue(':id', $profileId);
        $PDO2->execute();
        $hobbiesResult = $PDO2->fetchAll();
        $PDO2->closeCursor();
        return $hobbiesResult;
    }

    public function getAcademic($profileId){
        //Get  academic
        $queryAcademic = 'SELECT id, certification, program FROM tbl_member_academic WHERE member_id =:id';
        $PDO5 = $this->dbConnection->prepare($queryAcademic);
        $PDO5->bindValue(':id', $profileId);
        $PDO5->execute();
        $academicResult = $PDO5->fetchAll();
        $PDO5->closeCursor();
        return $academicResult;
    }

    public function addPicture($profileId, $imgData){
        $queryPicture = 'UPDATE `tbl_member_mst` SET pic_path=:pic_path WHERE id=:profileId';
        $PDO = $this->dbConnection->prepare($queryPicture);
        $PDO->bindValue(':pic_path', $imgData);
        $PDO->bindValue(':profileId', $profileId);
        $PDO->execute();
        $PDO->closeCursor();
    }

    public function addGender($gender, $profileId){
        $queryGender= 'UPDATE `tbl_member_mst` SET gender=:gender WHERE id=:profileId';
        $PDO1 = $this->dbConnection->prepare($queryGender);
        $PDO1->bindValue(':gender', $gender);
        $PDO1->bindValue(':profileId', $profileId);
        $PDO1->execute();
        $PDO1->closeCursor();
    }

    public function addDOB($dob, $profileId){
        $queryDOB= 'UPDATE `tbl_member_mst` SET dob=:dob WHERE id=:profileId';
        $PDO2 = $this->dbConnection->prepare($queryDOB);
        $PDO2->bindValue(':dob', $dob);
        $PDO2->bindValue(':profileId', $profileId);
        $PDO2->execute();
        $PDO2->closeCursor();
    }

    public function addLimit($limit, $profileId){
        $queryLimit= 'UPDATE `tbl_member_mst` SET mentorship_limit=:limit WHERE id=:profileId';
        $PDO3 = $this->dbConnection->prepare($queryLimit);
        $PDO3->bindValue(':limit', $limit);
        $PDO3->bindValue(':profileId', $profileId);
        $PDO3->execute();
        $PDO3->closeCursor();
    }

    public function addExperience($exp, $profileId){
        $queryExperience= 'UPDATE `tbl_member_mst` SET experience=:exp WHERE id=:profileId';
        $PDO4 = $this->dbConnection->prepare($queryExperience);
        $PDO4->bindValue(':exp', $exp);
        $PDO4->bindValue(':profileId', $profileId);
        $PDO4->execute();
        $PDO4->closeCursor();
    }

    public function addDescription($des, $profileId){
        $queryDescription= 'UPDATE `tbl_member_profile` SET member_description=:des WHERE member_id=:profileId';
        $PDO5 = $this->dbConnection->prepare($queryDescription);
        $PDO5->bindValue(':des', $des);
        $PDO5->bindValue(':profileId', $profileId);
        $PDO5->execute();
        $PDO5->closeCursor();
    }

    public function addHobbies($hobbies, $profileId){
        $queryHobbies = 'INSERT INTO `tbl_member_hobbies` (`hobby`, `member_id`) VALUES (:hobby, :member_id)';
        $PDO6 = $this->dbConnection->prepare($queryHobbies);
        $PDO6->bindValue(':hobby', $hobbies);
        $PDO6->bindValue(':member_id', $profileId);
        $PDO6->execute();
        $PDO6->closeCursor();
    }

    public function addAcademic($profileId, $cert, $program){
        $queryAcademic = 'INSERT INTO `tbl_member_academic` (`member_id`, `certification`, `program` ) VALUES (:member_id, :cert, :program)';
        $PDO11 = $this->dbConnection->prepare($queryAcademic);
        $PDO11->bindValue(':member_id', $profileId);
        $PDO11->bindValue(':cert', $cert);
        $PDO11->bindValue(':program', $program);
        $PDO11->execute();
        $PDO11->closeCursor();
    }

    public function updateName($profileId, $firstname, $middlename, $lastname){
        $queryUpdateName= 'UPDATE `tbl_member_mst` SET first_name=:firstname, middle_name=:middlename, last_name=:lastname WHERE id=:profileId';
        $PDO12 = $this->dbConnection->prepare($queryUpdateName);
        $PDO12->bindValue(':firstname', $firstname);
        $PDO12->bindValue(':middlename', $middlename);
        $PDO12->bindValue(':lastname', $lastname);
        $PDO12->bindValue(':profileId', $profileId);
        $PDO12->execute();
        $PDO12->closeCursor();
    }

    public function updateEmail($profileId, $email){
        $queryUpdateEmail= 'UPDATE `tbl_member_mst` SET email=:email WHERE id=:profileId';
        $PDO13 = $this->dbConnection->prepare($queryUpdateEmail);
        $PDO13->bindValue(':email', $email);
        $PDO13->bindValue(':profileId', $profileId);
        $PDO13->execute();
        $PDO13->closeCursor();
    }

    public function updateHobbies($profileId, $hobby){
        $queryUpdateHobbies= 'UPDATE `tbl_member_hobbies` SET hobby=:hobby WHERE member_id=:profileId';
        $PDO14 = $this->dbConnection->prepare($queryUpdateHobbies);
        $PDO14->bindValue(':hobby', $hobby);
        $PDO14->bindValue(':profileId', $profileId);
        $PDO14->execute();
        $PDO14->closeCursor();
    }

    public function updateAcademics($id, $cert, $program){
        $queryUpdateAcademic = 'UPDATE `tbl_member_academic` SET certification=:cert, program=:program WHERE id=:id';
        $PDO15 = $this->dbConnection->prepare($queryUpdateAcademic);
        $PDO15->bindValue(':id', $id);
        $PDO15->bindValue(':cert', $cert);
        $PDO15->bindValue(':program', $program);
        $PDO15->execute();
        $PDO15->closeCursor();
    }

    public function deleteGender($delete, $profileId){
        $queryDeleteGender= 'UPDATE `tbl_member_mst` SET gender=:gender WHERE id=:profileId';
        $PDO16 = $this->dbConnection->prepare($queryDeleteGender);
        $PDO16->bindValue(':gender', $delete);
        $PDO16->bindValue(':profileId', $profileId);
        $PDO16->execute();
        $PDO16->closeCursor();
    }

    public function deleteDOB($delete, $profileId){
        $queryDeleteDOB= 'UPDATE `tbl_member_mst` SET dob=:dob WHERE id=:profileId';
        $PDO17 = $this->dbConnection->prepare($queryDeleteDOB);
        $PDO17->bindValue(':dob', $delete);
        $PDO17->bindValue(':profileId', $profileId);
        $PDO17->execute();
        $PDO17->closeCursor();
    }

    public function deleteLimit($delete, $profileId){
        $queryDeleteLimit= 'UPDATE `tbl_member_mst` SET mentorship_limit=:limit WHERE id=:profileId';
        $PDO18 = $this->dbConnection->prepare($queryDeleteLimit);
        $PDO18->bindValue(':limit', $delete);
        $PDO18->bindValue(':profileId', $profileId);
        $PDO18->execute();
        $PDO18->closeCursor();
    }

    public function deleteExperience($delete, $profileId){
        $queryDeleteExp= 'UPDATE `tbl_member_mst` SET experience=:exp WHERE id=:profileId';
        $PDO19 = $this->dbConnection->prepare($queryDeleteExp);
        $PDO19->bindValue(':exp', $delete);
        $PDO19->bindValue(':profileId', $profileId);
        $PDO19->execute();
        $PDO19->closeCursor();
    }

    public function deleteDescription($delete, $profileId){
        $queryDeleteDes= 'UPDATE `tbl_member_profile` SET member_description=:des WHERE member_id=:profileId';
        $PDO20 = $this->dbConnection->prepare($queryDeleteDes);
        $PDO20->bindValue(':des', $delete);
        $PDO20->bindValue(':profileId', $profileId);
        $PDO20->execute();
        $PDO20->closeCursor();
    }

    public function deleteHobbies($profileId){
        $queryDeleteHobbies= 'DELETE FROM `tbl_member_hobbies` WHERE member_id=:profileId';
        $PDO21 = $this->dbConnection->prepare($queryDeleteHobbies);
        $PDO21->bindValue(':profileId', $profileId);
        $PDO21->execute();
        $PDO21->closeCursor();
    }

    public function deleteAcademic($id){
        $queryDeleteAcademic= 'DELETE FROM `tbl_member_academic` WHERE id=:id';
        $PDO21 = $this->dbConnection->prepare($queryDeleteAcademic);
        $PDO21->bindValue(':id', $id);
        $PDO21->execute();
        $PDO21->closeCursor();
    }

    public function sendRequest($userId, $profileId){
        $querySendRequest = 'INSERT INTO `tbl_mentorship_request` (`sender_id`, `receiver_id`, `request_date`) VALUES (:userId, :profileId, :date)';
        $PDO = $this->dbConnection->prepare($querySendRequest);
        $PDO->bindValue(':userId', $userId);
        $PDO->bindValue(':profileId', $profileId);
        $PDO->bindValue(':date', date("Y-m-d"));
        $PDO->execute();
        $PDO->closeCursor();
    }

    public function getRequest($userId){
        $queryGetRequest = 'SELECT id, sender_id FROM tbl_mentorship_request WHERE receiver_id =:userId and status=:nothing';
        $PDO1 = $this->dbConnection->prepare($queryGetRequest);
        $PDO1->bindValue(':userId', $userId);
        $PDO1->bindValue(':nothing', '');
        $PDO1->execute();
        $getRequestResult = $PDO1->fetchAll();
        $PDO1->closeCursor();
        return $getRequestResult;
    }

    public function getSenderName($senderId){
        $querySenderName = 'SELECT first_name, middle_name, last_name FROM tbl_member_mst WHERE id =:senderId';
        $PDO2 = $this->dbConnection->prepare($querySenderName);
        $PDO2->bindValue(':senderId', $senderId);
        $PDO2->execute();
        $senderNameResult = $PDO2->fetchAll();
        $PDO2->closeCursor();
        return $senderNameResult;
    }

    public function requestStatus($requestId, $status){
        $queryStatus= 'UPDATE `tbl_mentorship_request` SET status=:status WHERE id=:requestId';
        $PDO3 = $this->dbConnection->prepare($queryStatus);
        $PDO3->bindValue(':status', $status);
        $PDO3->bindValue(':requestId', $requestId);
        $PDO3->execute();
        $PDO3->closeCursor();
    }
    /*End of Caelia*/


    /*From Janani*/
    function getReviews($mentor_id){
        //Get reviews based on mentor_id
        $queryReviews = 'SELECT R.id, mentor_id, username, review 
                     FROM reviews_tbl R INNER JOIN mentor_tbl M
                     ON M.id = R.mentor_id
                     WHERE M.id = :mentor_id';
        $PDOstmt3 = $this->dbConnection->prepare($queryReviews);
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
        $statement3 = $this->dbConnection->prepare($queryNewReview);
        $statement3->bindValue(':mentor_id', $mentor_id);
        $statement3->bindValue(':add_review', $add_review);
        $statement3->execute();
    }

    function editReview($new_review, $review_id){
        //Edit review in database
        $queryEditReview = 'UPDATE reviews_tbl
                      SET review = :new_review
                      WHERE id = :review_id';
        $statement4 = $this->dbConnection->prepare($queryEditReview);
        $statement4->bindValue(':new_review', $new_review);
        $statement4->bindValue(':review_id', $review_id);
        $statement4->execute();
    }

    function deleteReview($review_id){
        //Delete review from database by review_id
        $query = "DELETE FROM reviews_tbl WHERE id = :review_id";
        $PDOstmt = $this->dbConnection->prepare($query);
        $PDOstmt->bindValue(':review_id', $review_id);
        $PDOstmt->execute();
    }


    /*================Star Rating=================================*/
    function updateStars($mentor_id, $stars)
    {
        //Set or update star-rating in database
        $queryStarRating = 'UPDATE mentor_tbl SET star_rating =:stars WHERE id=:mentor_id';
        $statement4 = $this->dbConnection->prepare($queryStarRating);
        $statement4->bindValue(':mentor_id', $mentor_id);
        $statement4->bindValue(':stars', $stars);
        $statement4->execute();
    }
    /*==================================================================*/

    /*==================Mentor=========================================*/
    public function getAMentor($mentor_id){

        //Get username for selected mentor_id
        $queryMentor = 'SELECT * FROM mentor_tbl WHERE id =:mentor_id';
        $PDOstmt1 = $this->dbConnection->prepare($queryMentor);
        $PDOstmt1->bindValue(':mentor_id', $mentor_id);
        $PDOstmt1->execute();
        $mentoor = $PDOstmt1->fetch();
        return $mentoor;

    }

    public function getAllMentors(){

        //Get all mentors
        $queryAllMentors = 'SELECT * FROM mentor_tbl ORDER BY id';
        $PDOstmt2 = $this->dbConnection->prepare($queryAllMentors);
        $PDOstmt2->execute();
        $mentors = $PDOstmt2->fetchAll();
        return $mentors;

    }
    /*====================================================================*/
    //QuickMatch
    public function getRandom(){

        //Grab the five random mentors
        $query5Members = 'SELECT * FROM sample_quickmatch_tbl ORDER BY rand() LIMIT 5';
        $PDOstmt = $this->dbConnection->prepare($query5Members);
        $PDOstmt->execute();
        $fivemembers = $PDOstmt->fetchAll();
        return $fivemembers;
    }

    public function getNew(){
        //Grab the five newest members
        $queryNewMembers = 'SELECT * FROM sample_quickmatch_tbl ORDER BY reg_date DESC LIMIT 5';
        $PDOstmt2 = $this->dbConnection->prepare($queryNewMembers);
        $PDOstmt2->execute();
        $newmembers = $PDOstmt2->fetchAll();
        return $newmembers;
    }

    public function getOnline(){
        //Grab five random active members
        $queryOnlineMembers = 'SELECT * FROM sample_quickmatch_tbl WHERE active=1 ORDER BY rand() LIMIT 5';
        $PDOstmt3 = $this->dbConnection->prepare($queryOnlineMembers);
        $PDOstmt3->execute();
        $onlinemembers = $PDOstmt3->fetchAll();
        return $onlinemembers;
    }


    public function getFeatured(){
        $queryFeaturedMembers = 'SELECT * FROM sample_quickmatch_tbl ORDER BY avg_star_rating DESC, rand() LIMIT 5';
        $PDOstmt4 = $this->dbConnection->prepare($queryFeaturedMembers);
        $PDOstmt4->execute();
        $featuredmembers = $PDOstmt4->fetchAll();
        return $featuredmembers;
    }

    public function getNearby($username){

        //1) Find your location
        $queryMyLocation = 'SELECT city_name FROM sample_quickmatch_tbl WHERE username= :username';
        $PDOstmt5 = $this->dbConnection->prepare($queryMyLocation);
        $PDOstmt5->bindValue(':username', $username);
        $PDOstmt5->execute();
        $mycity = $PDOstmt5->fetch();

        //var_dump($mycity);

        //2) Find a random list of members from the same city
        $queryNearbyMembers = 'SELECT * FROM sample_quickmatch_tbl WHERE city_name = :mycity ORDER BY rand() LIMIT 5';
        $PDOstmt6 = $this->dbConnection->prepare($queryNearbyMembers);
        $PDOstmt6->bindValue(':mycity', $mycity['city_name']); //$mycity is an array with a key-value pair, grab the value
        $PDOstmt6->execute();
        $nearbymembers = $PDOstmt6->fetchAll();

        //var_dump($nearbymembers);

        return $nearbymembers;

    }
//    =================================================Similiar Listings====================================================

    function getInterests ($username){

        //First retrieve user's interest categories
        $queryInterests = 'SELECT interest_category FROM sample_similar_listings_tbl WHERE username =:username ';
        $PDOstmt2 = $this->dbConnection->prepare($queryInterests);
        $PDOstmt2->bindValue(':username', $username);
        $PDOstmt2->execute();
        $user_interest_cat = $PDOstmt2->fetchAll(PDO::FETCH_ASSOC); //Fetch the result rows as an associated array:   0 => array (size=1) 'interest_category' => string 'mathematics' (length=11)
        return $user_interest_cat;
    }

    function getInterestItems($interests){
        //Grab items with matching item category from database table and display them
        $qMarks = str_repeat('?,', count($interests) - 1) . '?'; // Gives you     ? , ?   , where ? are the array values you pass from $interests array when you do execute($interests)

        $queryItems = "SELECT * FROM sample_similar_listings_tbl WHERE item_category IN ($qMarks)";
        $PDOstmt = $this->dbConnection->prepare($queryItems);
        $PDOstmt->execute($interests);
        $allitems = $PDOstmt->fetchAll();
        return $allitems;
    }

//    =================================================END OF SIMILAR LISTINGS====================================================


   /*End of Janani functions*/

   /*Start TejPal Crud Functions*/
//===============================================================================================================================

    public function viewAllBlogs($blogobj){
        $query = "SELECT blog.id,blog.heading,blog.content,blog.summary,cat.name,blog.date_created, mem.first_name 
	FROM tbl_blog_info blog JOIN tbl_member mem ON blog.member_id = mem.id 
    JOIN tbl_category cat ON cat.id = blog.category_id";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($result);
        return $result;
    }

    //View One
    public function viewMyBlog($memberid){
//        echo $blogobj->getId();
        $query = "SELECT blog.id,blog.heading,blog.content,blog.summary,cat.name,blog.date_created, mem.first_name 
	FROM tbl_blog_info blog JOIN tbl_member mem ON blog.member_id = mem.id 
    JOIN tbl_category cat ON cat.id = blog.category_id
    WHERE blog.member_id = $memberid";
        $pdostatement = $this->dbConnection->prepare($query);
//        $pdostatement->bindValue(':id',$blogobj->getId());
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($result);
//        echo "<br>";
        //var_dump($result);
//        echo "<br>";
        return $result;
    }

    //select one blog by id
    public function selectOneBlog($blogobj){
        $query = "SELECT blog.id,blog.heading,blog.content,blog.summary,cat.name,blog.date_created, mem.first_name 
	FROM tbl_blog_info blog JOIN tbl_member mem ON blog.member_id = mem.id 
    JOIN tbl_category cat ON cat.id = blog.category_id
    WHERE blog.id = :id";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->bindValue(':id',$blogobj->getId());
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);

//        echo "<br>";
//        var_dump($result);
//        echo "<br>";
        return $result;
    }

    //edit blog
    public function editMyBlog($blogobj){
        $query = "UPDATE tbl_blog_info blog
    SET blog.heading='Heading in sql',blog.content='Content in sql',blog.summary='Summary in sql'  
                    WHERE blog.id = :id";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->bindValue(':id',$blogobj->getId());
        $pdostatement->bindValue(':heading',$blogobj->getHeading());
        $pdostatement->bindValue(':content',$blogobj->getContent());
        $pdostatement->bindValue(':summary',$blogobj->getSummary());
        $pdostatement->bindValue(':dated',$blogobj->getDateCreated());
        $pdostatement->execute();
        $result = $pdostatement;
//        var_dump($result);
        return $result;
    }

    public function deleteBlog($blogid){
        echo $blogid;
        $query = "DELETE FROM tbl_blog_info WHERE tbl_blog_info.id=$blogid";
        $pdostatement = $this->dbConnection->prepare($query);
//        $pdostatement->bindValue(':id',$blogobj->getId());
        $pdostatement->execute();
        $count = $pdostatement->rowcount();
//        var_dump($count);
        return $count;
    }

    //INSERT
    public function createBlog($blogobj){
        //var_dump($blogobj);
        $query = "INSERT INTO tbl_blog_info(heading,content,summary,member_id,category_id,date_created) 
                    VALUES (:heading,:content,:summary,:memberid,:categoryid,:datecreated)";
        //echo $query;

        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->bindValue(':heading',$blogobj->getHeading());
        $pdostatement->bindValue(':content',$blogobj->getContent());
        $pdostatement->bindValue(':summary',$blogobj->getSummary());
        $pdostatement->bindValue(':memberid',$blogobj->getMemberId());
        $pdostatement->bindValue(':categoryid',$blogobj->getCategoryId());
        $pdostatement->bindValue(':datecreated',$blogobj->getDateCreated());
        $pdostatement->execute();
        $count = $pdostatement->rowcount();
        return $count;
//        echo "heading: ". $blogobj->getHeading()."<br/>";
//        echo "content: ". $blogobj->getContent()."<br/>";
//        echo "summary: ". $blogobj->getSummary()."<br/>";
//        echo "mem_id: ". $blogobj->getMemberId()."<br/>";
//        echo "cat: ". $blogobj->getCategoryId()."<br/>";
//        echo "date: ". $blogobj->getDateCreated()."<br/>";
//        print_r($pdostatement);
//        var_dump($pdostatement);

//        var_dump($count);
//        echo "dump";
    }

//////***************End Blog Crud Tejpal***************//////

//////***************Start Share Note Crud Tejpal***************//////

    public function getcategories(){
        $_query = "SELECT id,name FROM tbl_category";
        $pdostatement = $this->dbConnection->prepare($_query);
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
//        $result = $pdostatement;
//        var_dump($result);
        return $result;
    }

    public function viewAllCategories(){
        $query = "SELECT id,name FROM tbl_category";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function viewAllSubjects($id){
        $query = "SELECT id,name FROM tbl_subject sub WHERE sub.category_id = $id";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function viewAllTopics($id){
        $query = "SELECT id,name FROM tbl_topic WHERE subject_id = $id";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function MentorId($id){
        $query = "SELECT creator_id FROM tbl_topic WHERE id=$id";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function viewMentor($id){
        $query = "SELECT id,first_name,last_name,is_mentor FROM tbl_member WHERE id = $id";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function showTopicsByMentorId($id){
        $query = "SELECT id,name FROM tbl_topic WHERE creator_id = $id";
//        var_dump($query);
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


//////***************End Mentor Search Crud Tejpal***************//////

//////***************Start Share Note Crud Tejpal***************//////

    public function viewAllNotes($id){
        $query = "SELECT id,title,date_created FROM tbl_note WHERE creator_id = $id";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function createNewNote($noteObject){
//        $query = "INSERT INTO tbl_note(title, content, image, creator_id, date_created) VALUES (:title,:content,:image,:creater_id,:date_created)";
        $query = "INSERT INTO tbl_note(title,content,image,creator_id,date_created) VALUES (:title,:content,:image,:creatorid,:datecreated)";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->bindValue(':title',$noteObject->getTitle());
        $pdostatement->bindValue(':content',$noteObject->getContent());
        $pdostatement->bindValue(':image',$noteObject->getImage());
        $pdostatement->bindValue(':creatorid',$noteObject->getCreatorId());
        $pdostatement->bindValue(':datecreated',$noteObject->getDateCreated());
        $pdostatement->execute();
        return $pdostatement;
    }

    public function getAllMembers($memberid){
        $query = "SELECT id,first_name,last_name FROM tbl_member WHERE id != $memberid";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function noteShare($nodeShareObj){
        $query = "INSERT INTO tbl_note_share(sender_id,receiver_id,note_id,share_date) VALUES (:senderid,:receiverid,:noteid,:sharedate)";
//        echo $query;
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->bindValue(':senderid',$nodeShareObj->getSenderId());
        $pdostatement->bindValue(':receiverid',$nodeShareObj->getReceiverId());
        $pdostatement->bindValue(':noteid',$nodeShareObj->getNoteId());
        $pdostatement->bindValue(':sharedate',$nodeShareObj->getShareDate());
        $pdostatement->execute();
        $result = $pdostatement->rowcount();
//        var_dump($result);
        return $result;

//        echo "senderid: " . $nodeShareObj->getSenderId();
//        echo "<br>";
//        echo "recieverid: " . $nodeShareObj->getReceiverId();
//        echo "<br>";
//        echo "noteid: " . $nodeShareObj->getNoteId();
//        echo "<br>";
//        echo "sharedate: " . $nodeShareObj->getShareDate();
//        echo "<br>";
    }

    public function viewSharedNotes($memberid)
    {
//        $noteid = "SELECT note_id FROM tbl_note_share WHERE receiver_id = $memberid";
//        $pdostatement = $conn->prepare($noteid);
        $query = "SELECT id,title,content FROM tbl_note WHERE id in (SELECT note_id FROM tbl_note_share WHERE receiver_id = $memberid)";
        $pdostatement = $this->dbConnection->prepare($query);
        $pdostatement->execute();
        $result = $pdostatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
//
    }
//////***************End Share Note Crud Tejpal***************//////


////////////////////////////*********************End Crud Functions Tejpal*********************////////////////////////////



}