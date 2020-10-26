<?php
function authorize($cookieKey, $authenticationURL) {
  if( !isset($_COOKIE[$cookieKey]) ) {
    header("Location: ".$authenticationURL);
  }
}

// $path = $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
// echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $path);
?>