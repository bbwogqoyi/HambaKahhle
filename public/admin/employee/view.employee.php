<!DOCTYPE html>
<html lang="en">

<?php
$GLOBALS['active_nav_item'] = 'assets_dashboard';


//import database utils
require_once(dirname(__DIR__) . "../../auth/authorization.php");
authorize('employeeID', '../index.php');
require_once(dirname(__DIR__) . "../../common/utils.php");

$employeeID = $firstName = $lastName = $email = $password = $roleCd = $pImg = null;
$dbMutationStatus=null;

if( isset($_POST['addNewEmployee']) || isset($_POST['updateEmployee']) ) {
  $firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
  $lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  $roleCd = filter_var($_POST['employeeTypeID'], FILTER_SANITIZE_STRING);
  //$pImg = filter_var($_POST['profileImage'], FILTER_SANITIZE_STRING);
}

function retrieveExistingEmployee($employeeID) {
  $query = "SELECT * from employee e where e.employeeID='$employeeID'";
  return executeQuery($query);
}

function deleteExistingEmployee($employeeID) {
  $query = "DELETE FROM employee e WHERE e.employeeID='$employeeID'";
  return executeQuery($query);
}

if( isset($_POST['deleteEmployee']) ) {
  deleteExistingEmployee($_REQUEST['employeeID']);
  header("Location: ../assets/employees.php");
}
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/tailwind.css" />
  <link rel="stylesheet" href="../../css/custom.css" />
  <script type="text/javascript" src="../../js/pristine.min.js"></script>
  <title>View Employee</title>
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
          onClick="deleteDepotRecord();"
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

      function deleteDepotRecord() {
        document.getElementById("updateEmployeeForm").submit();
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
        Employee
      </p>
      <a 
        href="../assets/employees.php" 
        class="bg-red-400 hover:bg-red-700 text-white font-bold text-center text-lg py-4 px-auto w-56 rounded">
        Cancel
      </a>
    </div>

    <!-- Employee Form -->
    <form 
      id="updateEmployeeForm" class="w-full mx-auto"  method="POST" 
      <?php 

        $queryParam = ( isset($_REQUEST['employeeID']) ? '?employeeID='.$_REQUEST['employeeID'] : '');

        echo 'action="./view.employee.php'. $queryParam .'"';
      ?>
    >
      
      <div class="w-full flex flex-row justify-between items-center">
        <!-- Retrieve data about the selected depot -->
        <?php
          $result = retrieveExistingEmployee($_REQUEST['employeeID']);
          $employee = mysqli_fetch_assoc($result);
        ?>
        <div class="w-2/3 flex flex-col">
          <!-- Names -->
          <div class="flex w-full mb-8">
            <div class="form-group w-full md:w-1/2 px-3 mb-6 ">
              <label 
                for="firstName"
                class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
                  First Name
              </label>
              <input
                <?php echo ( 'disabled value="'. $employee['firstName'] .'"'  ); ?> 
                name="firstName" id="firstName" type="text" placeholder="" required
                data-pristine-pattern="/^[a-zA-Z\s]*$/"
                class="form-control appearance-none block w-full border bg-white text-gray-700 border-gray-200 
                rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white
                ">
            </div>
            <div class="form-group w-full md:w-1/2 px-3 mb-6 ">
              <label 
                for="lastName"
                class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
                  Last Name
              </label>
              <input
                <?php echo ( 'disabled value="'. $employee['lastName'] .'"'  ); ?> 
                name="lastName" id="lastName" type="text" placeholder="" required 
                class="form-control appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded
                py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                ">
            </div>
            
          </div>

          <!-- Identifying Info -->
          <div class="flex w-full mb-8">
            <div class="form-group w-full md:w-1/2 px-3 mb-6 ">
              <label 
                for="email"
                class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
                  Email
              </label>
              <input 
                <?php echo ( 'disabled value="'. $employee['email'] .'"'  ); ?> 
                name="email" id="email" type="email" placeholder="" required
                class="form-control appearance-none block w-full bg-white text-gray-700 border border-gray-200 
                rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                " >
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label 
                for="employeeTypeID"
                class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
                Employee Role
              </label>
              <div class="form-group relative">
                <select 
                  name="employeeTypeID" id="employeeTypeID"
                  class="form-control block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 
                    rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" disabled>
                  <option value=""></option>
                  <option <?php echo ( $employee['employeeTypeID'] == "1" ? "selected" : "" ); ?> value="1">Admin Staff</option>
                  <option <?php echo ( $employee['employeeTypeID'] == "2" ? "selected" : "" ); ?> value="2">HR Staff</option>
                  <option <?php echo ( $employee['employeeTypeID'] == "3" ? "selected" : "" ); ?> value="3">Managers</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
              </div>
            </div>
          </div>

          <!-- Security Info -->
          <div class="flex w-full mb-8">
            <div class="form-group w-full px-3 mb-6 ">
              <label 
                for="password"
                class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2 ">
                  Password
              </label>
              <input 
                <?php echo ( 'disabled value="'. $employee['password'] .'"'  ); ?> 
                name="password" id="password" type="password" placeholder="" required
                class="form-control appearance-none block w-full bg-white text-gray-700 border border-gray-200 
                rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                " >
            </div>
            <div class="form-group w-full px-3 mb-6 ">
              <label
                for="password2"
                class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
                  Confirm Password
              </label>
              <input 
                <?php echo ( 'disabled value="'. $employee['password'] .'"'  ); ?> 
                name="password2" id="password2" type="password" placeholder="" required
                class="form-control appearance-none block w-full bg-white text-gray-700 border border-gray-200 
                rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                " >
            </div>
          </div>
        </div>

        <div class="w-1/3 flex flex-col items-center justify-center">
          <a href="#" class="w-3/4 flex pointer-cursor">
            <img class="w-full rounded-full border-2 border-transparent hover:border-indigo-400"
              src="https://images.unsplash.com/photo-1509305717900-84f40e786d82?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=144&h=144&q=80"
              alt="Nkosinathi Nkomo">
          </a>
        </div>
      </div>

      <!-- Button -->
      <div class="pr-4 mt-8 mb-4 w-full flex items-center justify-end">
        <a 
          <?php echo 'href="./update.employee.php?employeeID='.$_REQUEST['employeeID'].'"'; ?>
          class="bg-indigo-400 hover:bg-indigo-700 text-white font-bold text-center text-lg py-4 px-auto w-56 mr-2 rounded">
            Edit Employee
        </a>
        <input type="text" id="deleteEmployee" name="deleteEmployee" class="hidden" />
        <button 
          type="button"
          onClick="showModal();"
          class="bg-red-500 hover:bg-red-700 text-white font-bold text-center text-lg py-4 px-auto w-56 mr-2 rounded">
            Delete Employee
        </button> 
      </div>
    </form>
  </div>
  <script>
    window.onload = function () {
      var form = document.getElementById("updateEmployeeForm");

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