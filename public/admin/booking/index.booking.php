<!doctype html>
<html lang="en">

<?php
//import database credentials
require_once(dirname(__DIR__) . "../../common/utils.php");
require_once(dirname(__DIR__) . "../../auth/authorization.php");

$GLOBALS['active_nav_item'] = 'admin_dashboard';

function getBookings(){
  // issue query instructions
  $query = 
  "SELECT c.firstName, c.lastName, b.*, s.*
    from clients c, booking_status s, (select * from booking) b
    where b.clientID = c.clientID and s.statusID=b.statusID and b.statusID>=2
    limit 20;
  ";

  // connect to the database 
  $result = executeQuery($query);

  return $result;
}

?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../../css/tailwind.css" />
  <link rel="stylesheet" href="../../css/custom.css" />
  <title>Admin Dashboard</title>

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
  <?php
    require_once("../../component_partials/admin.topbar.nav.php");
  ?>

  <!-- Page Content-->
  <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full lg:w-4/5">
    <!-- Searchbar + Button -->
    <div class="flex justify-between w-full items-center mb-10"> 
      <?php
        require_once("../../component_partials/searchbar.php");
        echo searchbar('index.booking.php');
      ?>
      
      <!-- <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-10 rounded">
        Assign
      </button> -->
    </div>

    <!-- dynamic content -->
    <table class="table-fixed text-left w-full">
      <thead class="bg-gray-200">
        <tr>
          <th class="w-1/6 px-4 py-2">Name</th>
          <th class="w-1/6 px-4 py-2">Pick-up Address</th>
          <th class="w-1/6 px-4 py-2">Start Date</th>
          <th class="w-1/6 px-4 py-2">End Date</th>
          <th class="w-1/6 px-4 py-2">Status</th>
          <th class="w-1/12 px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <?php
          $result = getBookings();
          if($result==null || mysqli_num_rows($result)<1) 
          {
            echo 
            '<tr class="text-2xl text-gray-600 text-center">
            <td colspan="10">No Bookings</td>
            </tr>';
          }

          while ($result!=null && $row = mysqli_fetch_assoc($result)) {
            echo '
              <tr>
                <td class="border px-4 py-2">'. $row["firstName"] . " " . $row["lastName"] .'</td>
                <td class="border px-4 py-2">'. $row["initialCollectionPoint"] .'</td>
                <td class="border px-4 py-2">'. $row["startDate"] .'</td>
                <td class="border px-4 py-2">'. $row["endDate"] .'</td>
                <td class="border px-4 py-2">'. $row["short_description"] .'</td>
                <td class="border py-2">
                  <span class="inline-flex justify-evenly w-full">
                    <!-- Edit button -->
                    <a href="./booking.overview.php?id='. $row["bookingID"].'">
                      <span class="flex flex-col items-center justify-items-center">
                        <svg alt="Edit" class="text-blue-300 hover:text-blue-700 h-6 w-6 m-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <p class="font-thin text-sm -mt-1">Edit</p> 
                      </span> 
                    </a>
                    <!-- Delete button -->
                    <a href="#">
                      <span class="flex flex-col items-center justify-items-center">
                        <svg class="text-red-300 hover:text-red-700 h-6 w-6 m-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="font-thin text-sm -mt-1">Delete</p> 
                      </span> 
                    </a>
                  </span>
                </td>
              </tr>
            ';
          }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>