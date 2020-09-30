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

  if(isset($_REQUEST['newVehicle'])) {
    $id = $_POST['idNum'];
    $Regnum = filter_var($_POST['RegNum'], FILTER_SANITIZE_STRING);
    $Purchdate = filter_var($_POST['PurchDate'], FILTER_SANITIZE_STRING);
    $NumOfseats = filter_var($_POST['numOfseats'], FILTER_SANITIZE_EMAIL);
    $Make = filter_var($_POST['Make'], FILTER_SANITIZE_STRING);
    $Model = filter_var($_POST['model'], FILTER_SANITIZE_STRING);
    $Year = filter_var($_POST['Year'], FILTER_SANITIZE_STRING);
    $liceCode = filter_var($_POST['liceCode'], FILTER_SANITIZE_STRING);
    $query = 
      "INSERT INTO vehicle (registrationNumber, Purchasedate, Number_of_seats, make, model,year,licensecode)
        VALUES ('$Regnum', '$Purchdate', '$NumOfseats', '$Make', '$Model','$Year','$liceCode');";
    $result = executeQuery($query);
    if($result) {
      header("Location: sign_in.php");
    } else {
      header("Location: ../common/404.html");
    }
  } else {
    include 'add_vehicle_html.php';
  }
?>

</html>