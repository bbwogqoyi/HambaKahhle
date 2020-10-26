<html>
  <body>
		
	<?php

	 require_once("../config/config.php");
		$conn = mysqli_connect($servername, $username, $password, $database) or die("Could not connect to database!");
		
		
		$id = $_REQUEST['id'];
		$status = 4;

		$query = "UPDATE booking SET statusID = '$status' 
WHERE bookingID = $id
";

		$result = mysqli_query($conn, $query) or die("Could not execute query");
		
	echo " <script type='text/javascript'>alert('Successfully Issued final booking,Please wait for confirmation');</script>";




 	mysqli_close($conn);
	header("Location: ../clientdashboard/clientdashboard.php");
	?>
</body>
  </html>
