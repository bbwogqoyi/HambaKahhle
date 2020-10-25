	 	<?php
	 require_once("../config/config.php");
	 
	$conn = mysqli_connect($servername, $username, $password, $database) or die("Could not connect to database!");
	
		
		$query = "SELECT * FROM driver" ;
		
		$result = mysqli_query($conn, $query) or die("Could not execute query");
		

		while($row = $result->fetch_assoc()){
				
			echo " name: " . $row["firstName"] . "</td><br>";
		        echo " surname: " . $row["lastName"] . "</td><br>";
		         echo " town: " . $row["hometown"] . "</td><br>";
			echo " num: " . $row["contactNumber"] . "</td><br>";
			echo "drverid: " . $row["driverID"] . "</td><br>";
			echo "email: " . $row["email"] . "</td><br>";
			echo "password: " . $row["password"] . "</td>";

          }
		
				mysqli_close($conn);
	
	?>		
       		