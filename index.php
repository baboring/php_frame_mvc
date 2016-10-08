<?php
    // Start the session
    require_once ('_config/config.php');
    include_once ('_main/application.php');

    Application::Dispatch();

?>