<?php 
	
	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "portal";
	$myTable = "rx_user";
	// Create connection
	$conn_sale = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	if (!$conn_sale) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	mysqli_set_charset($conn_sale, "utf8"); // Change latin charset to UTF-8 charset for MSQL
	/* END DB Config and connection */

 ?>