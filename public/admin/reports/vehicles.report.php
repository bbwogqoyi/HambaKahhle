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

function queryVehiclesData() {
  $activeVehiclesQuery = 
  "SELECT v.*, b.*, d.*, s.short_description 
  from vehiclebooking vb, vehicle v, booking b, driver d, booking_status s
  where vb.registrationNumber = v.registrationNumber
  and vb.bookingID = b.bookingID
  and d.driverID = b.driverID
  and s.statusID = b.statusID";
  

  $freeVehiclesQuery = 
  "SELECT * from vehicle v
  where v.registrationNumber not in (
  SELECT vb.registrationNumber from vehiclebooking vb
  )";
  
  $results["active_vehicles"] = executeQuery($activeVehiclesQuery);
  $results["unused_vehicles"] = executeQuery($freeVehiclesQuery);
  return $results;
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

    $vehiclesInfo = queryVehiclesData();
  ?>

  <!-- Page Content-->
  <div class="mt-16 mb-16 py-8 px-6 mx-auto bg-white items-center w-full lg:w-4/5">
    <!-- Assets Page Navbar -->
    <div class="">
      <nav class="flex flex-col sm:flex-row">
        
        <a href="./vehicles.report.php" 
          class="border-b-2 font-medium border-indigo-500 text-indigo-400 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none"  >
            Vehicles
        </a>
        
        <a href="./depots.report.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-700 hover:font-semibold focus:outline-none" >
            Depots
        </a>
        <a href="./employees.report.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none">
            Employees
        </a>
        <a href="./bookings.report.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none"  >
            Bookings
        </a>
      </nav>
    </div>

    <!-- vehicles chart -->
    <div class="w-full mt-4 flex justify-center mx-auto">
      <div class="w-3/5">
      <canvas  id="myChart"></canvas>
      </div>
    </div>

    <!-- Active Vehicles Table -->
    <table class="table-fixed text-left w-full mt-10">
      <caption class="text-lg font-medium mb-3">Active vehicles and their associated booking</caption>
      <thead class="bg-gray-200">
        <tr>
          <th class="w-1/6 px-4 py-2">Vehicle</th>
          <th class="w-1/6 px-4 py-2">Registration Number</th>
          <th class="w-1/6 px-4 py-2">Booking Start Date</th>
          <th class="w-1/6 px-4 py-2">Booking End Date</th>
          <th class="w-1/12 px-4 py-2">Passengers</th>
          <th class="w-1/6 px-4 py-2">Booking Driver</th>
          <th class="w-1/6 px-4 py-2">Booking Status</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <?php
          $result = $vehiclesInfo["active_vehicles"];
          if($result==null || mysqli_num_rows($result)<1) 
          {
            echo 
            '<tr class="text-2xl text-gray-600 text-center">
            <td colspan="10">No Active Vehicles</td>
            </tr>';
          }

          while ($result!=null && $row = mysqli_fetch_assoc($result)) {
            echo '
              <tr>
                <td class="border px-4 py-2">'. $row["make"] . " " . $row["model"] .'</td>
                <td class="border px-4 py-2">'. $row["registrationNumber"] .'</td>
                <td class="border px-4 py-2">'. $row["startDate"] .'</td>
                <td class="border px-4 py-2">'. $row["endDate"] .'</td>
                <td class="border px-4 py-2">'. $row["numberOfPassengers"] .'</td>
                <td class="border px-4 py-2">'. $row["firstName"] . " " . $row["lastName"] .'</td>
                <td class="border px-4 py-2">'. $row["short_description"] .'</td>
              </tr>
            ';
          }
        ?>
      </tbody>
    </table>


    <!-- Unused Vehicles Table -->
    <table class="table-fixed text-left w-full mt-10">
      <caption class="text-lg font-medium mb-3">Unused vehicles</caption>
      <thead class="bg-gray-200">
        <tr>
          <th class="w-1/6 px-4 py-2">Registration Number</th>
          <th class="w-1/6 px-4 py-2">Number of Seats</th>
          <th class="w-1/6 px-4 py-2">Make</th>
          <th class="w-1/6 px-4 py-2">Model</th>
          <th class="w-1/6 px-4 py-2">Year</th>
          <th class="w-1/6 px-4 py-2">Purchase date</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <?php
          $result = $vehiclesInfo["unused_vehicles"];
          if($result==null || mysqli_num_rows($result)<1) 
          {
            echo 
            '<tr class="text-2xl text-gray-600 text-center">
            <td colspan="6">No Unused Vehicles</td>
            </tr>';
          }
        ?>
        <?php
          $row_index=0;
          while($result!=null && $row = mysqli_fetch_assoc($result))
          {
            echo '
              <tr>
                <td class="border px-4 py-4">'. $row["registrationNumber"] . '</td>
                <td class="border px-4 py-4">'. $row["make"] . '</td>
                <td class="border px-4 py-4">'. $row["model"] . '</td>
                <td class="border px-4 py-4">'. $row["year"] . '</td>
                <td class="border px-4 py-4">'. $row["numberOfSeats"] . '</td>
                <td class="border px-4 py-4">'. $row["dateOfPurchase"] . '</td>
              </tr>
            ';
          }
          ?>
      </tbody>
    </table>

    <script>
      var doughnutChartForVehicles = function(vehicle_dist) {
        var labels = [];
        var dataset = [];
        for (const [key, value] of Object.entries(vehicle_dist)) {
          labels.push(key);
          dataset.push(value);
        }

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: 'Vehicles Report',
              data: dataset,
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  stepSize: 1,
                  beginAtZero: true
                }
              }]
            }
          }
        });
      }

      <?php
        $jsonResultSet['unused_vehicles'] = mysqli_num_rows($vehiclesInfo["unused_vehicles"]);
        $jsonResultSet['active_vehicles'] = mysqli_num_rows($vehiclesInfo["active_vehicles"]);
        echo 'doughnutChartForVehicles('.json_encode($jsonResultSet).');';
      ?>
    </script>

  </div>
</body>
</html>