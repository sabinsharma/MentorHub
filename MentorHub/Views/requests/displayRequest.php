<?php
if(session_status()==PHP_SESSION_NONE){
   session_start();
}

$userId = $_SESSION['member_id'];

require_once ('Model/CRUD.php');

$request = new CRUD();
$getRequestResult = $request->getRequest($userId);
$countRequest = count($getRequestResult);
if($countRequest > 0){
    $requestNotify = $countRequest;

    $startRequest = '    <div class="dropdown">
                        <a data-toggle="dropdown" href="#"><i class="fa fa-users fa-3x fa-fw" aria-hidden="true"></i><span class="badge topright" id="notify">' . $requestNotify . '</span></a>
                        <ul id="request" class="dropdown-menu request-dropdown" role="menu">';

    $endRequest = '</ul></div></li>';

    foreach ($getRequestResult as $requestInfo){
        $requestId = $requestInfo['id'];
        $senderId = $requestInfo['sender_id'];
    }

    $getSenderName = $request->getSenderName($senderId);

    foreach ($getSenderName as $senderInfo){
        $senderName = '<li class="header_message"> <input type="text" id="requestId" value="' . $requestId . '" hidden>' . $senderInfo['first_name'] . ' ' . $senderInfo['last_name'] . '</li>
                           <span id="statusChanged"><input type="submit" class="btn btn-default request_button" id="accept_request" name="accept_request" value="Accept"> <input type="submit" class="btn btn-default request_button" id="decline_request" value="Decline"></span><li class="divider" role="presentation"></li>';
    }
}else{
    $requestNotify = '';
    $startRequest = '<a href="#"><i class="fa fa-users fa-3x fa-fw" aria-hidden="true"></i></a></li>';
    $endRequest = '';
    $senderName = '';
}