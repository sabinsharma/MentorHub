<?php
require_once ('Model/CRUD.php');
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 13/04/2017
 * Time: 5:29 PM
 */
class ReviewController
{
    public function index(){
        require_once 'Views/Review/index.php';
    }

    public  function addReview(){
        $crud=new CRUD();
        $mentors = $crud->getAllMentors();
        require_once 'Views/Review/addreview.php';
    }

    public function editReview(){
        require_once 'Views/Review/editreview.php';
    }
}