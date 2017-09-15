<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 11/04/2017
 * Time: 1:53 PM
 */

use Pubnub\Pubnub;

$pubnub=new Pubnub(array(
    'subscribe_key'=>'pub-c-8fe27734-6624-48ea-b850-e022009c2840',
    'publish_key'=>'sub-c-05756a74-1f30-11e7-9093-0619f8945a4f',
    'secret_key'=>'sec-c-NTBmYjQ1MTEtZWI1NC00YzVjLTliMTUtYmNkNjY5OTEyMGNh',
    'ssl'=>false,
    'verify_peer'=>false));

$pubnub->subscribe('ch01',function($message){
    //message is recieved here
    print_r($message);
});
?>
<div class="row">
    <div class="col-md-8">
        //for video
    </div>
    <div class="col-md-4">
        <div class="row">
            <form method="post" action="#">
            <textarea rows="10" cols="10"></textarea>
            <input type="text" id="txtMessage" name="txtMessage" />
                <input type="button" id="btnSendMessage" name="btnSendMessage" value="Send" />
            </form>
        </div>
    </div>
</div>
