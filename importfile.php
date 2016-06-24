<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Bootstrap 101 Template</title>
  <!-- Datatable CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="css/editor.bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
  <link rel="stylesheet" href="css/editor.dataTables.min.css">

  <!-- Bootstrap Theme -->
  <link href="lumen/bootstrap.css" rel="stylesheet">
  <link href="2/css/font-awesome.min.css" rel="stylesheet">
  <link href="2/css/bootswatch.css" rel="stylesheet">

  <!-- JQUERY -->
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.3.js"></script>
  <!--JQUERY Bootstrap theme -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script type="text/javascript" src="bootstrap-filestyle/bootstrap-filestyle.js"></script>
  
  <!-- DataTable -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
  <script type="text/javascript" src="js/dataTables.editor.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>

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
    .margin-small{
      margin:20px 0px;
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
  <?php include('header.php'); ?>
	<div class="container">
  <div class="panel panel-warning">
  <div class="panel-heading">
    <h2 style="color:white;">Import Excel File</h2>
  </div>
  <form class="form-group" name="form1" method="post" action="uploadfileexcel.php" enctype="multipart/form-data">
  <div class="panel-body">
    <div class="row">
      
        <div class="row" style="margin-top:50px;">
          <div class="col-lg-offset-3 col-lg-6">
            <input type="file" name="fileToUpload" id="fileToUpload" class="filestyle" data-size="nr" data-buttonText="Import Excel" data-iconName="glyphicon glyphicon-folder-open" data-placeholder="ไม่มีไฟล์" data-buttonName="btn-info" data-icon="false">
            <hr>
            
            
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