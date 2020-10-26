<!doctype html>
<html lang="en">

<?php
//import database credentials
require_once(dirname(__DIR__) . "../../common/utils.php");
require_once(dirname(__DIR__) . "../../auth/authorization.php");

$GLOBALS['active_nav_item'] = 'admin_dashboard';

function getBookings() {
  if( isset($_REQUEST['searchText']) ) {
    $searchText = $_REQUEST['searchText'];

    $query = 
    "SELECT c.firstName, c.lastName, b.*, s.*
      from clients c, booking_status s, (select * from booking) b
      where b.clientID = c.clientID and s.statusID=b.statusID and b.statusID>=2
      having ( 
        CONCAT(c.firstName, ' ', c.lastName) LIKE '%$searchText%'
        or s.short_description LIKE '%$searchText%' 
      )
      limit 30";
  } else {
    // issue query instructions
    $query = 
    "SELECT c.firstName, c.lastName, b.*, s.*
      from clients c, booking_status s, (select * from booking) b
      where b.clientID = c.clientID and s.statusID=b.statusID and b.statusID>=2
      limit 30";
  }

  // connect to the database 
  $result = executeQuery($query);

  return $result;
}

if( isset($_POST['deleteModalBookingID']) ) {
  $bookingID = $_POST['deleteModalBookingID'];

  $query = 
    "DELETE from vehiclebooking vb
      where vb.bookingID = '$bookingID';
      
      delete from daytrip dt
      where dt.bookingID = '$bookingID';
      
      delete from daytripdepot dd
      where dd.tripNumber in (
        select _dt.tripNumber from daytrip _dt
        where _dt.bookingID = '$bookingID'
      );

      delete from booking b
      where b.bookingID= '$bookingID';";

  executeMultipleQueries($query);
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

  <!-- Delete Confirmation Modal + Form -->
  <form id="deleteBookingForm" class="hidden" action="./index.booking.php" method="POST">
    <input id="deleteModalBookingID" name="deleteModalBookingID" class="hidden" type="text" />
  </form>
  <div 
    id="deleteModal" 
    class="hidden absolute p-6 inset-x-0 mx-auto top-auto shadow-lg w-9/12 sm:w-1/2 md:w-1/3 lg:w-1/4 
      rounded-md border border-gray-200 bg-white ">
    <div class="w-12 h-12 mt-2 bg-red-200 flex flex-shrink-0 rounded-full items-center">
      <svg class="w-8 h-8 text-red-700 mx-auto py-auto block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
      </svg>
    </div>
    <div class="pl-8">
      <p class="text-2xl font-semibold text-gray-800">Delete record</p>
      <p class="text-gray-600 text-sm">Are you sure you want to delete this record? All of data will be permanantly removed from our servers forever.</p>
      <p class="text-gray-600 text-sm mb-4">This action cannot be undone.</p>

      <div class="flex">
        <button 
          type="button" 
          onClick="deleteBookingRecord();"
          class="bg-red-500 hover:bg-red-700 text-gray-100 font-medium shadow-xs  border-red-600 border px-4 py-2 mr-3 rounded">
            Delete
        </button>
        <button
          type="button" 
          onClick="closeModal();"
          class="bg-gray-3
          00 font-medium text-gray-500 border-gray-600 hover:border-gray-800 hover:text-gray-800 border px-4 py-2 rounded" >
            Cancel
        </button>
      </div>
    </div>
    <script>
      function closeModal() {
        var modal = document.getElementById("deleteModal");
        modal.classList.remove("flex");
        modal.classList.add("hidden");
      }

      function showModal(bookingID) {
        document.getElementById("deleteModalBookingID").value = parseInt(bookingID);
        var modal = document.getElementById("deleteModal");
        modal.classList.remove("hidden");
        modal.classList.add("flex");
      }

      function deleteBookingRecord() {
        document.getElementById("deleteBookingForm").submit();
      }
    </script>
  </div>

  <!-- Page Content-->
  <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full lg:w-4/5">
    <!-- Searchbar + Button -->
    <div class="flex justify-between w-full items-center mb-10"> 
      <div class="w-1/3">
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
            <svg class="h-6 w-6 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </span>
          <form id="searchForm" action='./index.booking.php' method="GET" >
            <input 
            <?php echo (isset($_REQUEST['searchText']) ? ( 'value="'.$_REQUEST['searchText'].'"') : "" );?>
            type="text" id="searchText" name="searchText" oninput="searchTextChange()"
            class="py-3 pl-10 w-full text-lg bg-white border border-grey-400 rounded-md text-gray-800 placeholder-gray-500  shadow"
            placeholder="Search" />
            <span id="searchBtn" class="absolute inset-y-0 right-0 pl-3 hidden items-center">
              <button type="submit" onclick="search();" class="bg-indigo-400 hover:bg-indigo-600 text-white font-bold py-2 px-6 mr-2 rounded">
                Go
              </button>
            </span>
          </form>
        </div>
      </div>
      
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
                <td class="border px-4 py-2 truncate">'. $row["firstName"] . " " . $row["lastName"] .'</td>
                <td class="border px-4 py-2 truncate">'. $row["initialCollectionPoint"] .'</td>
                <td class="border px-4 py-2 truncate">'. $row["startDate"] .'</td>
                <td class="border px-4 py-2 truncate">'. $row["endDate"] .'</td>
                <td class="border px-4 py-2 truncate">'. $row["short_description"] .'</td>
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
                    <button onClick="showModal(\''.$row["bookingID"].'\')" >
                      <span class="flex flex-col items-center justify-items-center active:border-none">
                        <svg class="text-red-300 hover:text-red-700 h-6 w-6 m-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="font-thin text-sm -mt-1">Delete</p> 
                      </span> 
                    </button>
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