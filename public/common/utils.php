<?php
// reusable helper function to execute queries on the DB
function executeQuery($query) {
  // database credentials
  require_once("db.config.php");

  // make connection to db
  $conn = 
    mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE)
    or die("Could not connect to database!");

  // execute query
  $result = 
    mysqli_query($conn, $query)
    or die("Error description: " . mysqli_error($conn));
    // or die("Could not execute query!");

  // close db connection
  mysqli_close($conn);

  return $result;
}

define("HAMBAKAHLE_ROOT", "/hambakahle/public");

?>