<html>
<head>
	<title>Upload excel !!</title>
	<meta http-equiv="refresh" content="2;url=importfile.php">
</head>
	<body>
	<?php
	
	/** PHPExcel */
	require_once 'Classes/PHPExcel.php';

	/** PHPExcel_IOFactory - Reader */
	include 'Classes/PHPExcel/IOFactory.php';
	
	/*echo '
			<pre>';
	var_dump($namedDataArray);
	echo '</pre>
			<hr />
			';
	ECHO "
			<BR>
			";
	ECHO COUNT($namedDataArray);
	ECHO "
			<BR>
			";*/
	//ตาราง แสดงข้อมูล ที่อ่านข้อมูลจาก Excel
	//คอลัมที่ A-J ตามไฟล์ Excel

	//*** Connect to MySQL Database ***//
	$servername = "localhost";
	$username = "root";
	$password = "";
	//$dbname = "node3";
	$dbname = "testdb";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	mysqli_set_charset($conn, "utf8"); // Change latin charset to UTF-8 charset for MSQL



	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$target_dir = "uploads/";
	$target_file = $target_dir .date('Ymd-hs-').basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$file =basename($_FILES["fileToUpload"]["name"]);
	$inputFileName = $file;

	//กำหนดไฟล์ที่ต้องการดึงข้อมูล / จากโฟลเดอร์ที่เก็บหรืออัพโหลดมาเก็บไว้
	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
	$objReader->setReadDataOnly(true);  
	$objPHPExcel = $objReader->load($inputFileName);  


	// ไม่เอา Header เริ่มอ่านข้อมูลที่แถวที่ 4

	$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
	$highestRow = $objWorksheet->getHighestRow();
	$highestColumn = $objWorksheet->getHighestColumn();

	$r = -1;
	$namedDataArray = array();
	for ($row = 2; $row<= $highestRow; ++$row) {
	$dataRow = $objWorksheet->
		rangeToArray('B'.$row.':'.$highestColumn.$row,null, true, true, true);
		if ((isset($dataRow[$row]['B'])) && ($dataRow[$row]['B'] != '')) {
		    ++$r;
		    $namedDataArray[$r] = $dataRow[$row];


		}
	}

	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$excelFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	/* if($excelFileType != "xlsx" || $excelFileType != "xls" ) {
	    echo "Sorry, only XLSX & XLS,  files are allowed.";
	    $uploadOk = 0;
	}*/
	// Check if $uploadOk is set to 0 by an error
	/* if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	}*/ 
   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ".date('Ymd-hs-').basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	

	/*
   Code :
	Insert to Database
	ดึงค่ามาบันทึกลงในฐานข้อมูลที่ออกแบบไว้ ตามฟิลด์ที่ต้องการเก็บข้อมูล อยู่ใน Loop Foreach
	*/

	if(COUNT($namedDataArray) >= 0){
		$i = 0;
		foreach ($namedDataArray as $result) {
			$i++;
			
			if(trim($result["B"]) !=""){

				$strSQL = "INSERT INTO project (province,district,sub_district,project_name,address,builder,location_lat_long,location_code,location_name,node_nearby,remark,status,type) VALUES ('".$result["B"]."','".$result["C"]."','".$result["D"]."','".$result["E"]."','".$result["F"]."','".$result["G"]."','".$result["H"]."','".$result["I"]."','".$result["J"]."','".$result["K"]."','".$result["L"]."','".$result["M"]."','".$result["N"]."')";
				
				//echo $strSQL;
				if (mysqli_query($conn, $strSQL)) {
					$newsuccess = "New record created successfully";
				} else {
					echo "Error: " . $strSQL . "<br>" . mysqli_error($conn);
				}

				
			}
				
		}
		echo "Insert successfully!!" ;
	}
	?>
	</body>
</html>