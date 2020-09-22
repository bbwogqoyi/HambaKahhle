<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <title>Assign Driver</title>

  <style>
    #menu-toggle:checked+#menu {
      display: block;
    }

    #searchBar:focus + #searchBtn{
      display: flex;
    }

  </style>
</head>

<body class="antialiased bg-gray-200">
  <!-- Top Navbar -->
  <?php
    require_once("../component_partials/topbar.nav.php");
  ?>

  <!-- Page Content-->
  <div class="mt-16 py-8 px-6 mx-auto bg-white flex flex-wrap items-center w-full lg:w-4/5">
    <!-- Searchbar + Cancel Button -->
    <div class="flex justify-between w-full items-center mb-10"> 
      <?php
        require_once("../component_partials/searchbar.php");
        echo searchbar('index.php');
      ?>

      <a href="#" onclick="history.go(-1);" class="bg-red-300 hover:bg-red-700 text-white font-bold py-2 px-10 rounded">
        Cancel
      </a>
    </div>

    <!-- Content Table -->
    <?php
      require_once("./admin.driver.list.php");
    ?>
  </div>

</body>
</html>