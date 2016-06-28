<?php
	include('Classes/connection_pdo.php');

	header("Location: index.php");

	$db = new DB();

	$sql = "UPDATE project SET 
			id = '".$_POST["id"]."' ,
			project_name = '".$_POST["project_name"]."' ,
			province = '".$_POST["province"]."' ,
			district = '".$_POST["district"]."' ,
			sub_district = '".$_POST["sub_district"]."',
			address = '".$_POST["address"]."' ,
			builder = '".$_POST["builder"]."' ,
			location_lat_long = '".$_POST["location_lat_long"]."' ,
			location_code = '".$_POST["location_code"]."' ,
			location_name = '".$_POST["location_name"]."' ,
			remark = '".$_POST["remark"]."' ,
			node_nearby = '".$_POST["node_nearby"]."' ,
			type = '".$_POST["type"]."' ,
			status = '".$_POST["status"]."'
			WHERE id = '".$_POST["id"]."' ";

	$query = $db->query($sql);
	$query = $db->execute();
	$query = $db->single();

?>