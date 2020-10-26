
<!doctype html>
<html lang="en">
<?php   
		if(isset($_COOKIE['message'])){
		
			echo $_COOKIE['message'];
			setcookie("message", "",time() + 3600, '/');
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
  <title>Client Dashboard</title>

  <style>
  /* Tooltip container */
.tooltipc {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltipc .tooltiptextc {
  visibility: hidden;
  width: 120px;
  background-color: #fff;
  color: #000;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
 
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltipc:hover .tooltiptextc {
  visibility: visible;

}.tooltipe {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltipe .tooltiptexte {
  visibility: hidden;
  width: 120px;
  background-color: #fff;
  color: #000;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
 
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltipe:hover .tooltiptexte {
  visibility: visible;


}.tooltipd {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltipd .tooltiptextd {
  visibility: hidden;
  width: 120px;
  background-color: #fff;
  color: #000;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
 
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltipd:hover .tooltiptextd {
  visibility: visible;
}

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
			<h1  class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 lg:py-6 lg:px-4 px-0  border-b-2 border-transparent md:hover:border-indigo-400   lg:border-gray-300">Client Dashboard	<h1>
       </div>

	    <div class="w-1/3">
        <div class="relative">
         
			
            <button class="bg-indigo-300 hover:bg-indigo-500 text-white font-bold py-2 px-6 mr-2 rounded">
			<?php
           echo " <a href=\"../booking/booking.php?id=" .  $_COOKIE['clientID'] . "\"> New Booking</a>";
			  ?>
            </button>
			
        </div>
       
      </div>
      
      
  
    </div>

    <!-- Content Table  echo "  -->
	
    <table class="table-auto text-left w-full">
      <thead class="bg-gray-200">
        <tr>
          <th class="w-1/6 px-4 py-2">initial Collection Point</th>
          <th class="w-1/12 px-4 py-2">Start Date</th>
          <th class="w-1/12 px-4 py-2">End Date</th>
          <th class="w-1/12 px-4 py-2">Number of passengers</th>
          <th class="w-1/12 px-4 py-2">Trailer</th>
          <th class="w-1/12 px-4 py-2">Status</th>
          <th class="w-1/12 px-4 py-2">Options</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <tr>
			<?php
	 require_once("../config/config.php");
	 
	$conn = mysqli_connect($servername, $username, $password, $database) or die("Could not connect to database!");
		$clientCookie = $_COOKIE['clientID'];
		
		$query = "SELECT * FROM booking WHERE clientID = " . $clientCookie;
		//$query = "SELECT * FROM booking ";
		$email = $_COOKIE["email"];
		$clientID = $_COOKIE["clientID"];

		$result = mysqli_query($conn, $query) or die("Could not execute query");
		$i = 0;

		while($row = $result->fetch_assoc()){
				 if($i % 2 != 0){
						echo " <td class=\"border px-4 py-4 bg-gray-300\"> " . $row["initialCollectionPoint"] . "</td>";
						echo " <td class=\"border px-4 py-4 bg-gray-300\"> " . $row["startDate"] . "</td>";
						echo " <td class=\"border px-4 py-4 bg-gray-300\"> " . $row["endDate"] . "</td>";
						echo " <td class=\"border px-4 py-4 bg-gray-300\"> " . $row["numberOfPassengers"] . "</td>";
						echo " <td class=\"border px-4 py-4 bg-gray-300\"> " . $row["trailer"] . "</td>";
						if($row["statusID"] == 1){
							echo " <td class=\"border px-4 py-4 bg-gray-300\">Booking Created</td>";
						}
						else if($row["statusID"] == 2){
				
							echo " <td class=\"border px-4 py-4 bg-gray-300\"> Pending...</td>";
						}else if($row["statusID"] == 3){
				
							echo " <td class=\"border px-4 py-4 bg-gray-300\"> Awaiting your confirmation</td>";
						}else if($row["statusID"] == 4){
				
							echo " <td class=\"border px-4 py-4 bg-gray-300\"> Finalized</td>";
						}else if($row["statusID"] == 5){
				
							echo " <td class=\"border px-4 py-4 bg-gray-300\"> Trip In Progress</td>";
						}else if($row["statusID"] == 6){
				
							echo " <td class=\"border px-4 py-4 bg-gray-300\"> Canceled</td>";
						}else if($row["statusID"] == 7){
				
							echo " <td class=\"border px-4 py-4 bg-gray-300\"> Issued</td>";
						}
				
				
				
				}
			else{
				echo " <td class=\"border px-4 py-4\"> " . $row["initialCollectionPoint"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["startDate"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["endDate"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["numberOfPassengers"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["trailer"] . "</td>";
					if($row["statusID"] == 1){
							echo " <td class=\"border px-4 py-4 \"> Booking Created</td>";
						}
						else if($row["statusID"] == 2){
				
							echo " <td class=\"border px-4 py-4\"> Pending</td>";
						}else if($row["statusID"] == 3){
				
							echo " <td class=\"border px-4 py-4\"> Awaiting Your confirmation</td>";
						}else if($row["statusID"] == 4){
				
							echo " <td class=\"border px-4 py-4\"> Finalized Booking</td>";
						}else if($row["statusID"] == 5){
				
							echo " <td class=\"border px-4 py-4\"> Trip In Progress</td>";
						}else if($row["statusID"] == 6){
				
							echo " <td class=\"border px-4 py-4 \"> Canceled </td>";
						}else if($row["statusID"] == 7){
				
							echo " <td class=\"border px-4 py-4 \"> Issued</td>";
						}
			 }
			// echo "</tr>";
			if( $row["statusID"] == 1 ){
						echo " <td class=\"border py-2\">
						<span class=\"inline-flex w-full justify-between px-3\">
						  <a class=\"tooltipe\"  href=\"../daytripdashboard/daytripdashboard.php?id=" . $row['bookingID'] . "&cp=" . $row["initialCollectionPoint"] . "&sd=" . $row["startDate"] .
						  "\">
							<svg alt=\"Edit\" class=\"text-blue-300 hover:text-blue-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
							  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 6v6m0 0v6m0-6h6m-6 0H6\" />
							  <p class=\"font-semibold text-xs text-center -mt-1\">Add</p> <span class=\"tooltiptexte\">Add day trips to this booking</span>
						   </svg>

						  </a>
						 <a class=\"tooltipc\" href=\"../booking/issueBooking.php?id=" . $row['bookingID'] . "\"  onClick =\" return confirm('Are you sure you want to Confirm this booking?')\">
							<svg  class=\"fill-current text-green-400 hover:text-green-700 Tooltip h-6 w-6 m-2\"  viewBox=\"0 0 512 512\" stroke=\"currentColor\">
							  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M506.955 1.314a9.999 9.999 0 00-10.045.078L313.656 109.756c-4.754 2.811-6.329 8.943-3.518 13.697 2.81 4.753 8.942 6.328 13.697 3.518l131.482-77.749-244.906 254.113-121.808-37.266 158.965-94c4.754-2.812 6.329-8.944 3.518-13.698-2.81-4.753-8.943-6.33-13.697-3.518L58.91 260.392a10 10 0 002.164 18.171l145.469 44.504L270.72 439.88c.067.121.136.223.207.314 1.071 1.786 2.676 3.245 4.678 4.087a9.99 9.99 0 0010.869-2.065l73.794-72.12 138.806 42.466A10 10 0 00512 403V10a10 10 0 00-5.045-8.686zM271.265 329.23a10.005 10.005 0 00-1.779 5.694v61.171l-43.823-79.765 193.921-201.21-148.319 214.11zm18.221 82.079v-62.867l48.99 14.988-48.99 47.879zM492 389.483l-196.499-60.116L492 45.704v343.779z\"/>
							  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M164.423 347.577c-3.906-3.905-10.236-3.905-14.143 0l-93.352 93.352c-3.905 3.905-3.905 10.237 0 14.143C58.882 457.024 61.441 458 64 458s5.118-.976 7.071-2.929l93.352-93.352c3.905-3.904 3.905-10.236 0-14.142zM40.071 471.928c-3.906-3.903-10.236-3.903-14.142.001l-23 23c-3.905 3.905-3.905 10.237 0 14.143C4.882 511.024 7.441 512 10 512s5.118-.977 7.071-2.929l23-23c3.905-3.905 3.905-10.237 0-14.143zM142.649 494.34a10.072 10.072 0 00-7.069-2.93c-2.641 0-5.21 1.07-7.07 2.93a10.058 10.058 0 00-2.93 7.07c0 2.63 1.069 5.21 2.93 7.07 1.86 1.86 4.44 2.93 7.07 2.93s5.21-1.07 7.069-2.93a10.077 10.077 0 002.931-7.07c0-2.64-1.07-5.21-2.931-7.07zM217.051 419.935c-3.903-3.905-10.233-3.905-14.142 0l-49.446 49.445c-3.905 3.905-3.905 10.237 0 14.142 1.953 1.953 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l49.446-49.445c3.905-3.905 3.905-10.237 0-14.142zM387.704 416.139c-3.906-3.904-10.236-3.904-14.142 0l-49.58 49.58c-3.905 3.905-3.905 10.237 0 14.143 1.953 1.952 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l49.58-49.58c3.905-3.905 3.905-10.237 0-14.143zM283.5 136.31c-1.86-1.86-4.44-2.93-7.07-2.93s-5.21 1.07-7.07 2.93a10.086 10.086 0 00-2.93 7.08c0 2.63 1.07 5.2 2.93 7.06 1.86 1.87 4.44 2.93 7.07 2.93s5.21-1.06 7.07-2.93a10.057 10.057 0 002.93-7.06c0-2.64-1.07-5.22-2.93-7.08z\"/>
							<p class=\"font-semibold text-xs text-center  -mt-1\">Confirm<div \">
						  <span class=\"tooltiptextc\">Send confirmation of booking</span>
						</div>
						</p> 
									   </svg>
						  </a>
						  <!-- Delete button -->
						  <a class=\"tooltipd\" href=\"../booking/deletebooking.php?id=" . $row['bookingID'] . "\" onClick =\" return confirm('Are you sure you want to delete this booking?')\" >
							<svg class=\"text-red-300 hover:text-red-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
							  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z\"/>
							<p class=\"font-semibold text-xs text-center -mt-1\">Delete</p> <span class=\"tooltiptextd\">Delete this booing</span>
						   </svg>
						  </a>
						</span>
					  </td> ";
					   echo " </tr>";
						 $i = $i + 1;

			 }
			 elseif( $row["statusID"] == 3 ){
						echo " <td class=\"border py-2\">
						<span class=\"inline-flex w-full justify-between px-3\">
						 		  <a class=\"tooltipe\"  href=\"../daytripdashboard/daytripdashboard.php?id=" . $row['bookingID'] . "&cp=" . $row["initialCollectionPoint"] . "&sd=" . $row["startDate"] .
						  "\">
							<svg alt=\"Edit\" class=\"text-blue-300 hover:text-blue-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
							  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 12a3 3 0 11-6 0 3 3 0 016 0z\" />
  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\" />
							  <p class=\"font-semibold text-xs text-center -mt-1\">View</p> <span class=\"tooltiptexte\">View Booking details</span>
						   </svg>

						  </a>   
						
						</span>
					  </td> ";
					   echo " </tr>";
						 $i = $i + 1;

			 }
			 elseif( $row["statusID"] == 4 ){
						echo " <td class=\"border py-2\">
						<span class=\"inline-flex w-full justify-between px-3\">
						  <a class=\"tooltipe\"  href=\"../daytripdashboard/daytripdashboard.php?id=" . $row['bookingID'] . "&cp=" . $row["initialCollectionPoint"] . "&sd=" . $row["startDate"] .
						  "\">
							<svg alt=\"Edit\" class=\"text-blue-300 hover:text-blue-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
							  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 12a3 3 0 11-6 0 3 3 0 016 0z\" />
  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\" />
							  <p class=\"font-semibold text-xs text-center -mt-1\">View</p> <span class=\"tooltiptexte\">View Booking details</span>
						   </svg>

						  </a>
						 <a class=\"tooltipc\" href=\"../booking/finalBooking.php?id=" . $row['bookingID'] . "\"  onClick =\" return confirm('Are you sure you want to Confirm this final booking? You will be charged once confirmed')\">
							<svg  class=\"fill-current text-green-400 hover:text-green-700 Tooltip h-6 w-6 m-2\"  viewBox=\"0 0 512 512\" stroke=\"currentColor\">
							  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M506.955 1.314a9.999 9.999 0 00-10.045.078L313.656 109.756c-4.754 2.811-6.329 8.943-3.518 13.697 2.81 4.753 8.942 6.328 13.697 3.518l131.482-77.749-244.906 254.113-121.808-37.266 158.965-94c4.754-2.812 6.329-8.944 3.518-13.698-2.81-4.753-8.943-6.33-13.697-3.518L58.91 260.392a10 10 0 002.164 18.171l145.469 44.504L270.72 439.88c.067.121.136.223.207.314 1.071 1.786 2.676 3.245 4.678 4.087a9.99 9.99 0 0010.869-2.065l73.794-72.12 138.806 42.466A10 10 0 00512 403V10a10 10 0 00-5.045-8.686zM271.265 329.23a10.005 10.005 0 00-1.779 5.694v61.171l-43.823-79.765 193.921-201.21-148.319 214.11zm18.221 82.079v-62.867l48.99 14.988-48.99 47.879zM492 389.483l-196.499-60.116L492 45.704v343.779z\"/>
							  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M164.423 347.577c-3.906-3.905-10.236-3.905-14.143 0l-93.352 93.352c-3.905 3.905-3.905 10.237 0 14.143C58.882 457.024 61.441 458 64 458s5.118-.976 7.071-2.929l93.352-93.352c3.905-3.904 3.905-10.236 0-14.142zM40.071 471.928c-3.906-3.903-10.236-3.903-14.142.001l-23 23c-3.905 3.905-3.905 10.237 0 14.143C4.882 511.024 7.441 512 10 512s5.118-.977 7.071-2.929l23-23c3.905-3.905 3.905-10.237 0-14.143zM142.649 494.34a10.072 10.072 0 00-7.069-2.93c-2.641 0-5.21 1.07-7.07 2.93a10.058 10.058 0 00-2.93 7.07c0 2.63 1.069 5.21 2.93 7.07 1.86 1.86 4.44 2.93 7.07 2.93s5.21-1.07 7.069-2.93a10.077 10.077 0 002.931-7.07c0-2.64-1.07-5.21-2.931-7.07zM217.051 419.935c-3.903-3.905-10.233-3.905-14.142 0l-49.446 49.445c-3.905 3.905-3.905 10.237 0 14.142 1.953 1.953 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l49.446-49.445c3.905-3.905 3.905-10.237 0-14.142zM387.704 416.139c-3.906-3.904-10.236-3.904-14.142 0l-49.58 49.58c-3.905 3.905-3.905 10.237 0 14.143 1.953 1.952 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l49.58-49.58c3.905-3.905 3.905-10.237 0-14.143zM283.5 136.31c-1.86-1.86-4.44-2.93-7.07-2.93s-5.21 1.07-7.07 2.93a10.086 10.086 0 00-2.93 7.08c0 2.63 1.07 5.2 2.93 7.06 1.86 1.87 4.44 2.93 7.07 2.93s5.21-1.06 7.07-2.93a10.057 10.057 0 002.93-7.06c0-2.64-1.07-5.22-2.93-7.08z\"/>
							<p class=\"font-semibold text-xs text-center  -mt-1\">Confirm<div \">
						  <span class=\"tooltiptextc\">Send final booking confirmation</span>
						</div>
						</p> 
									   </svg>
						  </a>
						  <!-- Delete button -->
						  <a class=\"tooltipd\" href=\"../booking/deletebooking.php?id=" . $row['bookingID'] . "\" onClick =\" return confirm('Are you sure you want to cancel this booking? You will be charged R300 to cancel a ready made booking')\" >
							<svg class=\"text-red-300 hover:text-red-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
							  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z\"/>
							<p class=\"font-semibold text-xs text-center -mt-1\">Cancel</p> <span class=\"tooltiptextd\">Cancel this booking</span>
						   </svg>
						  </a>
						</span>
					  </td> ";
					   echo " </tr>";
						 $i = $i + 1;

			 }
			 elseif( $row["statusID"] == 5 ){
						echo " <td class=\"border flex justify-between py-2\">
						<span class=\"inline-flex w-full justify-center px-3\">
						  <a class=\"tooltipe\"  href=\"../daytripdashboard/daytripdashboard.php?id=" . $row['bookingID'] . "&cp=" . $row["initialCollectionPoint"] . "&sd=" . $row["startDate"] .
						  "\">
							<svg alt=\"Edit\" class=\"text-blue-300 hover:text-blue-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
							  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 12a3 3 0 11-6 0 3 3 0 016 0z\" />
  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\" />
							  <p class=\"font-semibold text-xs text-center -mt-1\">View</p> <span class=\"tooltiptexte\">View Booking details</span>
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
            <span class="font-semibold">Log in</span>
            <span class="block text-gray-500">Succesfully Logged in!</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
	
    
    function showNotification() {
	 var notification = document.getElementById("savedNotification");
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



</body>
  </html>