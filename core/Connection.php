<?php
class Connection{
    private static $instance = null, $conn = null;

    private function __construct($config){
        try{
            $dns = 'mysql:dbname='.$config['db'].';host='.$config['host'];

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ];

            $con = new PDO($dns, $config['user'], $config['pass'], $options);
            self::$conn = $con;

        } catch (Exception $exception){
            $mess = $exception->getMessage();
            die ($mess);
        }
    }

    public static function getInstance($config){
        if(self::$instance == null){
            $connection  = new Connection($config);
            self::$instance = self::$conn;
        }
        return self::$instance;
    }
}