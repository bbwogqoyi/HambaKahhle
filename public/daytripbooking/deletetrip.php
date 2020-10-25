<html>
  <body>
		
	<?php

	 require_once("../config/config.php");
		$conn = mysqli_connect($servername, $username, $password, $database) or die("Could not connect to database!");
		
		$tripID = $_REQUEST['id'];
		$bookingID = $_REQUEST['bid'];
		$query = "DELETE FROM daytrip WHERE tripNumber = " . $tripID;

		$result = mysqli_query($conn, $query) or die("Oops!, could not delete");
	
		echo " <script type='text/javascript'>alert('Successfully deleted booking');</script>";

		


 	mysqli_close($conn);
	header("Location: ../daytripdashboard/daytripdashboard.php?id='$bookingID'");
	
	?>
</body>
  </html>
