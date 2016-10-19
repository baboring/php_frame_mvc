<?php

    class Search {

        public function index() {

            $subcat = null;
            switch(GlobalData::GetUserType()) {
                case UserType::Admin: $subcat = "Client";
                    break;
                case UserType::Business:  $subcat = 'Client';
                    break;
                case UserType::Client: $subcat = 'Records';
                    break;
            } 
            if(null != $subcat)
                Application::Redirect(navi::Search,$subcat);
        }

        // Search Business, Client so on
        public function Business() {
            require_once ('_server/views/header.php');
            if(GlobalData::IsLoggedIn()) {
                require_once ("_server/views/dash_navi.php");
                require_once ("_server/views/ContentsView_Menu.php");
                require_once ("_server/modules/search/SearchView_Business.php");
            }
            require_once ('_server/views/footer.php');
        }

        // Search Business, Client so on
        public function Client() {
            require_once ('_server/views/header.php');
            if(GlobalData::IsLoggedIn()) {

                require_once ("_server/views/dash_navi.php");
                require_once ("_server/views/ContentsView_Menu.php");
                require_once ("_server/modules/search/SearchView_Client.php");
            }
            require_once ('_server/views/footer.php');
        }

        // Search Business, Client so on
        public function Records() {
            require_once ('_server/views/header.php');
            if(GlobalData::IsLoggedIn()) {
                require_once ("_server/views/dash_navi.php");
                require_once ("_server/views/ContentsView_Menu.php");
                require_once ("_server/modules/search/SearchView_Records.php");
            }
            require_once ('_server/views/footer.php');
        }
        // Search Business, Client so on
        public function Services() {
            require_once ('_server/views/header.php');
            if(GlobalData::IsLoggedIn()) {
                require_once ("_server/views/dash_navi.php");
                require_once ("_server/views/ContentsView_Menu.php");
                require_once ("_server/modules/search/SearchView_Client.php");
            }
            require_once ('_server/views/footer.php');
        }
    }

?>