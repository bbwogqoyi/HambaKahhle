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

function queryBookingCounts() {
  $query = 
    "SELECT s.short_description, b.statusID, count(b.statusID) as statusCount
      from booking b, booking_status s
      where s.statusID=b.statusID
      group by b.statusID";
  $result = executeQuery($query);
  return $result;
}

function queryAllBookings() {
  $query = 
    "SELECT * from booking b, clients c, booking_status s
      where c.clientID = b.clientID
      and s.statusID = b.statusID
      order by b.statusID";

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
        <a href="./depots.report.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-700 hover:font-semibold focus:outline-none" >
            Depots
        </a>
        <a href="./employees.report.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none">
            Employees
        </a>
        <a href="./bookings.report.php" class="  
            border-b-2 font-medium border-indigo-500 text-indigo-400 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none"  >
            Bookings
        </a>
      </nav>
    </div>

    <!-- Bookings Chart -->
    <div class="w-full mt-4 flex justify-center mx-auto">
      <div class="w-3/5">
      <canvas  id="myChart"></canvas>
      </div>
    </div>

    <!-- dynamic content -->
    <table class="table-fixed text-left w-full mt-8">
      <caption class="text-lg font-medium mb-3">Current Bookings</caption>
      <thead class="bg-gray-200">
        <tr>
          <th class="w-1/6 px-4 py-2">Booking Client</th>
          <th class="w-1/6 px-4 py-2">Passengers</th>
          <th class="w-1/6 px-4 py-2">Start Date</th>
          <th class="w-1/6 px-4 py-2">End Date</th>
          <th class="w-1/6 px-4 py-2">Status</th>
          <th class="w-1/6 px-4 py-2">Start Location</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <?php
          $result = queryAllBookings();
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
                <td class="border px-4 py-2">'. $row["numberOfPassengers"] .'</td>
                <td class="border px-4 py-2">'. $row["startDate"] .'</td>
                <td class="border px-4 py-2">'. $row["endDate"] .'</td>
                <td class="border px-4 py-2">'. $row["short_description"] .'</td>
                <td class="border px-4 py-2">'. $row["initialCollectionPoint"] .'</td>
              </tr>
            ';
          }
        ?>
      </tbody>
    </table>


    <script>
      var barChartForBookingsActivity = function(bookingCount) {
        var labels = [];
        var dataset = [];
        for (const [key, value] of Object.entries(bookingCount)) {
          labels.push(key);
          dataset.push(value);
        }

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: '# of Bookings',
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
        $result = queryBookingCounts();
        $jsonResultSet = null;
        while($result!=null && $row = mysqli_fetch_assoc($result))
        {
          $jsonResultSet[$row['short_description']] = $row['statusCount'];
        }

        echo 'barChartForBookingsActivity('.json_encode($jsonResultSet).');'
      ?>
    </script>
  </div>
</body>
</html>