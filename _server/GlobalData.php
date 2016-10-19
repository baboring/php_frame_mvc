<?php

    class UserData {
        public $user_id;
        public $user_name;
    }

    // Global Data 
    class GlobalData {

        public $userData;

        // is logged
        public static function IsLoggedIn() {
            return (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]);
        }

        public static function SetLoggedIn($u_uid) {
            $_SESSION["loggedIn"] = true;
            $_SESSION["u_uid"] = $u_uid;

            $_SESSION["clt_uid"] = null;
            $_SESSION["clt_name"] = null;
            $_SESSION["bus_uid"] = null;
            $_SESSION["bus_name"] = null;
            
        }

        public static function SetLoggedOut() {
            $_SESSION["loggedIn"] = null;
            $_SESSION["u_uid"] = null;
            $_SESSION["userid"] = null;

            $_SESSION["clt_uid"] = null;
            $_SESSION["clt_name"] = null;
            $_SESSION["bus_uid"] = null;
            $_SESSION["bus_name"] = null;
        }

        /////////////////////////////////////////
        public static function GetUserName() {
            if(empty($_SESSION["username"]) || null == $_SESSION["username"])
                return "";
            return $_SESSION["username"];
        }
        public static function SetUserName($username) {
            $_SESSION["username"] = $username;
        }
        /////////////////////////////////////////
        public static function GetUserType() {
            if(empty($_SESSION["usertype"]) || null == $_SESSION["usertype"])
                return "";
            return $_SESSION["usertype"];
        }
        public static function SetUserType($usertype) {
            $_SESSION["usertype"] = $usertype;
        }
        /////////////////////////////////////////
        public static function GetUuid() {
            if(empty($_SESSION["u_uid"]) || null == $_SESSION["u_uid"])
                return "";
            return $_SESSION["u_uid"];
        }
        public static function GetUserId() {
            if(empty($_SESSION["userid"]) || null == $_SESSION["userid"])
                return "";
            return $_SESSION["userid"];
        }
        public static function SetUserId($userid) {
            $_SESSION["userid"] = $userid;
        }
        /////////////////////////////////////////
        public static function GetAuthority() {
            return $_SESSION["authority"];
        }
        public static function IsAuthority($level) {
            return ($_SESSION["authority"] >= $level);
        }
        public static function SetAuthority($authority) {
            $_SESSION["authority"] = $authority;
        }

        /////////////////////////////////////////
        public static function GetDebug() {
            if(empty($_SESSION["debug"]))
                return null;
            return $_SESSION["debug"];
        }
        public static function SetDebug($val) {
            $_SESSION["debug"] = $val;
        }

        /////////////////////////////////////////
        public static function GetMnuAction() {
            if(empty($_SESSION["mnu_action"]))
                return null;
            return $_SESSION["mnu_action"];
        }
        public static function SetMnuAction($val) {
            $_SESSION["mnu_action"] = $val;
        }
        /////////////////////////////////////////
        public static function GetClientInfo() {

            if(null == $_SESSION["clt_uid"])
                return null;
            $info = array();
            
            $info['uid'] = $_SESSION["clt_uid"];
            $info['name'] = $_SESSION["clt_name"];

            return $info;
        }
        public static function SetClientInfo($val) {
            if(null === $val || null === $val['uid'])
                return;
            $_SESSION["clt_uid"] = $val['uid'];
            $_SESSION["clt_name"] = $val['name'];
        }
        /////////////////////////////////////////
        public static function GetBusinessInfo() {

            if(null == $_SESSION["bus_uid"])
                return null;
            $info = array();
            
            $info['uid'] = $_SESSION["bus_uid"];
            $info['name'] = $_SESSION["bus_name"];

            return $info;
        }
        public static function SetBusinessInfo($val) {
            if(null === $val || null === $val['uid'])
                return;
            $_SESSION["bus_uid"] = $val['uid'];
            $_SESSION["bus_name"] = $val['name'];
        }
    }
?>