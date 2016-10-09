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



?>