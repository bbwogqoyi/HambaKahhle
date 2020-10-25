<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php 
    //add database credentials
    require_once("config.php");

    //connect to the database
    $newConnection = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database!");
    
    //store the values from the form
    $newlastname = $_REQUEST['lastname'];
    $newfirstname = $_REQUEST['firstname'];
    $newcontactnumber = $_REQUEST['contactnum'];
    $newemail = $_REQUEST['e_mail'];
    $clientID = $_REQUEST['client-id'];
    
   
    
    //issue the query instructions
    $newQuery = "UPDATE clients SET lastname= '$newlastname', firstname = '$newfirstname', email = '$newEmail', contactNumber = '$newcontactnumber' WHERE clientID = $clientID";
    $newResult = mysqli_query($newConnection, $newQuery) or die("Could not retrieve data!");
    
    //end the connection to the database
    mysqli_close($newConnection);
    
    //display message that confirms the update
    echo "<p style=\"color: green;\">The record was successfully updated!</p>";
?> 
</body>
</html>