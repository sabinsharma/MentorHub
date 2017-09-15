<?php
require_once 'Model/CRUD.php';
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 21/04/2017
 * Time: 5:35 AM
 */
class OfferController
{
    public function index(){
        $crud=new CRUD();
        $result=$crud->SelectAll("Select Id,Name FROM tbl_store");
        require_once 'Views/Offers/index.php';

    }
}