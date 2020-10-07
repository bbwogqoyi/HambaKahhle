<?php
//import database credentials
require_once(dirname(__DIR__) . "../../common/db.config.php");

function getBookings(){
  //connect to the database 
  $conn = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE)
         or die("Sorry , could not connect ot the database!");

  //issue query instructions
  $query = 
  "SELECT c.firstName, c.lastName, b.*, s.*
    from clients c, booking_status s, (select * from booking) b
    where b.clientID = c.clientID and s.id=b.status and b.status>=2
    limit 20;
  ";  //and b.status>=2
  $result = mysqli_query($conn, $query) or die("Error on query!");

  //disconnect 
  mysqli_close($conn);
  return $result;
}

?>

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
        <td colspan="6">No Bookings</td>
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
                <a href="./admin.booking.overview.php?id='. $row["bookingID"].'">
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
      