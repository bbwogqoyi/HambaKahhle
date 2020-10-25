<?php

//store the values from the form

$newlastname = $_REQUEST['lastname'];
$newfirstname = $_REQUEST['firstname'];
$newcontactnumber = $_REQUEST['contactnum'];
$newEmail = $_REQUEST['e_mail'];


$id = 2;

//add database credentials
require_once("config.php");

//connect to the database
$newConnection = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database!");


//issue the query instructions
$newQuery = "UPDATE clients SET lastname= '$newlastname', firstname = '$newfirstname', email = '$newEmail', contactNumber = '$newcontactnumber' WHERE clientID = $id";
$newResult = mysqli_query($newConnection, $newQuery) or die("Could not retrieve data!");

//end the connection to the database
mysqli_close($newConnection);

//display message that confirms the update
echo "<p style=\"color: green;\">The record was successfully updated!</p>";

?>