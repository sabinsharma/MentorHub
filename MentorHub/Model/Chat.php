<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 11/04/2017
 * Time: 4:41 PM
 */
require_once ('lib/autoloader.php');
use Pubnub\Pubnub;
class Chat
{
    private $pubnub;
    public function init($channel){

        $this->pubnub=new Pubnub(array(
            'subscribe_key'=>'pub-c-8fe27734-6624-48ea-b850-e022009c2840',
            'publish_key'=>'sub-c-05756a74-1f30-11e7-9093-0619f8945a4f',
            'secret_key'=>'sec-c-NTBmYjQ1MTEtZWI1NC00YzVjLTliMTUtYmNkNjY5OTEyMGNh',
            'ssl'=>false,
            'verify_peer'=>false));
        //Subscribe to a channel, this is not async
        $this->pubnub->subscribe($channel,function($message){
            //message is recieved here
            print_r($message);
       });
        //$pubnub = new Pubnub('sub-c-4dd602ce-1edb-11e7-9093-0619f8945a4f', 'pub-c-d86bf8ac-1f0f-4c76-9483-da7151dae30e');
       // return $pubnub;

       // $this->publish($this->pubnub,$channel,'test exit');
    }


    // Use the publish command separately from the Subscribe code shown above.
    // Subscribe is not async and will block the execution until complete.
    public function publish($pubnub,$channel,$message){
        $publish_result=$pubnub->publish($channel,$message);
        print_r($publish_result);
    }

    public function loadMessage(){
        $history = $this->init()->history('$channel');
        print_r($history['messages']);
    }
}