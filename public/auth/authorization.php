<?php
if( !isset($_COOKIE['employeeID']) ) {
  $adminBaseUrl = "index.php"; //"admin/index.php";
  header("Location: /hambakahle/public/admin/index.php");
}
?>