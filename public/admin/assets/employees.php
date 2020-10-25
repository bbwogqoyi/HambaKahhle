<!DOCTYPE html>
<html lang="en">
<?php
$GLOBALS['active_nav_item'] = 'assets_dashboard';
require_once(dirname(__DIR__) . "../../auth/authorization.php");

//import database utils
require_once(dirname(__DIR__) . "../../common/utils.php");

function queryAvailableEmployees() {
  $query = 
    "SELECT e.*, t.short_description FROM employee e, employeetype t
      where e.employeeTypeID=t.employeeTypeID LIMIT 20";
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
        <a href="./depots.php" class="text-gray-600 py-4 px-6 block hover:text-indigo-500 hover:font-semibold  focus:outline-none" >
            Depots
        </a>
        <a href="./employees.php"  class="text-indigo-400 py-4 px-6 block hover:text-indigo-700 hover:font-semibold focus:outline-none  
            border-b-2 font-medium border-indigo-500" >
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
      
      <a href="../employee/add.employee.php"
          class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-4 px-10 rounded">
        Add New Employee
      </a>
    </div>

    <!-- dynamic content -->
    <table class="table-auto text-left w-full">
      <thead class="bg-gray-200">
        <tr>
          <th class="w-1/6 px-4 py-2">Name</th>
          <th class="w-1/6 px-4 py-2">Email</th>
          <th class="w-1/6 px-4 py-2">Role</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <?php
          $result = queryAvailableEmployees();
          if($result==null || mysqli_num_rows($result)<1) 
          {
            echo 
            '<tr class="text-2xl text-gray-600 text-center">
            <td colspan="10">No Employees</td>
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
                <td class="flex items-center border px-4 py-4">
                  <a href="../employee/view.employee.php?employeeID='. $row["employeeID"] .'" class="lg:ml-4  flex items-center justify-start lg:mb-0 mb-4 pointer-cursor">
                    <img class="rounded-full w-12 h-12 mr-4 border-2 border-transparent hover:border-indigo-800"
                      src="https://images.unsplash.com/photo-1509305717900-84f40e786d82?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=144&h=144&q=80"
                      alt="Nkosinathi Nkomo">
                      <p class="text-indigo-500 font-medium hover:text-indigo-600 hover:border-b-2 border-indigo-600" >
                      '. $row["firstName"] .' '. $row["lastName"] . '
                      </p>
                  </a>
                </td>
                <td class="border px-4 py-4">'. $row["email"] . '</td>
                <td class="border px-4 py-4">'. $row["short_description"] . '</td>
              </tr>
            ';
          }
          ?>
      </tbody>
    </table>

  </div>
</body>
</html>