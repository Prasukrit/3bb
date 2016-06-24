<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<?php 
		include('../Classes/connection_pdo.php');
		$db = new DB();
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript">
		
		function getAmphur(val){
			$.ajax({
				type:"POST",
				url: "get_amphur.php",
				data: 'province_id='+val,
				success: function(data){
					$("#amphur").html(data);
				}
			});
			//alert("OK");
		}
		function getDistrict(val){
			$.ajax({
				type:"POST",
				url: "get_district.php",
				data: 'amphur_id='+val,
				success: function(data){
					$("#district").html(data);
				}
			});
			//alert("OK");
		}

		function showMsg(){
			$("#msgP").html($("#province option:selected").text());
			$("#msgA").html($("#amphur option:selected").text());
			$("#msgD").html($("#district option:selected").text());
			return false;
		}
	</script>
</head>
<body>
	<?php 
		$sql = "SELECT * FROM tbl_province";
		$query = $db->query($sql);
		$query = $db->execute();
		$query = $db->fetch();
	 ?>
	<form action="">
	<label for="">Province : </label>
	<select name="" id="province" onChange="getAmphur(this.value);">
		<option value="">-- Select Province --</option>
		<?php foreach ($query as $key => $row) { ?>
				
			
			<option value="<?php echo $row['PROVINCE_ID']; ?>" >
				<?php echo $row['PROVINCE_NAME']; ?>	
			</option>
		<?php }	 ?>
	</select>
	
	<label for="">Amphur : </label>
	<select name="" id="amphur" onChange="getDistrict(this.value);">
		<option value="">-- Select Amphur --</option>
	</select>

	<label for="">District : </label>
	<select name="" id="district">
		<option value="">-- Select Disctrict --</option>
	</select>

	<button value="search" onClick="return showMsg()">Search</button>
	</form>

	Select province : <span id="msgP"></span><br>
	Select amphur : <span id="msgA"></span><br>
	Select district : <span id="msgD"></span>
</body>
</html>