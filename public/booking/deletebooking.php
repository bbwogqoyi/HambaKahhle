<html>
  <body>
		
	<?php

	 require_once("../config/config.php");
		$conn = mysqli_connect($servername, $username, $password, $database) or die("Could not connect to database!");
		
		$id = $_REQUEST['id'];
		$query = "DELETE FROM daytrip WHERE bookingID = " . $id;

		$result = mysqli_query($conn, $query) or die("Oops!, could not delete");
	
		echo " <script type='text/javascript'>alert('Successfully deleted booking');</script>";

		$query = "DELETE FROM booking WHERE bookingID = " . $id;

		$result = mysqli_query($conn, $query) or die("Oops!, could not delete");
	
		echo " <script type='text/javascript'>alert('Successfully deleted booking');</script>";
		setcookie("message", "Successfully deleted booking",time() + 3600, '/');



 	mysqli_close($conn);
	header("Location: ../clientdashboard/clientdashboard.php");
	
	?>
</body>
  </html>
