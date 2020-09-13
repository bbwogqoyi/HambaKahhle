<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <title>Log In</title>
</head>

<body class="bg-grey-100 h-screen font-sans">
    <form action="login.php" method="POST">

  <div class="container mx-auto h-full flex justify-center items-center">
    <div class="w-2/3 lg:w-1/3">
      <h1 class="font-light text-4xl mb-6 text-center">Log In</h1>
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
      <div class="text-center">
        <p class="text-grey-dark text-sm">Don't have an account? <a href="#" class="no-underline text-blue font-bold">Create an Account</a>.</p>
    </div>
    </div>
  </div>
  </form>
</body>
<?php

  require_once("../config/config.php");

  if(isset($_REQUEST['submit'])) {
	   $conn = mysqli_connect($servername, $username, $password, $database) or die("There was a problem connecting to the server!");

		$email = $_POST['email'];
		$password = $_POST['password'];

		$query = 
		  "SELECT clientID,email,password FROM clients WHERE email =\"" . $email ."\"";
		  $result = mysqli_query($conn, $query) or die("Could not execute query");

		  if($row = $result->fetch_assoc()){
		  
				if($row["email"] == $email){

					if($row['password'] == $password){
						echo " <script type='text/javascript'>alert('Logged in succesfully');</script>";
						setcookie("email", $email);
						setcookie("password", $password);
							header("Location: ../index.html");
					}
					else{
						echo " <script type='text/javascript'>alert('Incorrect password');</script>";
					}

				}
				else{
					echo " <script type='text/javascript'>alert('This email is not resigestered!');</script>";
				}


		    
		  }
		  else{
			echo " <script type='text/javascript'>alert('This email is not resigestered!');</script>";
		   }
		mysqli_close($conn);

  }else{
	 echo " <script type='text/javascript'>alert('not set');</script>";
  }

?>
</html>