<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <title>Assign vehicle</title>
</head>

<body class="antialiased bg-gray-200">
  <!-- Top Navbar -->
  <?php
    require_once("../component_partials/topbar.nav.php");
  ?>

  <!-- Page Content-->
  <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full md:w-4/5 rounded">
    <!-- Searchbar + Button -->
    <div class="flex justify-between w-full items-center mb-10"> 
      <div class="w-1/3">
        
         
          <label class="py-3 w-1/6 px-4 py-2  text-lg  text-black-800 placeholder-gray-500 shadow ">Profile Page</label>
        
      </div>
      
    </div>

    <table class="table-fixed w-full">
      <thead>
        <br><br>
        <tr class="bg-gray-100">
          <th class="w-1/6 px-4 py-2"></th>
          <th class="w-1/6 px-4 py-2">Last Name</th>
          <th class="w-1/6 px-4 py-2">First Name</th>
          <th class="w-1/6 px-4 py-2d">Contact Number</th>
          <th class="w-1/6 px-4 py-2">Email</th>
          <th class="w-1/6 px-4 py-2">ClientID</th>
          
        </tr>
      </thead>
      <tbody class="text-gray-700">
      <tr>
      <td><div class="md:flex bg-white rounded-lg p-6"> <img class="h-25 w-16 md:h-24 md:w-24 rounded-full mx-auto md:mx-0 md:mr-6" src="question12.png"><div class="text-center md:text-left"></td>
      <td class="border px-4 py-4 bg-gray-500" >Musekiwa</td>
      <td class="border px-4 py-4 bg-gray-500" >Musekiwa</td>
      <td class="border px-4 py-4 bg-gray-500" >Musekiwa</td>
      <td class="border px-4 py-4 bg-gray-500" >Musekiwa</td>
      <td class="border px-4 py-4 bg-gray-500" >Musekiwa</td>
			<?php
	
	
	?>	
      </tbody>
    </table>
    <div class="flex items-center justify-between">
            <div class="inline-flex">
              <button class=" text-green-500 bg-white-600 hover:text-white hover:bg-green-500 font-bold py-2 px-4 rounded"> <a href="Update.php">
                Update
              </button>
              <button class="text-red-500 bg-white-600 hover:text-white hover:bg-red-500 font-bold py-2 px-4 rounded">
                Cancel
              </button>
            </div>
  </div>

</body>

</html>