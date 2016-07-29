<?php
    session_start();
    
    $_SESSION['ro10app'] = "test@jasmine.com";
    include('Classes/connection_pdo.php');
    include('Classes/connection_mysqli_sales.php');
    //--Important--//
    include ('./session_validate.php');
    
    $db = new DB();
    
    $sql_check_user = "SELECT count(user_email) as user_email FROM sale_user WHERE user_email = '".$_SESSION['ro10app']."'";
    $check_user = $db->query($sql_check_user);
    $check_user = $db->execute();
    $result_check_user = $db->single();
    //echo $result_check_user["user_email"];
    if($result_check_user["user_email"] <= 0){
        $sql_sale_match = "SELECT * FROM rx_user WHERE user_email='" .$_SESSION['ro10app']. "'";
        $query_sale_match = mysqli_query($conn_sale, $sql_sale_match);
        $row_sale_match = mysqli_fetch_assoc($query_sale_match);
        $user_code = $row_sale_match["user_code"];
        $user_name = $row_sale_match["user_name"];
        $user_email = $row_sale_match["user_email"];
        $user_tel = $row_sale_match["user_tel"];
        $user_role = $row_sale_match["user_role"];
        $department_id = $row_sale_match["department_ID"];
        
        if($row_sale_match_email == $_SESSION['ro10app']){
            $sql_insert = "INSERT INTO sale_user (user_name, department, user_email, user_tel, user_code, user_role, permission_menu_id) "
                        . "VALUES ('".$user_name."','".$department_id."', '".$user_email."', '".$user_tel."', "
                        . "'".$user_code."', '".$user_role."', 'menu_id1'   )";
            $query_insert = $db->execute($sql_insert);
            $result_insert = $db->fetch();
        }
    }
    //Check Account Matching
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>โครงการติดตั้งNode3</title>

  <!--CSS PACKS-->
  <?php include('./css_packs.html') ?>

  <!--SCRIPT PACKS-->
  <?php include('./script_packs.html') ?>

  <script type="text/javascript">

    $(document).ready(function() {
        
        // Setup - add a text input to each footer cell
        $('#example thead tr#search td').each( function () {
            var title = $('#example thead td').eq( $(this).index() ).text();
            $(this).html( '<input class="form-control input-sm" placeholder="'+title+'" onclick="stopPropagation(event); type="text" style="width:100%;" "  />' );
        } );
        
         // Apply the filter
        $("#example thead input").on( 'keyup change', function () {
            table
                .column( $(this).parent().index()+':visible' )
                .search( this.value )
                .draw();
        } );


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

        // Data Table function
        var table = $('#example').DataTable( {
            "dom": "<'pull-right'l><'col-md-6'B><'col-md-6 pull-right'f>rt<'row'<'col-md-6'i><'col-md-6'p>>",
            "fixedHeader": true,
            "stateSave": true,
            "iDisplayLength": 10,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "orderCellsTop": true,
            'columnDefs': [{
              'targets': 7,
              'orderable': false
            }],
            //"scrollX": true,
            "buttons": [

                { 
                    className:'glyphicon glyphicon glyphicon-open-file ' ,
                    extend:'excelFlash',
                    text: '&nbsp;EXCEL',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5,6 ] 
                    }
                },
                { 
                    className:'glyphicon glyphicon glyphicon-open-file' ,
                    extend:'csvFlash',
                    text: '&nbsp;CSV',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5,6 ] 
                    }
                },
                { 
                    className:'glyphicon glyphicon-print' ,
                    extend:'print',
                    text: '&nbsp;Print',
                    orientation: 'landscape' ,
                    filename: 'โครงการ node 3',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [ 0,1,2,3,4,5,6 ],
                        
                    }
                }
            ],

            "order": [[ 0, "desc" ]]
        } );

        //stopPropagation
        function stopPropagation(evt) {
          if (evt.stopPropagation !== undefined) {
            evt.stopPropagation();
          } else {
            evt.cancelBubble = true;
          }
        }

        // Hide row
        function like(user) 
        {
            $.ajax({
                url: "update-hide.php",
                type: "POST",
                data: { 'id': user,
                        'status': '1' 
                },                   
                success: function()
                {
                    alert("ok");                                    
                }
            });
        }
    } );

  </script>
  <style>
      .margin-small-right{
          margin-right: 15px;
      }
  </style>
</head>
<body>
  <?php 
  
  include('header.php');

  ?>
<!--container-->
<div class="container-fluid">
    <div class="row">

        <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-warning margin-side" >
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title"> <strong>รายการข้อมูลโครงการ</strong>
                        <!--Hide button -->
                        <!--<a class="pull-right" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <i class="glyphicon glyphicon-minus"></i>
                      </a>-->
                    </h4>
                </div><!--/panel header-->
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">

                        <!--TABLE-->

                        <table id="example" class="display table table-striped table-bordered" width="100%" cellspacing="0">
                            <div class="col-md-6 pull-left">
                                <?php if (strpos(trim($sale_perrmission_menu), "menu_id5") != "") { ?>
                                    <a href="create_project.php?menu_id=5" class="<?php if ($page == 'create_project.php' || $page == 'create_project_update.php') { ?>active<?php } ?> create_project dt-button buttons-excel buttons-flash glyphicon glyphicon-plus" >&nbsp;CREATE</a>
                                <?php } ?>
                            </div>
                            <?php
                            // $sql = "SELECT * FROM project where status = 0";
                            // $query = mysqli_query($conn, $sql);
                            $sql = "SELECT * FROM project WHERE sale_personal_id = '" . $row_sale_match_code . "' and status = '0' ";
                            $query = $db->query($sql);
                            $query = $db->execute();
                            $query = $db->fetch();
                            ?>
                            <thead>
                                <tr class="active">
                                    <th align='center' style="max-width:90px;">Location code</th>
                                    <th align='center' style="max-width:110px;">พิกัด</th>
                                    <th align='center' >ชื่อโครงการ</th>
                                    <th align='center' style="max-width:75px;">เขต/อำเภอ</th>
                                    <th align='center' style="max-width:70px;">จังหวัด</th>       
                                    <th align='center' style="max-width:110px;">ผู้จัดสรรโครงการ</th>
                                    <th align='center' style="max-width:75px;">ประเภท</th>
                                    <th align="center" style="width:80px;min-width: 100px" >ดู/แก้ไข/ซ่อน</th>
                                </tr>
                                <tr id="search">
                                    <td>Location code</td>
                                    <td>พิกัด</td>
                                    <td>ชื่อโครงการ</td>
                                    <td>เขต/อำเภอ</td>
                                    <td>จังหวัด</td>                    
                                    <td>ผู้จัดสรรโครงการ</td>
                                    <td>ประเภท</td>
                                    <td>แก้ไข/ซ่อน</td>

                                </tr>
                            </thead>
                            <tbody>
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
                                    $sale_id = $result["sale_personal_id"];
                                    $project_unit = $result["project_unit"];
                                    $contact_name = $result["contact_name"];
                                    $contact_tel1 = $result["contact_tel1"];
                                    $contact_tel2 = $result["contact_tel2"];
                                    ?>
                                    <tr>

                                        <td>
                                            <?php echo $location_code ?></td>
                                        <td>
                                            <?php echo $location_lat_long ?></td>
                                        <td>
                                            <?php echo $project_name ?></td>
                                        <td>
                                            <?php echo $district ?></td>
                                        <td>
                                            <?php echo $province ?></td>
                                        <td>
                                            <?php echo $builder ?></td>
                                        <td>
                                            <?php echo $type ?></td>
                                        <td style="text-align: center;">
                                            <a>
                                                <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#myModal<?php echo $id; ?>' value='<?php echo $id; ?>'>
                                                    <i class='glyphicon glyphicon-eye-open'></i>
                                                </button>
                                            </a>
                                                
                                            <a class='btn btn-success btn-xs' href='detail.php?id=<?php echo $id; ?>' ><i class='glyphicon glyphicon-pencil'></i></a>
                                            <a class='btn btn-warning btn-xs' href='update-hide.php?status=<?php echo $status."&id=".$id; ?>' ><i class='glyphicon glyphicon-eye-close'></i></a>
                                                
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <?php include ('./modal_projectdetail.php'); ?>
                                    <!--Modal-->
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr >
                                    <th align='center' >Location code</th>
                                    <th align='center' >พิกัด</th>
                                    <th align='center' >ชื่อโครงการ</th>
                                    <th align='center' >เขต/อำเภอ</th>
                                    <th align='center' >จังหวัด</th>
                                    <th align='center' >ผู้จัดสรรโครงการ</th>
                                    <th align='center' >ประเภท</th>
                                    <th align="center" >ดู/แก้ไข/ซ่อน</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!--/panel body-->
                </div>
            </div>
        </div><!--/panel box-->
    </div><!--/row-->
</div>
    <!-- /container-->
</body>
</html>