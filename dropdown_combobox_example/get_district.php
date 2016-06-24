<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<?php include('../Classes/connection_pdo.php');
		$db = new DB();
	 ?>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
</head>
<body>
	<?php 

		$sql = "SELECT * FROM tbl_district WHERE amphur_id = '".$_POST["amphur_id"]."'" ;
		$query = $db->query($sql);
		$query = $db->execute();
		$query = $db->fetch();
		?>
		<option value="">-- Select District --</option>
		<?php
		foreach ($query as $row) { ?>
			
			<option value="<?php echo $row["disctrict_id"]; ?>" >
				<?php echo $row["DISTRICT_NAME"]; ?>	
			</option>

		<?php	} ?>
	
</body>
</html>