<!doctype html>
<html lang="en">
<?php
require_once(dirname(__DIR__) . "../../auth/authorization.php");
$GLOBALS['active_nav_item'] = 'assets_dashboard';

//import database credentials
require_once(dirname(__DIR__) . "../../common/utils.php");



// get associated information about the booking and client
//$bookingInfo = mysqli_fetch_assoc( $resultSet['bookingInfoResult'] );
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../../css/tailwind.css" />
  <link rel="stylesheet" href="../../css/custom.css" />
  <title>Booking Overview</title>

  <style>
    #menu-toggle:checked+#menu {
      display: block;
    }

    #searchBar:focus + #searchBtn{
      display: flex;
    }

    #addVehicleForm + input {
      pointer-events: none;
    }

  </style>
</head>

<body class="antialiased bg-gray-200">
  <!-- Top Navbar -->
  <?php
    require_once("../../component_partials/admin.topbar.nav.php");
  ?>

  <!-- Page Content-->
  <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full lg:w-4/5">
    <!-- Booking Overview -->
    <form id="addVehicleForm" class="w-full mx-auto" action="./add.vehicle.php" method="POST">
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
  </div>
</body>
</html>