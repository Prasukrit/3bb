<?php 
	
	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "portal";
	$myTable = "rx_user";
	// Create connection
	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	mysqli_set_charset($conn, "utf8"); // Change latin charset to UTF-8 charset for MSQL
	/* END DB Config and connection */

 ?>