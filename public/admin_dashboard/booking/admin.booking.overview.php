<?php
  if(!isset($_REQUEST["id"])) {
    header("Location: ../index.php");
  }
?>

<!doctype html>
<html lang="en">

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

  </style>
</head>

<body class="antialiased bg-gray-200">
  <!-- Top Navbar -->
  <?php
    require_once("../../component_partials/topbar.nav.php");


    //import database credentials
    require_once(dirname(__DIR__) . "../../common/db.config.php");

    function getBookingDetails($bookingID){
      //connect to the database 
      $conn = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE)
            or die("Sorry , could not connect ot the database!");

      //issue query instructions
      $query = "SELECT * FROM booking b, clients c WHERE bookingID=$bookingID";  
      $result = mysqli_query($conn, $query) or die("Error on query!");

      //disconnect 
      mysqli_close($conn);
      return $result;
    }

    $result = mysqli_fetch_assoc(
      getBookingDetails($_REQUEST["id"])
    );
  ?>

  <!-- Page Content-->
  <div class="mt-16 mx-auto w-full lg:w-4/5">

    <!-- Booking Status Visualizer -->
    <div class="mb-8 px-8 pt-2 w-full flex items-center justify-between content-evenly bg-white border border-indigo-100 shadow-sm">
      <div>
        <p class="text-sm text-gray-400">
          Step One
        </p>
        <p class="text-lg">
          New Booking
        </p>
      </div>
      <div class="border-indigo-400 border-b-4 pb-4 pl-2">
        <p class="text-sm text-indigo-500">
          Step Two
        </p>
        <p class="text-lg font-medium">
          Assign Vehicle
        </p>
      </div>
      <div>
        <p class="text-sm text-gray-400">
          Step Three
        </p>
        <p class="text-lg ">
          Assign Driver
        </p>
      </div>
      <div>
        <p class="text-sm text-gray-400">
          Step Four
        </p>
        <p class="text-lg ">
          Request Client Confirmation
        </p>
      </div>
      <div>
        <p class="text-sm text-gray-400">
          Step Five
        </p>
        <p class="text-lg ">
          Finalize Booking
        </p>
      </div>
    </div>

    <!-- Booking Overview -->
    <div class="w-full flex justify-between bg-white border border-indigo-100 shadow">
      <!-- Booking Summary -->
      <div class="px-8 my-6 mr-1 w-1/3 border-gray-400 border-r">
        <span class="pb-6 flex items-center justify-center">
          <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
          </svg>
          <p class="text-xl font-bold text-gray-900">Booking Summary</p>
        </span>
        <?php
          echo '
          <div class="flex justify-between items-center border-b border-indigo-200 my-4 pb-2">
            <p class="text-base text-gray-500">Client Name</p>
            <p class="text-base font-semibold text-gray-700">'. $result["firstName"] . ' ' . $result["lastName"] .'</p>
          </div>
          <div class="flex justify-between items-center border-b border-indigo-200 my-4 pb-2">
            <p class="text-base text-gray-500">Pick-up Town</p>
            <p class="text-base font-semibold text-gray-700">'. $result["initialCollectionPoint"] .'</p>
          </div>
          <div class="flex justify-between items-center border-b border-indigo-200 my-4 pb-2">
            <p class="text-base text-gray-500">Number of passengers</p>
            <p class="text-base font-semibold text-gray-700">'. $result["numberOfPassengers"] .'</p>
          </div>
          <div class="flex justify-between items-center border-b border-indigo-200 my-4 pb-2">
            <p class="text-base text-gray-500">E-mail</p>
            <p class="text-base font-semibold text-gray-700">'. $result["email"] .'</p>
          </div>
          <div class="flex justify-between items-center border-b border-indigo-200 my-4 pb-2">
            <p class="text-base text-gray-500">Contact Number</p>
            <p class="text-base font-semibold text-gray-700">'. $result["contactNumber"] .'</p>
          </div>
          ';
        ?>
        
      </div>
  
      <!-- Vehicles Summary -->
      <div class="px-8 my-6 ml-1 w-1/3 border-gray-400 border-r">
        <span class="pb-6 flex items-center justify-center">
          <svg class="w-6 h-6 mr-2 text-gray-700 fill-current" fill="none" viewBox="0 0 512 512" stroke="currentColor">
            <path stroke-width="1" d="M497.36 69.995c-7.532-7.545-19.753-7.558-27.285-.032L238.582 300.845l-83.522-90.713c-7.217-7.834-19.419-8.342-27.266-1.126-7.841 7.217-8.343 19.425-1.126 27.266l97.126 105.481a19.273 19.273 0 0013.784 6.22c.141.006.277.006.412.006a19.317 19.317 0 0013.623-5.628L497.322 97.286c7.551-7.525 7.564-19.746.038-27.291z"/>
            <path stroke-width="1" d="M492.703 236.703c-10.658 0-19.296 8.638-19.296 19.297 0 119.883-97.524 217.407-217.407 217.407-119.876 0-217.407-97.524-217.407-217.407 0-119.876 97.531-217.407 217.407-217.407 10.658 0 19.297-8.638 19.297-19.296C275.297 8.638 266.658 0 256 0 114.84 0 0 114.84 0 256c0 141.154 114.84 256 256 256 141.154 0 256-114.846 256-256 0-10.658-8.638-19.297-19.297-19.297z"/>
          </svg>
          <p class="text-xl font-bold text-gray-900">Vehicle And Trailers</p>
        </span>
        <!-- Assign Vehicle Section -->
        <div class="w-full mx-auto py-8 mb-6 flex justify-center border border-indigo-200 bg-indigo-100 shadow">
          <span class="pb-6 flex items-center">
            <svg class="w-8 h-8 mr-2 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-xl font-bold text-gray-900">Assign Vehicle</p>
          </span>
        </div>
        <!-- Add Trailers Section -->
        <div class="w-full mx-auto py-8 my-6 flex justify-center border border-indigo-200 bg-indigo-100 shadow">
          <span class="pb-6 flex items-center">
            <svg class="w-8 h-8 mr-2 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-xl font-bold text-gray-900">Add Trailers</p>
          </span>
          
        </div>
      </div>

      <!-- Driver Summary -->
      <div class="px-8 my-6 ml-1 w-1/3">
        <span class="pb-6 flex items-center justify-center">
          <svg class="w-6 h-6 mr-2"fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
          </svg>
          <p class="text-xl font-bold text-gray-900">Driver</p>
        </span>
        <div class="w-full mx-auto py-8 flex justify-center border border-indigo-200 bg-gray-100 hover:bg-indigo-100 shadow">
          <a href="../driver/admin.driver.php">
            <span class="pb-6 flex items-center">
              <svg class="w-8 h-8 mr-2 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <p class="text-xl font-bold text-gray-900">Assign Driver</p>
            </span>
          </a>
          
        </div>
      </div>
    </div>
    

  </div>

</body>

</html>