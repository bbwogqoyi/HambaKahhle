<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
    <title>Document</title>
    
</head>
<body class="antialiased bg-gray-200" >
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
  
<div class="mt-16 mb-16 py-8 px-6 mx-auto bg-white w-1/3 md:w-4/5 rounded">
 

   
 <div class="flex justify-center  py-6 px-6 text-2xl items-center bg-grey-300">
 <div class="w-2/3 lg:w-1/3">

 
 <form action="updateinfo.php" method ="POST" >
       
  
    

    <div name ="User_details" class="px-6 border-black" >

      <div name ="" class="text-3xl text-center border-b border-black">
         <h1>Account Information</h1>
      </div>
      <br>

        <div name ="">
            <label for="" class="block mb-2 text-sm font-bold text-gray-70">First Name:</label>
            <input type="text" name="firstname" id="fn" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" value="<?php echo $firstname;?>" required>
        </div>
 
         <br>
  
        <div name ="">
            <label for="" class="block mb-2 text-sm font-bold text-gray-70">Last Name:</label>
            <input type="text" name="lastname" id="ln" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" value="<?php echo $lastname;?>" required >
        </div>

       <br>
  
        <div name ="">
            <label for="" class="block mb-2 text-sm font-bold text-gray-70">email:</label>
            <input type="text" name="e_mail" id="em" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" value="<?php echo $email;?>" required >
         </div>
 
     
       <br>
  
      <div name ="">
            <label for="" class="block mb-2 text-sm font-bold text-gray-70 ">Contact Number:</label>
            <input type="text" name="contactnum" id="cn" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" value="<?php echo $contactnum;?>" required >
      </div>
        <br>
      

       <br><br>
      <div name ="" class="text-3xl border-b border-black text-center">
         <h1>Change Password <input type="checkbox" id="checkbox1" > </h1>
      </div>
      <div id="checkdiv" class="">
      <br>
        <div name ="password">
            <label for="" class="block mb-2 text-sm font-bold text-gray-70">Current Password:</label>
            <input type="password" id="PSW1" name="password" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
       </div>
       <br>
       <div name ="password">
            <label for="" class="block mb-2 text-sm font-bold text-gray-70">New Password:</label>
            <input type="password" id="PSW2"  class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
       </div>

       

       
       <br>
  
        <div name ="cpassword">
            <label for="" class="block mb-2 text-sm font-bold text-gray-70">Confirm Password:</label>
            <input type="password" id="PSW3"  class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
       </div>

       <br>

       <input type="checkbox"  onclick="myFunction()"> <label for="" class="text-xl" > Show Password</label> 

       <br>
       </div>
       <div class="flex items-center justify-between px-2 py-2">
            <div class="inline-flex">
              <input type="submit" value ="update" class="text-black bg-white-600 hover:text-white hover:bg-black py-2 px-4 rounded">
              <button class="text-black bg-white-600 hover:text-white hover:bg-black py-2 px-4 rounded">
                Cancel
              </button>
            </div>
          </div>
    </form>
 
          </div> 
     </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>


function myFunction() {
  var x = document.getElementById("PSW1");
  var y = document.getElementById("PSW2");
  var z = document.getElementById("PSW3");

  if (x.type === "password") 
  {
    x.type = "text";
  } else 
  {
    x.type = "password";
  }

  else if(y.type === "password"))
  {
    y.type = "text";
  } else 
  {
    y.type = "password";
  }
  else if (x.type === "password")
  {
    z.type = "text";

  }
  else 
  {
    z.type == "password";
  }

}


 
</script>

    
</body>
</html>