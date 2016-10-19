<?php

    class Export {

        public function index() {

            Application::Redirect(navi::Export,'View');

        }

        public function View() {
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

                require_once ('_server/modules/member/MemberDoc.php');
                $cDetail = MemberDoc::GetDataResult_ClientDetail($clientInfo['uid'])->data;

                require_once ("_server/modules/report/ReportView.php");
            }
            require_once ('_server/views/footer.php');

        }
    }

?>