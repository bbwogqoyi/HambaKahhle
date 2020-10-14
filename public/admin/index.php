<!DOCTYPE html>
<html lang="en">
<?php
// import database utils
require_once(dirname(__DIR__) . "../common/utils.php");

if( isset($_COOKIE["employeeID"]) ) {
  header("Location: ./booking/index.booking.php");
}

if( isset($_REQUEST['submit']) ) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = 
    "SELECT email, employeeID, employeeTypeID FROM employee 
      WHERE email='$email' AND password='$password'";

  $result = executeQuery($query);

  if( $result!=null && $row=mysqli_fetch_assoc($result) ){
    $cookieDuration = time() + 3*3600;
    setcookie("email", $row["email"], $cookieDuration, '/');
    setcookie("employeeID", $row["employeeID"], $cookieDuration, '/');
    setcookie("employeeTypeID", $row["employeeTypeID"], $cookieDuration, '/');
    header("Location: ./booking/index.booking.php");
  } 
  else{
    echo " <script type='text/javascript'>alert('This email is not resigestered!');</script>";
  }
}

?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <title>Admin Log In</title>
  <script>
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

    if(getCookie("employeeID").length > 0 ) {
      location.reload();
    }
  </script>
</head>

<body class="bg-gray-100 h-screen font-sans">
  <!-- Top Navbar -->
  <?php
    require_once(dirname(__DIR__) . "../component_partials/admin.topbar.nav.php");
  ?>

  <form action="index.php" method="POST">
    <div class="container mx-auto h-full flex justify-center items-center mt-24">
      <div class="w-2/3 lg:w-1/3">
        <h1 class="font-light text-4xl mb-6 text-center">Staff Log In</h1>
        <div class="border-indigo-400 p-8 border-t-8 bg-white mb-6 rounded-lg shadow-lg">
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Email
            </label>
            <input type="text" name="email" id="email"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="n.nkomo@blackpeakltd.co.za" />
          </div>
          <div class="mb-4">
            <label class="font-bold text-grey-darker block mb-2">
              Password
            </label>
            <input type="password" name="password" id="password"
              class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
              placeholder="Password" />
          </div>
          <div class="flex items-center justify-between">
            <div class="inline-flex">
              <input type="submit" name="submit" id="submit" value="Login" 
                class="bg-indigo-600 hover:bg-teal text-white font-bold py-2 px-4 rounded" />
              <button class="bg-red-600 ml-2 hover:bg-teal text-white font-bold py-2 px-4 rounded">
                  Cancel
              </button>
            </div>

            <a class="no-underline inline-block align-baseline font-bold text-sm text-blue hover:text-blue-dark float-right" href="#">
                Forgot Password?
            </a>
          </div>
        </div>
    </div>
  </form>
</body>
</html>