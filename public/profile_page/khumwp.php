<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/tailwind.css" />
    <link rel="stylesheet" href="../css/custom.css" />
    <link rel="stylesheet" href="../css/styling.css" />
    <script tyepe= "text/javascript" src="../js/pristine.min.js"></script>
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

    <title>Document</title>
</head>
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
 
<?php 

     


    //add database credentials
    require_once("config.php");

    //store the ID from the previous page
    if(isset($_COOKIE["clientID"]))
    {

        $id = ($_COOKIE["clientID"]);
        
        
        //connect to the database
        $connection = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database!");
        
        //issue the query instructions
        $query = "SELECT lastName, firstName, contactNumber, clientID, email FROM clients WHERE clientID = $id";
        $result = mysqli_query($connection, $query) or die("Could not retrieve data!");
        
        //get original details from database
        while ($row = mysqli_fetch_array($result)) {
          $lastname = $row['lastName']; 
          $firstname = $row['firstName']; 
          $contactnum = $row['contactNumber'];
          $clientid = $row['clientID'];
          $email = $row['email'];
          
          
        }       
        
        //end the connection to the database
        mysqli_close($connection); 
    }  
    
?>

<body>

 <!-- Page Content-->
 <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full lg:w-4/5">
    <!-- Searchbar + Button -->
    <div class="flex justify-between w-full items-center mx-4 mb-10"> 
      <div class="w-1/3">
    			<h1  class=" block uppercase tracking-wide text-gray-700 text-2xl font-bold mb-2 lg:py-6 lg:px-4 px-0  border-b-2 border-transparent md:hover:border-indigo-400   lg:border-gray-300"> Account Information<h1>

      </div> 
	  <div class="w-1/3">
        <div class="relative">
        </div>
      </div>
    </div>

    <!-- Content Table -->
              
			  <div class="w-full inline-flex w-full justify-between px-3" style="left: 50%;padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
			    

<form id="updatedetails_form" class="content-around w-full shadow-2xl items-center" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;" action="updateinfo.php" method ="POST">
                       
					   <div class="p-8 border-t-8 bg-white mb-6 rounded-lg shadow-lg" >

  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;" for="grid-first-name">
       Fisrt Name
      </label>
   
         <input type="text" id="firstname" name="firstname" class="border rounded shadow appearance-none focus:outline-none focus:shadow-outline mb-6" value="<?php echo $firstname;?>" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
    </div><br>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
       Last Name
      </label>
       <input type="text" id="lastname" name="lastname" class="border rounded shadow appearance-none focus:outline-none focus:shadow-outline mb-6" value="<?php echo $lastname;?>" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
	</div><br>
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;" for="grid-first-name">
       Email
      </label>
   
         <input type="email" id="em" name="e_mail" class="border rounded shadow appearance-none focus:outline-none focus:shadow-outline" value="<?php echo $email;?>" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
    </div>
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;" for="grid-first-name">
       Contact Number
      </label>
   
         <input type="text" id="cn" name="contactnum" class="border rounded shadow appearance-none focus:outline-none focus:shadow-outline" value="<?php echo $contactnum;?>" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
    </div>
  </div>
  <br><br>

  <div class="flex flex-wrap -mx-1 mb-6">
    <div class="w-full ">
      <label class="block uppercase tracking-wide text-gray-700 text-2xl font-bold mb-2 border-b-2 border-transparent md:hover:border-indigo-400" for="grid-password" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
      change password
      </label>
       
  </div>

  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="form-group w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;" for="grid-first-name">
       New Password
      </label>
   
         <input type="password" id="NPW" name="PW1" class="form-control border rounded shadow appearance-none focus:outline-none focus:shadow-outline" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;" 
         data-pristine-pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.?[0-9]).{8,}$/"
                          data-pristine-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter adn one number" >
    </div>
    <div class="form-group w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
       Confirm Password
      </label>
                        <input type="password" id="CPW" name="PW2" class="form-control border rounded shadow appearance-none focus:outline-none focus:shadow-outline" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;" 
                        data-pristine-pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.?[0-9]).{8,}$/"
                          data-pristine-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" >
	 </div>
  </div>
	 <div class ="w-full content-around py-3" style="padding-top: 0.75rem;padding-bottom: 0.75rem;padding-left: 0.75rem;">
  <button class="content-around flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 justify-center rounded" type="submit" name="submit" id="submit">
      Update Details
    </button>
	</div>
</form>
  </div>
  
 

</div>
<script>

window.onload = function()
{
  var form = document.getElementById("updatedetails_form");

  var pristine = new Pristine(form);
  form.addEventListener('submit', function (e)
  {

    
    var valid = pristine.validate();
    console.log("Bryan why why why? "+valid);
    if(valid){
    return true;
    }

    else {
      e.preventDefault();
    }

  });

};


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