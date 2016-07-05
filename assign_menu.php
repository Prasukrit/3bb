<?php 
	session_start();

	include('./Classes/connection_pdo.php');
        include ('./Classes/connection_mysqli_sales.php');
        //--Important--//
        include ('./session_validate.php');


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
        <!--CSS PACKS-->
        <?php include('./css_packs.html') ?>

        <!--SCRIPT PACKS-->
        <?php include('./script_packs.html') ?>

		<script>
      
      

			$(document).ready(function(){

        /* checkbox #1 */
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
            'fixedHeader': true,
            "stateSave": true,
            'columnDefs': [{
                            'targets': 4,
                            'orderable': false,
            }],
          'order': [[0, 'asc']]
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
      background-color: #212121;
      z-index: 1000;
      color: #E0E0E0;
    }
    .top-zero{
        
    }
  </style>
</head>
<body>
	<?php 

    include_once('header.php');

    $sql = "SELECT * FROM sale_user ";
    $query = $db->query($sql);
    $query = $db->execute();
    $query = $db->fetch();
  ?>
  <form action="update_permission_menu.php" method="post" role="form" autocomplete="off"  accept-charset="utf-8">
      <div class="container" style="margin-bottom:40px;display:block;">
          <div class="row">
              <div class="panel-group animated fadeIn" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-warning margin-side" >
                      <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title"> <strong>กำหนดสิทธิ์เมนูผู้ใช้งาน</strong>
                          </h4>
                      </div>
                      <div class="panel-body" role="tab" id="panel-body">

                          <table id="example" class="display table table-striped table-bordered" width="100%" cellspacing="0">
                              <thead style="margin-top: 0px !important;">
                                  <tr class="active">
                                      <th align='center' >รหัสพนักงาน</th>
                                      <th align='center' >ชื่อ-นามสกุล</th>
                                      <th align='center' >email</th>
                                      <th align='center' >เบอร์โทร</th>
                                      <th width="100px;" >กำหนดสิทธิ์</th>
                                  </tr>
                              </thead>
                              <tbody id="general-content">
                                  <?php
                                  foreach ($query as $key => $result) {

                                      $sale_id = $result["user_code"];
                                      $sale_name = $result["user_name"];
                                      $sale_email = $result["user_email"];
                                      $sale_tel = $result["user_tel"];
                                      ?>
                                  <tr>
                                          <td><?php echo $sale_id; ?></td>
                                          <td><?php echo $sale_name; ?></td>
                                          <td><?php echo $sale_email; ?></td> 
                                          <td><?php echo $sale_tel; ?></td>
                                          <td align='center'>
                                              <a href="update_assign_menu.php?sale_id=<?php echo $sale_id?> ">
                                                  <i class="glyphicon glyphicon-book"></i>
                                              </a>
                                              
                                          </td>
                                      </tr>

                                  <?php } ?>
                              </tbody>
                              <tfoot>
                                  <tr>
                                      <th align='center' >รหัสพนักงาน</th>
                                      <th align='center' >ชื่อ-นามสกุล</th>
                                      <th align='center' >email</th>
                                      <th align='center' >เบอร์โทร</th>
                                      <th align='center' >กำหนดสิทธิ์</th>
                                  </tr>
                              </tfoot>

                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
  </form>
</body>
</html>
