
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
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

<body class="antialiased bg-gray-200">
  <!-- Top Navbar -->
  <header class="bg-white lg:py-0 py-2">
    <div class="w-full flex flex-wrap items-center md:w-3/4 px-6 md:px-0 md:mx-auto">
      <div class="flex-1 flex justify-between items-center">
        <a href="#">
          <svg class="w-20 h-20" viewBox="0 0 261 220" fill="none">
            <path
              d="M.634 176v-35.547h12.451c4.313 0 7.585.83 9.814 2.49 2.23 1.644 3.345 4.061 3.345 7.251 0 1.742-.447 3.28-1.343 4.615-.895 1.318-2.14 2.286-3.735 2.905 1.823.456 3.255 1.375 4.297 2.759 1.058 1.383 1.587 3.076 1.587 5.078 0 3.418-1.09 6.006-3.272 7.763-2.18 1.758-5.29 2.653-9.326 2.686H.634zm7.324-15.479v9.595h6.274c1.726 0 3.069-.407 4.029-1.22.976-.831 1.465-1.97 1.465-3.418 0-3.256-1.685-4.908-5.054-4.957H7.958zm0-5.175h5.42c3.695-.065 5.542-1.538 5.542-4.419 0-1.612-.472-2.767-1.416-3.467-.928-.716-2.4-1.074-4.419-1.074H7.958v8.96zM66.392 170.116h15.551V176H59.067v-35.547h7.325v29.663zM133.224 168.676h-12.842L117.94 176h-7.788l13.233-35.547h6.787L143.478 176h-7.789l-2.465-7.324zm-10.865-5.933h8.887l-4.468-13.305-4.419 13.305zM200.666 164.159c-.277 3.825-1.693 6.836-4.248 9.033-2.539 2.198-5.892 3.296-10.059 3.296-4.557 0-8.146-1.53-10.766-4.59-2.604-3.076-3.906-7.291-3.906-12.646v-2.173c0-3.418.602-6.429 1.806-9.033 1.205-2.604 2.922-4.598 5.152-5.982 2.246-1.399 4.85-2.099 7.812-2.099 4.102 0 7.406 1.098 9.912 3.296 2.507 2.197 3.955 5.281 4.346 9.253h-7.324c-.179-2.295-.822-3.955-1.929-4.981-1.091-1.041-2.759-1.562-5.005-1.562-2.441 0-4.272.879-5.493 2.636-1.205 1.742-1.823 4.452-1.856 8.13v2.686c0 3.841.578 6.649 1.734 8.423 1.172 1.774 3.011 2.661 5.517 2.661 2.263 0 3.947-.513 5.054-1.538 1.123-1.042 1.766-2.645 1.929-4.81h7.324zM243.108 161.742l-3.808 4.102V176h-7.324v-35.547h7.324v16.113l3.222-4.419 9.058-11.694h9.009l-12.622 15.796L260.955 176h-8.716l-9.131-14.258zM36.857 207.476V220h-7.324v-35.547H43.4c2.67 0 5.013.488 7.032 1.465 2.034.977 3.597 2.368 4.687 4.175 1.09 1.79 1.636 3.833 1.636 6.128 0 3.483-1.196 6.233-3.589 8.252-2.376 2.002-5.672 3.003-9.888 3.003h-6.42zm0-5.933H43.4c1.937 0 3.41-.456 4.42-1.367 1.025-.912 1.537-2.214 1.537-3.906 0-1.742-.512-3.15-1.538-4.224-1.025-1.074-2.441-1.628-4.248-1.66h-6.714v11.157zM109.695 204.595H95.633v9.521h16.504V220H88.309v-35.547h23.779v5.933H95.633v8.471h14.062v5.738zM163.002 212.676H150.16L147.719 220h-7.788l13.232-35.547h6.787L173.256 220h-7.788l-2.466-7.324zm-10.864-5.933h8.886l-4.467-13.305-4.419 13.305zM214.209 205.742l-3.809 4.102V220h-7.324v-35.547h7.324v16.113l3.223-4.419 9.058-11.694h9.008l-12.622 15.796L232.056 220h-8.716l-9.131-14.258zM129.5 0L172 67l45 68-76-58.5 10.5-27L41 135 129.5 0z"
              fill="#000" />
          </svg>
        </a>
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
			<div class="relative">
				  <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
						<svg class="h-6 w-6 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
						  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
						</svg>
				  </span>
				  <input type="text" id="searchBar" name="searchBar"
				  class="py-3 pl-10 w-full text-lg bg-white border border-grey-400 rounded-md text-gray-800 placeholder-gray-500  shadow"
				  placeholder="Search" />
				  <span id="searchBtn" class="absolute inset-y-0 right-0 pl-3 hidden items-center">
						<button class="bg-indigo-300 hover:bg-indigo-500 text-white font-bold py-2 px-6 mr-2 rounded">
						  Go
						</button>
				  </span>
			</div>
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
          <th class="w-1/6 px-4 py-2">Start Date</th>
          <th class="w-1/6 px-4 py-2">End Date</th>
          <th class="w-1/6 px-4 py-2">Number of passengers</th>
          <th class="w-1/6 px-4 py-2">Trailer?</th>
          <th class="w-1/6 px-4 py-2">Status Code</th>
          <th class="w-1/6 px-4 py-2">Options</th>
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
				echo " <td class=\"border px-4 py-4 bg-blue-200\"> " . $row["initialCollectionPoint"] . "</td>";
				echo " <td class=\"border px-4 py-4 bg-blue-200\"> " . $row["startDate"] . "</td>";
				echo " <td class=\"border px-4 py-4 bg-blue-200\"> " . $row["endDate"] . "</td>";
				echo " <td class=\"border px-4 py-4 bg-blue-200\"> " . $row["numberOfPassengers"] . "</td>";
				echo " <td class=\"border px-4 py-4 bg-blue-200\"> " . $row["trailer"] . "</td>";
				echo " <td class=\"border px-4 py-4 bg-blue-200\"> " . $row["statusID"] . "</td>";
				
				
				}
			else{
				echo " <td class=\"border px-4 py-4\"> " . $row["initialCollectionPoint"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["startDate"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["endDate"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["numberOfPassengers"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["trailer"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["statusID"] . "</td>";
			 }
			// echo "</tr>";
			echo " <td class=\"border py-2\">
            <span class=\"inline-flex\">
              <a href=\"../daytripdashboard/daytripdashboard.php?id= " . $row['bookingID'] . "\">
                <svg alt=\"Edit\" class=\"text-blue-300 hover:text-blue-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z\"/>
                </svg>
              </a>
             <a href=\"../booking/issueBooking.php?id= " . $row['bookingID'] . "\">
                <svg  class=\"fill-current text-green-400 hover:text-green-700 h-6 w-6 m-2\"  viewBox=\"0 0 512 512\" stroke=\"currentColor\">
                  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M506.955 1.314a9.999 9.999 0 00-10.045.078L313.656 109.756c-4.754 2.811-6.329 8.943-3.518 13.697 2.81 4.753 8.942 6.328 13.697 3.518l131.482-77.749-244.906 254.113-121.808-37.266 158.965-94c4.754-2.812 6.329-8.944 3.518-13.698-2.81-4.753-8.943-6.33-13.697-3.518L58.91 260.392a10 10 0 002.164 18.171l145.469 44.504L270.72 439.88c.067.121.136.223.207.314 1.071 1.786 2.676 3.245 4.678 4.087a9.99 9.99 0 0010.869-2.065l73.794-72.12 138.806 42.466A10 10 0 00512 403V10a10 10 0 00-5.045-8.686zM271.265 329.23a10.005 10.005 0 00-1.779 5.694v61.171l-43.823-79.765 193.921-201.21-148.319 214.11zm18.221 82.079v-62.867l48.99 14.988-48.99 47.879zM492 389.483l-196.499-60.116L492 45.704v343.779z\"/>
                  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M164.423 347.577c-3.906-3.905-10.236-3.905-14.143 0l-93.352 93.352c-3.905 3.905-3.905 10.237 0 14.143C58.882 457.024 61.441 458 64 458s5.118-.976 7.071-2.929l93.352-93.352c3.905-3.904 3.905-10.236 0-14.142zM40.071 471.928c-3.906-3.903-10.236-3.903-14.142.001l-23 23c-3.905 3.905-3.905 10.237 0 14.143C4.882 511.024 7.441 512 10 512s5.118-.977 7.071-2.929l23-23c3.905-3.905 3.905-10.237 0-14.143zM142.649 494.34a10.072 10.072 0 00-7.069-2.93c-2.641 0-5.21 1.07-7.07 2.93a10.058 10.058 0 00-2.93 7.07c0 2.63 1.069 5.21 2.93 7.07 1.86 1.86 4.44 2.93 7.07 2.93s5.21-1.07 7.069-2.93a10.077 10.077 0 002.931-7.07c0-2.64-1.07-5.21-2.931-7.07zM217.051 419.935c-3.903-3.905-10.233-3.905-14.142 0l-49.446 49.445c-3.905 3.905-3.905 10.237 0 14.142 1.953 1.953 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l49.446-49.445c3.905-3.905 3.905-10.237 0-14.142zM387.704 416.139c-3.906-3.904-10.236-3.904-14.142 0l-49.58 49.58c-3.905 3.905-3.905 10.237 0 14.143 1.953 1.952 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l49.58-49.58c3.905-3.905 3.905-10.237 0-14.143zM283.5 136.31c-1.86-1.86-4.44-2.93-7.07-2.93s-5.21 1.07-7.07 2.93a10.086 10.086 0 00-2.93 7.08c0 2.63 1.07 5.2 2.93 7.06 1.86 1.87 4.44 2.93 7.07 2.93s5.21-1.06 7.07-2.93a10.057 10.057 0 002.93-7.06c0-2.64-1.07-5.22-2.93-7.08z\"/>
                </svg>
              </a>
              <!-- Delete button -->
              <a href=\"../booking/deletebooking.php?id= " . $row['bookingID'] . "\" onClick =\" return confirm('Are you sure you want to delete this booking? ')\" >
                <svg class=\"text-red-300 hover:text-red-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z\"/>
                </svg>
              </a>
            </span>
          </td> ";
		   echo " </tr>";
			 $i = $i + 1;
		}
	
	
 	mysqli_close($conn);
	
	?>		
        
 
      </tbody>
    </table>
  </div>



</body>
  </html>