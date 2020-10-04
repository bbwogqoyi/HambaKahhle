<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="../../css/tailwind.css" />
  <link rel="stylesheet" href="../../css/custom.css" />
  <title>Vehicle</title>

  <style>
    #menu-toggle:checked+#menu {
      display: block;
    }

  </style>
</head>

<body class="bg-grey-100 h-screen font-sans">
  <div class="container mx-auto h-full flex justify-center items-center">
    <div class="w-2/3 lg:w-1/3">
      <h1 class="font-light text-4xl mb-6 text-center">Add Vehicle</h1>
      <form id="newUserForm" action="add_vehicle.php" method="POST" onsubmit="return validateRegistation();">
        <div class="border-blue-500 p-8 border-t-8 bg-white mb-6 rounded-lg shadow-lg">

          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Registration Numer
            </label>
            <input type="text" id="firstname" name="RegNum"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="Registration Numer" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Purchse Date
            </label>
            <input type="Date" id="lastname" name="PurchDate"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="Purchse Date" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Number of Seats
            </label>
            <input type="number" id="email" name="numOfseats"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="Number of Seats" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Make
            </label>
            <input type="text" id="contact" name="Make"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="Make" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Model
            </label>
            <input type="text" id="password" name="model"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="Model" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Year
            </label>
            <input type="year" id="confirm_password" name="Year"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="Year" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              License Code
            </label>
            <input type="text" id="confirm_password" name="liceCode"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="License Code" />
          </div>
          <div class="inline-flex">
            <div class="flex items-center">
              <button type="submit" id="newVehicle" name="newVehicle" class="bg-blue-600 hover:bg-teal text-white font-bold py-2 px-4 rounded">
              Add Vehicle
              </button>
            </div>
            <div class="flex items-center ml-2">
              <button type="button" class="bg-red-600 hover:bg-teal text-white font-bold py-2 px-4 rounded">
                Cancel
              </button>
            </div>
          </div>
        </div>
      </form>
      <div class="text-center">
        <p class="text-grey-dark text-sm">Already have an account? <a href="#"
            class="no-underline text-blue font-bold">Sign In</a>.</p>
      </div>
    </div>
  </div>
</body>

