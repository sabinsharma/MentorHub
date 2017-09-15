<?php

/**
 * Created by PhpStorm.
 * User: bubbl
 * Date: 2017-04-09
 * Time: 4:31 PM
 */
class RequestStatusController
{
    public function status(){
        require_once('Model/CRUD.php');

        $request = new CRUD();

        $requestId = $_POST['requestId'];
        $status = $_POST['status'];

        if($status == 'accept'){
            $request->requestStatus($requestId, $status);
        }

        if($status == 'decline'){
            $request->requestStatus($requestId, $status);
        }
    }

}