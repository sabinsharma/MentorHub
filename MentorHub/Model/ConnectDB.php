<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 18/03/2017
 * Time: 3:11 PM
 */
class ConnectDB
{
    //private static $dns="mysql:host=localhost;dbname=mentorhub";//
    private static $dns="mysql:host=;dbname=";
    private static $username="";
    private static $password='';
    private static $connection;

    public static function dbConnect(){
        if(!isset(self::$connection)){
            try{
                self::$connection=new PDO(self::$dns,self::$username,self::$password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $ex){
                echo $ex->getCode().":".$ex->getMessage().":".$ex->errorInfo;
            }

        }

        return self::$connection;

    }
}
