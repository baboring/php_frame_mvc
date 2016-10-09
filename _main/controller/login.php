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

            if(DataMember::TryLogin($inp_userid, $inp_password)) {
                $_SESSION["userid"] = $inp_userid;
                Application::Redirect(Navi::Member);
                exit(0);
            } else {
                $error_msg = "<h2>".DataMember::$err_msg."</h2>";
            }
            ///////////////////////////////////////////
            require_once ("_views/form_login.php");
            require_once ('_views/footer.php');
        }

        public function logout() {
            $_SESSION["userid"] = null;
            $this->index();
        }
    }
?>