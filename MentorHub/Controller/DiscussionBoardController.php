<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 18/03/2017
 * Time: 8:48 PM
 */
require_once ('Model/ConnectDB.php');
//require_once ('Model/DBQuery.php');
require_once ('Model/CRUD.php');
class DiscussionBoard
{
    private $connection;


    public function __construct()
    {
        $this->connection=ConnectDB::dbConnect();
    }

    public function index(){
        $crud=new CRUD();
        //$dbQuery=new DBQuery();
        //populate the discussion area in index.php and modal window of index.php
        $disarea=$crud->Select("Select id,discussion_area FROM tbl_discussion_area where active=TRUE","Model/DiscussionArea.php");

        //display discussion detail in index.php
        $discussionDetail=$crud->FetchALL("vw_disucssionareatopics","DiscussionArea");
        //populate createby dropdown in index.php
        //$createdBy=$crud->SelectAll("Select id,first_name||' '||middle_name||' '||last_name FROM tbl_member_mst WHERE id in (SELECT distinct created_by FROM tbl_topics WHERE ACTIVE =TRUE)");
        $createdBy=$crud->SelectAll("SELECT id,member_name FROM memberwithtopics");
        require_once ('Views/discussions/index.php');

    }

// this function is called to load the topics
    public function listTopics(){
        $crud=new CRUD();
        if(isset($_POST['area_askquestion'])){
            //$dbQuery=new DBQuery();

            $topics=$crud->Select("SELECT topic FROM tbl_topics where active=TRUE and area_id="+$_POST['area_askquestion'],'Model/Topics');
        }
        else
        {
            //$dbQuery=new DBQuery();
            $topics=$crud->Select("SELECT topic FROM tbl_topics where active=TRUE",'Model/Topics');
        }
        require_once ('Vews/discussions/index.php');
    }

    public function ShowDiscussionDetails($discussionDetail,$crud){


    }

    public function ViewReplies()
    {
        if(isset($_GET['TopicID']) && !empty($_GET['TopicID']))
        {
            $crud=new CRUD();
            $mytopic=$crud->SelectAll("SELECT id,topic,description FROM tbl_topics WHERE id=".$_GET['TopicID']);
           $replies=$crud->Find('vw_discussiontopicsreplies',array('TopicID'=>$mytopic[0]['id']));
//            var_dump($result);
            require_once "Views/discussions/replies.php";
        }
        else
        {
            echo "nothing in topicid";
//            $URL="?controller=discussionboard&action=index";
//            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . "'>';//cannot use header so uset this meta tag.

        }

    }
}



//var_dump($disarea);
/*$sth = $dbh->query("SELECT * FROM people");
$sth->setFetchMode(PDO::FETCH_CLASS, 'Person');
$person = $sth->fetch();
$person->tell();
$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Person');
$person = $sth->fetch();
$person->tell();

$news = $pdo->query('SELECT * FROM news')->fetchAll(PDO::FETCH_CLASS, 'News');

$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND status=:status');
$stmt->execute(['email' => $email, 'status' => $status]);
$user = $stmt->fetch();

$sql = "UPDATE users SET name = ? WHERE id = ?";
$pdo->prepare($sql)->execute([$name, $id]);

//accessing affected rows needs 3 lines of code.
$stmt = $pdo->prepare("DELETE FROM goods WHERE category = ?");
$stmt->execute([$cat]);
$deleted = $stmt->rowCount();

//insert example

    try {
            $pdo->prepare("INSERT INTO users VALUES (NULL,?,?,?,?)")->execute($data);
        } catch (PDOException $e) {
            if ($e->getCode() == 1062) {
                // Take some action if there is a key constraint violation, i.e. duplicate name
            } else {
                throw $e;
            }
      }
*/
//        require_once ('Model/DiscussionArea.php');
//        $disarea=new DiscussionArea();
//
//        $disArea=$this->connection->query("Select id,discussion_area FROM tbl_discussion_area where active=TRUE")->fetchAll(PDO::FETCH_CLASS,'DiscussionArea');
//        var_dump($disArea);
//        var_dump($disarea);

//echo $disArea->getDiscussionArea();
//$disArea->get
//        foreach ($disArea as $post){
//            echo "<p>".$post->;
//            //echo "<a href='?controller=posts&action=show&id=".$post->id."'>Details</a></p>";
//
//        }







//protected static $_table;
/*$list=[];
require_once "Model/CRUD.php";
require_once "Model/DiscussionArea.php";
$crud=new CRUD();
$result=$crud->FetchALL('tbl_discussion_area','discussion_area');//table name,column_name used for sorting
$objDisArea=new DiscussionArea();
//var_dump($result);*/
//$cnt=0;
/*foreach ($result as $disarea){*/
//$list[]=   //new DiscussionArea($disarea['id'],$post['author'],$post['content']);
//$list[]=$disarea;
/* $objDisArea->setId($disarea['id']);
 $objDisArea->setDiscussionArea($disarea['discussion_area']);
 var_dump($objDisArea);
 $list[$cnt]=$objDisArea;
 var_dump($list);
 $cnt=$cnt+1;*/
//}

//var_dump($objDisArea);
//var_dump($list);
// require_once ('Views/discussions/index.php');