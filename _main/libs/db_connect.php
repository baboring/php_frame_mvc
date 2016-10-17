<?php
    class dbCon
    {
        private static $_instance;
        private $_pdo;
        protected $transactionCounter = 0;

        private function __construct() {//private constructor:
            try { // assign PDO object to db variable
                $this->_pdo = new PDO('mysql:host=localhost;dbname=lab_c0661374', 'root', '');
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

        public static function beginTransaction()
        {
            $dbh = self::GetConnection();
            if (!self::$_instance->transactionCounter++) {
                return $dbh->beginTransaction();
            }
            $dbh->exec('SAVEPOINT trans'.self::$_instance->transactionCounter);
            return self::$_instance->transactionCounter >= 0;
        }

        public static function commit()
        {
            $dbh = self::GetConnection();
            if (!--self::$_instance->transactionCounter) {
                return $dbh->commit();
            }
            return self::$_instance->transactionCounter >= 0;
        }

        public static function rollback()
        {
            $dbh = self::GetConnection();
            if (--self::$_instance->transactionCounter) {
                $dbh->exec('ROLLBACK TO trans'.self::$_instance->transactionCounter + 1);
                return true;
            }
            return $dbh->rollback();
        }

    }
?>