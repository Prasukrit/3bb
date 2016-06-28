<?php
	include('Classes/connection_pdo.php');
	include_once('Classes/connection_mysqli.php');
	//header("Location: manageproject_1.php");
	$db = new DB();

	if(isset($_POST["sale_id"])){
		$sale_id = $_POST["sale_id"];
		$sale_name = $_POST["sale_name"];
	}

	if (isset($_POST["project_id"])) {
		$project_id = $_POST["project_id"] ;
	}
	// Loop PDO update sale_id
	for($i=0;$i<count($project_id);$i++){
		//Check array value from previous page
		//echo "array:".$i." : ".$project_id[$i]."<br>"; 

		$sql_update = "UPDATE project SET 
			sale_personal_id = '".$sale_id."'  
	 		WHERE id = '".$project_id[$i]."' ";
	 		$query = $db->query($sql_update);
			$query = $db->execute();

		//Check value from previous page
		// echo "count: ".count($project_id)."<br>" ;
		// echo $_POST["sale_name"]." | ";
		// echo $_POST["sale_id"];
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Bootstrap 101 Template</title>

	<!--CSS Cutom กำหนดค่าเอง-->
	<link rel="stylesheet" href="css_custom/custom.css">
	<!--Animated effect transition Doc : https://github.com/daneden/animate.css --> 
	<link rel="stylesheet" href="css_custom/animate.css">

	<!-- Datatable CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.2/css/bootstrap.css">  
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap4.min.css">  
	<link rel="stylesheet" charset="utf8" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">  
	<link rel="stylesheet" charset="utf8" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">  
	<link rel="stylesheet" charset="utf8" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">  

	<!-- Bootstrap Theme -->  
	<link href="lumen/bootstrap.css" rel="stylesheet">  
	<link href="2/css/font-awesome.min.css" rel="stylesheet">  
	<link href="2/css/bootswatch.css" rel="stylesheet"> 

	<!-- JQUERY -->  
	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.3.js"></script>
	<!--JQUERY Bootstrap theme -->  
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  	<!-- DataTable -->  
  	<script type="text/javascript" charset="utf8"  src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap4.min.js"></script>
  	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
  	<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
  	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
  	<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>

  	<!--Button Datatable-->  
  	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.flash.min.js"></script>
  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  	<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  	<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
  	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
  	<script type="text/javascript" src="media/js/jquery.checkAll.js"></script>
	<script>
    	$(document).ready(function(){

			// English menu --> Thai menu เพิ่มส่วนนี้เข้าไปจะถือว่าเป็นการตั้งค่าให้ Datatable เป็น Default ใหม่เลย
	        $.extend(true, $.fn.dataTable.defaults, {
	            "language": {
	              "sProcessing": "กำลังดำเนินการ...",
	              "sLengthMenu": "แสดง_MENU_ แถว",
	              "sZeroRecords": "ไม่พบข้อมูล",
	              "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
	              "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
	              "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
	              "sInfoPostFix": "",
	              "sSearch": "ค้นหา:",
	              "sUrl": "",
	              "oPaginate": {
	                            "sFirst": "เิริ่มต้น",
	                            "sPrevious": "ก่อนหน้า",
	                            "sNext": "ถัดไป",
	                            "sLast": "สุดท้าย"
	              }
	             }
	        });

	        //Datatable customization
	        var table = $('#example').DataTable({
	        	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		      	'order': [[0, 'desc']],
	    	});
	    	
	  	});
	  	//Button Function go back to previous page
  		function goBack() {
    		window.history.back();
  		}

	</script>
	<style>
		#footer {
	    position: fixed;
	    left: 0px;
	    bottom: 0px;
	    height: 45px;
	    width: 100%;
	    margin-bottom: -1px;
	    background-color: #FFEBEE;
	    z-index: 1000;
	    color:gray;
    	}
	</style>
</head>
<body>
	<?php include('header.php') ?>
	<div class="container">
	<div class="box animated fadeInDown">
		<h1 align="center"><i class="glyphicon glyphicon-ok-sign" style="color:green"></i>    อัพเดทผู้รับผิดชอบโครงการเสร็จสมบูรณ์ !!</h1>
	</div>
		<hr>
			<div class="col-lg-3">
				<div class="well well-lg" style="background-color:#d9edf7;">
				  	<p><strong><u>ผู้รับผิดชอบโครงการ</u></strong></p>
				  	<p><?php echo "รหัสพนักงาน : ".$sale_id."" ?></p>
				  	<p><?php echo "ชื่อ : ".$sale_name."" ?></p>
				</div>
				<hr>
				<a href="index.php" class="btn btn-danger" style="width:100%;"><i class="glyphicon glyphicon-home"></i>&nbsp;กลับสู่หน้าแรก</a>
			</div>
			<div class="col-lg-9">
				<table class="table table-hover table-bordered">
				
				<tr class="active">
					<th>Location_code</th>
					<th>ชื่อโครงการ</th>
					<th>ผู้จัดสรรโครงการ</th>
					<th>จังหวัด</th>
					<th>เขต/อำเภอ</th>
					<th>ประเภท</th>
				</tr>
					
					
				
				<?php
				if(!empty($project_id)){

					for($i=0;$i<count($project_id);$i++){
					$sql = "SELECT * FROM project WHERE id='$project_id[$i]'";
					$query = mysqli_query($conn, $sql);

					while($row = mysqli_fetch_assoc($query)){
					?>
					<tr>
						<td>
							<?php echo $row["location_code"]; ?>
						</td>

						<td>
							<?php echo $row["project_name"]; ?>
						</td>
						<td>
							<?php echo $row["builder"]; ?>
						</td>
						<td>
							<?php echo $row["province"]; ?>
						</td>
						<td>
							<?php echo $row["district"]; ?>
						</td>
						<td>
							<?php echo $row["type"]; ?>
						</td>
					</tr>
				<?php 
					}
				}

				}else { ?>
					<tr >
						<td colspan="6">ไม่พบข้อมูลผู้รับผิดชอบโครงการ</td>
					</tr>
				<?php } ?> 
				
					
				</table>
			</div>
		
	</div>
</body>
</html>
