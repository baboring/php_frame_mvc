<?php
    require_once ('_server/libs/db_connect.php');
    // result data of login 
    class DataResult_ServiceTypes {

        public $data;

        public function __construct() {//private constructor: 
            $szQuery = "select s_code,s_name from service_type";
            $user_rows = dbCon::GetConnection()->query($szQuery);
            $this->data = $user_rows->fetchAll();
        }
    }

?>