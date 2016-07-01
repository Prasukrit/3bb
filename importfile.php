<?php
    session_start();
    
    $session = $_SESSION['ro10app'] = "woraton.t@jasmine.com";
    
    include('./Classes/connection_mysqli_sales.php');
    
    $sql_sale_match = "SELECT * FROM rx_user WHERE user_email='" .$session. "'";
    $query_sale_match = mysqli_query($conn, $sql_sale_match);
    //echo $sql_sale_match;
    $row_sale_match = mysqli_fetch_assoc($query_sale_match);
    $row_sale_match_id = $row_sale_match["user_code"];
    $row_sale_match_name = $row_sale_match["user_name"];
    $row_sale_match_email = $row_sale_match["user_email"];
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
  <script type="text/javascript" charset="utf8" src="media/js/fixedHeader/dataTables.fixedHeader.min.js"></script>
  <script type="text/javascript" src="media/js/fixedColumns/dataTables.fixedColumns.min.js"></script>

  <!--Button Datatable-->
  <script type="text/javascript" src="media/js/button/buttons.flash.min.js"></script>
  <script type="text/javascript" src="media/js/button/jszip.min.js"></script>
  <script type="text/javascript" src="media/js/button/pdfmake.min.js"></script>
  <script type="text/javascript" src="media/js/button/vfs_fonts.js"></script>
  <script type="text/javascript" src="media/js/button/buttons.html5.min.js"></script>
  <script type="text/javascript" src="media/js/button/buttons.print.min.js"></script>
  <style>
    .box{
      margin: 15px;
      background-color: #fff;
      border: 1px solid #e1e1e8;
      border-width: 1px;
      border-radius: 4px 4px 0 0;
    }
  </style>
</head>
<body>
  <?php include('header.php'); ?>
	<div class="container">
    <div class="panel panel-warning animated fadeIn">
      <div class="panel-heading">
        <h2 style="color:white;">Import Excel File</h2>
      </div>
      <form class="form-group" name="form1" method="post" action="uploadfileexcel.php" enctype="multipart/form-data">
      <div class="panel-body">
        <div class="row">
          <div class="row" style="margin-top:50px;">
            <div class="col-lg-offset-2 col-lg-8">
              <input type="file" name="fileToUpload" id="fileToUpload" class="filestyle" data-size="nr" data-buttonText="Import Excel" data-iconName="glyphicon glyphicon-folder-open" data-placeholder="ไม่มีไฟล์" data-buttonName="btn-info" data-icon="false" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
              <hr>
              
              <p class="label label-primary lead" style="background-color:#AD1457;">ตัวอย่าง format</p>
              <div class="well ">
                <div class="row">
                  <div class="col-sm-4">
                    <ol>
                      <li><p>ลำดับ</p></li>
                      <li><p>จังหวัด</p></li>
                      <li><p>อำเภอ</p></li>
                      <li><p>ตำบล</p></li>
                      <li><p>ชื่อโครงการ</p></li>
                    </ol>
                  </div>
                  <div class="col-sm-4">
                    <ol start="6">
                      <li><p>ที่ตั้ง</p></li>
                      <li><p>ผู้จัดสรร</p></li>
                      <li><p>พิกัด</p></li>
                      <li><p>location_code</p></li>
                      <li><p>location_name</p></li>
                    </ol>
                      
                  </div>
                  <div class="col-sm-4">
                    <ol start="9">
                      <li><p>node ใกล้เคียง</p></li>
                      <li><p>remark</p></li>
                      <li><p>แสดง/ซ่อน</p></li>
                      <li><p>ประเภท</p></li>
                    </ol>
                  </div>
                </div>
                  
              </div><!--/Well-->
              <p class="text-danger text-center">นำเข้าไฟล์ได้เฉพาะนามสกุล .CSV .XLSX . XLS เท่านั้น</p>
                
                
            </div>
          </div>
          
          <script>
            $(document).ready(
                function(){
                    $('input:file').change(
                        function(){
                            if ($(this).val()) {
                                $('input:submit').attr('disabled',false); 
                            } 
                        }
                    );

            });
          </script> 
        </div>
      </div>
      <div class="panel-footer">
        <div class="margin-small text-center">
          <input class="btn btn-primary btn-lg" name="btnSubmit" type="submit" value="Import" disabled>
        </div>
      </div>
      </form>
    </div>	
	</div>
</body>
</html>