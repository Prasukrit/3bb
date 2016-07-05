<?php
    session_start();
    
    $_SESSION['ro10app'] = "leena.k@jasmine.com";
    include('Classes/connection_pdo.php');
    include('Classes/connection_mysqli_sales.php');
    //--Important--//
    include ('./session_validate.php');
    
    $db = new DB();
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
            "dom": "<'row'<'col-md-6'lB><'col-md-6'f>>rt<'row'<'col-md-6'i><'col-md-6'p>>",
            "fixedHeader": true,
            "stateSave": true,
            "iDisplayLength": 10,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "orderCellsTop": true,
            'columnDefs': [{
              'targets': 7,
              'searchable': false,
              'orderable': false
            }],
            "scrollX": true,
            "buttons": [
                 { className:'glyphicon glyphicon glyphicon-open-file' ,extend:'excelFlash',text: '&nbsp;EXCEL'},
                 { className:'glyphicon glyphicon glyphicon-open-file' ,extend:'csvFlash',text: '&nbsp;CSV'},
                 { className:'glyphicon glyphicon-print' ,extend:'print',text: '&nbsp;Print',orientation: 'landscape',filename: 'โครงการ node 3',pageSize: 'LEGAL'}
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
            <div class="col-lg-6 pull-left">
              <!--<a href="" class="editor_create btn btn-primary btn-md">Create +</a>
            -->
            </div>
          <!--TABLE-->
          <div class="row padding-small">
                <table id="example" class="display table table-striped table-bordered" width="100%" cellspacing="0">
                  <?php
                          // $sql = "SELECT * FROM project where status = 0";
                          // $query = mysqli_query($conn, $sql);
                      $sql = "SELECT * FROM project WHERE sale_personal_id = '".$row_sale_match_id."' and status = '0' ";
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
                        $sale_id = $result["sale_personal_id"];


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
                      <td>
                        <?php echo "<a><button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#myModal$id' value='$id'>
                          <i class='glyphicon glyphicon-eye-open'></i>
                        </button></a>
                      " ?>
                        <?php echo "<a class='btn btn-success btn-xs' href='detail.php?id=$id' ><i class='glyphicon glyphicon-pencil'></i></a>
                      " ?>
                      <?php echo "<a class='btn btn-warning btn-xs' href='update-hide.php?status=$status&id=$id' ><i class='glyphicon glyphicon-eye-close'></i></a>
                    " ?>
                    
                  </td>
                </tr>
                <!-- Modal -->
                <div class="modal animated fade " id="myModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">รายละเอียดของ<?php echo $location_code ; ?></h4>
                      </div>
                      <div class="modal-body">
                        <div class="col-xs-3">
                          <div class="form-group">
                              <label>ID</label>
                              <input type="text" class="form-control input-sm" name="id" id="id" readonly value="<?php echo $id; ?>"> 
                          </div>
                        </div>
                        <div class="col-xs-5">
                          <div class="form-group">
                              <label>ชื่อโครงการ</label>
                              <input type="text" class="form-control input-sm" name="project_name" readonly  id="project_name" value="<?php echo $project_name; ?>">
                          </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>ประเภท</label>
                              <input type="text" class="form-control input-sm" name="type" id="type"  readonly value="<?php echo $type; ?>">
                            </div>
                        </div>

                        <div class="col-xs-4">  
                          <div class="form-group">
                              <label>แขวง/ตำบล</label>
                              <input type="text" class="form-control input-sm" name="sub_district" id="sub_district"  readonly value="<?php echo $sub_district; ?>">   
                          </div>
                        </div>

                        <div class="col-xs-4">  
                          <div class="form-group">
                              <label>เขต/อำเภอ</label>
                              <input type="text" class="form-control input-sm" name="district" id="district"  readonly value="<?php echo $district; ?>">   
                          </div>
                        </div>

                        <div class="col-xs-4">
                          <div class="form-group">
                              <label>จังหวัด</label>
                              <input type="text" class="form-control input-sm" name="province" id="province"  readonly value="<?php echo $province; ?>">
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="form-group">
                                <label>ที่อยู่</label>
                              <textarea class="form-control input-sm" name="address" readonly ><?php echo $address; ?></textarea>   
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>หมายเหตุ</label>
                                <textarea class="form-control input-sm" name="remark" readonly ><?php echo $remark; ?></textarea>
                            </div>
                        </div>

                        <div class="col-xs-3">
                          <div class="form-group">
                                <label>Location code</label>
                              <input type="text" class="form-control input-sm" name="location_code" id="location_code"  readonly value="<?php echo $location_code; ?>">   
                            </div>
                        </div>

                        <div class="col-xs-4">
                          <div class="form-group">
                                <label>พิกัด</label>
                              <input type="text" class="form-control input-sm" name="location_lat_long" id="location_lat_long"  readonly value="<?php echo $location_lat_long; ?>">   
                            </div>
                        </div>

                        <div class="col-xs-5">
                          <div class="form-group">
                                <label>ชื่อผู้จัดสรรโครงการ</label>
                              <input type="text" class="form-control input-sm" name="builder" id="builder"  readonly value="<?php echo $builder; ?>">   
                            </div>
                        </div>

                        <div class="col-xs-5">
                          <div class="form-group">
                                <label>Node ใกล้เคียง</label>
                              <input type="text" class="form-control input-sm" name="node_nearby" id="node_nearby"  readonly value="<?php echo $node_nearby; ?>">   
                            </div>
                        </div>
                        <?php 
                            $user_code = $sale_id; // testdb ของอีกอันนึง

                            // Query ของ portal 
                            $sql_sale = "SELECT * FROM rx_user where user_code ='".trim($user_code)."' limit 1 ";
                            $row_sale = mysqli_query($conn_sale, $sql_sale);
                            while($result = mysqli_fetch_assoc($row_sale)) {

                         ?>
                        <div class="col-xs-7">
                          <div class="form-group">
                                <label>ชื่อผู้รับผิดชอบโครงการ</label>
                                <input type="text" class="form-control input-sm" name="sale_name" id="sale_name"  readonly <?php if(empty($result["user_code"])){
                                  echo "value=''";
                                }else{
                                  echo "value='".$result["user_name"]."'";
                                } ?>
                                >   
                            </div>
                        </div>
                        <?php  }  ?>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">ปิด</button>
                      </div>
                    </div>
                  </div>
                </div><!--Modal-->
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

            </div>
          </div><!--/panel body-->
        </div>
      </div>
    </div><!--/panel box-->
  </div><!--/row-->
</div><!-- /container-->
</body>
</html>