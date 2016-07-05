<?php 
	session_start();

	include('./Classes/connection_pdo.php');
        include ('./Classes/connection_mysqli_sales.php');
        //--Important--//
        include ('./session_validate.php');


	if(isset($_GET["sale_id"])){
            $sale_id = $_GET["sale_id"];
   	}
        //echo $sale_id;
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

    $sql = "SELECT * FROM sale_user where user_code = '".$sale_id."' limit 1";
    $sale_query = $db->query($sql);
    $sale_query = $db->execute();
    $sale_query = $db->fetch();
    
    
  ?>
    <form action="update_assign.php" method="post" role="form" autocomplete="off"  accept-charset="utf-8">
        <div class="container" style="margin-bottom:40px;display:block;">
            <div class="panel panel-warning animated fadeIn">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title"><button class=" btn btn-warning" onclick="goBack()"><i class="glyphicon glyphicon-arrow-left"></i></button><strong>  กำหนดสิทธิ์เมนูผู้ใช้งาน</strong>
                    </h4>
                </div>

                <!--/panel header-->
                <?php
                foreach ($sale_query as $row_sale) {
                    $sale_id = $row_sale["user_code"];
                    $sale_name = $row_sale["user_name"];
                    $sale_email = $row_sale["user_email"];
                    $sale_tel = $row_sale["user_tel"];
                    $sale_menu = $row_sale["permission_menu_id"]
                    ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="margin-side">
                                <div class="col-md-offset-2 col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">รหัสพนักงาน.</label>
                                                <input class="form-control input-md" type="text" name="sale_id"  placeholder="id.1234" value="<?php echo $sale_id; ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">ชื่อ-นามสกุล</label>
                                                <input class="form-control input-md" type="text" name="sale_name"  placeholder="ระบุชื่อ" value="<?php echo $sale_name; ?>" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input class="form-control input-md" type="text" name="email" placeholder="example@mail.com" value="<?php echo $sale_email; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">เบอร์โทร</label>
                                                <input class="form-control input-md" type="text" name="tel" placeholder="08X-XXXXXXX" value="<?php echo $sale_tel; ?>"  >

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-1 col-md-10">
                                <table class="table table-active table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4">กำหนดสิทธิ์ให้กับ : <?php echo $sale_name; ?></th>
                                        </tr>
                                        <tr>
                                            <th>โครงการ</th>
                                            <th>Import</th>
                                            <th>จัดสรรโครงการ</th>
                                            <th>กำหนดสิทธิ์</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center;">
                                            <?php if(strpos($sale_menu,"menu_id1") == "0"  ) { ?>
                                            <td><input class="" checked type="checkbox" name="menu_permission[]" value="menu_id1,"  ></td>
                                            <?php } else { ?>
                                            <td><input class="" type="checkbox" name="menu_permission[]" value="menu_id1,"  ></td>
                                            <?php } ?>
                                            
                                            <?php if(strpos($sale_menu,"menu_id2") != ""  ) { ?>
                                            <td><input class="" checked type="checkbox" name="menu_permission[]" value="menu_id2,"  ></td>
                                            <?php } else { ?>
                                            <td><input class="" type="checkbox" name="menu_permission[]" value="menu_id2,"  ></td>
                                            <?php } ?>
                                                                                      
                                            <?php if(strpos($sale_menu,"menu_id3") != ""  ) { ?>
                                            <td><input class="" checked type="checkbox" name="menu_permission[]" value="menu_id3,"  ></td>
                                            <?php } else { ?>
                                            <td><input class="" type="checkbox" name="menu_permission[]" value="menu_id3,"  ></td>
                                            <?php } ?>
                                            
                                            <?php if(strpos($sale_menu,"menu_id4") != ""  ) { ?>
                                            <td><input class="" checked type="checkbox" name="menu_permission[]" value="menu_id4,"  ></td>
                                            <?php } else { ?>
                                            <td><input class=""  type="checkbox" name="menu_permission[]" value="menu_id4,"  ></td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>

                        </div>
                        <div class="panel-footer text-center">
                            <button class="btn btn-default button-md-size" onclick="goBack()">ย้อนกลับ</button>
                                <input class="btn btn-success button-md-size" type="submit" value="อัพเดท" />
                            </div>
                    </div><!--/panel-body -->
                    

                </div><!--/panel box-->
            <?php } ?>



        </div><!-- /container -->

    </form>
</body>
</html>
