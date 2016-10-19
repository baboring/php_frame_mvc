<?php

    class Dashboard {
        
        public function index() {
            require_once ('_server/views/header.php');
            if(GlobalData::IsLoggedIn()) {
                //Application::Redirect(Navi::Dashboard,'Search');
                require_once ("_server/views/dash_navi.php");
                require_once ("_server/views/ContentsView_Menu.php");
                    $display_title = 'Welcome';
                    $display_contents = 'This web site is for something....';
                    $button = 'Ok';
                    $onClick = "GoUrl('".Navi::GetUrl(Navi::Search)."');";
                    //$onClick = 'HistoryBack();';
                require_once ("_server/views/WelcomeView.php");
            }
            require_once ('_server/views/footer.php');
        }

        public function logout() {
            GlobalData::SetLoggedOut();
            $this->index();
        }
    }
?>