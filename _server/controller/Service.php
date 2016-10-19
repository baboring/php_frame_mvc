<?php

    class Service {

        public function index() {
            Application::Redirect(navi::Service,'Add');
        }

        public function Add() {
            require_once ('_server/views/header.php');
            if(GlobalData::IsLoggedIn()) {
                require_once ("_server/views/dash_navi.php");

                require_once ("_server/views/ContentsView_Menu.php");
                
                // get target client
                $clientInfo = GlobalData::GetClientInfo();

                if(null == $clientInfo) {
                    $display_title = 'No Client Info';
                    $display_contents = 'This function needs client`s information';
                    $button = 'Go to Search';
                    $onClick = "GoUrl('".Navi::GetUrl(Navi::Search)."');";
                    require_once ("_server/views/MessageBoxView.php");
                    require_once ('_server/views/footer.php');
                    exit(0);
                }

                require_once ("_server/modules/service/ServicesDoc.php");

                $dataForm = null;
                if (IsExistVarInPost('confirm')) {
                    $dataForm = ReadData_FromPost(ServicesDoc::FormArgs);
                    $result = ServicesDoc::AddRecord($dataForm);
                    $display_title = 'Adding Service Record';
                    if($result) {
                    // -------- Success -----------
                        $display_contents = 'Success....';
                        $button = 'Next';
                        $onClick = "GoUrl('".Navi::GetUrl(Navi::Search)."');";
                    } else {
                    // -------- failed -----------
                        $display_contents = ServicesDoc::$err_msg;
                        $button = 'Back';
                        $onClick = 'HistoryBack();';
                    }
                    require_once ("_server/views/MessageBoxView.php");
                    exit(0);
                }
                require_once ('_server/modules/member/MemberDoc.php');
                $cDetail = MemberDoc::GetDataResult_ClientDetail($clientInfo['uid'])->data;
 
                require_once ("_server/modules/service/ServiceView.php");
            }
            require_once ('_server/views/footer.php');

        }
    }

?>