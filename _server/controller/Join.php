<?php

    require_once ('_server/modules/member/MemberDoc.php');

    class Join {
        
        public function index() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            if (!empty($_GET['pwd'])) $inp_password = $_GET['pwd'];
                else $inp_password = '';            
            require_once ('_server/modules/Join/JoinView.php');
            require_once ('_server/views/footer.php');
        }

        public function try_join() {
            require_once ('_server/views/header.php');
            ///////////////////////////////////////////
            $dataForm = ReadData_FromPost(MemberDoc::FormArgs);
            $result = MemberDoc::Add($dataForm);
            $display_title = 'Register Success!';
            if($result) {
            // -------- Success -----------
                $display_contents = 'Success....';
                $button = 'Go to Login';
                $onClick = "GoUrl('".Navi::GetUrl(Navi::Login)."');";
            } else {
            // -------- failed -----------
                $display_contents = MemberDoc::$err_msg;
                $button = 'Go Back';
                $onClick = 'HistoryBack();';
            }
            require_once ("_server/views/MessageBoxView.php");
            require_once ('_server/views/footer.php');
        }
    }
?>