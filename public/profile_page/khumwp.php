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
  <?php
      require_once("../component_partials/topbar.nav.php");
    ?>
 
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





</script>
    
</body>

</html>