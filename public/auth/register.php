<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <script type="text/javascript" src="validators.js"></script>
  <title>Sign Up</title>
</head>

<?php
  require("../common/utils.php");

  if(isset($_REQUEST['newUser']) && isset($_REQUEST["submit"])) {
    $id = $_POST['idNum'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    $query = 
      "INSERT INTO clients (firstname, lastname, contactNumber, email, password)
        VALUES ('$firstname', '$lastname', '$contact', '$email', '$password');";
    // $result = executeQuery($query);
    // if($result) {
    //   header("Location: sign-in.php");
    // } else {
    //   header("Location: ../common/404.html");
    // }
    
  } else {
    include 'register_html.php';
  }


?>

</html>