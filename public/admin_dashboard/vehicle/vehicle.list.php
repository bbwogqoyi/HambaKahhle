<!doctype html>
<html lang="en">
<?php
//import database utils
require_once(dirname(__DIR__) . "../../common/utils.php");

function queryAvailableVehicles() {
  $query = 
    "SELECT * from vehicle v
      where v.registrationNumber not in
      (
        SELECT vb.registrationNumber from vehiclebooking vb, ( 
          SELECT bookingID from booking b where b.status>=3 and  b.status<=5 ) b
        where vb.bookingID = b.bookingID
      )
    ";
  $result = executeQuery($query);
  return $result;
}

function assignSelectedVehiclesToBooking($registrationNumber, $bookingID) {
  $query = 
    "INSERT into vehiclebooking(registrationNumber, bookingID) 
      values ('$registrationNumber', $bookingID)
    ";
  echo $query;
  $result = executeQuery($query);
  return $result;
}

$result = null;
if( isset($_POST['submit']) ) {
  if( !empty($_POST['check_list']) ) {
    // Loop to store and display values of individual checked checkbox.
    foreach($_POST['check_list'] as $registrationNumber){
      assignSelectedVehiclesToBooking($registrationNumber, $_REQUEST['bookingID']);
    }
    $redirectURL = '../booking/admin.booking.overview.php?id='. $_REQUEST['bookingID'];
    header("Location: $redirectURL");
  }
} else {
  $result = queryAvailableVehicles();
}

?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../../css/tailwind.css" />
  <link rel="stylesheet" href="../../css/custom.css" />
  <title>Assign vehicle</title>

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
    require_once("../../component_partials/topbar.nav.php");
  ?>

  <!-- Page Content-->
  <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full md:w-4/5 rounded">
  <form action='vehicle.list.php?bookingID=<?php echo $_REQUEST["bookingID"]; ?>' method="POST"> <!--  href="vehicle.list.php" -->

    
    <!-- (Searchbar + Button) Div -->
    <div class="flex justify-between w-full items-center mb-10"> 
      <!-- Searchbar -->
      <div class="w-1/3">
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
            <svg class="h-6 w-6 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </span>
          <input type="text" id="searchBar" name="searchBar"
          class="py-3 pl-10 w-full text-lg bg-white border border-grey-400 rounded-md text-gray-800 placeholder-gray-500 shadow"
          placeholder="Search" />
        </div>
      </div>
      <!-- Button -  href="./admin.booking.overview.php?'. $actionLink .'"  -->
      <button id="submit" name="submit" type="submit" 
        class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-3 px-10 rounded">
        Assign Car(s)
      </button>
    </div>

    <table class="table-fixed w-full text-left">
      <thead>
        <tr class="bg-gray-200">
          <th class="w-1/6 px-4 py-2">Registration Number</th>
          <th class="w-1/6 px-4 py-2">Number of Seats</th>
          <th class="w-1/6 px-4 py-2">Make</th>
          <th class="w-1/6 px-4 py-2">Model</th>
          <th class="w-1/6 px-4 py-2">Year</th>
          <th class="w-1/6 px-4 py-2">Purchase date</th>
          <th class="w-1/12 px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">     
        <?php
          $row_index=0;
          while($row = $result->fetch_assoc())
          {
            $row_index+=1;
            $actionLink = "#";
            echo '
              <tr>
                <td id="reg_'. $row_index .'" class="border px-4 py-4">'. $row["registrationNumber"] . '</td>
                <td class="border px-4 py-4">'. $row["numberOfSeats"] . '</td>
                <td class="border px-4 py-4">'. $row["make"] . '</td>
                <td class="border px-4 py-4">'. $row["model"] . '</td>
                <td class="border px-4 py-4">'. $row["year"] . '</td>
                <td class="border px-4 py-4">'. $row["dateOfPurchase"] . '</td>
                <td class="border py-2">
                  <span class="inline-flex">
                    <input id="vehicleTicker_'. $row_index .'" value="'. $row["registrationNumber"] .'" name="check_list[]" 
                      type="checkbox" class="hidden" >
                    </input>
                    <a onclick="clickEvt(this);" id="checkbox_'. $row_index .'" class="flex items-center group">
                      <svg id="checkbox_svg_'. $row_index .'" class="w-12 h-12 pl-2 pr-1 text-gray-400 group-hover:text-indigo-500" 
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                      </svg>
                      <p id="checkbox_txt_'. $row_index .'" class="noSelect py-2 text-gray-400 font-medium group-hover:font-bold group-hover:text-indigo-500">
                        Select
                      </p>
                    </a>
                  </span>
                </td>
              </tr>
            ';
          }
          ?>
      </tbody>
    </table>
    </form>
  </div>
  <script>
    function removeItemOnce(arr, value) {
      var index = arr.indexOf(value);
      if (index > -1) {
        arr.splice(index, 1);
      }
      return arr;
    }

    function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }
    
    var clickEvt = function(elem) {
      // get the elements id value
      var elemSplit = elem.id.split('_');
      var elemID = elemSplit[elemSplit.length-1];

      // get hidden checkbox, that stores state (toggle action)
      var checkbox = document.getElementById('vehicleTicker_'+elemID);
      checkbox.checked = !checkbox.checked;

      // apply text-color based on the checkbox value
      if(checkbox.checked) {
        document.getElementById('checkbox_svg_'+elemID).style.color  = 'rgba(76, 81, 191, var(--text-opacity))';
        document.getElementById('checkbox_txt_'+elemID).style.color  = 'rgba(102, 126, 234, var(--text-opacity))';
      }
      else {
        document.getElementById('checkbox_svg_'+elemID).style.color  = 'rgba(203, 213, 224, var(--text-opacity))';
        document.getElementById('checkbox_txt_'+elemID).style.color  = 'rgba(203, 213, 224, var(--text-opacity))';
      }
    }
  </script>
</body>
</html>