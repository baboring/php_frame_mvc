<?php

    require_once ('_main/member.php');

    class MemberList {
        
        public function index() {
            require_once ('_views/header.php');
            if(empty($_SESSION["userid"])) {
                exit(0);
            }
            $userData = Member::Fetch_MemberInfo($_SESSION["userid"]);
            
            require_once ("_views/form_list.php");
            require_once ('_views/footer.php');
        }

      
    }
?>