<?php
    class dbCon
    {
        private static $_instance;
        private $_pdo;

        private function __construct() {//private constructor:
            try { // assign PDO object to db variable
                $this->_pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
                //$this->_pdo.setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) { //Output error – would normally log this to error file rather than output to user.
                echo "Connection Error: " . $e->getMessage();
            }
        }
        public static function GetConnection() {
            if (self::$_instance === null) //don't check connection, check instance
                self::$_instance = new dbCon();
            return self::$_instance->_pdo;
        }
        //to TRULY ensure there is only 1 instance, you'll have to disable object cloning
        public function __clone() {
            return false;
        }
        public function __wakeup() {
            return false;
        }
    }
?>