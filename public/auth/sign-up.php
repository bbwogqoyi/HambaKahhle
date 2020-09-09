<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <title>Sign Up</title>
</head>

<?php
  require_once("../common/utils.php");

  if(isset($_REQUEST['newUser'])) {
    $id = $_POST['idNum'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    $query = 
      "INSERT INTO table_name (column1, column2, column3, ...)
        VALUES (value1, value2, value3, ...);";
    if(executeQuery($query)) {
      header("Location: sign-in.php");
    } else {
      header("Location: ../common/404.html");
    }
    
  } else {
    include 'sign-up-template.php';
  }


?>



</html>