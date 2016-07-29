<?php
    session_start();
    
    include('./Classes/connection_mysqli_sales.php');
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
    <title>นำเข้าไฟล์ Excel</title>

    <!--CSS PACKS-->
    <?php include('./css_packs.html') ?>

    <!--SCRIPT PACKS-->
    <?php include('./script_packs.html') ?>
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
        <h3 style="color:white;">Import Excel File</h3>
      </div>
      <form class="form-group" name="form1" method="post" action="uploadfileexcel.php" enctype="multipart/form-data">
      <div class="panel-body">
        <div class="row">
          <div class="row" style="margin-top:50px;">
            <div class="col-lg-offset-2 col-lg-8">
              <input type="file" name="fileToUpload" id="fileToUpload" class="filestyle" data-size="nr" data-buttonText="Import Excel" data-iconName="glyphicon glyphicon-folder-open" data-placeholder="ไม่มีไฟล์" data-buttonName="btn-info" data-icon="false" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
              <hr>
              
              <p class="label label-primary lead" style="background-color:#AD1457;">ตัวอย่าง format column </p>
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