<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../../css/tailwind.css" />
  <link rel="stylesheet" href="../../css/custom.css" />
  <title>Assign vehicle</title>
</head>

<body class="antialiased bg-gray-200">
  <!-- Top Navbar -->
  <?php
    require_once("../../component_partials/topbar.nav.php");
  ?>

  <!-- Page Content-->
  <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full md:w-4/5 rounded">
    <!-- Searchbar + Button -->
    <div class="flex justify-between w-full items-center mb-10"> 
      <div class="w-1/3">
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
            <svg class="h-6 w-6 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </span>
          <input type="text" id="searchBar" name="searchBar"
          class="py-3 pl-10 w-full text-lg bg-white border border-grey-400 rounded-md text-gray-800 placeholder-gray-500 shadow"
          placeholder="Search" />
        </div>
      </div>
      <a href="add_vehicle.php" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-10 rounded">
        Add Car
      </a>
    </div>

    <table class="table-fixed w-full">
      <thead>
        <br><br>
        <tr class="bg-gray-100">
          <th class="w-1/6 px-4 py-2">Registration Number</th>
          <th class="w-1/6 px-4 py-2">Purchase date</th>
          <th class="w-1/6 px-4 py-2d">Number of Seats</th>
          <th class="w-1/6 px-4 py-2">Make</th>
          <th class="w-1/6 px-4 py-2">Model</th>
          <th class="w-1/6 px-4 py-2">Year</th>
          <th class="w-1/6 px-4 py-2">License Code</th>
          <th class="w-1/6 px-4 py-2"></th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
      <tr>
			<?php
	 require_once("../../config/config.php");
	$conn = mysqli_connect($servername, $username, $password, $database) or die("Could not connect to database!");
		// $clientCookie = $_COOKIE['clientID'];
		$query = "SELECT * FROM vehicle  ";

		$result = mysqli_query($conn, $query) or die("Could not execute query");
		$i = 0;

    while($row = $result->fetch_assoc())
    {
			// 	 if($i % 2 != 0){
			// 	echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["registrationNumber"] . "</td>";
			// 	echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["dateOfPurchase"] . "</td>";
			// 	echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["numberOfSeats"] . "</td>";
			// 	echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["make"] . "</td>";
			// 	echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["model"] . "</td>";
      //   echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["year"] . "</td>";
      //   echo " <td class=\"border px-4 py-4 bg-blue-500\"> " . $row["licenseCode"] . "</td>";
				
			// 	}
			// else{
				echo " <td class=\"border px-4 py-4\"> " . $row["registrationNumber"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["dateOfPurchase"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["numberOfSeats"] . "</td>";
				echo " <td class=\"border px-4 py-4\"> " . $row["make"] . "</td>";
        echo " <td class=\"border px-4 py-4\"> " . $row["model"] . "</td>";
        echo " <td class=\"border px-4 py-4\"> " . $row["year"] . "</td>";
        echo " <td class=\"border px-4 py-4\"> " . $row["licenseCode"] . "</td>";
			//  }
      // echo "</tr>";
      echo " <td class=\"border py-2\">
            <span class=\"inline-flex\">
              <a href=\"#\">
                <svg alt=\"Edit\" class=\"text-blue-300 hover:text-blue-700 h-6 w-6 m-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z\"/>
                </svg>
              </a>
              <a href=\"#\">
                <svg  class=\"fill-current text-green-400 hover:text-green-700 h-6 w-6 m-2\"  viewBox=\"0 0 512 512\" stroke=\"currentColor\">
                  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M506.955 1.314a9.999 9.999 0 00-10.045.078L313.656 109.756c-4.754 2.811-6.329 8.943-3.518 13.697 2.81 4.753 8.942 6.328 13.697 3.518l131.482-77.749-244.906 254.113-121.808-37.266 158.965-94c4.754-2.812 6.329-8.944 3.518-13.698-2.81-4.753-8.943-6.33-13.697-3.518L58.91 260.392a10 10 0 002.164 18.171l145.469 44.504L270.72 439.88c.067.121.136.223.207.314 1.071 1.786 2.676 3.245 4.678 4.087a9.99 9.99 0 0010.869-2.065l73.794-72.12 138.806 42.466A10 10 0 00512 403V10a10 10 0 00-5.045-8.686zM271.265 329.23a10.005 10.005 0 00-1.779 5.694v61.171l-43.823-79.765 193.921-201.21-148.319 214.11zm18.221 82.079v-62.867l48.99 14.988-48.99 47.879zM492 389.483l-196.499-60.116L492 45.704v343.779z\"/>
                  <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M164.423 347.577c-3.906-3.905-10.236-3.905-14.143 0l-93.352 93.352c-3.905 3.905-3.905 10.237 0 14.143C58.882 457.024 61.441 458 64 458s5.118-.976 7.071-2.929l93.352-93.352c3.905-3.904 3.905-10.236 0-14.142zM40.071 471.928c-3.906-3.903-10.236-3.903-14.142.001l-23 23c-3.905 3.905-3.905 10.237 0 14.143C4.882 511.024 7.441 512 10 512s5.118-.977 7.071-2.929l23-23c3.905-3.905 3.905-10.237 0-14.143zM142.649 494.34a10.072 10.072 0 00-7.069-2.93c-2.641 0-5.21 1.07-7.07 2.93a10.058 10.058 0 00-2.93 7.07c0 2.63 1.069 5.21 2.93 7.07 1.86 1.86 4.44 2.93 7.07 2.93s5.21-1.07 7.069-2.93a10.077 10.077 0 002.931-7.07c0-2.64-1.07-5.21-2.931-7.07zM217.051 419.935c-3.903-3.905-10.233-3.905-14.142 0l-49.446 49.445c-3.905 3.905-3.905 10.237 0 14.142 1.953 1.953 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l49.446-49.445c3.905-3.905 3.905-10.237 0-14.142zM387.704 416.139c-3.906-3.904-10.236-3.904-14.142 0l-49.58 49.58c-3.905 3.905-3.905 10.237 0 14.143 1.953 1.952 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l49.58-49.58c3.905-3.905 3.905-10.237 0-14.143zM283.5 136.31c-1.86-1.86-4.44-2.93-7.07-2.93s-5.21 1.07-7.07 2.93a10.086 10.086 0 00-2.93 7.08c0 2.63 1.07 5.2 2.93 7.06 1.86 1.87 4.44 2.93 7.07 2.93s5.21-1.06 7.07-2.93a10.057 10.057 0 002.93-7.06c0-2.64-1.07-5.22-2.93-7.08z\"/>
                </svg>
              </a>
              <!-- Delete button -->
              <a href=\"#\">
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