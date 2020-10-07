<?php
if( !isset($_COOKIE['adminID']) ) {
  $adminBaseUrl = "index.php"; //"admin/index.php";
  header("Location: /hambakahle/public/admin/index.php");
}
?>