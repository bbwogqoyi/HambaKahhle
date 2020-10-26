
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/custom.css" />
  <link rel="stylesheet" href="lgin.css" />
  <title>Log In</title>
</head>

<body class="bg-grey-100 h-screen font-sans">
	<?php

  require_once("../config/config.php");

 if(!isset($_COOKIE["clientID"])) {
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
							setcookie("email", $email,time() + 3600, '/');
							setcookie("clientID", $row["clientID"],time() + 3600, '/');
								header("Location: ../clientdashboard/clientdashboard.php");
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
	  }
}
else{
	header("Location: ../clientdashboard/clientdashboard.php");
}


?>


  

   <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="login.php" method="POST" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
               <input type="text" name="email" id="email"
            class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
            placeholder="n.nkomo@campus.ru.ac.za" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password"
            class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow"
            placeholder="Password" />
            </div>
            <input type="submit" name="submit" id="submit" value="Login" class="btn solid" />
            
            
          </form>
          <form action="#" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" />
            </div>
            <input type="submit" class="btn" value="Sign up" />
            
            
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
              ex ratione. Aliquid!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="lgo.gif" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="lgo.gif" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="appi.js"></script>
</body>

</html>