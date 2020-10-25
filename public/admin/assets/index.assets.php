<!DOCTYPE html>
<html lang="en">
<?php
$GLOBALS['active_nav_item'] = 'assets_dashboard';
require_once(dirname(__DIR__) . "../../auth/authorization.php");

//import database utils
require_once(dirname(__DIR__) . "../../common/utils.php");

function queryAvailableVehicles() {
  $query = 
    "SELECT * from vehicle v LIMIT 20";
  $result = executeQuery($query);
  return $result;
}

?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/tailwind.css" />
  <link rel="stylesheet" href="../../css/custom.css" />
  <title>Assets</title>
</head>
<body class="antialiased bg-gray-200">
   <!-- Top Navbar -->
   <?php
    require_once("../../component_partials/admin.topbar.nav.php");
  ?>

  <!-- Page Content-->
  <div class="mt-16 mb-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full lg:w-4/5">
    <!-- Assets Page Navbar -->
    <div class="">
      <nav class="flex flex-col sm:flex-row">
        <a href="./index.assets.php" class="text-indigo-400 py-4 px-6 block hover:text-indigo-700 
          hover:font-semibold focus:outline-none border-b-2 font-medium border-indigo-500" >
          Vehicles
        </a>
        <a href="./depots.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none">
          Depots
        </a>
        <a href="./employees.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none">
          Employees
        </a>
        </nav>
    </div>

    <!-- Searchbar + Button -->
    <div class="mt-8 flex justify-between w-full items-center mb-10"> 
      <?php
        require_once("../../component_partials/searchbar.php");
        echo searchbar('index.php');
      ?>
      
      <!-- <a href="../vehicle/add.vehicle.php" -->
      <a href="../vehicle/add.vehicle.php"
          class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-4 px-10 rounded">
        Add New Vehicle
      </a>
    </div>

    <!-- dynamic content -->
    <table class="table-fixed text-left w-full">
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
          $result = queryAvailableVehicles();
          if($result==null || mysqli_num_rows($result)<1) 
          {
            echo 
            '<tr class="text-2xl text-gray-600 text-center">
            <td colspan="10">No Vehicles</td>
            </tr>';
          }
        ?>
        <?php
          $row_index=0;
          while($result!=null && $row = mysqli_fetch_assoc($result))
          {
            echo '
              <tr>
                <td class="border px-4 py-4 text-indigo-500 font-medium">
                  <a 
                    href="../vehicle/view.vehicle.php?registrationNumber='. $row["registrationNumber"] . '"
                    class="hover:border-b-2 border-indigo-600" >
                    '. $row["registrationNumber"] . '
                  </a>
                </td>
                <td class="border px-4 py-4">'. $row["numberOfSeats"] . '</td>
                <td class="border px-4 py-4">'. $row["make"] . '</td>
                <td class="border px-4 py-4">'. $row["model"] . '</td>
                <td class="border px-4 py-4">'. $row["year"] . '</td>
                <td class="border px-4 py-4">'. $row["dateOfPurchase"] . '</td>
              </tr>
            ';
          }
          ?>
      </tbody>
    </table>

  </div>
</body>
</html>