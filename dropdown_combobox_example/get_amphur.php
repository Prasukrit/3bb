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

		$sql = "SELECT * FROM tbl_amphur WHERE province_id = '".$_POST["province_id"]."'" ;
		$query = $db->query($sql);
		$query = $db->execute();
		$query = $db->fetch();
		?>

		<option value="">-- Select Amphur --</option>
		<?php
		foreach ($query as $row) { ?>
			
			<option value="<?php echo $row["AMPHUR_ID"]; ?>" >
				<?php echo $row["AMPHUR_NAME"]; ?>	
			</option>

		<?php	} ?>
	
</body>
</html>