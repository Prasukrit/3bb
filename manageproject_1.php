<?php 
session_start();
    
$session = $_SESSION['ro10app'] = "woraton.t@jasmine.com";
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('Classes/connection_pdo.php');
include('./Classes/connection_mysqli_sales.php');

$sql_sale_match = "SELECT * FROM rx_user WHERE user_email='" . $session . "'";
$query_sale_match = mysqli_query($conn, $sql_sale_match);
//echo $sql_sale_match;
$row_sale_match = mysqli_fetch_assoc($query_sale_match);
$row_sale_match_id = $row_sale_match["user_code"];
$row_sale_match_name = $row_sale_match["user_name"];
$row_sale_match_email = $row_sale_match["user_email"];


$db = new DB();

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
		<!-- Animate effect transition -->
  		<link rel="stylesheet" type="text/css" href="css_custom/animate.css">
	  	
	  	<!-- Datatable CSS -->
	  	<link rel="stylesheet" href="media/css/bootstrap.css">
	  	<link rel="stylesheet" href="media/css/datatables/dataTables.bootstrap4.min.css">
	  	<link rel="stylesheet" charset="utf8" href="media/css/select/select.dataTables.min.css">
	  	<link rel="stylesheet" charset="utf8" href="media/css/button/buttons.dataTables.min.css">
	  	<link rel="stylesheet" charset="utf8" href="media/css/fixedHeader/fixedHeader.dataTables.min.css">

	  	<!-- Bootstrap Theme -->
	  	<link href="lumen/bootstrap.css" rel="stylesheet">
	  	<link href="2/css/font-awesome.min.css" rel="stylesheet">
	  	<link href="2/css/bootswatch.css" rel="stylesheet">

	  	<!-- JQUERY -->
	  	<script type="text/javascript" charset="utf8" src="media/js/jquery-1.12.3.js"></script>
	  	<!--JQUERY Bootstrap theme -->
	  	<script src="media/js/bootstrap/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	  	<!-- DataTable -->
	  	<script type="text/javascript" charset="utf8"  src="media/js/jquery.dataTables.min.js"></script>
	  	<script type="text/javascript" charset="utf8" src="media/js/datatables/dataTables.bootstrap4.min.js"></script>
	 	<script type="text/javascript" src="media/js/button/dataTables.buttons.min.js"></script>
	  	<script type="text/javascript" src="media/js/select/dataTables.select.min.js"></script>
	  	<script type="text/javascript" charset="utf8" src="media/js/fixedHeader/dataTables.fixedHeader.min.js">	</script>
	  	<script type="text/javascript" src="media/js/fixedColumns/dataTables.fixedColumns.min.js"></script>

	  	<!--Button Datatable-->
	  	<script type="text/javascript" src="media/js/button/buttons.flash.min.js"></script>
	  	<script type="text/javascript" src="media/js/button/jszip.min.js"></script>
	  	<script type="text/javascript" src="media/js/button/pdfmake.min.js"></script>
	  	<script type="text/javascript" src="media/js/button/vfs_fonts.js"></script>
	  	<script type="text/javascript" src="media/js/button/buttons.html5.min.js"></script>
	  	<script type="text/javascript" src="media/js/button/buttons.print.min.js"></script>
  		<script type="text/javascript" src="media/js/jquery.checkAll.js"></script>
	<script>
    	$(document).ready(function(){
    		//Disable Warning alert of Datatables
    		$.fn.dataTable.ext.errMode = 'none';

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
		      	'order': [[1, 'asc']],
		      	'columnDefs': [{
		            'targets': 0,
		            'searchable': false,
		            'orderable': false,
		            'width': '1%'
		         }]
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
	    margin-bottom: -3px;
	    background-color: #212121;
	    z-index: 1000;
	    color: #E0E0E0;
    	}
	</style>
</head>
<body>
	<?php include('header.php') ?>
	<?php 
		
		if(isset($_POST["sale_id"])){
    		$sale_id = $_POST["sale_id"];
    	}
    	$sale_id = $_POST["sale_id"];

	 ?>
  	<form action="update_manageproject.php" method="post" role="form" autocomplete="off"  accept-charset="utf-8">
  	<div class="container-fluid">
	    <div class="row">
	      	<div class="panel-group animated fadeIn" id="accordion" role="tablist" aria-multiselectable="true">
	        	<div class="panel panel-warning margin-side" >
	          		<div class="panel-heading" role="tab" id="headingOne">
	            		<h4 class="panel-title"> <strong>รายการจัดสรรข้อมูลโครงการ</strong></h4>
	          		</div>
	          		<div class="panel-body" role="tab" id="panel-body">
	            		<table id="example" class="display table table-striped table-bordered" width="100%" cellspacing="0">
			              	<thead>
				              	<tr class="active">
				              		<th></th>
				              		<th align='center' style="max-width:90px;">Location code</th>
				                  	<th align='center' style="max-width:120px;">Location</th>
				                  	<th align='center' >ชื่อโครงการ</th>
				                  	<th align='center' style="max-width:90px;">จังหวัด</th>
				                  	<th align='center' style="max-width:90px;">เขต/อำเภอ</th>
				                  	<th align='center' style="max-width:90px;">แขวง/ตำบล</th>
				                  	<th align='center' >ที่อยู่</th>
				                  	<th align='center' style="max-width:75px;">ประเภท</th>
				              	</tr>
			              	</thead>              
			              	
			              	
			                <?php
		                	if(isset($_POST["checkboxlist"])){
		                		$get_id_post = $_POST["checkboxlist"];
		                	?>
								<tbody>
		                <?php	foreach ($get_id_post as $get_id) {
								$sql = "SELECT * FROM project WHERE id = :id ";
			                  	$query = $db->query($sql);
			                  	$query = $db->bind(':id', $get_id );
			                  	$query = $db->execute();
			                  	$query = $db->fetch();
			                  	$count = $db->rowCount();
									
									if(!empty(trim($get_id))){
										
										foreach ($query as  $key => $result) {
			                      
					                      $id = $result["id"];
					                      $location_code = $result["location_code"];
					                      $project_name = $result["project_name"];
					                      $province = $result["province"];
					                      $district =$result["district"];
					                      $address = $result["address"];
					                      $builder = $result["builder"];
					                      $sub_district =  $result["sub_district"];
					                      $location_lat_long = $result["location_lat_long"];
					                      $location_name = $result["location_name"];
					                      $node_nearby = $result["node_nearby"];
					                      $remark =  $result["remark"];
					                      $type = $result["type"];
					                      $status = $result["status"] ;
					        		?>
					        		<tr>
					        			<td>
					        				<input type="checkbox" name="project_id[]" checked="true"  id="project_id" value="<?php  echo $id ;?>"  >
					        			</td>
					                  <td>
					                    <?php echo $location_code;?></td>
					                  <td>
					                    <?php echo $location_lat_long; ?></td>
					                  <td>
					                    <?php echo $project_name; ?></td>
					                  <td>
					                    <?php echo $province; ?></td>
					                  <td>
					                    <?php echo $district; ?></td>
					                  <td>
					                    <?php echo $sub_district; ?></td>
					                  <td>
					                    <?php echo $address; ?></td>
					                  <td>
					                    <?php echo $type;?></td>
					                </tr>
									
					        		<?php }
									}	
								}
							?>
								</tbody>

			                <?php }else { ?>
			                	<tbody>
					                <tr>
					                	<td colspan="8" style="text-align: center;" >
					                		ยังไม่ทำการเลือกโครงการ กรุณากลับไปเลือกโครงการ <a href="manageproject.php">ย้อนกลับ</a>
					                	</td>
					                </tr>
								</tbody>
			                <?php } ?><!-- End else condition -->

			              	<tfoot>
			                	<tr>
			                		<th></th>
				                  	<th align='center' style="max-width:90px;">Location code</th>
				                  	<th align='center' style="max-width:120px;">Location</th>
				                  	<th align='center' >ชื่อโครงการ</th>
				                  	<th align='center' style="max-width:90px;">จังหวัด</th>
				                  	<th align='center' style="max-width:90px;">เขต/อำเภอ</th>
				                  	<th align='center' style="max-width:90px;">แขวง/ตำบล</th>
				                  	<th align='center' >ที่อยู่</th>
				                  	<th align='center' style="max-width:75px;">ประเภท</th>
			                	</tr>
			              	</tfoot>

	            		</table>
	          		</div>
	        	</div>
	      	</div>
	    </div>
  	</div>
  	<footer id="footer" class="navbar ">
	    <div class="container-fluid">
	      	<div class="col-lg-8">
		        <div class="form-group form-inline">
		        <?php if(!empty($sale_id)) {

		        		include_once('Classes/connection_mysqli_sales.php');

		        		$sql_sale = "SELECT * FROM rx_user WHERE user_code ='".$sale_id."' ";
	                  	
	                  	$row_sale = mysqli_query($conn, $sql_sale);

	                  	while($row = mysqli_fetch_assoc($row_sale)) {
	                  		$user_code = $row["user_code"];
	                  		$user_name = $row["user_name"];
	                  	
	            ?>
		            	<label style="margin-right:15px;">
			            ผู้รับผิดชอบโครงการ
			            <input type="text" name="sale_name" class="form-control input-md" value="<?php echo $user_name ; ?>" placeholder="ชื่อผู้รับผิดชอบ" readonly />  
			          	</label>
			          	&nbsp;&nbsp;
			          	
			            <label style="margin-right:15px;">รหัสพนักงาน</label>
			            <input type="text" name="sale_id" class="form-control input-md" value="<?php echo $user_code; ?>" placeholder="ชื่อผู้รับผิดชอบ" readonly />  
		        <?php 
		        		}
		        	}else { ?>
		        		<label style="margin-right:15px;">
			            ผู้รับผิดชอบโครงการ
			            <input type="text" name="sale_name" class="form-control input-md" value="" placeholder="ชื่อผู้รับผิดชอบ" readonly />  
			          	</label>
			          	&nbsp;&nbsp;
			          	
			            <label style="margin-right:15px;">รหัสพนักงาน</label>
			            <input type="text" name="sale_id" class="form-control input-md" value="" placeholder="รหัสพนักงาน" readonly />  
		        <?php
		        	}

		        ?>
		        </div>
		    </div>

	      	<div class="col-lg-4">
	        	<ul class="nav navbar-nav navbar-right">
	          		<li>
	          			<button class="btn btn-default" onclick="goBack()" style="width:120px;">ย้อนกลับ</button>
	            		<input type="submit" name="submit" class="btn btn-success" style="width:120px;" value="submit" />  
	          		</li>
	        	</ul>
	      	</div>
	      	<?php mysqli_close($conn); ?>
	    </div>
  	</footer>
  	</form>
</body>
</html>
