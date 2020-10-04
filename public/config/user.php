
<?php

  require_once("../config/config.php");

	   $conn = mysqli_connect($servername, $username, $password, $database) or die("There was a problem connecting to the server!");

		$email = $_COOKIE['email'];
		$password = $_COOKIE['password'];

		$query = 
		  "SELECT clientID,email,password,firstName, lastName FROM clients WHERE email =\"" . $email ."\"";
		  $result = mysqli_query($conn, $query) or die("Could not execute query");

		  if($row = $result->fetch_assoc()){
		  
				if($row["email"] == $email){

					
						define("EMAIL", $row['email']);
						define("FIRSTNAME", $row['firstName']);
						define("LASTNAME", $row['lastName']);
						define("CONTACT_NUMBER", $row['contactNumber']);
						define("CLIENTID", $row['clientID']);
					
					

				}
				else{
					echo " <script type='text/javascript'>alert('This email is not resigestered!');</script>";
				}


		    
		  }
		  else{
			echo " <script type='text/javascript'>alert('This email is not resigestered!');</script>";
		   }
		mysqli_close($conn);



?>
