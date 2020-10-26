<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <link rel="stylesheet" href="../css/styling.css" />
    <title>Document</title>
</head>
<body class="antialiased bg-gray-200" >
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
  $profpic = null;
  ?>
 <?php 
    
    //add database credentials
    require_once("config.php");

    if(isset($_COOKIE["clientID"]))
    {
      $id = ($_COOKIE["clientID"]);

      $connection = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database!");
      //store the ID from the previous page
           
      if($_SERVER['REQUEST_METHOD'] == "POST")
      { 
      
        
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
        {
          $filename = "Uploads/".$_FILES['file']['name'];
          move_uploaded_file($_FILES['file']['tmp_name'],$filename);
          if(file_exists($filename))
          {
            $query = "UPDATE clients SET profileImage = '$filename' where clientID = $id";
            $newResult = mysqli_query($connection, $query) or die("Could not retrieve data!");

          }

        }

        else{
          echo "please add a valid image";
        }


      }

      
      //connect to the database
      
      
      
      //issue the query instructions
            
      
      //end the connection to the database
      mysqli_close($connection);  
    }
    
    
?>
  
<div class="mt-16 mb-16 py-8 px-6 mx-auto bg-white w-1/3 md:w-4/5 rounded">
  <div name ="image_container" class="rounded-full text-center">
        
        
         
         <span>
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
              
              echo '<img id="profile-pic" class="h-56 w-56 rounded-lg" src="'.$profpic.'" alt="">'; 
          

         ?></span>
      
      <form  method = "post" enctype="multipart/form-data">
   <input type="file" name="file" ><br><br>
   <input id="post_button" class="bg-blue-700 py-2 px-24 rounded text-white" type="submit" value="Post">
   </form>
   

   

 
 
 
        
    </div>
</div>


<script>
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