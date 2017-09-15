<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 21/03/2017
 * Time: 12:54 PM
 */

if(isset($_POST['factory'])){
    switch ($_POST['factory']){
        case 'getTopics':
            getTopics($_POST['id']);
            break;
        case 'getReplies':
            getReplies($_POST['id']);
            break;
        case 'listTopics':
            getTopicList($_POST['id'],$_POST['topic']);
            break;
        case 'getmemberid':
            getmemberID();
            break;
        case 'saveTopics':
            AddTopicInformation();
            break;
        case 'listTopicDetail':
            listTopicDetail();
            break;
        case 'getTopicInfo':
            getTopicInfos($_POST['topicid']);
            break;
        case 'deleteTopic':
            deleteTopic($_POST['topicid']);
            break;
        case 'updateViewCount':
            updateViewCount($_POST['topicID']);
            break;
        case 'saveUserReply':
            saveUserReply($_POST['topicID'],$_POST['userReply'],$_POST['status']);
            break;
        case 'getReply':
            getReply($_POST['topicDetailID']);
            break;
        case 'updateReply':
            updateReply($_POST['topicDetailId'],$_POST['updateReply'],$_POST['Topic_ID']);
            break;
        case 'reloadReplies':
            reloadReplies($_POST['topicID']);
            break;
        case 'deleteReply':
            deleteReply($_POST['topicdetailid']);
            break;
        case 'selectSubject':
            SelectSubjectsByCat($_POST['catid']);
            break;
        case 'selectTopic':
            SelectTopicsBySub($_POST['subid']);
            break;
        case 'selectMentor':
            selectMentorByTopic($_POST['mentId']);
            break;
        case 'selectTopics':
            selectTopicByMemberId($_POST['topicId']);
            break;
        case 'saveStoreManager':
            saveStoreManager($_POST['storemanager']);
            break;
        case 'managerLogin':
            managerLogin($_POST['username'],$_POST['password']);
            break;
        case 'deleteBlog':
            deleteBlog($_POST['blogid']);
            break;
        case 'saveStore':
            saveStoreInformation($_POST['storeInfo']);
            break;
        case 'updateStoreInfo':
            updateStoreInfo($_POST['updatedStoreInfo']);
            break;
        case 'addCoupon':
            addCoupon($_POST['addCoupon']);
            break;
        case 'loadCoupons':
            loadCoupons();
            break;
        case 'updateCoupon':
            updateCoupon($_POST['couponInfo']);
            break;
        case 'confirmCouponDeletion':
            confirmCouponDeletion($_POST['couponid']);
            break;
        case 'getCouponsList':
            getCouponsList($_POST['storeId']);
    }
}
//this is code from Tejpal Singh , MR. King
function deleteBlog($blogid){
    require_once '../Model/CRUD.php';
    $delBlog=new CRUD();
    $delBlog->deleteBlog($blogid);
}


function selectTopicByMemberId($topicid){
    /*require_once '../Controller/MentorSearchCrud.php';
    require_once '../Model/Connection.php';*/

    require_once '../Model/CRUD.php';

    /*$myconn = new Connection();
    $conn = $myconn->dbConnect();*/
    $mentorSearchCrud = new CRUD();

    $creatorId = $mentorSearchCrud->MentorId($topicid);
    foreach ($creatorId as $creatorval){
//        var_dump($creatorval['creator_id']);
    }
    ;
    $topics = $mentorSearchCrud->showTopicsByMentorId($creatorval['creator_id']);
    echo "";
    foreach ($topics as $topicval){
        echo "<a href=\"#\">" . $topicval['name'] . "</a>";
        echo "<br>";
    }

}




function selectMentorByTopic($topicid){
    /*require_once '../Controller/MentorSearchCrud.php';
    require_once '../Model/Connection.php';*/

    require_once '../Model/CRUD.php';

    /*$myconn = new Connection();
    $conn = $myconn->dbConnect();*/
    $mentorSearchCrud = new CRUD();

    $mentorid = $mentorSearchCrud->MentorId($topicid);

    foreach ($mentorid as $mentorval){
        if($mentorval != null){
            $mentor = $mentorSearchCrud->viewMentor($mentorval['creator_id']);
            foreach ($mentor as $mentorval){
                $name = $mentorval['first_name'] . " " . $mentorval['last_name'];
                echo "<h2>" . $name . "</h2>";
                echo "<br>";

                if($mentorval['is_mentor'] == 1){
                    echo "<span class=\"label label-mentor\" id=\"mentor-symbol\" style=\"background-color: #f00;\">Menter</span>";
                    echo "    ";
                    echo "<span class=\"label label-mentee\" id=\"mentee-symbol\" style=\"background-color: #ccc;\">Mentee</span>";
                }
                else{
                    echo "<span class=\"label label-mentor\" id=\"mentor-symbol\" style=\"background-color: #ccc;\">Menter</span>";
                    echo "    ";
                    echo "<span class=\"label label-mentee\" id=\"mentor-symbol\" style=\"background-color: #00f;\">Menter</span>";
                }
            }
        }
        else{
            echo "No Memeber Found";
        }
    }
}


function SelectTopicsBySub($subid)
{
//    require_once '../Controller/MentorSearchCrud.php';
//    require_once '../Model/Connection.php';

    require_once '../Model/CRUD.php';

    $mentorSearchCrud = new CRUD();
    /*$myconn = new Connection();
    $conn = $myconn->dbConnect();*/

    $topics = $mentorSearchCrud->viewAllTopics($subid);

    if($topics != null){
        foreach ($topics as $topic) {
            echo "<option value=\"" . $topic['id'] . "\">" . $topic['name'] . "</option>";
        }
//        var_dump($topics);
    }
    else{
        echo "<option value='--'>No result found</option>";
    }

}

function SelectSubjectsByCat($catid){
    require_once '../Model/CRUD.php';
    /*require_once '../Model/Connection.php';*/

    $mentorSearchCrud = new CRUD();


    $subjects = $mentorSearchCrud->viewAllSubjects($catid);

    if($subjects != null){
        foreach ($subjects as $subject){
            echo "<option value=\"".$subject['id']."\">".$subject['name']."</option>";
        }
    }
    else{
        echo "<option value='--'>No result found</option>";
    }


}
//End of Mr. King Code
function getTopics($id='id'){

    foreach (ListTopics($id) as $topic){
        echo "<option value=".$topic['id'].">".$topic['topic']."</option>";
    }
}

function getTopicList($id,$topics){
    $query="SELECT id, topic FROM tbl_topics WHERE area_id=".$id." and topic like '%".$topics."%'";
    require_once "../Model/CRUD.php";
    $crud=new CRUD();
    foreach ($crud->SelectAll($query) as $topicitem){
        echo "<a href=".$topicitem['id'].">".$topicitem['topic']."</a>";
    }
}

function ListTopics($id){
    $cond=array("area_id"=>$id);
    require_once "../Model/CRUD.php";
    $crud=new CRUD();
    $topics=$crud->Find('tbl_topics',$cond);
    return $topics;
}

function getReplies($id){
    $topic=array('topic_id'=>$id);
    require_once "../Model/CRUD.php";
    $crud=new CRUD();
    $replies=$crud->Find('tbl_topics_detail',$topic);
    foreach ($replies as $reply){
        echo "<div class='row'>
                <div class='col-md-12'>".$reply['reply']."</div>
               </div>
            <hr>";
    }
}

function setProperties($arrTopic){
    require_once "../Model/Topics.php";
    $topic=new Topics();
    if($arrTopic->topicid!=''){
        $topic->setId($arrTopic->topicid);
    }
    $topic->setAreaId($arrTopic->area_id);
    $topic->setTopic($arrTopic->topic);
    $topic->setDescription($arrTopic->description);
    $topic->setActive($arrTopic->active);
    $topic->setCreatedBy($arrTopic->created_by);
    $topic->setViewCount(0);
    $topic->setCreatedDate(date('Y-m-d H:i:s'));
    return $topic;
}


function AddTopicInformation(){
 $arrTopic=json_decode($_POST['info']);

 //code below initialize the variable of the class Topics and send the object as a parameter to the Insert method of the CRUD class
 $topic=setProperties($arrTopic);
 require_once '../Model/CRUD.php';
 $crud=new CRUD();
 //if the $arrTopic does not contain the value of topicid, then insert the data.
 if($arrTopic->topicid==''){
     $result=$crud->InsertInfo('tbl_topics',$topic);
     echo $result." records saved successful";
 }
 else{
     $result=$crud->UpdateInfo('tbl_topics',$topic);
     echo $result."records updated successfully";
 }

}

function getmemberID(){
    session_start();
    echo $_SESSION['member_id'];
}

function listTopicDetail(){
    session_start();

    require_once '../Model/CRUD.php';
    $crud=new CRUD();
    $AreaID=$_POST['areaid']==''?'AreaID':$_POST['areaid'];
    $TopicID=$_POST['topicId']==''?'TopicID':$_POST['topicId'];
    $CreatedBy=$_POST['creatorId']==''?'CreatedBy':$_POST['creatorId'];

    $query="SELECT * FROM vw_disucssionareatopics WHERE AreaID=".$AreaID." AND TopicID=".$TopicID." AND CreatedBy=".$CreatedBy;
    $result=$crud->SelectAll($query);
    $cnt=1;
    foreach ($result as $disItem) {
        echo"<tr>";
        echo "<td>$cnt</td>";
        echo "<td>".$disItem['Topic']."</td>";
        echo"<td>".$disItem['ViewCount']."</td>";
        $result=$crud->SelectAll("SELECT COUNT(id) as Replies FROM tbl_topics_detail WHERE topic_id=".$disItem['TopicID']);
        echo"<td>".$result[0]['Replies']."</td>";
        if($CreatedBy==$_SESSION['member_id']){
            echo"<td><a href='?controller=discussionboard&action=ViewReplies&TopicID=".$disItem['TopicID']."' id='updateViewCount' data-id=".$disItem['TopicID'].">View</a></td>";
//            echo"<td><a href='?controller=discussionboard&action=index&id=".$disItem['TopicID']."' data-toggle=\"modal\" data-target=\"#modalAskQuestion\">Edit</a></td>";
            echo "<td><a data-toggle=\"modal\" data-id=".$disItem['TopicID']." title=\"Edit this topic\" id=\"open-AddTopicDialog\" href=\"#modalAskQuestion\">Edit</a></td>";
            echo"<td><a href='#' data-id=".$disItem['TopicID']." id='deleteTopic'>delete</a></td>";
        }
        else{
            echo"<td><a href='?controller=discussionboard&action=ViewReplies&TopicID=".$disItem['TopicID']."' id='updateViewCount' data-id=".$disItem['TopicID'].">View</a></td>";
        }

        echo "</tr>";
        $cnt++;
    }
   // echo "memberid=".$_SESSION['memberid'];


}

function getTopicInfos($topicid){
    require_once '../Model/CRUD.php';
    $crud=new CRUD();
    $result=$crud->Find('tbl_topics',array('id'=>$topicid));
    //print_r( $result=$crud->Find('tbl_topics',array('id'=>$topicid)));
    echo json_encode(array('areaid'=>$result[0]['area_id'],'topic'=>$result[0]['topic'],'description'=>$result[0]['description']));

}

function deleteTopic($id){
    require_once '../Model/CRUD.php';
    $crud=new CRUD();
    $result=$crud->DeleteInfo('tbl_topics',array('id'=>$id));
    echo $result." record deleted successfully";
}

function updateViewCount($topicID){
  require_once  '../Model/CRUD.php';
  $crud=new CRUD();
  $viewcount=$crud->getMaxValue('tbl_topics','view_count',$topicID);
  $maxValue=$viewcount[0]['view_count']+1;
  $result=$crud->SelectAll("Update tbl_topics set view_count=".$maxValue." WHERE id=".$topicID);

}

function saveUserReply($topicID,$userReply,$status){
    session_start();

    require_once '../Model/CRUD.php';
    require_once '../Model/TopicsDetail.php';
    $crud=new CRUD();
    $topicDetail=new TopicsDetail();

    $topicDetail->setTopicId($topicID);
    $topicDetail->setReply($userReply);
    if($status=='true')
    $topicDetail->setActive(1);
    else
    $topicDetail->setActive(0);
    $topicDetail->setRepliedBy($_SESSION['member_id']);
    $res=$crud->InsertInfo('tbl_topics_detail',$topicDetail);
    echo $res;
}
//get the reply associated with the topicDetailID and send it back to the calling ajax function, so that texteditor can
//can be filled with the reply
function getReply($topicDetailId){
    require_once '../Model/CRUD.php';
    $crud=new CRUD();
    $result=$crud->Find('tbl_topics_detail',array("id"=>$topicDetailId));
    echo json_encode(array("reply"=>$result[0]['reply'],"topic_id"=>$result[0]['topic_id']));
}

//when update button in modal window of replies.php is clicked, this function is called. This function update the answer
function updateReply($topicDetailId,$updatedAnswer,$topicid){
    require_once '../Model/Crud.php';
    $crud=new CRUD();
    $result=$crud->UpdateColumn('tbl_topics_detail',$topicDetailId,array("reply"=>$updatedAnswer));
    echo $result;
}

function reloadReplies($topicID)
{
    session_start();
    $reloadInfo='';
    require_once '../Model/Crud.php';
    $crud=new CRUD();
    $replies=$crud->Find('vw_discussiontopicsreplies',array('TopicID'=>$topicID));
    if(count($replies)>0){
        $reloadInfo= "<div class='row'>";
        foreach ($replies as $topicreply){
            $reloadInfo.= "<div class='col-md-12'>";
            $reloadInfo.= "<div class='row'>";
            $reloadInfo.= "<div class='col-md-10'>";
            $reloadInfo.= $topicreply['Reply'];
            $reloadInfo.= "</div>";//div class col-md-8

            if($_SESSION['member_id']==$topicreply['RepliedBy']) {
                $reloadInfo.= "<div class='col-md-1'>";
                $reloadInfo.= "<span class='glyphicon glyphicon-pencil' data-id='" . $topicreply['TopicDetailID'] . "' data-toggle='modal' data-target='#modalPostAnswer'>";
                $reloadInfo.="</div>";//div class com-md-2
                $reloadInfo.= "<div class='col-md-1'>";
                $reloadInfo.= "<span class='glyphicon glyphicon-trash' data-id='" . $topicreply['TopicDetailID'] . "'>";
                $reloadInfo.= "</div>";//div class col-md-2
            }//end of if statement
            $reloadInfo.= "</div>";//inner div class row
            $reloadInfo.= "<hr>";
            $reloadInfo.= "</div>";//div class col-md-12

        }//end of foreach


        $reloadInfo.= "</div>";//outer div class row
    }
        echo $reloadInfo;
}

function deleteReply($topicDetailID){
    require_once '../Model/CRUD.php';
    $crud=new CRUD();
    $result=$crud->DeleteInfo('tbl_topics_detail',array('id'=>$topicDetailID));
    echo $result;
}

function saveStoreManager($storeManagerInfo){
    $storeManager=json_decode($storeManagerInfo);
    $middleName=$storeManager->MName!=''?$storeManager->MName:null;
    $unitNumber=$storeManager->UnitNumber!=''?$storeManager->UnitNumber:null;
    require_once '../Model/CRUD.php';
    $crud=new CRUD();
    $result=$crud->InsertInfo('tbl_store_manager',$storeManager);
    echo $result. " Records Saved Successfully";

}

function managerLogin($username,$pswd){
    require_once '../Model/CRUD.php';
    $crud=new CRUD();
    $result=$crud->SelectAll("Select * from tbl_store_manager WHERE UserName='".$username."' and Psd='".$pswd."'");

    session_start();
    if(count($result)>0){
        unset($_SESSION['member_id']);
        $_SESSION['manager_id']=$result[0]['Id'];
        $_SESSION['manager_name']=$result[0]['FName']." ".$result[0]['MName']." ".$result[0]['LName'];

        $storeinfo=$crud->SelectAll("Select * FROM tbl_store WHERE Manager_Id=".$result[0]['Id']);
        if(count($storeinfo)>0)
        $_SESSION['Store_ID']=$storeinfo[0]['Id'];
        else
            $_SESSION['Store_ID']=0;
    }


     //echo "Select * from tbl_store_manager WHERE UserName='".$username."' and Psd='".$pswd."'".count($result);
     echo count($result);
}

function saveStoreInformation($storeinfo){
    $storeInformation=json_decode($storeinfo);
    require_once ('../Model/CRUD.php');
    $crud=new CRUD();
    $result=$crud->InsertInfo('tbl_store',$storeInformation);
    if($result==1){
        echo "Store Registered Successfully";
    }
}

function updateStoreInfo($storeInfo){
    $infoStoreUpdate=json_decode($storeInfo);
    require_once '../Model/CRUD.php';
    $crud=new CRUD();
    $result=$crud->UpdateInfo('tbl_store',$infoStoreUpdate);
    if($result==1){
        echo "Store Information Updated Successfully";
    }
}

function addCoupon($couponinfo){
    $couponInformation=json_decode($couponinfo);
    require_once '../Model/CRUD.php';
    $crud=new CRUD();
    $result=$crud->InsertInfo('tbl_coupon',$couponInformation);
    if($result==1){
        echo "Coupon information added successfully!!!";
    }
}

function loadCoupons()
{
    require_once '../Model/CRUD.php';
    $crud = new CRUD();
    $result = $crud->SelectAll('SELECT * FROM tbl_coupon');
    //echo count($result);
    if (count($result) > 0) {
        foreach ($result as $coupon) {
            echo "<tr>";
            echo "<td>" . $coupon['Amount'] . "</td>";
            echo "<td>" . $coupon['Quantity'] . "</td>";
            echo "<td>" . $coupon['QuantityOnHand'] . "</td>";

            $date = new DateTime($coupon['EnteredDate']);
            echo "<td>" . $date->format('Y-m-d') . "</td>";
            echo "<td><a href='?controller=dashboard&action=editCoupon&id=".$coupon['Id']."' class='btn btn-primary'>Edit</a></td>";
            //echo "<td><a href='?controller=dashboard&action=deleteCoupon&id=".$coupon['Id']."' class='btn btn-danger'>Delete</a></td>";
            echo "<td><input type='button' data-id=".$coupon['Id']." class='btn btn-danger' id='btnDeleteCoupon' value='delete'></td>";
            echo "</tr>";
        }
    }
}

function updateCoupon($couponInfo){
    $couponUpdateInfo=json_decode($couponInfo);
    require_once '../Model/CRUD.php';
    $crud=new CRUD();
    $result=$crud->UpdateInfo('tbl_coupon',$couponUpdateInfo);
    if($result==1){
        echo "Coupon Information update successfully!!";
    }
}

function confirmCouponDeletion($couponid){
    require_once '../Model/CRUD.php';
    $crud=new CRUD();
    $result=$crud->Find('tbl_coupon',array('Id'=>$couponid));
    if($result[0]['Quantity']!=$result[0]['QuantityOnHand']){
        echo false;
    }
    else
    {
        echo true;
    }
}

function getCouponsList($storeid){
    require_once '../Model/CRUD.php';
    $crud = new CRUD();
    $result = $crud->SelectAll('SELECT * FROM tbl_coupon where StoreId='.$storeid);
    //echo count($result);
    if (count($result) > 0) {
        foreach ($result as $coupon) {
            echo "<tr>";
            echo "<td>" . $coupon['Amount'] . "</td>";
            echo "<td>" . $coupon['Quantity'] . "</td>";
            echo "<td>" . $coupon['QuantityOnHand'] . "</td>";
            echo "<td><a href='?controller=offer&action=subscribe&id=".$coupon['Id']."' class='btn btn-primary'>Subscribe</a></td>";
            echo "</tr>";
        }
    }
}