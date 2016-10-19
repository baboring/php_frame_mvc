<?php
/* -------------------------------------------------------------
 purpos : set up configuration
 author : Benjamin
 date : Oct 10, 2016
 desc : 
------------------------------------------------------------- */
class Config {

    public static function Setup() {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        define('APP_NAME', 'Final Assignment Project');
        define('URL', 'http://localhost/_www_root/');
        /** 나중에 여기에 DB 관련 환경설정 값이 입력됨 */
        session_start();
    }
        
}

////////////////////////////////
Config::Setup();


////////////////////////////////
?>