<?php
// get database credentials
require_once("config.php");

// declaring a function with the expected inputs
function getAllClientsBookings($clientID) {
  // make connection to db
  $conn = 
    mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE)
    or die("Could not connect to database!");

  $sqlQuery = "SELECT * FROM blackpeakltd.booking where clientID=$clientID";
  
  // Change character set to utf8
  mysqli_set_charset($conn,"utf8");
  
  // execute query
  $result = 
    mysqli_query($conn, $query)
    or die("Could not execute query!");

  // close db connection
  mysqli_close($conn);

  // return data resultset
  return $result;
}
?>
