<?php
    require_once ('_server/libs/db_connect.php');


    class DataResult_UserTypes {

        public $data;

        public function __construct($val, $auth_level = null) {//private constructor: 
            $szQuery = "select code,type from user_type ";
            if(null != $auth_level)
                $szQuery .= " where authority < ".$auth_level;
            else
                $szQuery .= " where authority =  99";
            $user_rows = dbCon::GetConnection()->query($szQuery);
            $this->data = $user_rows->fetchAll($val);
        }
    }

?>