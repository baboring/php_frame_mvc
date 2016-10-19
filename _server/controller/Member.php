<?php

    class Member {
        
        public function index() {

            Application::Redirect(navi::Member,'Add_Account');
        }

        // Add Account
        public function Add_Account() {
            require_once ('_server/views/header.php');
            if(GlobalData::IsLoggedIn()) {

                require_once ("_server/views/dash_navi.php");
                require_once ("_server/views/ContentsView_Menu.php");
                require_once ("_server/modules/member/MemberDoc.php");

                $dataForm = null;
                if (IsExistVarInPost('confirm')) {
                    $dataForm = ReadData_FromPost(MemberDoc::FormArgs);
                    $result = MemberDoc::Add($dataForm);
                    $display_title = 'Add New '.$dataForm['type'];
                    if($result) {
                    // -------- Success -----------
                        $display_contents = 'Success....';
                        $button = 'Next';
                        $onClick = "GoUrl('".Navi::GetUrl(Navi::Search)."');";
                    } else {
                    // -------- failed -----------
                        $display_contents = MemberDoc::$err_msg;
                        $button = 'Back';
                        $onClick = 'HistoryBack();';
                    }
                    require_once ("_server/views/MessageBoxView.php");
                    require_once ('_server/views/footer.php');
                    exit(0);
                }
                require_once ("_server/modules/member/MemberView_Add.php");
            }
            require_once ('_server/views/footer.php');
        }


        public function Delete() {
            require_once ('_server/views/header.php');
            if(GlobalData::IsLoggedIn()) {

                require_once ("_server/modules/member/MemberDoc.php");
                if (!empty($_POST['idx'])) $idx = $_POST['idx'];
                    else $idx = '';
                echo 'delete:'.$idx;

                // delete user
                if(isset($idx) && !MemberDoc::DeleteUserByUid($idx)) {
                    // error : need to handle
                }
                
            }
            require_once ('_server/views/footer.php');
        }

        ///////////////////////////////////////////////////////////////////////////////////////
        public function Update() {
            require_once ('_server/views/header.php');
            if(GlobalData::IsLoggedIn()) {

                require_once ("_server/views/dash_navi.php");
                require_once ("_server/views/ContentsView_Menu.php");
                require_once ("_server/modules/member/MemberDoc.php");

                if (IsExistVarInPost('confirm')) {
                    $dataForm = ReadData_FromPost(MemberDoc::FormArgs);

                    // update database
                    $result = MemberDoc::Update($dataForm);
                    $display_title = 'Update Info ';
                    if($result) {
                    // -------- Success -----------
                        $display_contents = 'Success....';
                        $button = 'Next';
                        $onClick = "GoUrl('".Navi::GetUrl(Navi::Search)."');";
                    } else {
                    // -------- failed -----------
                        $display_contents = MemberDoc::$err_msg;
                        $button = 'Back';
                        $onClick = 'HistoryBack();';
                    }
                    require_once ("_server/views/MessageBoxView.php");
                    require_once ('_server/views/footer.php');
                    exit(0);                    
                }

                require_once ('_server/modules/member/MemberView_Update.php');
            }
            require_once ('_server/views/footer.php');
        }

      
    }
?>