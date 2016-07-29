<?php 
	session_start();

	include('./Classes/connection_mysqli.php');
        include ('./Classes/connection_mysqli_sales.php');
        //--Important--//
        include ('./session_validate.php');

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
            scrollCollapse: false,
            paging: false,
            "stateSave": true,
            'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                }],
            'order': [[5, 'asc']]
        });
    });

    //Button Function go back to previous page
    function goBack() {
        window.history.back();
    }

      </script>

</head>
<body>
    <?php
    include_once('header.php');

    $sql = "SELECT * FROM sale_user ";
    $query = mysqli_query($conn, $sql);
    $i = 0;
    ?>
    <div class="container-fluid" >
        <div class="row">
                <div class="panel panel-warning margin-side" >
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title"> <strong>รายการจัดสรรข้อมูลโครงการ</strong></h4>
                    </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="row padding-small" >
                            <table id="example" class="display table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="active">
                                        <th class="text-center">ดู</th>
                                        <th>รหัสพนักงาน</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>email</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>จำนวนโครงการ</th>
                                    </tr>
                                </thead>
                                <tbody id="general-content">
                                    <?php while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        $i++;
                                        $user_code = $result["user_code"];

                                        $sql_count = "SELECT
                                                            count(p.project_name) AS count
                                                    FROM
                                                            project p
                                                    JOIN sale_user s ON p.sale_personal_id = s.user_code
                                                    WHERE
                                                            sale_personal_id = '" . $result["user_code"] . "'";

                                        $query_count = mysqli_query($conn, $sql_count);
                                        $result_count = mysqli_fetch_array($query_count, MYSQLI_ASSOC);
                                        
                                        ?>
                                        
                                        <tr>
                                            <td class="text-center">
                                                <?php echo "<a><button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#projectSale$i' value=''>
                          <i class='glyphicon glyphicon-eye-open'></i>
                        </button></a>"; ?>
                                                
                                            </td>
                                            <td>
                                                <?php echo $user_code; ?>
                                            </td>
                                            <td>
                                                <?php echo $result["user_name"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $result["user_email"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $result["user_tel"]; ?>
                                            </td>
                                            <td>
                                                <b><?php echo $result_count["count"]; ?></b>
                                            </td>  
                                            
                                        </tr>
                                        <!--Modal-->
                                            <?php include('./modal_project_of_sale.php'); ?>
                                        <!--/Modal-->
                                        
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <th>ดู</th>
                                    <th>รหัสพนักงาน</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>email</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>จำนวนโครงการ</th>
                                </tfoot>

                            </table>

                        </div>
                    </div>
                </div>
            </div>

    </div>
    </div>
    
</body>
</html>
