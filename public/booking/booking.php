<!DOCTYPE html>
<html lang="en">
<?php

	if(isset($_REQUEST['submit'])){
		$initialCollectionPoint =  $_REQUEST['initialCollectionPoint'];
		//$destination =  $_REQUEST['destination'];
		$startDate =  $_REQUEST['startDate'];
		$endDate =  $_REQUEST['endDate'];
		//echo " <script type='text/javascript'>alert('Your Start date is after your end date!');</script>";
		
		
		if( strtotime($startDate) < strtotime($endDate) ) {
				
					
					$trailer =  $_REQUEST['trailer'];
					$numPassengers =  $_REQUEST['numPassengers'];
					$lat =  $_REQUEST['lat'];
					$lng =  $_REQUEST['lng'];
					$loc =  "yes";
					$clientID =  $_COOKIE['clientID'];
					$date1 = strtotime($startDate);
					$date2 = strtotime($endDate);

					if($date1 > $date2){
						echo " <script type='text/javascript'>alert('Your Start date is after your end date!');</script>";
							header("Location: booking.php");
					}
					else{
					// Date 2 is >
		
					$status = 1;
					require_once("../config/config.php");
					$conn = mysqli_connect($servername, $username, $password, $database) or die("Could not connect to database!");
		
						$query = "INSERT INTO booking (initialCollectionPoint, startDate, endDate, numberOfPassengers, clientID,trailer,statusID,hasLocation,latitude,longitude)
						VALUES ('$initialCollectionPoint', '$startDate','$endDate', '$numPassengers','$clientID','$trailer','$status','$loc','$lat','$lng')";


						$result = mysqli_query($conn, $query) or die("Could not execute") ;
		
						if($result === false) {

							echo "Could not execute query: " . $result . " quer: " . $query ;
												//header("Location: booking.php");

			
						}
						else{
							setcookie("message", "Successfully added booking",time() + 3600, '/');
							header("Location: ../clientdashboard/clientdashboard.php");
							}

							
						mysqli_close($conn);
						}

		}
		else{
			echo "Your start date is after your end date!";
		}
		}
		
	?>
	
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
    <link rel="stylesheet" href="../css/styling.css" />

  <title>Booking</title>

  <style>

    #menu-toggle:checked+#menu {
      display: block;
    }

    #searchBar:focus + #searchBtn{
      display: flex;
    }

  </style>
</head>

<body onload = "myMap()" class="antialiased bg-gray-200">
  <!-- Top Navbar -->
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
        <a href="#" class="lg:ml-4 flex items-center justify-start lg:mb-0 mb-4 pointer-cursor">
          <img class="rounded-full w-10 h-10 border-2 border-transparent hover:border-indigo-400"
            src="https://images.unsplash.com/photo-1509305717900-84f40e786d82?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=144&h=144&q=80"
            alt="Nkosinathi Nkomo">
        </a>
  
      </div>
    </div>


  </header>

  <!-- Page Content-->
  <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full lg:w-4/5">
    <!-- Searchbar + Button -->
    <div class="flex justify-between w-full items-center mx-4 mb-10"> 
      <div class="w-1/3">
    			<h1  class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 lg:py-6 lg:px-4 px-0  border-b-2 border-transparent md:hover:border-indigo-400
				lg:border-gray-300"><a href="../clientdashboard/clientdashboard.php">Client Dashboard</a> -> Add New booking<h1>

      </div> 
	  <div class="w-1/3">
        <div class="relative">
         
			
          
			
        </div>
       
      </div>
      
      
  
    </div>

    <!-- Content Table -->
              
			  <div class="w-full inline-flex w-full justify-between px-3" style="left: 50%;padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
			    

<form class="content-around w-full shadow-2xl items-center" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;" action="booking.php" method="POST">
                       
					   <div class="p-8 border-t-8 bg-white mb-6 rounded-lg shadow-lg" >

  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;" for="grid-first-name">
       Initial collection Date
      </label>
   
         <input type="date" id="startDate" name="startDate"
                               
                               min="2020-01-01" max="2021-12-31" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
       End Date
      </label>
                        <input type="date" id="endDate" name="endDate"
                              
                               min="2020-01-01" max="2021-12-31" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
	</div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
        Initial collection Point
      </label>
           <textarea style="border: 2px solid black;
  border-radius: 4px;padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;"  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name"  name="initialCollectionPoint" id="initialCollectionPoint" max=500></textarea>

    </div>
	  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
	   <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
        Get My Location
      </label>
	   <div  style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;height: 100%;" id="googleMap" ></div>
	            	   <input style="opacity: 0;" type="text"  name="lat" id="lat">
	            	   <input style="opacity: 0;"  type="text"  name="lng" id="lng">

  </div>
  </div>
 <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 " for="grid-first-name" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
      Number of passengers
      </label>
   
         	   <input style="border: 2px solid black;
  border-radius: 4px;padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;"  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name" type="number" value=0 name="numPassengers" id="numPassengers" max=500>

    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase  text-gray-700 text-xs font-bold mb-2" for="grid-last-name" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;">
       Would you like a trailer?
      </label>
	  <h3>Trailer</h3>
                       <select name="trailer" id="trailer" style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;" class="block w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>

                        </select>
	</div>
	
	 <div class="w-full content-around py-3" style="padding-top: 0.75rem;padding-bottom: 0.75rem;padding-left: 0.75rem;">
  <button class="content-around flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 justify-center rounded" type="submit" name="submit" id="submit">
      Book Now
    </button>
	</div>
	</form>
  </div>
  
 

  </div>
 

    <script>


        function myMap() {
		  var x = document.getElementById("googleMap");
  
    
                if(navigator.geolocation){
                        navigator.geolocation.getCurrentPosition(showPosition);
                }
                else{
                    alert("Geolocation is not supported on this device");
                }

        }

        function showPosition(position){
		
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
		document.getElementById("lat").value =lat ;
	
		 document.getElementById("lng").value =lng ;
		// document.getElementById("startDate").value = Date();

            var mapProp= {
            center:new google.maps.LatLng(lat,lng),
            zoom:10,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
            

        }

		


    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIVgzlPlKXdhQkUuiP6mKS9P6kqbJDxHE&callback=myMap"></script>

 <!-- <iframe id="map" src="map.html" title="location"></iframe>-->
</body>
  </html>