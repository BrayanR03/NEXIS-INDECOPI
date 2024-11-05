<?php

class database{
    // variables para sql server
    // private static $serverName = "LAPTOP-D05MS1MQ\SQLEXPRESS"; //sql server 2018
    private static $serverName = "LAPTOP-D05MS1MQ"; //SQL SERVER 2008 R2
    // private static $serverName="localhost";
    private static $database = "BD_SINOE_MDE";
    private static $username = "sa";
    private static $password = "12345678";

    public static function connect(){
        try {
            $conn = new PDO("sqlsrv:server=" . self::$serverName . ";Database=" . self::$database, self::$username, self::$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    // public static function connect() {
    //     try {
    //         // Cambia el DSN a MySQL
    //         $conn = new PDO("mysql:host=" . self::$serverName . ";dbname=" . self::$database, self::$username, self::$password);
    //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         return $conn;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }
}