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
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contact = filter_var($_POST['contact'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $query = 
      "INSERT INTO clients (firstname, lastname, contactNumber, email, password)
        VALUES ('$firstname', '$lastname', '$contact', '$email', '$password');";
    $result = executeQuery($query);
    if($result) {
      header("Location: sign_in.php");
    } else {
      header("Location: ../common/404.html");
    }
  } else {
    include 'register_html.php';
  }
?>

</html>