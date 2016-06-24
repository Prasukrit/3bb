<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>โครงการติดตั้งNode3</title>

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
            "dom": "l<'row'<'col-md-6'B><'col-md-6'f>>rt<'row'<'col-md-6'i><'col-md-6'p>>",
            "fixedHeader": true,
            "iDisplayLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "orderCellsTop": true,
            "scrollX": true,
            "buttons": [
                 { className:'glyphicon glyphicon glyphicon-open-file' ,extend:'excelFlash',text: '&nbsp;EXCEL'},
                 { className:'glyphicon glyphicon glyphicon-open-file' ,extend:'csvFlash',text: '&nbsp;CSV'},
                 { className:'glyphicon glyphicon-print' ,extend:'print',text: '&nbsp;Print',orientation: 'landscape',filename: 'โครงการ node 3',pageSize: 'LEGAL'}
            ],

            "order": [[ 1, "asc" ]]
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
  td.details-control {
        background: url('images/resources/open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('images/resources/close.png') no-repeat center center;
    }
    .padding-small{
      padding: 15px;
    }
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

  </style>

</head>
<body>
  <?php 
  include('header.php');
  include('Classes/connection_pdo.php');

  $db = new DB();

  ?>
  <!--Search static search (Optional)-->
  <!--<div class="container">
  <div class="row">
    <div class="well ">
      <div class="row">
        <form action="">
          <div class="col-sm-2">
            <div class="form-group">
              <div>
                <label for="">ชื่อโครงการ</label>
                <input type="text" class="form-control" placeholder="ex.บัวทองเคหะ บางบัวทอง"></div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <div>
                <label for="">Location code</label>
                <input type="text" class="form-control" placeholder="ex.BB1023"></div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <div>
                <label for="">จังหวัด</label>
                <select class="form-control">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <div>
                <label for="">เขต/อำเภอ</label>
                <select class="form-control">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <div>
                <label for="">แขวง/ตำบล</label>
                <select class="form-control">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <div class="search-button">
                <button style="width:100%;" class="btn btn-primary" type="submit"> <i class="glyphicon glyphicon-search"></i>
                  ค้นหา
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
-->
<div class="container-fluid">
  <div class="row">

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
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
                      $sql = "SELECT * FROM project WHERE status = '0' ";
                      $query = $db->
                  query($sql);
                      $query = $db->execute();
                      $query = $db->fetch();
                    ?>
                  <thead>
                    <tr>
                      <th align='center' style="max-width:75px;">Location code</th>
                      <th align='center' >ชื่อโครงการ</th>
                      <th align='center' style="max-width:90px;">จังหวัด</th>
                      <th align='center' style="max-width:90px;">เขต/อำเภอ</th>
                      <th align='center' style="max-width:90px;">แขวง/ตำบล</th>
                      <th align='center' style="max-width:120px;">Location</th>
                      <th align='center' style="max-width:140px;">Remark</th>
                      <th align='center' style="max-width:75px;">Type</th>
                      <th align="center" style="width:100px;" >Edit/Delete</th>
                    </tr>
                    <tr id="search">
                      <td>Location code</td>
                      <td>ชื่อโครงการ</td>
                      <td>จังหวัด</td>
                      <td>เขต/อำเภอ</td>
                      <td>แขวง/ตำบล</td>
                      <td>Location</td>
                      <td>Remark</td>
                      <td>Type</td>
                      <td>Edit/Delete</td>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                            foreach ($query as $key =>
                    $result) {
                               
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
                        <?php echo $location_code ?></td>
                      <td>
                        <?php echo $project_name ?></td>
                      <td>
                        <?php echo $province ?></td>
                      <td>
                        <?php echo $district ?></td>
                      <td>
                        <?php echo $sub_district ?></td>
                      <td>
                        <?php echo $location_lat_long ?></td>
                      <td>
                        <?php echo $remark ?></td>
                      <td>
                        <?php echo $type ?></td>
                      <td>
                        <?php echo "<a class='btn btn-success btn-xs' href='detail.php?id=$id' >Edit</a>
                      " ?>
                      <?php echo "<a class='btn btn-primary btn-xs' href='update-hide.php?status=$status&id=$id' >HIDE</a>
                    " ?>
                  </td>
                </tr>

                <?php } ?>
                </tbody>
              <tfoot>
                <tr >
                  <th align='center' style="max-width:75px;">Location code</th>
                  <th align='center' >ชื่อโครงการ</th>
                  <th align='center' style="max-width:90px;">จังหวัด</th>
                  <th align='center' style="max-width:90px;">เขต/อำเภอ</th>
                  <th align='center' style="max-width:90px;">แขวง/ตำบล</th>
                  <th align='center' style="max-width:120px;">Location</th>
                  <th align='center' style="max-width:140px;">Remark</th>
                  <th align='center' style="max-width:75px;">Type</th>
                  <th align="center" style="max-width:100px;" >Edit/Delete</th>
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