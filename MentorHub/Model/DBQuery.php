<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 19/03/2017
 * Time: 1:55 AM
 */
require_once ('Model/ConnectDB.php');
class DBQuery
{

    private $connection;

    public function __construct()
    {
        $this->connection=ConnectDB::dbConnect();
    }

    public function Select($query,$class){
        require_once ($class);
        //$disarea=new DiscussionArea();

        return $this->connection->query($query)->fetchAll(PDO::FETCH_CLASS,'DiscussionArea');
    }


}