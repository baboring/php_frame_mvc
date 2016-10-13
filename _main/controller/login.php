<?php

    class Login {
        
        public function index() {
            require_once ('_views/header.php');
            ///////////////////////////////////////////
            require_once ("_views/form_login.php");
            require_once ('_views/footer.php');
        }

        public function try_login() {
            require_once ('_main/data_member.php');
            require_once ('_views/header.php');

            $inp_userid = "";
            $inp_password = "";

            if (!empty($_POST['userid']) && filter_has_var(INPUT_POST,"userid"))
                $inp_userid = $_POST['userid'];
            if (!empty($_POST['password']) && filter_has_var(INPUT_POST,"password"))
                $inp_password = $_POST['password'];

            require_once ('_main/models/DataResult_LoginTry.php');

            $result = new DataResult_LoginTry($inp_userid, $inp_password);

            // login check
            if(null == $result->err_msg) {
                GlobalData::SetLoggedIn($inp_userid);
                GlobalData::SetDebug($result->expire_date);
                Application::Redirect(Navi::Member);
                exit(0);
            }
            else{
                if( $result->err_msg == 'expired password date') {
                    GlobalData::SetUserID($inp_userid);
                    $display = $result->err_msg;
                    $button = 'Change Password';
                    $url = Navi::GetUrl(Navi::Member,'update');
                    require_once ("_views/form_alert.php");
                    exit(0);
                }
                $error_msg = "<h2>".$result->err_msg."</h2>";
            }
            ///////////////////////////////////////////
            require_once ("_views/form_login.php");
            require_once ('_views/footer.php');
        }

        public function logout() {
            GlobalData::SetLoggedOut();
            $this->index();
        }
    }
?>