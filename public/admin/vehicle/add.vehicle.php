<!DOCTYPE html>
<html lang="en">

<?php
$GLOBALS['active_nav_item'] = 'assets_dashboard';

//import database utils
require_once(dirname(__DIR__) . "../../auth/authorization.php");
authorize('employeeID', '../index.php');
require_once(dirname(__DIR__) . "../../common/utils.php");

function retrieveExistingVehicle($registrationNumber) {
  $query = "SELECT * from vehicle v where v.registrationNumber='$registrationNumber'";
  return executeQuery($query);
}

function deleteExistingVehicle($registrationNumber) {
  $query = "DELETE FROM vehicle v WHERE v.registrationNumber='$registrationNumber'";
  return executeQuery($query);
}

function updateExistingVehicle() {
  if( isset($_POST['submit']) && isset($_POST['vehicle_registration']) ) {
    $Regnum = filter_var($_POST['vehicle_registration'], FILTER_SANITIZE_STRING);
    $Purchdate = filter_var($_POST['vehicle_purchase_date'], FILTER_SANITIZE_STRING);
    $NumOfseats = filter_var($_POST['vehicle_seat_count'], FILTER_SANITIZE_EMAIL);
    $Make = filter_var($_POST['vehicle_make'], FILTER_SANITIZE_STRING);
    $Model = filter_var($_POST['vehicle_model'], FILTER_SANITIZE_STRING);
    $Year = filter_var($_POST['vehicle_year'], FILTER_SANITIZE_STRING);
    $licence = filter_var($_POST['vehicle_licence'], FILTER_SANITIZE_STRING);
  
    $query = 
      "UPDATE vehicle v
        set
        v.dateOfPurchase='$Purchdate', 
        v.numberOfSeats='$NumOfseats', 
        v.make='$Make', 
        v.model='$Model', 
        v.year='$Year',
        v.licensecode='$licence'
        where v.registrationNumber='$Regnum'"
      ;
  
    return executeQuery($query);
  }
}

function insertNewVehicle() {
  if( isset($_POST['submit']) && isset($_POST['vehicle_registration']) ) {
    $Regnum = filter_var($_POST['vehicle_registration'], FILTER_SANITIZE_STRING);
    $Purchdate = filter_var($_POST['vehicle_purchase_date'], FILTER_SANITIZE_STRING);
    $NumOfseats = filter_var($_POST['vehicle_seat_count'], FILTER_SANITIZE_EMAIL);
    $Make = filter_var($_POST['vehicle_make'], FILTER_SANITIZE_STRING);
    $Model = filter_var($_POST['vehicle_model'], FILTER_SANITIZE_STRING);
    $Year = filter_var($_POST['vehicle_year'], FILTER_SANITIZE_STRING);
    $licence = filter_var($_POST['vehicle_licence'], FILTER_SANITIZE_STRING);
  
    $query = 
      "INSERT INTO vehicle (registrationNumber, dateOfPurchase, numberOfSeats, make, model, year, licensecode)
        VALUES ('$Regnum', '$Purchdate', '$NumOfseats', '$Make', '$Model','$Year','$licence')"
      ;
  
    return executeQuery($query);
  }
}

$vehicle = null;
if( isset($_REQUEST['submit']) ) {
  $result = insertNewVehicle();
}


?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/tailwind.css" />
  <link rel="stylesheet" href="../../css/custom.css" />
  <script type="text/javascript" src="../../js/pristine.min.js"></script>
  <title>Add Vehicle</title>
  <style>
    .has-success .form-control {
      border-bottom: 2px solid #168b3f;
    }

    .has-danger .form-control {
      border-bottom: 2px solid #dc1d34;
    }

    .form-group .text-help {
      color: #dc1d34;
    }
  </style>
</head>
<body class="bg-gray-200 antialiased font-sans">
  <!-- Top Navbar -->
  <?php
    require_once("../../component_partials/admin.topbar.nav.php");
  ?>
  <!-- Record Saved Notification -->
  <div id="savedNotification" class="hidden fixed top-0 mx-auto w-full">
    <div class="m-auto w-full md:w-1/4">
      <div class="bg-white rounded-lg border-gray-300 border p-3 shadow-lg">
        <div class="flex flex-row">
          <div class="px-2">
            <svg width="24" height="24" viewBox="0 0 1792 1792" fill="#44C997" xmlns="http://www.w3.org/2000/svg">
              <path d="M1299 813l-422 422q-19 19-45 19t-45-19l-294-294q-19-19-19-45t19-45l102-102q19-19 45-19t45 19l147 147 275-275q19-19 45-19t45 19l102 102q19 19 19 45t-19 45zm141 83q0-148-73-273t-198-198-273-73-273 73-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273zm224 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/>
              </svg>
          </div>
          <div class="ml-2 mr-6">
            <span class="font-semibold">Successfully Saved!</span>
            <span class="block text-gray-500">The database mutation completed without fault</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page Content-->
  <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full lg:w-4/5">
    <p class="mb-8 text-4xl text-gray-700 font-semibold">Add Vehicles</p>
    <form id="vehicleForm" class="w-full mx-auto" action="./add.vehicle.php" method="POST">
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="form-group w-full md:w-1/3 px-3 mb-6 md:mb-0">
          <label 
            for="vehicle_make"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
              Make
          </label>
          <input 
            name="vehicle_make" id="vehicle_make" type="text" placeholder="Toyota" required
            data-pristine-pattern="/^[a-zA-Z\s]*$/" 
            class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
            rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
             >
        </div>
        <div class="form-group w-full md:w-1/3 px-3">
          <label 
            for="vehicle_model"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
              Model
          </label>
          <input 
            name="vehicle_model"id="vehicle_model" type="text" placeholder="Corolla" required
            data-pristine-pattern="/^[-0-9a-zA-Z\s]*$/" 
            class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
            rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
        </div>
        <div class="form-group w-full md:w-1/3 px-3">
          <label 
            for="vehicle_year"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
              Year
          </label>
          <input
            name="vehicle_year" id="vehicle_year" type="number" placeholder="2020" maxlength="4" required 
            class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-8">
        <div class="form-group w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label
            for="vehicle_seat_count"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
              Number of Seats
          </label>
          <input 
            name="vehicle_seat_count" id="vehicle_seat_count" type="number" placeholder="0" required
            class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
            rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label 
            for="vehicle_licence"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
            Licence Code
          </label>
          <div class="relative">
            <select 
              name="vehicle_licence" id="vehicle_licence"
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 
                rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
              <option value="1">Motorcycles</option>
              <option value="2">Light Motor Vehicles</option>
              <option value="3">Heavy Motor Vehicles</option>
              <option value="4">Combinations & Articulated Vehicles</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
          </div>
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="form-group w-full md:w-1/2 px-3">
          <label
            for="vehicle_registration"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
            Registration Number
          </label>
          <input 
            name="vehicle_registration" id="vehicle_registration" type="text" placeholder="5NPDH4AE8EH125303" required
            class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 
            leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
        </div>
        <div class="form-group w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label
            for="vehicle_purchase_date"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
            Date of Purchase
          </label>
          <input
            name="vehicle_purchase_date" id="vehicle_purchase_date" type="date" placeholder="YYYY-MM-DD" required
            class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 
            leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        </div>
      </div>
      

      <!-- Button -->
      <div class="mt-16 mb-4 flex justify-end w-full items-center">
        <button 
          type="submit" id="submit" name="submit"
          class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold text-center text-lg py-4 px-auto w-56 mr-2 rounded">
            Add New Vehicle
        </button>
        <!-- href="../assets/index.assets.php"  -->
        <a 
          href="../assets/index.assets.php" 
          class="bg-red-400 hover:bg-red-700 text-white font-bold text-center text-lg py-4 px-auto w-56 rounded">
          Cancel
        </a>
      </div>
    </form>
  </div>
  <script>
    window.onload = function () {
      var form = document.getElementById("vehicleForm");

      // create the pristine instance
      var pristine = new Pristine(form);
      form.addEventListener('submit', function (e) {
        //e.preventDefault();
        
        // check if the form is valid
        console.log(pristine.validate());
        var valid = pristine.validate(); // returns true or false
        if(valid) {
          return true;
        } else {
          e.preventDefault();
        }
        //return pristine.validate(); // returns true or false
      });
    };

    var notification = document.getElementById("savedNotification");
    
    function showNotification() {
      notification.classList.remove("hidden");
      notification.classList.add("fade-in");

      setTimeout(function(){
        notification.classList.remove("fade-in");
        notification.classList.add("slide-out-top");
      
        setTimeout(function(){
          notification.classList.add("hidden");
          notification.style.transform = "translateY(0)";
          notification.classList.remove("slide-out-top");
        }, 2000);
      }, 3000);
    }

    <?php
      if( $dbMutationStatus ) {
        echo 'showNotification();';
      }
    ?>

  </script>
</body>
</html>