<?php
    require_once ('_main/libs/db_connect.php');

    class DataMember
    {
        public static $err_msg = '';

        // fetch list of User Types
        public static function Fetch_UserTypes($val) {
            $szQuery = "select code,type from member_type";
            $user_rows = dbCon::GetConnection()->query($szQuery);
            return $user_rows->fetchAll($val);
        }

        // fetch list of User Types
        public static function Fetch_MemberList($type, $search_group = null, $search_key = null) {

            $szWhere = "";
            switch($type) {
                case '1': // admin
                    $szAddition = ",user_id, tel, email, token, license, ohip ";//, security_q, security_a ";
                    $szWhere = "where 1";
                    break;
                case '2': // doctor
                    $szAddition = ",tel , ohip ";
                    $szWhere = "where A.type = 3";
                    break;
                case '3': // patient
                    $szAddition = ",tel ,license ";
                    $szWhere = "where A.type = 2";
                    break;
                default:
                    $szAddition ='';
                    break;
            }
            $szQuery = "select idx, user_name, B.type as 'type' ".$szAddition;
            $szQuery .= "from member_list as A ";
            $szQuery .= "inner join member_type as B ";
            $szQuery .= "on A.type = B.code ";
            $szQuery .= $szWhere;

            // search
            if(null != $search_key) {
                $szQuery .= " and substring(A.tel,1,3) = '".$search_key."'";
            }

            //echo 'sql='.$szQuery;

            $user_rows = dbCon::GetConnection()->query($szQuery);
            return $user_rows->fetchAll(PDO::FETCH_ASSOC);
        }

        // get member information
        public static function Fetch_MemberInfo($user_id) {
            $szQuery = "select * from member_list where user_id = '".$user_id."'";
            $res = dbCon::GetConnection()->query($szQuery);
            return $res->fetch(PDO::FETCH_ASSOC);
        }

        
        // delete user account
        public static function DeleteUserById($user_id) {
            if(strlen(trim($user_id) < 1)) {
                self::$err_msg = 'need a userid';
                return false;
            }
            $szQuery = "delete from member_list where user_id = '".$user_id."'";
            
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res) && $res > 0)
                   return true;
                self::$err_msg = 'not exist userid';
            }
            catch(Exception $e) { //Some error occured. (i.e. violation of constraints)
                echo $e;
            }
            return false;
        }

        public static function DeleteUserByIdx($idx) {
            if(strlen(trim($idx) < 1)) {
                self::$err_msg = 'need a idx';
                return false;
            }
            $szQuery = "delete from member_list where idx = ".$idx;
            
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res) && $res > 0)
                   return true;
                self::$err_msg = 'not exist userid';
            }
            catch(Exception $e) { //Some error occured. (i.e. violation of constraints)
                echo $e;
            }
            return false;
        }

        // insert new member
        public static function AddUser($user_id, $user_name, $password, $tel, $email, $security_q, $security_a, $type, $token, $license, $ohip) {

            if(empty($user_id) || strlen($user_id) < 1) {
                self::$err_msg = 'Error User id is empty';
                return false;
            }

            // insert query
            $szQuery = "insert into member_list (";
            $szQuery .= "user_name";
            $szQuery .= ",user_id";
            $szQuery .= ",password";
            $szQuery .= ",tel";
            $szQuery .= ",email";
            $szQuery .= ",security_q";
            $szQuery .= ",security_a";
            $szQuery .= ",type";
            switch($type) {
                case "1":
                    $szQuery .= ",token";
                    break;
                case "2":
                    $szQuery .= ",license";
                    break;
                case "3":
                    $szQuery .= ",ohip";
                    break;
            } 
            $szQuery .= ") value (";
            $szQuery .= "'".$user_name."'";
            $szQuery .= ",'".$user_id."'";
            $szQuery .= ",'".$password."'";
            $szQuery .= ",'".$tel."'";
            $szQuery .= ",'".$email."'";
            $szQuery .= ",'".$security_q."'";
            $szQuery .= ",'".$security_a."'";
            $szQuery .= ",'".$type."'";
            switch($type) {
                case "1":
                    $szQuery .= ",'".$token."'";
                    break;
                case "2":
                    $szQuery .= ",'".$license."'";
                    break;
                case "3":
                    $szQuery .= ",'".$ohip."'";
                    break;
            } 
            $szQuery .= ")";
            //echo 'query='.$szQuery;

            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res))
                   return true;
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = $e;
                echo $e;
            }
            return false;
        }

        // try login 
        public static function tryLogin($user_id, $password) {

            // verify if matching id & pass
            if(empty($user_id)) {
                self::$err_msg = 'Error User id is empty'; 
                return false;
            }

            $szQuery = "select password from member_list where user_id = '".$user_id."' limit 1"; 
            $res =  dbCon::GetConnection()->query($szQuery);

            if($res->rowCount() < 1) {
                self::$err_msg = 'Not exist user id';
                return false;
            }

            $data = $res->fetch();
            if($data['password'] != $password) {
                self::$err_msg = 'Password is Wrong!!!';
                return false;
            }

            // success
            return true;
        }
    }
?>