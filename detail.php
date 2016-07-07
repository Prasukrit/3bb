<?php 
	session_start();

	include('Classes/connection_pdo.php');
	include_once("Classes/connection_mysqli_sales.php");
        //--Important--//
        include ('./session_validate.php');

	$db = new DB();

	if(isset($_GET["id"])){
	   	$get_id = $_GET["id"];
   	}
?>

<?php 
		
		$sql = "SELECT * FROM project where id =".$get_id ;
		$query = $db->query($sql);
		$query = $db->bind(':id',$get_id);
		$query = $db->execute();
		$query = $db->fetch();
		
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>แก้ไขข้อมูลโครงการ</title>

        <!--CSS PACKS-->
        <?php include('./css_packs.html') ?>

        <!--SCRIPT PACKS-->
        <?php include('./script_packs.html') ?>
	<!--JS ColVision -->
	<script type="text/javascript" language="javascript" src="https://datatables.net/release-datatables/extensions/ColVis/js/dataTables.colVis.js"></script>

	<script type="text/javascript">
		//Button Function go back to previous page
  		function goBack() {
    		window.history.back();
  		}
	</script>

</head>
<body class="bg-default">
	<?php include('header.php') ?>
	<form action="update-success.php" method="post">
		<?php
				foreach ($query as $key => $row) {
	
		?>
		
		<div class="container">
			<div class="panel panel-primary animated fadeIn">
				<div class="panel-heading">
					<h3 class="panel-title">ข้อมูลโครงการ</h3>
				</div>
				<!--/panel header-->
				<div class="panel-body">
					<div class="row">
						<div class="margin-side">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ID.</label>
											<input class="form-control input-sm" type="text" name="id"  placeholder="id.1234" value="<?php echo $row['id']; ?>" readonly />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ประเภท</label>
											<select class="form-control input-sm" name="type" id="type"  ?>
												">
												<option value="" <?php if($row['type']==''){
													echo "selected='selected'";
												} ?>>--กรุณาเลือก--</option>
												<option value="คอนโด" <?php if($row['type']=='คอนโด'){
													echo "selected='selected'";
												} ?>>คอนโด</option>
												<option value="หมู่บ้านจัดสรรค์" <?php if($row['type']=='หมู่บ้านจัดสรรค์'){
													echo "selected='selected'";
												} ?>>หมู่บ้านจัดสรรค์</option>
												<option value="อพาทเม้น" <?php if($row['type']=='อพาทเม้น'){
													echo "selected='selected'";
												} ?>>อพาทเม้น</option>
												<option value="หอพักเอกชน" <?php if($row['type']=='หอพักเอกชน'){
													echo "selected='selected'";
												} ?>>หอพักเอกชน</option>
												<option value="บ้านเดี่ยว" <?php if($row['type']=='บ้านเดี่ยว'){
													echo "selected='selected'";
												} ?>>บ้านเดี่ยว</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ชื่อโครงการ</label>
											<input class="form-control input-sm" type="text" name="project_name" placeholder="ระบุชื่อโครงการ" value="<?php echo $row['project_name']; ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ผู้จัดสรรโครงการ</label>
											<input class="form-control input-sm" type="text" name="builder" placeholder="ระบุชื่อ" value="<?php echo $row['builder']; ?>"  >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">จังหวัด</label>
											<input class="form-control input-sm" type="text" name="province" placeholder="ระบุจังหวัด" value="<?php echo $row['province']; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="">เขต/อำเภอ</label>
											<input class="form-control input-sm" type="text" name="district" placeholder="ระบุเขตหรืออำเภอ" value="<?php echo $row['district']; ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">แขวง/ตำบล</label>
											<input class="form-control input-sm" type="text" name="sub_district" placeholder="ระบุแขวงหรือตำบล" value="<?php echo $row['sub_district']; ?>" />
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">ที่อยู่</label>
											<textarea style="text-indent:5px;" class="form-control" name="address" id="" cols="30" rows="3" placeholder="ระบุที่อยู่"><?php echo trim($row['address']); ?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/margin-left-side-->

						<div class="margin-side">
							<div class="col-md-6">
								<ul class="nav nav-tabs">
									<li role="presentation" class="active">
										<a href="#open" data-toggle="tab" > <i class="glyphicon glyphicon-ok" style="color:green;" ></i>
											&nbsp;&nbsp;ให้บริการ
										</a>
									</li>
									<li role="presentation">
										<a href="#close" data-toggle="tab" > <i class="glyphicon glyphicon-remove" style="color:red;"></i>
											&nbsp;&nbsp;ไม่ได้ให้บริการ
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<!--ให้บริการ-->
									<div class="tab-pane fade in active" id="open">
										<div class="row">
											<div class="col-md-6">

												<div class="form-group">
													<label for="">location code</label>
													<input class="form-control input-sm" type="text" name="location_code" placeholder="ระบุ location code" value="<?php echo $row['location_code']; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="">location name</label>
													<input class="form-control input-sm" type="text" name="location_name" placeholder="ระบุ location name" value="<?php echo $row['location_name']; ?>">
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="">พิกัด</label>
													<input class="form-control input-sm" type="text" name="location_lat_long" placeholder="ระบุ พิกัด"  value="<?php echo $row['location_lat_long']; ?>" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="">หมายเหตุ</label>
													<input class="form-control input-sm" type="text" name="remark" placeholder="ระบุ remark" value="<?php echo $row['remark']; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="">nodeใกล้เคียง</label>
													<input class="form-control input-sm" type="text" name="node_nearby" placeholder="ระบุ nodeใกล้เคียง" value="<?php echo $row['node_nearby']; ?>">
												</div>
											</div>
										</div>
									<?php  
									
									$user_code = $row['sale_personal_id']; // testdb ของอีกอันนึง

									// Query ของ portal 
									$sql_sale = "SELECT * FROM rx_user where user_code ='".trim($user_code)."' limit 1 ";
									$row_sale = mysqli_query($conn_sale, $sql_sale);
									while($result = mysqli_fetch_assoc($row_sale)) { ?>

										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label for="">รหัสพนักงาน</label>
													<input class="form-control input-sm" type="text" name="sale_personal" placeholder="รหัสพนักงาน" readonly value="<?php echo $result['user_code']; ?>" >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="">ผู้รับผิดชอบโครงการ</label>
													<input class="form-control input-sm" type="text" name="sale_personal" placeholder="ชื่อผู้รับผิดชอบโครงการ" readonly <?php if(empty($result["user_code"])){
															echo "value=''";
														}else{
															echo "value='".$result["user_name"]."'";
														} ?>  
													>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
									<!--/ให้บริการ -->
									<!--ไม่ได้ให้บริการ -->
									<div class="tab-pane fade" id="close">
										<p><strong>ระบุมายเหตุ</strong></p><hr>
										
										<textarea style="text-indent:5px;" class="form-control danger" name="remark" id="" cols="30" rows="3" placeholder="ระบุหมายเหตุกำกับ"><?php echo trim($row['remark2']); ?></textarea>
									</div>
									<!--/ไม่ได้ให้บริการ -->
								</div>

								
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="col-lg-12" for="">สถานะแสดงผล</label>
											<div class="col-lg-4">
												<div class="radio">
													<label>
														<input type="radio" name="status" id="status" value="0" <?php if($row["status"]==0){ echo "checked=''"; } ?>>แสดง
													</label>
												</div>
											</div>	
											<div class="col-lg-4">
												<div class="radio">
													<label>
														<input type="radio" name="status" id="status" value="1" <?php if($row["status"]==1){ echo "checked=''"; } ?>>ซ่อน
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/margin right side -->
					</div>
				</div>
				<!--/panel body -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="goBack()" >ยกเลิก</button>
					<input type="submit" class="btn btn-primary" value="บันทึกข้อมูล" />
				</div>
				<!--/panel footer-->
			</div>
			<!--/panel box-->
		</div>
		<!-- /container -->
		<?php } //End foreach ?>
	</form>
</body>
</html>