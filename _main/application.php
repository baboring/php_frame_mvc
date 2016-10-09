<?php
/* -------------------------------------------------------------
 purpos : Site Navigator
 author : Benjamin
 date : Oct 10, 2016
 desc : This is only one object in this system.
------------------------------------------------------------- */
require_once ('_main/enum.php');
require_once ('_main/libs/request.php');
require_once ('_main/libs/controller.php');

class Application  {

	private static $controller = null;
	private static $action = null;


    public static function Dispatch() {


        $cancontroll = false;
		$url = "";
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
		}

        $params = explode('/', $url);
		$counts = count($params);
		// default 
		self::$controller = Navi::Login;

        if(isset($params[0]) && $params[0])
			self::$controller = $params[0];
        // save last category
        $_SESSION["navi"] = self::$controller;

        //echo 'input:'.$url.'<br>'.self::$controller;

        // dispatch
        if (file_exists('./_main/controller/' . self::$controller . '.php')) {
			require './_main/controller/' . self::$controller . '.php';
			self::$controller = new self::$controller();
			self::$action = "index"; 
			if(isset($params[1]) && $params[1])
				self::$action = $params[1];

			// Do Run
			if (method_exists(self::$controller, self::$action)) {
				$cancontroll = true;
				switch ($counts) {
					case '0':
					case '1':
					case '2':
						self::$controller->{self::$action}();
						break;
					case '3':
						self::$controller->{self::$action}($params[2]);
						break;
					case '4':
						self::$controller->{self::$action}($params[2],$params[3]);
						break;
					case '5':
						self::$controller->{self::$action}($params[2],$params[3],$params[4]);
						break;
					case '6':
						self::$controller->{self::$action}($params[2],$params[3],$params[4],$params[5]);
						break;
					case '7':
						self::$controller->{self::$action}($params[2],$params[3],$params[4],$params[5],$params[6]);
						break;
					case '8':
						self::$controller->{self::$action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7]);
						break;
					case '9':
						self::$controller->{self::$action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8]);
						break;
					case '10':
						self::$controller->{self::$action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8],$params[9]);
						break;
				}	
			}
		}
		if($cancontroll === false) 
			echo "<!DOCTYPE html><html><head><meta charset='utf-8'></head><body><h1>Oops!!! wrong access.</h1></body></html>";
    }

    //
    public static function Redirect($categoty,$action = null) {

		 header('location: '.Navi::GetUrl($categoty,$action));
    }
}
?>