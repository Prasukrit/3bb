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
        <title>จัดสรรโครงการ</title>
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
                        scrollY:   '45vh',
                        scrollCollapse: true,
                        paging: false,
                        "stateSave": true,
                        'columnDefs': [{
                                'targets': 0,
                                'searchable': false,
                            'orderable': false,
                        }],
                    'order': [[1, 'asc']]
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
             background-color: #37474F;
             z-index: 1000;
             color: #E0E0E0;
           }
        </style>
</head>
<body>
	<?php 

    include_once('header.php');

    $sql = "SELECT * FROM project where status = '0' and sale_personal_id = '' OR sale_personal_id = 'admin00' ";
    $query = $db->query($sql);
    $query = $db->bind(":status","0");
    $query = $db->execute();
    $query = $db->fetch();
  ?>
  <form action="manageproject_1.php" method="post" role="form" autocomplete="off"  accept-charset="utf-8">
      <div class="container-fluid" style="margin-bottom:40px;display:block;">
          <div class="row">
              <div class="panel-group animated fadeIn" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-warning margin-side" >
                      <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title"> <strong>รายการจัดสรรข้อมูลโครงการ</strong>
                          </h4>
                      </div>
                      <div class="panel-body" role="tab" id="panel-body">

                          <table id="example" class="display table table-striped table-bordered" width="100%" cellspacing="0">
                              <thead>
                                  <tr class="active">
                                      <th class="no-sort" style="text-align: center">
                                          <input type="checkbox" class="check_all" />
                                      </th>
                                      <th align='center' style="max-width:90px;">Location code</th>
                                      <th align='center' style="max-width:120px;">พิกัด</th>
                                      <th align='center' >ชื่อโครงการ</th>
                                      <th align='center' >ที่อยู่</th>
                                      <th align='center' style="max-width:85px;">เขต/อำเภอ</th>
                                      <th align='center' style="max-width:80px;">จังหวัด</th>
                                      <th align='center' style="max-width:75px;">ประเภท</th>
                                  </tr>
                              </thead>
                              <tbody id="general-content">
                                  <?php
                                  foreach ($query as $key => $result) {

                                      $id = $result["id"];
                                      $location_code = $result["location_code"];
                                      $project_name = $result["project_name"];
                                      $province = $result["province"];
                                      $district = $result["district"];
                                      $address = $result["address"];
                                      $builder = $result["builder"];
                                      $sub_district = $result["sub_district"];
                                      $location_lat_long = $result["location_lat_long"];
                                      $location_name = $result["location_name"];
                                      $node_nearby = $result["node_nearby"];
                                      $remark = $result["remark"];
                                      $type = $result["type"];
                                      $status = $result["status"];
                                      ?>
                                      <tr>
                                          <td style="width: 20px;" align="center">
                                              <input type="checkbox" name="checkboxlist[]" class="check" value="<?php echo $id; ?>"></td>
                                          <td>
                                              <?php echo $location_code; ?></td>
                                          <td>
                                              <?php echo $location_lat_long; ?></td>
                                          <td>
                                              <?php echo $project_name; ?></td>
                                          <td>
                                              <?php echo $address; ?></td>
                                          <td>
                                              <?php echo $province; ?></td>
                                          <td>
                                              <?php echo $district; ?></td>                  
                                          <td>
                                              <?php echo $type; ?></td>
                                      </tr>

                                  <?php } ?>
                              </tbody>
                              <tfoot>
                                  <tr>
                                      <th>
                              <div id="general">
                                  <i>
                                      <span class="counter" style="color:orange;"></span>
                                  </i>
                              </div>
                              </th>
                              <th align='center' >Location code</th>
                              <th align='center' >พิกัด</th>
                              <th align='center' >ชื่อโครงการ</th>
                              <th align='center' >ที่อยู่</th>
                              <th align='center' >เขต/อำเภอ</th>
                              <th align='center' >จังหวัด</th>
                              <th align='center' >ประเภท</th>
                              </tr>
                              </tfoot>

                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <footer id="footer" class="navbar signup_scroll" style="margin-bottom:0px;">
          <div class="container-fluid">
              <div style="width:100%;float:left;display:block;">
                  <div class="form-group form-inline">
                      <?php
                      include_once("Classes/connection_mysqli_sales.php");

                      $sql_sale = "SELECT * FROM rx_user where user_code in ('26-448','12-127','t26-1339','26-292','t26-1584','admin00') ";
                      $row_sale = mysqli_query($conn_sale, $sql_sale);
                      ?>
                      <div class="" style="float:left;">
                          <label style="margin-right:15px;">
                              ผู้รับผิดชอบโครงการ

                              <select name="sale_id" class="form-control input-md"  id="sale_id" required="">
                                  <option  value="" >-- เลือกผู้รับผิดชอบโครงการ --</option>
                                  <?php
                                  while ($row = mysqli_fetch_assoc($row_sale)) {
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
                              <input type="submit" id="btncheck" class="btn btn-success" style="width:120px;" value="เลือก"  />        
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </footer>
  </form>
</body>
</html>
