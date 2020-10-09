<!DOCTYPE html>
<html lang="en">
<?php
$GLOBALS['active_nav_item'] = 'assets_dashboard';
require_once(dirname(__DIR__) . "../../auth/authorization.php");

//import database utils
require_once(dirname(__DIR__) . "../../common/utils.php");

function queryAvailableVehicles() {
  $query = 
    "SELECT * FROM depot d LIMIT 20";
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
  <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full lg:w-4/5">
    <!-- Assets Page Navbar -->
    <div class="">
      <nav class="flex flex-col sm:flex-row">
        <a href="./index.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none"  >
            Vehicles
        </a>
        <a href="./depots.php" class="text-indigo-400 py-4 px-6 block hover:text-indigo-700 hover:font-semibold focus:outline-none  
            border-b-2 font-medium border-indigo-500" >
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
      
      <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-4 px-10 rounded">
        Add New Depot
      </button>
    </div>

    <!-- dynamic content -->
    <table class="table-fixed text-left w-full">
      <thead class="bg-gray-200">
        <tr>
          <th class="w-1/6 px-4 py-2">Depot Name</th>
          <th class="w-1/6 px-4 py-2">Street Number</th>
          <th class="w-1/6 px-4 py-2">Street Name</th>
          <th class="w-1/6 px-4 py-2">Town</th>
          <th class="w-1/6 px-4 py-2">Contact Number</th>
          <th class="w-1/6 px-4 py-2">Number Of Beds Available</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <?php
          $result = queryAvailableVehicles();
          if($result==null || mysqli_num_rows($result)<1) 
          {
            echo 
            '<tr class="text-2xl text-gray-600 text-center">
            <td colspan="6">No Depots</td>
            </tr>';
          }
        ?>
        <?php
          $row_index=0;
          while($result!=null && $row = mysqli_fetch_assoc($result))
          {
            $row_index+=1;
            $actionLink = "#";
            echo '
              <tr>
                <td class="border px-4 py-4">'. $row["depotName"] . '</td>
                <td class="border px-4 py-4">'. $row["streetNumber"] . '</td>
                <td class="border px-4 py-4">'. $row["streetName"] . '</td>
                <td class="border px-4 py-4">'. $row["town"] . '</td>
                <td class="border px-4 py-4">'. $row["contactNumber"] . '</td>
                <td class="border px-4 py-4">'. $row["numberOfBedsAvailable"] . '</td>
              </tr>
            ';
          }
          ?>
      </tbody>
    </table>

  </div>
</body>
</html>