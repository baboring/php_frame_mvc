<?php
    require_once ('_main/libs/db_connect.php');
    // result data of login 
    class DataResult_LoginTry {

        public $err_msg;
        public $expire_date;
        public $IsCorrectPassword;

        public function __construct($user_id, $password) {//private constructor: 
            $err_msg = null;
            $IsCorrectPassword = false;
            // verify if matching id & pass
            if(empty($user_id)) {
                $this->err_msg = 'Error User id is empty'; 
                return false;
            }

            $szQuery = "select password,expire_date from member_list where user_id = '".$user_id."' limit 1"; 
            $res =  dbCon::GetConnection()->query($szQuery);

            if($res->rowCount() < 1) {
                $this->err_msg = 'Not exist user id';
                return false;
            }

            $data = $res->fetch();
            if($data['password'] != $password) {
                $this->err_msg = 'Password is Wrong!!!';
                return false;
            }
            // exire date check
            $now = date("Y-m-d H:i:s",time());
            $this->expire_date = $data['expire_date'];
            if($data['expire_date'] < $now) {
                $this->err_msg = 'expired password date';
                return false;
            }

            $IsCorrectPassword = true;

            // success
            return true;

        }

    }

?>