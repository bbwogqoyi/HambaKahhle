<?php
$test_data = array(
  0 => array(
    "driverID" => 0,
    "name" => "Andiswa Qwaba",
    "licenceList" => array(
      "code 10", "code 14"
    ),
    "dateOfBirth" => "01 January 1995",
    "contact" => "076 000 1234",
    "dateEmployed" => "31 November 2018",
    "homeTown" => "Grahamstown"
  ),
  1 => array(
    "driverID" => 3,
    "name" => "Nkosinathi Nkomo",
    "licenceList" => array(
      "code 8"
    ),
    "dateOfBirth" => "01 January 1995",
    "contact" => "081 123 0004",
    "dateEmployed" => "31 November 2020",
    "homeTown" => "Johannesburg"
  )
);

function buildLicenceList($licenceList) {
  $html = "";
  foreach($licenceList as $entry) {
    $html = $html . '<p class="font-medium">'.$entry.'</p>';
  }

  return $html;
}

function renderDriverEntry($driverID, $name, $licenceList, $dateOfBirth, $contact, $homeTown, $actionLink) {
  return '
    <tr>
      <td class="border px-4 py-2">'.$name.'</td>
      <td class="border px-4 py-2">
        '. buildLicenceList($licenceList) .'
      </td>
      <td class="border px-4 py-2">'.$homeTown.'</td>
      <td class="border px-4 py-2">'.$dateOfBirth.'</td>
      <td class="border px-4 py-2">'.$contact.'</td>
      <td class="border py-2">
        <a href="./admin.booking.overview.php?'.$actionLink.'" >
          <div class="flex items-center group">
            <svg class="w-12 h-12 pl-2 pr-1 text-gray-400 group-hover:text-indigo-700"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <p class="py-2 text-gray-400 font-medium group-hover:font-bold group-hover:text-indigo-700">
            Assign</p>
          </div>
        </a>
      </td>
    </tr>
  ';

}

?>

<!-- Content Table -->
<table class="table-auto text-left w-full">
  <thead class="bg-gray-200">
    <tr>
      <!-- <th class="w-1 px-4 py-2"></th> -->
      <th class="w-1/6 px-4 py-2">Name</th>
      <th class="w-1/6 px-4 py-2">Licences</th>
      <th class="w-1/6 px-4 py-2">Town</th>
      <th class="w-1/6 px-4 py-2">Date of Birth</th>
      <th class="w-1/6 px-4 py-2">Contact Number</th>
      <th class="w-1/12 px-4 py-2">Action</th>
    </tr>
  </thead>
  <tbody class="text-gray-700">
    <?php
      foreach($test_data as $model) {
        echo renderDriverEntry(
          $model["driverID"], $model["name"], $model["licenceList"], $model["dateOfBirth"],
           $model["contact"], $model["homeTown"], "#"
        );
      }
    ?>
  </tbody>
</table>