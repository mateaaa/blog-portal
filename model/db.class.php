<?php

class DB {

    private static $db = null;

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    public static function getConnection() {
        if (DB::$db === null) {
            try {
                $user = 'student';
                $pass = 'pass.mysql';
                // Unesi ispravni HOSTNAME, DATABASE, USERNAME i PASSWORD
                DB::$db = new PDO("mysql: host=192.168.89.245; dbname=penezic; charset=utf8", $user, $pass);
                DB::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                exit('PDO Error: ' . $e->getMessage());
            }
        }
        return DB::$db;
    }

}

?>