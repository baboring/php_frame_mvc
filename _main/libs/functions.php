<?php
/* -------------------------------------------------------------
 purpos : maintain functionallity utilities
 author : Benjamin
 date : Oct 10, 2016
------------------------------------------------------------- */

// from http://wezfurlong.org/blog/2006/nov/http-post-from-php-without-curl
function do_post_request($url, $data, $optional_headers = null)
{
  $params = array('http' => array(
              'method' => 'POST',
              'content' => $data
            ));
  if ($optional_headers !== null) {
    $params['http']['header'] = $optional_headers;
  }
  $ctx = stream_context_create($params);
  $fp = @fopen($url, 'rb', false, $ctx);
  if (!$fp) {
    throw new Exception("Problem with $url, $php_errormsg");
  }
  $response = @stream_get_contents($fp);
  if ($response === false) {
    throw new Exception("Problem reading data from $url, $php_errormsg");
  }
  return $response;
}

/**
 * Redirect with POST data.
 *
 * @param string $url URL.
 * @param array $post_data POST data. Example: array('foo' => 'var', 'id' => 123)
 * @param array $headers Optional. Extra headers to send.
 */
function redirect_post($url, array $data, array $headers = null) {
    $params = array(
        'http' => array(
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    if (!is_null($headers)) {
        $params['http']['header'] = '';
        foreach ($headers as $k => $v) {
            $params['http']['header'] .= "$k: $v\n";
        }
    }
    $ctx = stream_context_create($params);
    $fp = @fopen($url, 'rb', false, $ctx);
    if ($fp) {
        echo @stream_get_contents($fp);
        die();
    } else {
        // Error
        throw new Exception("Error loading '$url', $php_errormsg");
    }
}

function preparePostFields($array) {
  $params = array();

  foreach ($array as $key => $value) {
    $params[] = $key . '=' . urlencode($value);
  }

  return implode('&', $params);
}

function redirect_post_by_header($url, $data) {

  // Create a curl handle to domain 2
  $ch = curl_init(); 

  //configure a POST request with some options
  curl_setopt($ch, CURLOPT_POST, true);

  //put data to send
  curl_setopt($ch, CURLOPT_POSTFIELDS, preparePostFields($data));  

  //this option avoid retrieving HTTP response headers in answer
  curl_setopt($ch, CURLOPT_HEADER, 0);

  //we want to get result as a string
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  //execute request
  $result = curl_exec($ch);

  // now redirect to domain 2
  header("Location: ".$url);
}

/* ============================================================================
Random Password
============================================================================ */
function randomPassword($pwd_length) {
  //$symbol = '~!@#$%^&*()-_=+[]{};:,.<>?';     // etc
  $symbol = '^';     // etc
  $symbol_count = strlen($symbol);
  $index = mt_rand(0,$symbol_count-1);
  $password = substr($symbol,$index, 1); 
  $password .= chr(mt_rand(48,57)); // number
  $password .= chr(mt_rand(65,90)); // upper letter

  // Add Lowercase letters to reach the specified length
  while(strlen($password) < $pwd_length) 
    $password .=  chr(mt_rand(97,122));

  $password = str_shuffle($password);

  return $password;
}


function GetSafeValuePost($arg,$default = null) {
    if (isset($_POST[$arg])) {
        // if(is_array($_POST[[$arg]) {
        //     $arr = array();
        // }
        return $_POST[$arg];
    } 
    return $default;
}
function GetSafeValueGet($arg,$default = null) {
    if (isset($_GET[$arg])) 
        return $_GET[$arg];
    return $default;
}

// read data from post
function ReadData_FromPost($lst) {
    $results = array();
    foreach($lst as $key=>$value)
        $results[$value] = GetSafeValuePost($value);
    //var_dump($results);
    return $results;
}
function ReadData_FromGet($lst) {
    $results = array();
    foreach($lst as $key=>$value)
        $results[$value] = GetSafeValueGet($value);
    //var_dump($results);
    return $results;
}


function IsExistVarInPost($val) {
    return (isset($_POST[$val]) && filter_has_var(INPUT_POST,$val));
}
function IsExistVarInGet($val) {
    return (isset($_GET[$val]) && filter_has_var(INPUT_GET,$val));
}


function GUIDv4 ($trim = true)
{
    // Windows
    if (function_exists('com_create_guid') === true) {
        if ($trim === true)
            return trim(com_create_guid(), '{}');
        else
            return com_create_guid();
    }

    // OSX/Linux
    if (function_exists('openssl_random_pseudo_bytes') === true) {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    // Fallback (PHP 4.2+)
    mt_srand((double)microtime() * 10000);
    $charid = strtolower(md5(uniqid(rand(), true)));
    $hyphen = chr(45);                  // "-"
    $lbrace = $trim ? "" : chr(123);    // "{"
    $rbrace = $trim ? "" : chr(125);    // "}"
    $guidv4 = $lbrace.
              substr($charid,  0,  8).$hyphen.
              substr($charid,  8,  4).$hyphen.
              substr($charid, 12,  4).$hyphen.
              substr($charid, 16,  4).$hyphen.
              substr($charid, 20, 12).
              $rbrace;
    return $guidv4;
}
?>