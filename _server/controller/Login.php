<?php

    class Login {
        
        public function index() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            require_once ('_server/modules/login/LoginView.php');
            require_once ('_server/views/footer.php');
        }

        public function try_login() {
            require_once ('_server/views/header.php');

            $inp_userid = "";
            $inp_password = "";

            if (!empty($_POST['userid']) && filter_has_var(INPUT_POST,"userid"))
                $inp_userid = $_POST['userid'];
            if (!empty($_POST['password']) && filter_has_var(INPUT_POST,"password"))
                $inp_password = $_POST['password'];

            require_once ('_server/models/DataResult_LoginTry.php');

            $result = new DataResult_LoginTry($inp_userid, $inp_password);

            // login check
            if(null == $result->err_msg) {
                GlobalData::SetLoggedIn($result->user_uid);
                GlobalData::SetDebug($result->expire_date);
                GlobalData::SetUserName($result->user_name);
                GlobalData::SetUserType($result->user_type);
                GlobalData::SetAuthority($result->authority);
                GlobalData::SetUserID($inp_userid);

                // for report
                $info = array();
                $info['uid'] = $result->user_uid;
                $info['name'] = $result->user_name;

                // self register client
                switch(GlobalData::GetUserType()) {
                    case UserType::Admin:
                        break;
                    case UserType::Business:
                        GlobalData::SetBusinessInfo($info);
                        break;
                    case UserType::Client:
                        GlobalData::SetClientInfo($info);
                        break;
                }                 

                Application::Redirect(Navi::Dashboard);
                exit(0);
            }
            else{
                if( $result->err_msg == 'expired password date') {
                    GlobalData::SetUserID($inp_userid);

                    $display_title = 'Login Result';
                    $display_contents = $result->err_msg;
                    $button = 'Change Password';
                    $display_contents = 'Success....';
                    $button = 'Next';
                    $onClick = "GoUrl('".Navi::GetUrl(Navi::Member,'Update')."');";
                    require_once ('_server/views/MessageBoxView.php');
                    require_once ('_server/views/footer.php');
                    exit(0);
                }
                $error_msg = "<h2>".$result->err_msg."</h2>";
            }
            ///////////////////////////////////////////
            require_once ('_server/modules/login/LoginView.php');
            require_once ('_server/views/footer.php');
        }

        public function logout() {
            GlobalData::SetLoggedOut();
            header('location: '.URL);
        }
    }
?>