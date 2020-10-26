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

 
 
</script>

    
</body>
</html>