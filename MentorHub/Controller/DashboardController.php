<?php
require_once 'Model/CRUD.php';

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 20/04/2017
 * Time: 2:38 AM
 */
class DashboardController
{
    public function index(){
        $crud=new CRUD();
        $storeid=$crud->SelectAll("SELECT Id as storeid FROM tbl_store where Manager_Id=".$_SESSION['manager_id']);
        if(count($storeid)==1){
            $_SESSION['Store_ID']=$storeid[0]['storeid'];
        }
       else
       {
           $_SESSION['Store_ID']=0;
       }
        require_once 'Views/dashboard/index.php';


    }

    public function create(){
        require_once 'Views/dashboard/create.php';
    }

    public function edit(){
        $storeid=$_GET['id'];
        $crud=new CRUD();
        $result=$crud->SelectAll("Select * FROM tbl_store WHERE id=".$storeid);
        require_once 'Views/dashboard/edit.php';
    }

    public function addCoupon(){
        $storeid=$_GET['id'];
        require_once 'Views/dashboard/addCoupon.php';
    }

    public function editCoupon(){
        $couponId=$_GET['id'];
        $crud=new CRUD();
        $result=$crud->SelectAll("SELECT * FROM tbl_coupon WHERE id=".$couponId);
        $minValue=$result[0]['Quantity']-$result[0]['QuantityOnHand']==0?1:$result[0]['Quantity']-$result[0]['QuantityOnHand'];
        require_once 'Views/dashboard/editCoupon.php';
    }




}