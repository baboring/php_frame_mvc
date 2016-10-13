<?php

    require_once ('_main/data_member.php');

    class Member {
        
        public function index() {
            require_once ('_views/header.php');
            if(!GlobalData::IsLoggedIn())
                exit(0);
                
            $userData = DataMember::Fetch_MemberInfo($_SESSION["userid"]);
            
            require_once ("_views/form_member_list.php");
            require_once ('_views/footer.php');
        }

        public function delete() {
            require_once ('_views/header.php');
            if(!GlobalData::IsLoggedIn())
                exit(0);

            if (!empty($_POST['idx'])) $idx = $_POST['idx'];
                else $idx = '';
            echo 'delete:'.$idx;

            // delete user
            if(isset($idx) && !DataMember::DeleteUserByIdx($idx)) {
                // error : need to handle
            }
            
            $userData = DataMember::Fetch_MemberInfo(GlobalData::GetUserID());
            
            require_once ("_views/form_member_list.php");
            require_once ('_views/footer.php');
        }

        ///////////////////////////////////////////////////////////////////////////////////////
        public function update() {
            require_once ('_views/header.php');
            if(null == GlobalData::GetUserID())
                exit(0);

            if (!empty($_POST['user_id']) && filter_has_var(INPUT_POST,"user_id")) {
                $inp_user_id = $_POST['user_id'];

                if (!empty($_POST['password'])) $inp_password = $_POST['password'];
                    else $inp_password = '';
                if (!empty($_POST['user_name'])) $inp_user_name = $_POST['user_name'];
                    else $inp_user_name = '';
                if (!empty($_POST['tel'])) $inp_tel = $_POST['tel'];
                    else $inp_tel = '';
                if (!empty($_POST['email'])) $inp_email = $_POST['email'];
                    else $inp_email = '';
                if (!empty($_POST['security_q'])) $inp_security_q = $_POST['security_q'];
                    else $inp_security_q = '';
                if (!empty($_POST['security_a'])) $inp_security_a = $_POST['security_a'];
                    else $inp_security_a = '';

                // update database
                DataMember::Update($inp_user_id, $inp_user_name, $inp_password, $inp_tel, $inp_email, $inp_security_q, $inp_security_a);
                if(!GlobalData::IsLoggedIn())
                    GlobalData::SetLoggedIn($inp_user_id);
                Application::Redirect(Navi::Member);
                exit(0);
            }
            else {
                $userData = DataMember::Fetch_MemberInfo($_SESSION["userid"]);
            }

          
            require_once ("_views/form_member_update.php");
            require_once ('_views/footer.php');
        }

      
    }
?>