<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <script type="text/javascript" src="../js/pristine.min.js"></script>
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
  <?php
        
        

        //add database credentials
         require_once("../config/config.php");

        //store the ID from the previous page
        if(isset($_COOKIE["clientID"]))
        {
          $id = $_COOKIE["clientID"];
        
        
          //connect to the database
          $connection = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database!");
          
          //issue the query instructions
          $query = "SELECT lastName, firstName, contactNumber, clientID, email, profileImage FROM clients WHERE clientID = $id";
          
          $result = mysqli_query($connection, $query) or die("Could not retrieve data!");
          
          //get original details from database
          while ($row = mysqli_fetch_array($result)) {
              $lastname = $row['lastName']; 
              $firstname = $row['firstName']; 
              $contactnum = $row['contactNumber'];
              $clientid = $row['clientID'];
              $email = $row['email'];
              $profpic = $row['profileImage'];
              
              
              
          }       
          
          //end the connection to the database
          mysqli_close($connection); 

        }
      

  
  ?>
</head>
<body class="bg-gray-200 antialiased font-sans">
  <?php
      require_once("../component_partials/topbar.nav.php");
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
    <!-- Employee Title + Cancel button -->  
    <div class="mx-3 mb-4 w-full flex items-center justify-between">
      <p class="mb-8 text-4xl text-gray-700 font-semibold">
        Client Profile 
      </p>
      <a 
        href="../assets/employees.php" 
        class="bg-red-400 hover:bg-red-700 text-white font-bold text-center text-lg py-4 px-auto w-56 rounded">
        Cancel
      </a>
    </div>

    <!-- Employee Form -->
    <form id="updateEmployeeForm" action="workingprofile.php" class="w-full mx-auto"  method="POST">
      
      <div class="w-full flex flex-row justify-between items-center">
        
        <div class="w-2/3 flex flex-col">
          <!-- Names -->
          <div class="flex w-full mb-8">
            <div class="form-group w-full md:w-1/2 px-3 mb-6 ">
              <label 
                for="firstName"
                class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
                  First Name
              </label>
              <input name="firstName" id="firstName" type="firstName" value="<?php echo $firstname;?>"
              class="form-control bg-gray-300 appearance-none block w-full bg-white text-gray-700 border border-gray-200 
              rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
              " readonly>
            </div>
            <div class="form-group w-full md:w-1/2 px-3 mb-6 ">
              <label 
                for="lastName"
                class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
                  Last Name
              </label>
              <input name="lastName" id="lastName" type="lastName" value="<?php echo $lastname;?>"
              class="form-control bg-gray-300 appearance-none block w-full bg-white text-gray-700 border border-gray-200 
              rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
              " readonly >
              
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
                
                name="e_mail" id="e_mail" type="email" value="<?php echo $email;?>"
                class="form-control bg-gray-300 appearance-none block w-full bg-white text-gray-700 border border-gray-200 
                rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                " readonly >
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label 
                for="employeeTypeID"
                class="block uppercase tracking-wide text-gray-700 text-base font-bold mb-2" >
                Contact Number
              </label>
              <input 
                
                name="contactnum" id="contactnum" type="text" value="<?php echo $contactnum;?>"
                class="form-control bg-gray-300 appearance-none block w-full bg-white text-gray-700 border border-gray-200 
                rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                " readonly >
            </div>
          </div>
        </div>

        <div class="w-1/3 flex flex-col items-center justify-center">
          <a href="#" class="w-3/4 flex pointer-cursor">
            <img class="w-full rounded-full border-2 border-transparent hover:border-indigo-400"
              src="<?php echo $profpic ?>"
              alt="Nkosinathi Nkomo" onclick="clickme()">
          </a>
        </div>
      </div>

      <!-- Button -->
      <div class="pr-4 mt-1 mb-4 w-full flex items-center justify-end">
        <button 
          
          class="bg-indigo-400 hover:bg-indigo-700 text-white font-bold text-center text-lg py-4 px-auto w-56 mr-2 rounded" onclick="clickme2()">
            Edit Details
        </button>
        <button 
          type="submit" id="deleteEmployee" name="deleteEmployee"
          class="bg-red-400 hover:bg-red-700 text-white font-bold text-center text-lg py-4 px-auto w-56 mr-2 rounded">
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

   
function clickme(){
    location.href = "UpdateImage.php"; 
}

function clickme2()
{
  location.href = "workingprofile.php";
}

  </script>
</body>
</html>