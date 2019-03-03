<?php

class Database
{
    private static $dbName = 'tessera';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'php';
    private static $dbUserPassword = 'Sophie123';

    private static $conn = null;

    public function __construct()
    {
        exit('Init function is not allowed');
    }

    public static function connect()
    {
        // One connection through whole application
        if (null == self::$conn) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbUserPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$conn;
    }

    public static function disconnect()
    {
        self::$conn = null;
    }
}

?>