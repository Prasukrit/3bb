<?php
	include('Classes/connection_mysqli.php');

	//header("Location: index.php");

//	$db = new DB();
        
        $sql = "INSERT INTO project (
	project_name,
	province,
	district,
	sub_district,
	address,
	builder,
	location_lat_long,
	location_code,
	location_name,
	node_nearby,
	remark,
	type,
	status
) 
VALUES
	('".$_POST["project_name"]."' ,
	'".$_POST["province"]."' ,
	'".$_POST["district"]."' ,
	'".$_POST["sub_district"]."' ,
	'".$_POST["address"]."' ,
	'".$_POST["builder"]."' ,
	'".$_POST["location_lat_long"]."' ,
	'".$_POST["location_code"]."' ,
	'".$_POST["location_name"]."' ,
	'".$_POST["node_nearby"]."' ,
	'".$_POST["remark"]."' ,
	'".$_POST["type"]."' ,
	'".$_POST["status"]."') " ;
        $query = mysqli_query($conn, $sql);

?>
<html>
    <head>
        <title>กำลังสรา้งโครงการใหม่...</title>
        <meta http-equiv="refresh" content="3; url=index.php" />
        <?php
        //CSS
        include ('./css_packs.html');
        //JS
        include ('./script_packs.html');
        ?>
    </head>
    <body style="background: #164761;color: #ffffff;"  >
        <div class="container">
            <div class="row" style="margin-top: 150px;">
                
            
            <h3 class="pg-loading-logo-header text-center">
                <span style="color:#ffffff;">กำลังสรา้งโครงการใหม่... <img src="media/images/spinners/circle-bub_ocean.gif"></span>
            </h3>
            </div>
            <div class="row">
                <div class="col-sm-12">
                <table class="table table-bordered" style="border:solid white 1px">
                    <tr>
                        <td colspan="2">ชื่อโครงการ : <b><?php echo $_POST["project_name"]; ?></b></td>
                        <td colspan="2">ผู้จัดสรรโครงการ : <b><?php echo $_POST["builder"]; ?></b></td>
                        <td>ประเภท : <b><?php echo $_POST["type"]; ?></b></td>
                    </tr>
                    <tr>
                        
                    </tr>
                    <tr>
                        <td colspan="2">ที่อยู่ : <b><?php echo $_POST["address"]; ?></b></td>
                        <td>แขวง/ตำบล : <b><?php echo $_POST["sub_district"]; ?></b></td>
                        <td>เขต/อำเภอ : <b><?php echo $_POST["district"]; ?></b></td>
                        <td>จังหวัด : <b><?php echo $_POST["province"]; ?></b></td>
                    </tr>
                    <tr>
                        <td>Location code : <b><?php echo $_POST["location_code"]; ?></b></td>
                        <td>Location name : <b><?php echo $_POST["location_name"]; ?></b></td>
                        <td>พิกัด : <b><?php echo $_POST["location_lat_long"]; ?></b></td>
                        <td>Node ใกล้เคียง : <b><?php echo $_POST["node_nearby"]; ?></b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">หมายเหตุ : <b><?php echo $_POST["remark"]; ?></b></td>
                        <td colspan="2">ผู้รับผิดชอบโครงการ : <b><?php echo $_POST["sale_name"]; ?></b></td>
                    </tr>

                </table>
                </div>
                
            </div>
        </div>
                        
    </body>
</html>
