<!DOCTYPE html>
<html lang="en">
<!--
- The managers would like to have reports on their vehicles and their details
  -> Total count of the vehicles, contrast that number with the number of active 
- HR would like to have reports on employees and where they are at any time
- The admin staff would like to be able to report the number of rooms available in depots at any one time
-->
<?php
$GLOBALS['active_nav_item'] = 'reports_dashboard';
require_once(dirname(__DIR__) . "../../auth/authorization.php");

//import database utils
require_once(dirname(__DIR__) . "../../common/utils.php");

function queryAllDepots() {
  $query = 
    "SELECT * FROM depot";

  return executeQuery($query);
}
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/tailwind.css" />
  <link rel="stylesheet" href="../../css/custom.css" />
  <title>Reports</title>

  <script 
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" 
    integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" 
    crossorigin="anonymous">
  </script>
</head>
<body class="antialiased bg-gray-200">
  <!-- Top Navbar -->
  <?php
    require_once("../../component_partials/admin.topbar.nav.php");
  ?>

  <!-- Page Content-->
  <div class="mt-16 mb-16 py-8 px-6 mx-auto bg-white items-center w-full lg:w-4/5">
    <!-- Assets Page Navbar -->
    <div class="">
      <nav class="flex flex-col sm:flex-row">
        
        <a href="./vehicles.report.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none"  >
            Vehicles
        </a>
        <a href="./depots.report.php" 
            class="border-b-2 font-medium border-indigo-500 text-indigo-400 py-4 px-6 block
             hover:text-indigo-500 hover:font-semibold  focus:outline-none" >
            Depots
        </a>
        <a href="./employees.report.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none">
            Employees
        </a>
        <a href="./bookings.report.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-700 hover:font-semibold focus:outline-none" >
            Bookings
        </a>
      </nav>
    </div>

    <!-- dynamic content -->
    <table class="table-auto text-left w-full mt-8">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2">Depot Name</th>
          <th class="px-4 py-2">Address</th>
          <th class="px-4 py-2">Town</th>
          <th class="px-4 py-2">Contact Number</th>
          <th class="px-4 py-2">Number of Available Rooms</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <?php
          $result = queryAllDepots();
          if($result==null || mysqli_num_rows($result)<1) 
          {
            echo 
            '<tr class="text-2xl text-gray-600 text-center">
            <td colspan="10">No Depots</td>
            </tr>';
          }

          while ($result!=null && $row = mysqli_fetch_assoc($result)) {
            echo '
              <tr>
                <td class="border px-4 py-2">'. $row["depotName"] . '</td>
                <td class="border px-4 py-2">'. $row["streetNumber"] ." " . $row["streetName"] .'</td>
                <td class="border px-4 py-2">'. $row["town"] .'</td>
                <td class="border px-4 py-2">'. $row["contactNumber"] .'</td>
                <td class="border px-4 py-2">'. $row["numberOfBedsAvailable"] .'</td>
              </tr>
            ';
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>