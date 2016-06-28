<?php 
	session_start();

	include('Classes/connection_pdo.php');

	$_SESSION['ro10app'] = "puwadon.sa@jasmine.com";



	if(isset($_GET["id"])){
	   	$id = $_GET["id"];
   	}
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

        var buttoncheck = document.getElementById('button-check');

        var checker = document.getElementById('checkboxlist');
        
        $('#general i .counter').text('  ');

        var fnUpdateCount = function() {
          var generallen = $("#general-content input[name='checkboxlist[]']:checked").length;
            console.log(generallen,$("#general i .counter") )


          if (generallen > 0) {
            $("#general i .counter").text('(' + generallen + ')');


          } else {
            $("#general i .counter").text('  ');
          }
        };

        $("#general-content input:checkbox").on("change", function() {
              fnUpdateCount();
        });

        
        $('.check_all').change(function() {
              var checkthis = $(this);
              var checkboxes = $("#general-content input:checkbox");

              if (checkthis.is(':checked')) {
                checkboxes.prop('checked', true);
              } else {
                checkboxes.prop('checked', false);
              }
                    fnUpdateCount();
        });

        // Array holding selected row IDs
        var rows_selected = [];
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

        // Datatable Function
        var table = $('#example').DataTable({
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          scrollY:   '50vh',
          scrollCollapse: true,
          paging: false,
          'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'width': '1%'
          }],
          'order': [[1, 'asc']],
        });
      });

      //Button Function disable submit button before tik checkbox
      // $(function() {
      //   var chk = $('.check');
      //   var btn = $('#btncheck');

      //   chk.on('change', function() {
      //     btn.prop("disabled", !this.checked);//true: disabled, false: enabled
      //   }).trigger('change'); //page load trigger event
      // });
      //Button Function go back to previous page
      function goBack() {
        window.history.back();
      }
   
	</script>
</head>
<body>
	<?php 

    include_once('header.php');

    $sql = "SELECT * FROM project where status = '0' ";
    $query = $db->query($sql);
    $query = $db->bind(":status","0");
    $query = $db->execute();
    $query = $db->fetch();
  ?>
  <form action="manageproject_1.php" method="post" role="form" autocomplete="off"  accept-charset="utf-8">
  <div class="container-fluid" style="margin-bottom:40px;display:block;">
    <div class="row">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-warning margin-side" >
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title"> <strong>รายการจัดสรรข้อมูลโครงการ</strong>
            </h4>
          </div>
          <div class="panel-body" role="tab" id="panel-body">
            <table id="example" class="display table table-striped table-bordered" width="100%" cellspacing="0">
             <thead>
                <tr>
                  <th class="no-sort" style="text-align: center">
                    <input type="checkbox" class="check_all" />
                  </th>
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
              <tbody id="general-content">
                
                <?php
                    foreach ($query as $key=> $result) {
                      
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

                  <td style="width: 20px;" align="center">
                  
                    <input type="checkbox" id="checkboxlist" name="checkboxlist[]" value="<?php echo $id; ?>" />
                  </div>
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

                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>
                    <div id="general">
                      <i>
                          <span class="counter" style="color:green;"></span>
                      </i>
                    </div>
                  </th>
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
  <footer id="footer" class="navbar navbar-default signup_scroll" style="margin-bottom:0px;">
    <div class="container-fluid">
      <div style="width:100%;float:left;display:block;">
        <div class="form-group form-inline">
          <?php 
            include_once("Classes/connection_mysqli_sales.php");

            $sql_sale = "SELECT * FROM rx_user where user_code in ('26-448','12-127','t26-1339','26-292','t26-1584') ";
            $row_sale = mysqli_query($conn, $sql_sale);

           ?>
          <div class="" style="float:left;">
            <label style="margin-right:15px;">
              ผู้รับผิดชอบโครงการ
              
              <select name="sale_id" class="form-control input-sm"  id="sale_id" required="">
                <option  value="" >-- เลือกผู้รับผิดชอบโครงการ --</option>
                <?php while($row = mysqli_fetch_assoc($row_sale)) {
                  $user_name = $row["user_name"];
                  $user_code = $row["user_code"];
                 ?>
                <option value="<?php echo $user_code; ?>" >
                  <?php echo $user_name; ?>
                </option>
                <?php } ?>
              </select>
            </label>
          </div>
          &nbsp;&nbsp;
          <ul class="nav navbar-nav navbar-right">
            <li>
            <input type="submit" id="btncheck" name="btncheck" class="btn btn-success btn-sm"  style="width:120px;" value="เลือก"   /> 
           </li>
          </ul>
          <script type="text/javascript">
            $(function(){  
               $("#checkboxlist").click(function(){ // เมื่อคลิกที่ checkbox id=i_accept  
                   if($(this).attr("checked")=="checked"){ // ถ้าเลือก  
                       $("#btncheck").removeAttr("disabled"); // ให้ปุ่ม id=continue_bt ทำงาน สามารถคลิกได้  
                   }else{ // ยกเลิกไม่ทำการเลือก  
                       $("#btncheck").attr("disabled","disabled");  // ให้ปุ่ม id=continue_bt ไม่ทำงาน  
                   }  
               });  
            });  
          </script>
        </div>
      </div>
    </div>
  </footer>
  </form>
</body>
</html>
