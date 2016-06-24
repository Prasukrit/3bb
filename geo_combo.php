<?php
	header('Content-type:text/html;charset=UTF-8');
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	//echo "Connected successfully";

	if (!isset($_GET['load'])){
		$_GET['load'] = 'province';
	}
	switch($_GET['load']){
		case 'province':
			$sql = "SELECT * FROM tbl_province ";
			$result = mysqli_query($conn, $sql);
			echo '<option value="0">-- เลือกจังหวัด --</option>';
			while ($row = mysqli_fetch_assoc($result)){
				echo '<option value="',$row['PROVINCE_ID'],'">',
					$row['PROVINCE_NAME'],
				'</option>';
			}
		break;
		case 'amphur':
			$province_id = isset($_GET['province_id'])?intval($_GET['province_id']):0;
			$sql = "SELECT * FROM tbl_amphur WHERE PROVINCE_ID=$province_id";
			$result = mysqli_query($conn, $sql);
			echo '<option value="0">-- เลือกอำเภอ --</option>';
			while ($row = mysqli_fetch_assoc($result)){
				echo '<option value="',$row['AMPHUR_ID'],'">',
					$row['AMPHUR_NAME'],
				'</option>';
			}
		break;
		case 'district':
			$amphur_id = isset($_GET['amphur_id'])?intval($_GET['amphur_id']):0;
			$sql = "SELECT * FROM tbl_district WHERE AMPHUR_ID=$amphur_id";
			$result = mysqli_query($conn, $sql);
			echo '<option value="0">-- เลือกตำบล --</option>';
			while ($row = mysqli_fetch_assoc($result)){
				echo '<option value="',$row['DISTRICT_ID'],'">',
					$row['DISTRICT_NAME'],
				'</option>';
			}
		break;
	}
	function report(){
		return die('<option>'.htmlspecialchars(mysqli_error()).'</option>');
	}
?>