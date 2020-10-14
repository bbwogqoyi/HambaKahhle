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
  <div class="mt-16 py-8 px-6 mx-auto bg-white items-center w-full lg:w-4/5">
    <!-- Assets Page Navbar -->
    <div class="">
      <nav class="flex flex-col sm:flex-row">
      <a href="./index.php" class="  
            border-b-2 font-medium border-indigo-500 text-indigo-400 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none"  >
            Bookings
        </a>
        <a href="./index.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none"  >
            Vehicles
        </a>
        <a href="./index.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-700 hover:font-semibold focus:outline-none" >
            Depots
        </a>
        <a href="./index.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none">
            Employees
        </a>
      </nav>
    </div>

    <!-- dynamic content -->
    <div class="w-1/2 mt-4 flex">
      <canvas id="myChart"></canvas>
    </div>

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
        function queryBookings() {
          $query = 
            "SELECT s.short_description, b.statusID, count(b.statusID) as statusCount
              from booking b, booking_status s
              where s.statusID=b.statusID
              group by b.statusID";
          $result = executeQuery($query);
          return $result;
        }
        $result = queryBookings();
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