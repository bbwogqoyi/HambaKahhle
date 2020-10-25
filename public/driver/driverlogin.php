
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <title>Drivers Log In</title>
    
</head>

<body class="bg-grey-100 h-screen font-sans">

	<?php

  require_once("../config/config.php");

 if(!isset($_COOKIE["driverID"])) {
	  if(isset($_REQUEST['submit'])) {
		   $conn = mysqli_connect($servername, $username, $password, $database) or die("There was a problem connecting to the server!");

			$email = $_POST['email'];
			$password = $_POST['password'];

			$query = 
			  "SELECT driverID,email,password FROM driver WHERE email ='$email'" ;
			  $result = mysqli_query($conn, $query) or die("Could not execute query");

			  if($row = $result->fetch_assoc()){
		  
					if($row["email"] == $email){

						if($row['password'] == $password){
							;
							setcookie("email", $email,time() + 3600, '/');
							setcookie("driverID", $row["driverID"],time() + 3600, '/');
								header("Location: ../driver/driverdashboard.php");
						}
						else{
							
						}

					}
					else{
						
					}


		    
			  }
			  else{
			  echo '<script>showNoExist();</script>';
			   }
			mysqli_close($conn);

	  }else{
	  }
}
else{
	header("Location: ../driver/driverdashboard.php");
}


?>

	 <header class="bg-white lg:py-0 py-2">
        <div class="w-full flex flex-wrap items-center md:w-3/4 px-6 md:px-0 md:mx-auto">
            <div class="flex-1 flex justify-between items-center">
                <a href="#">
                    <svg class="w-20 h-20" viewBox="0 0 261 220" fill="none">
                        <path d="M.634 176v-35.547h12.451c4.313 0 7.585.83 9.814 2.49 2.23 1.644 3.345 4.061 3.345 7.251 0 1.742-.447 3.28-1.343 4.615-.895 1.318-2.14 2.286-3.735 2.905 1.823.456 3.255 1.375 4.297 2.759 1.058 1.383 1.587 3.076 1.587 5.078 0 3.418-1.09 6.006-3.272 7.763-2.18 1.758-5.29 2.653-9.326 2.686H.634zm7.324-15.479v9.595h6.274c1.726 0 3.069-.407 4.029-1.22.976-.831 1.465-1.97 1.465-3.418 0-3.256-1.685-4.908-5.054-4.957H7.958zm0-5.175h5.42c3.695-.065 5.542-1.538 5.542-4.419 0-1.612-.472-2.767-1.416-3.467-.928-.716-2.4-1.074-4.419-1.074H7.958v8.96zM66.392 170.116h15.551V176H59.067v-35.547h7.325v29.663zM133.224 168.676h-12.842L117.94 176h-7.788l13.233-35.547h6.787L143.478 176h-7.789l-2.465-7.324zm-10.865-5.933h8.887l-4.468-13.305-4.419 13.305zM200.666 164.159c-.277 3.825-1.693 6.836-4.248 9.033-2.539 2.198-5.892 3.296-10.059 3.296-4.557 0-8.146-1.53-10.766-4.59-2.604-3.076-3.906-7.291-3.906-12.646v-2.173c0-3.418.602-6.429 1.806-9.033 1.205-2.604 2.922-4.598 5.152-5.982 2.246-1.399 4.85-2.099 7.812-2.099 4.102 0 7.406 1.098 9.912 3.296 2.507 2.197 3.955 5.281 4.346 9.253h-7.324c-.179-2.295-.822-3.955-1.929-4.981-1.091-1.041-2.759-1.562-5.005-1.562-2.441 0-4.272.879-5.493 2.636-1.205 1.742-1.823 4.452-1.856 8.13v2.686c0 3.841.578 6.649 1.734 8.423 1.172 1.774 3.011 2.661 5.517 2.661 2.263 0 3.947-.513 5.054-1.538 1.123-1.042 1.766-2.645 1.929-4.81h7.324zM243.108 161.742l-3.808 4.102V176h-7.324v-35.547h7.324v16.113l3.222-4.419 9.058-11.694h9.009l-12.622 15.796L260.955 176h-8.716l-9.131-14.258zM36.857 207.476V220h-7.324v-35.547H43.4c2.67 0 5.013.488 7.032 1.465 2.034.977 3.597 2.368 4.687 4.175 1.09 1.79 1.636 3.833 1.636 6.128 0 3.483-1.196 6.233-3.589 8.252-2.376 2.002-5.672 3.003-9.888 3.003h-6.42zm0-5.933H43.4c1.937 0 3.41-.456 4.42-1.367 1.025-.912 1.537-2.214 1.537-3.906 0-1.742-.512-3.15-1.538-4.224-1.025-1.074-2.441-1.628-4.248-1.66h-6.714v11.157zM109.695 204.595H95.633v9.521h16.504V220H88.309v-35.547h23.779v5.933H95.633v8.471h14.062v5.738zM163.002 212.676H150.16L147.719 220h-7.788l13.232-35.547h6.787L173.256 220h-7.788l-2.466-7.324zm-10.864-5.933h8.886l-4.467-13.305-4.419 13.305zM214.209 205.742l-3.809 4.102V220h-7.324v-35.547h7.324v16.113l3.223-4.419 9.058-11.694h9.008l-12.622 15.796L232.056 220h-8.716l-9.131-14.258zM129.5 0L172 67l45 68-76-58.5 10.5-27L41 135 129.5 0z"
                              fill="#000" />
                    </svg>
                </a>
            </div>

            <label for="menu-toggle" class="pointer-cursor lg:hidden block">
                <svg class="fill-current text-gray-900"
                     xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <title>menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                </svg>
            </label>
            <input class="hidden" type="checkbox" id="menu-toggle" />

            <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
                <nav>
                    <ul class="pt-4 lg:pt-0 lg:flex items-center justify-between text-base text-gray-700">
                        <li>
                            <a class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent md:hover:border-indigo-400 font-semibold text-indigo-400 lg:border-indigo-400"
                               href="#">Bookings</a>
                        </li>
                        <li>
                            <a class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent md:hover:border-indigo-400"
                               href="#">Home</a>
                        </li>
                        <li>
                            <a class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent md:hover:border-indigo-400 lg:mb-0 mb-2"
                               href="#">About</a>
                        </li>
                    </ul>
                </nav>
              

            </div>
        </div>


    </header>

    <form action="driverlogin.php" method="POST">

  <div class="container mx-auto h-full flex justify-center items-center">
    <div class="w-2/3 lg:w-1/3">
      <h1 class="font-light text-4xl mb-6 text-center">Driver Log In</h1>
      <div class="border-blue-500 p-8 border-t-8 bg-white mb-6 rounded-lg shadow-lg">
        <div class="mb-4">
          <label class="font-bold text-grey-darker block mb-2">
            Username or Email
          </label>
          <input type="text" name="email" id="email"
            class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
            placeholder="n.nkomo@campus.ru.ac.za" />
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
            <input type="submit" name="submit" id="submit" value="Login" class="bg-blue-600 hover:bg-teal text-white font-bold py-2 px-4 rounded" />
             
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
  </div>
  </form>
   <!-- Record Saved Notification -->
  <div id="noExistNote" class="hidden fixed top-0 mx-auto w-full">
    <div class="m-auto w-full md:w-1/4">
      <div class="bg-white rounded-lg border-gray-300 border p-3 shadow-lg">
        <div class="flex flex-row">
          <div class="px-2">
            <svg width="24" height="24" viewBox="0 0 1792 1792" fill="#44C997" xmlns="http://www.w3.org/2000/svg">
              <path d="M1299 813l-422 422q-19 19-45 19t-45-19l-294-294q-19-19-19-45t19-45l102-102q19-19 45-19t45 19l147 147 275-275q19-19 45-19t45 19l102 102q19 19 19 45t-19 45zm141 83q0-148-73-273t-198-198-273-73-273 73-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273zm224 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/>
              </svg>
          </div>
          <div class="ml-2 mr-6">
            <span class="font-semibold">Log in</span>
            <span class="block text-gray-500">This user does not exist</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Record Saved Notification -->
  <div id="wrongNote" class="hidden fixed top-0 mx-auto w-full">
    <div class="m-auto w-full md:w-1/4">
      <div class="bg-white rounded-lg border-gray-300 border p-3 shadow-lg">
        <div class="flex flex-row">
          <div class="px-2">
            <svg width="24" height="24" viewBox="0 0 1792 1792" fill="#44C997" xmlns="http://www.w3.org/2000/svg">
              <path d="M1299 813l-422 422q-19 19-45 19t-45-19l-294-294q-19-19-19-45t19-45l102-102q19-19 45-19t45 19l147 147 275-275q19-19 45-19t45 19l102 102q19 19 19 45t-19 45zm141 83q0-148-73-273t-198-198-273-73-273 73-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273zm224 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/>
              </svg>
          </div>
          <div class="ml-2 mr-6">
            <span class="font-semibold">Log in</span>
            <span class="block text-gray-500">The password is incorrect!</span>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

</html>