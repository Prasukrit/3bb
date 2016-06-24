 <?php
	
	$conn=mysqli_connect("","root","","testdb");

	$project_id = $_GET['id'];
	$status = $_GET['status'];  

	// Check connection
	if (mysqli_connect_errno())
	{
	    echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	header("Location: index.php");

	if($status == 0){
		$sql = "UPDATE project SET status = 1 WHERE id = '$project_id' limit 1";
	}

	if (!mysqli_query($conn,$sql))
	{
	    die('Error: ' . mysqli_error($conn));
	}

	$objQuery = mysqli_query($conn,$sql);

?>

