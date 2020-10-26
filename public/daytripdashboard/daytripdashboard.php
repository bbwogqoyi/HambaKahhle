
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
    <link rel="stylesheet" href="../css/styling.css" />

  <title>Day trips</title>

  <style>
    #menu-toggle:checked+#menu {
      display: block;
    }

    #searchBar:focus + #searchBtn{
      display: flex;
    }

  </style>
</head>

<body class="antialiased bg-gray-200">
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
    			<h1  class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 lg:py-6 lg:px-4 px-0  border-b-2 border-transparent md:hover:border-indigo-400   lg:border-gray-300"><a class="md:hover:border-indigo-400" href="../clientdashboard/clientdashboard.php">Client Dashboard</a> -> <a href="#">My day trips</a><h1>

      </div> 
	  <div class="w-1/3">
        <div class="relative">
         
			
            <button class="bg-indigo-300 hover:bg-indigo-500 text-white font-bold py-2 px-6 mr-2 rounded">
			<?php
            echo "<a href=\"../daytripbooking/addtrip.php?id=" . $_REQUEST["id"] . "\"> Add day trip</a>";
			  ?>
            </button>
			
        </div>
       
      </div>
      
      
  
    </div>

    <!-- Content Table -->
    <table class="table-auto text-left w-full">
      <thead class="bg-gray-200">
        <tr>
          <th class="w-1/6 px-4 py-2"> Date</th>
          <th class="w-1/6 px-4 py-2">Pick-up Time</th>
          <th class="w-1/6 px-4 py-2">Pick-up Location</th>
          <th class="w-1/6 px-4 py-2">Drop-off location</th>
          <th class="w-1/12 px-4 py-2">Options</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <tr>
			<?php
	 require_once("../config/config.php");
	$conn = mysqli_connect($servername, $username, $password, $database) or die("Could not connect to database!");
		$bookingID = $_REQUEST['id'];
		
		$query = "SELECT * FROM daytrip WHERE bookingID = " . $_REQUEST['id'] ;

		$result = mysqli_query($conn, $query) or die("Could not execute query");
		$i = 0;

		if(mysqli_num_rows($result)!=0){
		
		
				while($row = $result->fetch_assoc()){
						 if($i % 2 != 0){
						echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["tripDate"] . "</td>";
						echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["tripTime"] . "</td>";
						echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["collectionPoint"] . "</td>";
						echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["destinationPoint"] . "</td>";
				
				
						}
					else{
						echo " <td class=\"border px-4 py-4 \"> " . $row["tripDate"] . "</td>";
						echo " <td class=\"border px-4 py-4 \"> " . $row["tripTime"] . "</td>";
						echo " <td class=\"border px-4 py-4 \"> " . $row["collectionPoint"] . "</td>";
						echo " <td class=\"border px-4 py-4\"> " . $row["destinationPoint"] . "</td>";
					 }
					// echo "</tr>";
					echo " <td class=\"border flex justify-between py-2\">
					<span class=\"inline-flex w-full justify-between px-3\">
					  <a  href=\"../daytripbooking/edittrip.php?id=" . $row['tripNumber'] . "&bid=" . $bookingID . "\">
						<svg alt=\"Edit\" class=\"text-blue-300 hover:text-blue-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
						  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z\"/>
						  <p class=\"font-thin text-sm text-center -mt-1\">Edit</p> 

					  </svg>
					   <!-- Delete button -->
					  <a href=\"../daytripbooking/deletetrip.php?id=" . $row['tripNumber'] . "&bid=" . $bookingID . "\" onClick =\" return confirm('Are you sure you want to delete this trip?')\" >
						<svg class=\"text-red-300 hover:text-red-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
						  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z\"/>
						<p class=\"font-thin text-sm text-center -mt-1\">Delete</p> 
					   </svg>
					  </a>
					</span>
				  </td> ";
				   echo " </tr>";
					 $i = $i + 1;
				}
		}
		else{
		if(isset( $_REQUEST['sd'])){
			$startDate =  $_REQUEST['sd'];
				$initialCollectionPoint =  $_REQUEST['cp'];
		}
		
		$tripTime =  "06:44";
		
		$dropLocation = "Add a destination point to this single day trip";
			$query = "INSERT INTO daytrip (tripDate,tripTime, collectionPoint,destinationPoint, bookingID)
			VALUES ('$startDate','$tripTime','$initialCollectionPoint','$dropLocation', '$bookingID')";

			$result = mysqli_query($conn, $query) or die("Could not execute query");
			echo "ADD several day trips to your booking";
			$query = "SELECT * FROM daytrip WHERE bookingID = " . $_REQUEST['id'] ;

		$result = mysqli_query($conn, $query) or die("Could not execute query");
		$i = 0;

		
		
		
				while($row = $result->fetch_assoc()){
						 if($i % 2 != 0){
						echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["tripDate"] . "</td>";
						echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["tripTime"] . "</td>";
						echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["collectionPoint"] . "</td>";
						echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["destinationPoint"] . "</td>";
				
				
						}
					else{
						echo " <td class=\"border px-4 py-4 \"> " . $row["tripDate"] . "</td>";
						echo " <td class=\"border px-4 py-4 \"> " . $row["tripTime"] . "</td>";
						echo " <td class=\"border px-4 py-4 \"> " . $row["collectionPoint"] . "</td>";
						echo " <td class=\"border px-4 py-4\"> " . $row["destinationPoint"] . "</td>";
					 }
					// echo "</tr>";
					echo " <td class=\"border flex justify-between py-2\">
					<span class=\"inline-flex w-full justify-between px-3\">
					  <a  href=\"../daytripbooking/edittrip.php?id=" . $row['tripNumber'] . "&bid=" . $bookingID  . "&cp=" . $cp . "&sd=" . $sd . "\">
						<svg alt=\"Edit\" class=\"text-blue-300 hover:text-blue-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
						  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z\"/>
						  <p class=\"font-thin text-sm text-center -mt-1\">Edit</p> 

					  </svg>
					   <!-- Delete button -->
					  <a href=\"../daytripbooking/deletetrip.php?id=" . $row['tripNumber'] . "&bid=" . $bookingID   . "&cp=" . $cp . "&sd=" . $sd  . "\" onClick =\" return confirm('Are you sure you want to delete this trip?')\" >
						<svg class=\"text-red-300 hover:text-red-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
						  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z\"/>
						<p class=\"font-thin text-sm text-center -mt-1\">Delete</p> 
					   </svg>
					  </a>
					</span>
				  </td> ";
				   echo " </tr>";
					 $i = $i + 1;
				}
		}
		
	
	
 	mysqli_close($conn);
	
	?>		
        
 
      </tbody>
    </table>
  </div>



</body>
  </html>