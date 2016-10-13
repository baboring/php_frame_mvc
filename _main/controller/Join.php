<?php

    require_once ('_main/data_member.php');

    class Join {
        
        public function index() {
            require_once ('_views/header.php');
            ///////////////////////////////////////////
            if (!empty($_GET['pwd'])) $inp_password = $_GET['pwd'];
                else $inp_password = '';            
            require_once ("_views/form_join.php");
            require_once ('_views/footer.php');
        }

        public function try_join() {
            require_once ('_views/header.php');
            ///////////////////////////////////////////
            
            if (!empty($_POST['type'])) $inp_type = $_POST['type'];
                else $inp_type = '';
            if (!empty($_POST['token'])) $inp_token = $_POST['token'];
                else $inp_token = '';
            if (!empty($_POST['license'])) $inp_license = $_POST['license'];
                else $inp_license = '';
            if (!empty($_POST['ohip'])) $inp_ohip = $_POST['ohip'];
                else $inp_ohip = '';

            if (!empty($_POST['user_id']) && filter_has_var(INPUT_POST,"user_id")) $inp_user_id = $_POST['user_id'];
                else $inp_user_id = '';
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

            if(DataMember::AddUser(
                $inp_user_id,
                $inp_user_name,
                $inp_password,
                $inp_tel,
                $inp_email,
                $inp_security_q, 
                $inp_security_a,
                $inp_type, 
                $inp_token, 
                $inp_license,
                $inp_ohip)) {
                    // success so, move to login
                    //Application::Redirect(URL.Navi::Join,'Success');

                    $display = 'Register Success!!';
                    $button = 'Next';
                    $url = Navi::GetUrl(Navi::Login);
                    require_once ("_views/form_alert.php");
                    exit(0);
                }
            // fails
            $error_msg = "fail to create account <br>".DataMember::$err_msg;            
            require_once ("_views/form_join.php");
            require_once ('_views/footer.php');
        }
    }
?>