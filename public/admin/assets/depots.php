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
    "SELECT * FROM depot d 
    having (
    concat_ws(' ', streetNumber, streetName, town) LIKE '%$searchText%'
      or d.depotName Like '%$searchText%'
      or d.town Like '%$searchText%'
      or d.contactNumber Like '%$searchText%'
      or d.numberOfBedsAvailable Like '%$searchText%'
      )
    LIMIT 20";
  } else {
    $query = "SELECT * FROM depot d LIMIT 20";
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
   <!-- Top Navbar -->
   <?php
    require_once("../../component_partials/admin.topbar.nav.php");
  ?>

  <!-- Page Content-->
  <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full lg:w-4/5">
    <!-- Assets Page Navbar -->
    <div class="">
      <nav class="flex flex-col sm:flex-row">
        <a href="./index.assets.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none"  >
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
      <div class="w-1/3">
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
            <svg class="h-6 w-6 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </span>
          <form id="searchForm" action='./depots.php' method="GET" >
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

      <a href="../depot/add.depot.php"
          class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-4 px-10 rounded">
          Add New Depot(s)
      </a>
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
            <td colspan="10">No Depots</td>
            </tr>';
          }
        ?>
        <?php
          while($result!=null && $row = mysqli_fetch_assoc($result))
          {
            echo '
              <tr class="group">
                <td class="border px-4 py-4 text-indigo-500 font-medium group-hover:bg-gray-100">
                  <a 
                    href="../depot/view.depot.php?depotID='. $row["depotID"] .'"
                    class="hover:border-b-2 border-indigo-600" >
                    '. $row["depotName"] . '
                  </a>  
                </td>
                
                <td class="border px-4 py-4 group-hover:bg-gray-100">'. $row["streetNumber"] . '</td>
                <td class="border px-4 py-4 group-hover:bg-gray-100 ">'. $row["streetName"] . '</td>
                <td class="border px-4 py-4 group-hover:bg-gray-100">'. $row["town"] . '</td>
                <td class="border px-4 py-4 group-hover:bg-gray-100">'. $row["contactNumber"] . '</td>
                <td class="border px-4 py-4 group-hover:bg-gray-100">'. $row["numberOfBedsAvailable"] . '</td>
              </tr>
            ';
          }
          ?>
      </tbody>
    </table>

  </div>
</body>
</html>