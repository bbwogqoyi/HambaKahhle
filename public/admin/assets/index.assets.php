<!DOCTYPE html>
<html lang="en">
<?php
$GLOBALS['active_nav_item'] = 'assets_dashboard';
require_once(dirname(__DIR__) . "../../auth/authorization.php");
authorize('employeeID', '../index.php');

//import database utils
require_once(dirname(__DIR__) . "../../common/utils.php");

function queryAvailableVehicles() {
  if( isset($_REQUEST['searchText']) ) {
    $searchText = $_REQUEST['searchText'];

    $query = 
      "SELECT * from vehicle v 
      having (
        concat_ws(' ', v.make, v.model) LIKE '%$searchText%'
          or v.numberOfSeats Like '%$searchText%'
          or v.registrationNumber Like '%$searchText%'
      ) LIMIT 20";
  } else {
    $query = 
    "SELECT * from vehicle v LIMIT 20";
  }
  
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
      <div class="w-1/3">
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
            <svg class="h-6 w-6 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </span>
          <form id="searchForm" action="./index.assets.php" method="GET" >
            <input class="hidden" id="bookingID" name="bookingID" value="<?php echo $_REQUEST['bookingID']; ?>" />
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