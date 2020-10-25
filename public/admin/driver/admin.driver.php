<!doctype html>
<html lang="en">

<?php
$GLOBALS['active_nav_item'] = 'admin_dashboard';
require_once(dirname(__DIR__) . "../../auth/authorization.php");

function buildLicenceList($licenceList) {
  $html = "";
  foreach($licenceList as $entry) {
    $html = $html . '<p class="font-medium">'.$entry.'</p>';
  }
  return $html;
}

// import database utils
require_once(dirname(__DIR__) . "../../common/utils.php");

function queryAvailableDrivers() {
  $query = 
    "SELECT d.*, GROUP_CONCAT(dl.licenseCode) as licenceList from driverlicense dl, (
      SELECT * from driver d
      where d.driverID not in (
        select b.driverID from booking b
        where b.statusID>=3 and b.statusID<=5
      )
    ) d
    where dl.driverID = d.driverID
    group by dl.driverID";

  $result = executeQuery($query);
  return $result;
}

// href="../booking/booking.overview.php'
// ./admin.driver.list.php?bookingID=xxx?driverID=yyy
function assignDriverOntoBooking($bookingID, $driverID) {
  $query = "UPDATE booking b SET b.driverID=$driverID WHERE b.bookingID=$bookingID";

  $result = executeQuery($query);
  return $result;
}

if( isset($_REQUEST['driverID']) ) {
  assignDriverOntoBooking($_REQUEST['bookingID'], $_REQUEST['driverID']);
  $redirectURL = '../booking/booking.overview.php?id='. $_REQUEST['bookingID'];
  header("Location: $redirectURL");
}

?> 

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../../css/tailwind.css" />
  <link rel="stylesheet" href="../../css/custom.css" />
  <title>Assign Driver</title>

  <style>
    .noSelect {
      user-select: none; /* supported by Chrome and Opera */
      -webkit-user-select: none; /* Safari */
      -khtml-user-select: none; /* Konqueror HTML */
      -moz-user-select: none; /* Firefox */
      -ms-user-select: none; /* Internet Explorer/Edge */
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
    <!-- Searchbar + Cancel Button -->
    <div class="flex justify-between w-full items-center mb-10"> 
      <?php
        require_once("../../component_partials/searchbar.php");
        echo searchbar('index.php');
      ?>

      <a href="#" onclick="history.go(-1);" class="bg-red-300 hover:bg-red-700 text-white font-bold py-2 px-10 rounded">
        Cancel
      </a>
    </div>

    <!-- Content Table -->
    <table class="table-auto text-left w-full">
      <thead class="bg-gray-200">
        <tr>
          <!-- <th class="w-1 px-4 py-2"></th> -->
          <th class="w-1/6 px-4 py-2">Name</th>
          <th class="w-1/6 px-4 py-2">Licences</th>
          <th class="w-1/6 px-4 py-2">Town</th>
          <th class="w-1/6 px-4 py-2">Date of Birth</th>
          <th class="w-1/6 px-4 py-2">Contact Number</th>
          <th class="w-1/12 px-4 py-2">Action</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <?php
          $result = queryAvailableDrivers();
          if($result==null || mysqli_num_rows($result)<1) 
          {
            echo 
            '<tr class="text-2xl text-gray-600 text-center">
            <td colspan="6">No Bookings</td>
            </tr>';
          }

          while($result!=null && $row = mysqli_fetch_assoc($result)) {
            $actionLink = "?bookingID=".$_REQUEST['bookingID']."&driverID=".$row["driverID"];
            echo '
              <tr>
                <td class="border px-4 py-2">'. $row["firstName"] .' '. $row["lastName"] .'</td>
                <td class="border px-4 py-2">
                  '. buildLicenceList( explode(",", $row["licenceList"]) ) .'
                </td>
                <td class="border px-4 py-2">'. $row["hometown"] .'</td>
                <td class="border px-4 py-2">'. $row["dateOFBirth"] .'</td>
                <td class="border px-4 py-2">' .$row["contactNumber"] .'</td>
                <td class="border py-2">
                  <a href="./admin.driver.php'. $actionLink .'" >
                    <div class="flex items-center group">
                      <svg class="w-12 h-12 pl-2 pr-1 text-gray-400 group-hover:text-indigo-700"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                      </svg>
                      <p class="noSelect py-2 text-gray-400 font-medium group-hover:font-bold group-hover:text-indigo-700">
                      Assign</p>
                    </div>
                  </a>
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