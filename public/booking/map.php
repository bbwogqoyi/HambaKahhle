<!doctype html>
<html lang="en">

<?php
	$lat = $_REQUEST['lat'];
	$lng = $_REQUEST['lng'];
	echo "
	<input style=\"opacity: 0;\" type=\"text\"  name=\"lat\" id=\"lat\" value=\"$lat\">
	            	   <input style=\"opacity: 0;\"  type=\"text\"  name=\"lng\" id=\"lng\" value=\"$lng\"> ";

  ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
    <link rel="stylesheet" href="../css/styling.css" />
  <title>Booking Overview</title>

  <style>
    #menu-toggle:checked+#menu {
      display: block;
    }

    #searchBar:focus + #searchBtn{
      display: flex;
    }

  </style>
</head>

<body onload="myMap" class="antialiased bg-gray-200">

 	   <div  style="padding-top: 0.75rem;padding-bottom: 0.75rem;right: 5px;padding-left: 0.75rem;height: 100%;width; 100%;position: absolute;top: 0%;left: 0%;" id="googleMap" ></div>
	   
    <script>


        function myMap() {
		  var x = document.getElementById("googleMap");
		
  
    
                if(navigator.geolocation){
                         var lng =Number(document.getElementById("lng").value);
		  var lat= Number(document.getElementById("lat").value);
	
            var mapProp= {
            center:new google.maps.LatLng(lat,lng),
            zoom:10,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                }
                else{
                    alert("Geolocation is not supported on this device");
                }

        }

    

		


    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIVgzlPlKXdhQkUuiP6mKS9P6kqbJDxHE&callback=myMap"></script>
</body>

</html>