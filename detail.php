<?php 
	session_start();

	include('Classes/connection_pdo.php');

	$_SESSION['ro10app'] = "puwadon.sa@jasmine.com";

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
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Bootstrap 101 Template</title>
	<!--CSS Datatables-->
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://datatables.net/release-datatables/extensions/ColVis/css/dataTables.colVis.css">

	<!-- Bootstrap Theme -->
	<link href="lumen/bootstrap.css" rel="stylesheet">
	<link href="2/css/font-awesome.min.css" rel="stylesheet">
	<link href="2/css/bootswatch.css" rel="stylesheet">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="//code.jquery.com/jquery-1.12.3.min.js"></script>
	<!--JS datatable-->
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<!--Fixed header datatable-->
	<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
	<!--JS Fixed datatable -->
	<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
	<!--JS ColVision -->
	<script type="text/javascript" language="javascript" src="https://datatables.net/release-datatables/extensions/ColVis/js/dataTables.colVis.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		//Button Function go back to previous page
  		function goBack() {
    		window.history.back();
  		}
	</script>
	<style>
    .bg-white{
      background-color: #FFFFFF;
    }
    .logo-box{
      height: 27px;

    }
    .search-button{
      padding-top: 23px;
    }
    .margin-side{
      margin: 0px 15px;
    }
    thead{
      background-color:white;
  }
  .navbar-fixed {
    top: 0;
    z-index: 100;
  position: fixed;
    width: 100%;
  }
  #nav_bar {
    border: 0;
    background-color: #ffffff;
    border-radius: 0px;
    margin-bottom: 0;
  }

  </style>

</head>
<body class="bg-default">
	<?php include('header.php') ?>
	<form action="update-success.php" method="post">
		<?php
				foreach ($query as $key => $row) {
	
		?>
		
		<div class="container">
			<div class="panel panel-primary">
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
											<input class="form-control" type="text" name="id"  placeholder="id.1234" value="<?php echo $row['id']; ?>" readonly />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ประเภท</label>
											<select class="form-control" name="type" id="type"  ?>
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
											<input class="form-control" type="text" name="project_name" placeholder="ระบุชื่อโครงการ" value="<?php echo $row['project_name']; ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ผู้ก่อตั้ง</label>
											<input class="form-control" type="text" name="builder" placeholder="ระบุชื่อ" value="<?php echo $row['builder']; ?>"  >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">จังหวัด</label>
											<input class="form-control" type="text" name="province" placeholder="ระบุจังหวัด" value="<?php echo $row['province']; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="">เขต/อำเภอ</label>
											<input class="form-control" type="text" name="district" placeholder="ระบุเขตหรืออำเภอ" value="<?php echo $row['district']; ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">แขวง/ตำบล</label>
											<input class="form-control" type="text" name="sub_district" placeholder="ระบุแขวงหรือตำบล" value="<?php echo $row['sub_district']; ?>" />
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
									<div class="tab-pane fade in active" id="open">
										<div class="row">
											<div class="col-md-6">

												<div class="form-group">
													<label for="">location code</label>
													<input class="form-control" type="text" name="location_code" placeholder="ระบุ location code" value="<?php echo $row['location_code']; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="">location name</label>
													<input class="form-control" type="text" name="location_name" placeholder="ระบุ location name" value="<?php echo $row['location_name']; ?>">
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="">พิกัด</label>
													<input class="form-control" type="text" name="location_lat_long" placeholder="ระบุ พิกัด"  value="<?php echo $row['location_lat_long']; ?>" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="">Remark</label>
													<input class="form-control" type="text" name="remark" placeholder="ระบุ remark" value="<?php echo $row['remark']; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="">nodeใกล้เคียง</label>
													<input class="form-control" type="text" name="node_nearby" placeholder="ระบุ nodeใกล้เคียง" value="<?php echo $row['node_nearby']; ?>">
												</div>
											</div>

										</div>
										
									</div>
									<div class="tab-pane fade" id="close">
										<p><strong>ระบุมายเหตุ</strong></p><hr>
										
										<textarea style="text-indent:5px;" class="form-control danger" name="remark" id="" cols="30" rows="3" placeholder="ระบุหมายเหตุกำกับ"><?php echo trim($row['remark']); ?></textarea>
      									
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="">ผู้รับผิดชอบโครงการ</label>
											<input class="form-control" type="text" name="sale_personal" placeholder="นายมงคล วงศ์สุวรรณ" value="<?php echo $row['sale_personal_id']; ?>" readonly >
										</div>
									</div>
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