<!doctype html>
<html lang="en">
<?php
  if(!isset($_REQUEST["id"])) {
    header("Location: ../index.php");
  }

  //import database credentials
  require_once(dirname(__DIR__) . "../../common/db.config.php");

  function getBookingDetails($bookingID){
    //connect to the database 
    $conn = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE)
          or die("Sorry , could not connect ot the database!");

    //issue query instructions
    $bookingInfoQuery =
      "SELECT b.*, c.firstName, c.lastName, c.contactNumber, c.email FROM booking b, clients c 
        WHERE b.clientID=c.clientID and bookingID=$bookingID"; 
    
    $vehicleBookingQuery = 
      "SELECT vb.bookingID, v.* from vehicle v, vehiclebooking vb
        where v.registrationNumber = vb.registrationNumber and vb.bookingID=$bookingID";

    $driverQuery =
      "SELECT b.bookingID, d.* from driver d, booking b
        where d.driverID=b.driverID and b.bookingID=$bookingID";

    $bookingInfoResult = mysqli_query($conn, $bookingInfoQuery) or die("Error on query!");
    $vehicleBookingResult = mysqli_query($conn, $vehicleBookingQuery) or die("Error on query!");
    $driverInfoResult = mysqli_query($conn, $driverQuery) or die("Error on query!");

    $result['bookingInfoResult'] = $bookingInfoResult;
    $result['vehicleBookingResult'] = $vehicleBookingResult;
    $result['driverInfoResult'] = $driverInfoResult;

    //disconnect 
    mysqli_close($conn);
    return $result;
  }

  if( isset($_REQUEST['submit']) ) {
    $conn = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE)
          or die("Sorry , could not connect ot the database!");
    
    // changing booking status to 'Awaiting Client Confirmation'
    $updateBookingQuery = 
      "UPDATE booking b
        SET b.status = 3
        WHERE b.bookingID=".$_REQUEST['id']
      ;

    $updateBookingResult = mysqli_query($conn, $updateBookingQuery) or die("Error on query!");
    mysqli_close($conn);

    $redirectURL = './index.php'. $_REQUEST['bookingID'];
    header("Location: $redirectURL");
  }
  
  $resultSet = getBookingDetails($_REQUEST["id"]);

  // get associated information about the vehicles reserved for the booking
  $vehicleBooking = mysqli_fetch_assoc( $resultSet['vehicleBookingResult'] );

  // get associated information about the booking and client
  $bookingInfo = mysqli_fetch_assoc( $resultSet['bookingInfoResult'] );
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

  </style>
</head>

<body class="antialiased bg-gray-200">
  <!-- Top Navbar -->
  <?php
    require_once("../../component_partials/topbar.nav.php");
  ?>

  <!-- Page Content-->
  <div class="mt-16 mx-auto w-full lg:w-4/5">

    <!-- Booking Status Visualizer -->
    <div class="pb-1 px-32 pt-2 w-full flex items-center justify-between
          content-evenly bg-white border border-indigo-100 shadow-lg">
      <?php
        function buildDiv($isActive, $subscript, $text) {
          $activeDiv = 
          '
            <div class="border-indigo-400 border-b-4 pb-4 pl-2">
              <p class="text-sm text-indigo-500">
                '. $subscript .'
              </p>
              <p class="text-lg font-medium">
                '. $text .'
              </p>
            </div>
           ';
          $defaultDiv =
          '
          <div>
            <p class="text-sm text-gray-400">
            '. $subscript .'
            </p>
            <p class="text-lg ">
              '. $text .'
            </p>
          </div>
          ';

          return ($isActive ? $activeDiv : $defaultDiv);
        } 

        $isVehicleAssigned = mysqli_num_rows( $resultSet['vehicleBookingResult'] ) > 0;
        $isDriverAssigned = mysqli_num_rows( $resultSet['driverInfoResult'] ) > 0;
        $isSentForClientConfirmation = $bookingInfo["status"]>=3;
        $isFinalized = $bookingInfo["status"]>=4;
        if(mysqli_num_rows( $resultSet['bookingInfoResult'] ) > 0) {

        }
         
        echo buildDiv($isVehicleAssigned, 'Step One', 'Assign Vehicle');
        echo buildDiv($isDriverAssigned, 'Step Two', 'Assign Driver');
        echo buildDiv($isSentForClientConfirmation, 'Step Three', 'Client Confirmation');
        echo buildDiv($isFinalized, 'Step Four', 'Finalize Booking');

      ?>
    </div>
    
    <!-- hidden submit to client div  -->
    <div class="mb-8 px-6 pt-0 w-full flex items-center justify-between
            bg-gray-100 border border-indigo-100 shadow-sm">
            
    <?php
      if($isVehicleAssigned && $isDriverAssigned && !$isSentForClientConfirmation) {
        echo '
        <div>
          <p class="text-xl font-semibold">
            
          </p>
        </div>   
        <div class="my-4">
          <a href="./admin.booking.overview.php?submit&id='. $_REQUEST['id'].'" id="submit" name="submit" type="submit" 
            class="flex bg-indigo-400 hover:bg-indigo-700 text-white font-bold py-3 px-10 rounded">
              Send For Client Confirmation
          </a>
        </div>
        ';
      }
    ?>
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
            <p class="text-base font-semibold text-gray-700">'. $bookingInfo["firstName"] . ' ' . $bookingInfo["lastName"] .'</p>
          </div>
          <div class="flex justify-between items-center border-b border-indigo-200 my-4 pb-2">
            <p class="text-base text-gray-500">Pick-up Town</p>
            <p class="text-base font-semibold text-gray-700">'. $bookingInfo["initialCollectionPoint"] .'</p>
          </div>
          <div class="flex justify-between items-center border-b border-indigo-200 my-4 pb-2">
            <p class="text-base text-gray-500">Number of passengers</p>
            <p class="text-base font-semibold text-gray-700">'. $bookingInfo["numberOfPassengers"] .'</p>
          </div>
          <div class="flex justify-between items-center border-b border-indigo-200 my-4 pb-2">
            <p class="text-base text-gray-500">E-mail</p>
            <p class="text-base font-semibold text-gray-700">'. $bookingInfo["email"] .'</p>
          </div>
          <div class="flex justify-between items-center border-b border-indigo-200 my-4 pb-2">
            <p class="text-base text-gray-500">Contact Number</p>
            <p class="text-base font-semibold text-gray-700">'. $bookingInfo["contactNumber"] .'</p>
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
        <?php
          if(mysqli_num_rows( $resultSet['vehicleBookingResult'] ) > 0)
          {
            echo '
              <div class="flex justify-between items-center border-b border-indigo-200 mx-1 my-4 pb-2">
                <p class="text-base text-gray-500">Make</p>
                <p class="text-base font-semibold text-gray-700">'. $vehicleBooking["make"] .'</p>
              </div>
              <div class="flex justify-between items-center border-b border-indigo-200 mx-1 my-4 pb-2">
                <p class="text-base text-gray-500">Model</p>
                <p class="text-base font-semibold text-gray-700">'. $vehicleBooking["model"] .'</p>
              </div>
              <div class="flex justify-between items-center border-b border-indigo-200 mx-1 my-4 pb-2">
                <p class="text-base text-gray-500">Registration</p>
                <p class="text-base font-semibold text-gray-700">
                  <span class="text-sm font-normal text-indigo-700"> ('. $vehicleBooking["year"] .') </span>
                  '.$vehicleBooking["registrationNumber"].'
                </p>
              </div>
              
            ';
          } else {
            echo '
              <a href="../vehicle/vehicle.list.php?bookingID='. $_REQUEST["id"] .'" class="w-full mx-auto py-8 mb-6 flex justify-center border border-indigo-200 bg-gray-100 hover:bg-indigo-100 shadow">
                <span class="pb-6 flex items-center">
                  <svg class="w-8 h-8 mr-2 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                  <p class="text-xl font-bold text-gray-900">Assign Vehicle</p>
                </span>
              </a>
            ';
          }
        ?>
        
        
        <!-- Add Trailers Section -->
        <div class="w-full mx-auto py-8 my-6 flex justify-center border border-indigo-200 bg-gray-100 hover:bg-indigo-100 shadow">
          <a href="#">
            <span class="pb-6 flex items-center">
              <svg class="w-8 h-8 mr-2 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <p class="text-xl font-bold text-gray-900">Add Trailers</p>
            </span>
          </a>
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
        <?php
          // get associated information about the vehicles reserved for the booking
          $driverInfo = mysqli_fetch_assoc( $resultSet['driverInfoResult'] );

          if(mysqli_num_rows( $resultSet['driverInfoResult'] ) > 0)
          {
            echo '
              <div class="flex justify-between items-center border-b border-indigo-200 mx-1 my-4 pb-2">
                <p class="text-base text-gray-500">Fullname</p>
                <p class="text-base font-semibold text-gray-700">
                  '. $driverInfo["firstName"] .' '. $driverInfo["lastName"] .'
                  </p>
              </div>
              <div class="flex justify-between items-center border-b border-indigo-200 mx-1 my-4 pb-2">
                <p class="text-base text-gray-500">Contact Number</p>
                <p class="text-base font-semibold text-gray-700">
                  '. $driverInfo["contactNumber"] .'
                  </p>
              </div>
            ';
          } else {
            echo '
              <div class="w-full mx-auto py-8 flex justify-center border border-indigo-200 bg-gray-100 hover:bg-indigo-100 shadow">
                <a href="../driver/admin.driver.php?bookingID='. $_REQUEST["id"] .'">
                  <span class="pb-6 flex items-center">
                    <svg class="w-8 h-8 mr-2 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-xl font-bold text-gray-900">Assign Driver</p>
                  </span>
                </a>
              </div>
            ';
          }
        ?>

      </div>
    </div>
    

  </div>

</body>

</html>