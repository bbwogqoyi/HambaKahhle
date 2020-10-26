<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <link rel="stylesheet" href="../css/styling.css" />
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
        require_once("config.php");

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
<header class="bg-gray-600 lg:py-0 py-2">
    <div class="w-full flex flex-wrap items-center md:w-3/4 px-6 md:px-0 md:mx-auto">
      <div class="flex-1 flex justify-between items-center">
      <div class="brand">
          <a href="#hero"><h1 style="color: #ooo;"><span>h</span>amba <span>k</span>ahle</h1></a>
        </div>
      </div>
  
      <label for="menu-toggle" class="pointer-cursor lg:hidden block">
        <svg class="fill-current text-gray-900"
          xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
          <title>menu</title>
          <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
        </svg>
      </label>
      <input class="hidden" type="checkbox" id="menu-toggle" />
  
      <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
        <nav>
          <ul class="pt-4 lg:pt-0 lg:flex items-center justify-between text-base text-gray-700">
            <li><a
                class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent md:hover:border-indigo-400 font-semibold text-indigo-400 lg:border-indigo-400"
                href="#">Bookings</a></li>
            <li><a class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent md:hover:border-indigo-400"
                href="#">Home</a></li>
            <li><a
                class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent md:hover:border-indigo-400 lg:mb-0 mb-2"
                href="#">About</a></li>
          </ul>
        </nav>
        <?php
             $profpic = null;

                //add database credentials
              require_once("../config/config.php");

              //store the ID from the previous page
              if(isset($_COOKIE["clientID"]))
              {
                $id = ($_COOKIE["clientID"]);
              
                
                //connect to the database
                $connection = mysqli_connect($servername, $username, $password, $database) or die("Could not connect to database!");
                
                //issue the query instructions
                $query = "SELECT profileImage FROM clients WHERE clientID = $id";
                $result = mysqli_query($connection, $query) or die("Could not retrieve data!");

                //get original details from database
                while ($row = mysqli_fetch_array($result)) 
                {
                  
                    $profpic = $row['profileImage']; 
                } 

                if($profpic == null)
                {
                  $profpic = "Uploads/Default.jpg";

                }
                
                //end the connection to the database
                mysqli_close($connection); 

              }

         ?>
       <?php
      
      if(isset($_COOKIE["clientID"]))
      {
          $clientID = $_COOKIE["clientID"];
          echo '
          <div class="realtive">
            <button class="block h-10 w-10 rounded-full overflow-hidden border-1 border-gray 500 focus:outline-none focus:border-white lg:ml-4 flex items-center justify-start lg:mb-0 mb-4 pointer-cursor" onclick="myFunction()" >
              <img class="rounded-full w-10 h-10 border-2 border-transparent hover:border-indigo-400"
                src="'.$profpic.'"
                alt="Nkosinathi Nkomo">
            </button>
            <div hidden id="myDIV" class="absolute top-auto  mt-2 py-2 w-48 bg-gray-300 rounded-lg shadow-xl"> 
              <a href="#"class="block px-4 py-2 hover:bg-indigo-500 hover:text-white">Home</a>
              <a href="../profile_page/profile12.php?clientID='.$clientID.'" class="block px-4 py-2 hover:bg-indigo-500 hover:text-white">Profile</a>
              <a href="#"class="block px-4 py-2 hover:bg-indigo-500 hover:text-white">Help</a>
              <a href="#"class="block px-4 py-2 hover:bg-indigo-500 hover:text-white" onclick="logout()">LogOut</a>
            </div>
          </div> ';
      } 

      ?>
  
      </div>
    </div>


  </header>
  
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
      
    </div>

    <!-- Employee Form -->
    <form id="updateEmployeeForm" action="khumwp.php" class="w-full mx-auto"  method="POST">
      
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
      <div class="pr-4 mt-1 mb-4 w-full items-center justify-end">
        <button 
          
          class="bg-teal-500 hover:bg-teal-700 text-white font-bold text-center text-sm py-4 px-auto w-56  rounded" onclick="clickme2()">
            Edit Details
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
  location.href = "khumwp.php";
}


    function myFunction()
        {
            var x = document.getElementById("myDIV");
            
            if (x.style.display === "block" ) {
              x.style.display = "none";
              
            } else {
              x.style.display = "block";
            }
          }

        function logout()
        {
          var txt;
          if (confirm("Press a Ok to logOut!")) {
            txt = "You pressed OK!";
            location.replace("../logout/logout.php");

          } else {
            txt = "You pressed Cancel!";
          }
          document.getElementById("demo").innerHTML = txt;
        }  



  </script>
</body>
</html>