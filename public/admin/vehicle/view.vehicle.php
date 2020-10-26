<!doctype html>
<html lang="en">
<?php
require_once(dirname(__DIR__) . "../../auth/authorization.php");
$GLOBALS['active_nav_item'] = 'assets_dashboard';

//import database credentials
require_once(dirname(__DIR__) . "../../common/utils.php");

$make = $model = $year = $numOfSeats = $licence = $registration = $purchaseDate = null;
$dbMutationStatus=null;

if( isset($_POST['addNewVehicle']) || isset($_POST['updateVehicle']) ) {
  $make = filter_var($_POST['make'], FILTER_SANITIZE_STRING);
  $model = filter_var($_POST['model'], FILTER_SANITIZE_STRING);
  $year = filter_var($_POST['year'], FILTER_SANITIZE_STRING);
  $numOfSeats = filter_var($_POST['numOfSeats'], FILTER_SANITIZE_STRING);
  $licence = filter_var($_POST['licence'], FILTER_SANITIZE_STRING);
  $purchaseDate = filter_var($_POST['purchaseDate'], FILTER_SANITIZE_STRING);
}

function retrieveVehicleInfo($registration) {
  $query = "SELECT * from vehicle v where v.registrationNumber='$registration'";
  return executeQuery($query);
}

function deleteExistingVehicle($registration) {
  $query = "DELETE FROM vehicle v WHERE v.registrationNumber='$registration'";
  return executeQueryAndRedirectOnSucess($query, "../assets/index.assets.php");
}

if( isset($_POST['deleteVehicle']) ) {
  deleteExistingVehicle($_REQUEST['registrationNumber']);
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../../css/tailwind.css" />
  <link rel="stylesheet" href="../../css/custom.css" />
  <script type="text/javascript" src="../../js/pristine.min.js"></script>
  <title>View Vehicle</title>

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
  <!-- Delete Confirmation Modal -->
  <div 
    id="deleteModal" 
    class="hidden absolute p-6 inset-x-0 mx-auto top-auto shadow-lg w-9/12 sm:w-1/2 md:w-1/3 lg:w-1/4 
      rounded-md border border-gray-200 bg-white ">
    <div class="w-12 h-12 mt-2 bg-red-200 flex flex-shrink-0 rounded-full items-center">
      <svg class="w-8 h-8 text-red-700 mx-auto py-auto block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
      </svg>
    </div>
    <div class="pl-8">
      <p class="text-2xl font-semibold text-gray-800">Delete record</p>
      <p class="text-gray-600 text-sm">Are you sure you want to delete this record? All of data will be permanantly removed from our servers forever.</p>
      <p class="text-gray-600 text-sm mb-4">This action cannot be undone.</p>

      <div class="flex">
        <button 
          type="button" 
          onClick="deleteRecord();"
          class="bg-red-500 hover:bg-red-700 text-gray-100 font-medium shadow-xs  border-red-600 border px-4 py-2 mr-3 rounded">
            Delete
        </button>
        <button
          type="button" 
          onClick="closeModal();"
          class="bg-gray-3
          00 font-medium text-gray-500 border-gray-600 hover:border-gray-800 hover:text-gray-800 border px-4 py-2 rounded" >
            Cancel
        </button>
      </div>
    </div>
    <script>
      function closeModal() {
        var modal = document.getElementById("deleteModal");
        modal.classList.remove("flex");
        modal.classList.add("hidden");
      }

      function showModal() {
        var modal = document.getElementById("deleteModal");
        modal.classList.remove("hidden");
        modal.classList.add("flex");
      }

      function deleteRecord() {
        document.getElementById("vehicleForm").submit();
      }
    </script>
  </div>
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
    <!-- Employee Title + Cancel button -->  
    <div class="mx-3 mb-4 w-full flex items-center justify-between">
      <p class="mb-8 text-4xl text-gray-700 font-semibold">
        Vehicles
      </p>
      <a 
        href="../assets/index.assets.php" 
        class="bg-red-400 hover:bg-red-700 text-white font-bold text-center text-lg py-4 px-auto w-56 rounded">
        Cancel
      </a>
    </div>
    <!-- Booking Overview -->
    <form 
      id="vehicleForm" class="w-full mx-auto"  method="POST" 
      <?php 
        $queryParam = ( isset($_REQUEST['registrationNumber']) ? '?registrationNumber='.$_REQUEST['registrationNumber'] : '');
        echo 'action="./view.vehicle.php'. $queryParam .'"';
      ?>
    >
      <!-- Retrieve data about the selected depot -->
      <?php
        $result = retrieveVehicleInfo($_REQUEST['registrationNumber']);
        $vehicle = mysqli_fetch_assoc($result);
      ?>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="form-group w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label 
            for="make"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
              Make
          </label>
          <input 
            <?php echo ( 'disabled value="'. $vehicle['make'] .'"'  ); ?> 
            name="make" id="make" type="text" placeholder="Toyota" required
            data-pristine-pattern="/^[a-zA-Z\s]*$/"
            class="form-control appearance-none block w-full bg-white text-gray-700 border border-gray-200 
            rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
             >
        </div>
        <div class="form-group w-full md:w-1/2 px-3">
          <label 
            for="model"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
              Model
          </label>
          <input 
            <?php echo ( 'disabled value="'. $vehicle['model'] .'"'  ); ?> 
            name="model"id="model" type="text" placeholder="Corolla" required
            data-pristine-pattern="/^[-0-9a-zA-Z\s]*$/" 
            class="form-control appearance-none block w-full bg-white text-gray-700 border border-gray-200 
            rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="form-group w-full md:w-1/2 px-3">
          <label 
            for="year"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
              Year
          </label>
          <input
            <?php echo ( 'disabled value="'. $vehicle['year'] .'"'  ); ?> 
            name="year" id="year" type="number" placeholder="2020" maxlength="4" required 
            class="form-control appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        </div>
        <div class="form-group w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label
            for="vehicle_purchase_date"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
            Date of Purchase
          </label>
          <input
          <?php echo ( 'disabled value="'. $vehicle['dateOfPurchase'] .'"'  ); ?> 
            name="vehicle_purchase_date" id="vehicle_purchase_date" type="date" placeholder="YYYY-MM-DD" required
            class="form-control appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 
            leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-8">
        <div class="form-group w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label
            for="numberOfSeats"
            class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
              Number of Seats
          </label>
          <input 
            <?php echo ( 'disabled value="'. $vehicle['numberOfSeats'] .'"'  ); ?> 
            name="numberOfSeats" id="numberOfSeats" type="number" placeholder="0" required
            class="form-control appearance-none block w-full bg-white text-gray-700 border border-gray-200 
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
              class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 
                rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" disabled >
              <option <?php echo ( $vehicle['licenseCode'] == "0" ? "selected" : "" ); ?> value="1">Trailer</option>
              <option <?php echo ( $vehicle['licenseCode'] == "1" ? "selected" : "" ); ?> value="1">Motorcycles</option>
              <option <?php echo ( $vehicle['licenseCode'] == "2" ? "selected" : "" ); ?> value="2">Light Motor Vehicles</option>
              <option <?php echo ( $vehicle['licenseCode'] == "3" ? "selected" : "" ); ?> value="3">Heavy Motor Vehicles</option>
              <option <?php echo ( $vehicle['licenseCode'] == "4" ? "selected" : "" ); ?> value="4">Combinations & Articulated Vehicles</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
          </div>
        </div>
      </div>
      

      <!-- Button -->
      <div class="mt-16 mb-4 flex justify-end w-full items-center">
        <a 
          <?php echo 'href="./update.vehicle.php?registrationNumber='.$_REQUEST['registrationNumber'].'"'; ?>
          class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold text-center text-lg py-4 px-auto w-56 mr-2 rounded">
            Edit Vehicle
        </a>
        <input type="text" id="deleteVehicle" name="deleteVehicle" class="hidden" />
        <button 
          type="button"
          onClick="showModal();"
          class="bg-red-500 hover:bg-red-700 text-white font-bold text-center text-lg py-4 px-auto w-56 mr-2 rounded">
            Delete Vehicle
        </button> 
        <!-- href="../assets/index.assets.php" -->
        
      </div>
    </form>

    </div>
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