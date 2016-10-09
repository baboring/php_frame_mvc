<?php

    require_once ('_main/data_member.php');

    class Member {
        
        public function index() {
            require_once ('_views/header.php');
            if(empty($_SESSION["userid"]))
                exit(0);
                
            $userData = DataMember::Fetch_MemberInfo($_SESSION["userid"]);
            
            require_once ("_views/form_member_list.php");
            require_once ('_views/footer.php');
        }

        public function delete() {
            require_once ('_views/header.php');
            if(empty($_SESSION["userid"]))
                exit(0);

            if (!empty($_POST['idx'])) $idx = $_POST['idx'];
                else $idx = '';
            echo 'delete:'.$idx;

            // delete user
            if(isset($idx) && !DataMember::DeleteUserByIdx($idx)) {
                // error : need to handle
            }
            
            $userData = DataMember::Fetch_MemberInfo($_SESSION["userid"]);
            
            require_once ("_views/form_member_list.php");
            require_once ('_views/footer.php');
        }

      
    }
?>