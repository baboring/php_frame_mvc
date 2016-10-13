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

        public static function SetLoggedIn($user_id) {
            $_SESSION["userid"] = $user_id;
            $_SESSION["loggedIn"] = true;
        }

        public static function SetLoggedOut() {
            $_SESSION["loggedIn"] = null;
            $_SESSION["userid"] = null;
        }

        public static function GetUserName() {
            if(empty($_SESSION["username"]) || null == $_SESSION["username"])
                return "";
            return $_SESSION["username"];
        }

        public static function GetUserId() {
            return $_SESSION["userid"];
        }
        public static function SetUserId($userid) {
            $_SESSION["userid"] = $userid;
        }

        public static function GetDebug() {
            if(empty($_SESSION["debug"]))
                return null;
            return $_SESSION["debug"];
        }
        public static function SetDebug($val) {
            $_SESSION["debug"] = $val;
        }
        
    }
?>