<?php
include('Classes/connection_pdo.php');

        
        $db = new DB();
	//header("Location: assign_menu.php?sale_id=".$_POST["sale_id"]);
        
        $menu ="";
        foreach($_POST["menu_permission"] as $str_check) {
            $menu .= $str_check;
            
        }
        //cho $menu;
        
	$sql = "UPDATE sale_user SET 
			user_email = '".$_POST["email"]."' ,
                        user_tel = '".$_POST["tel"]."' ,
                        permission_menu_id = '".$menu."' 
			WHERE user_code = '".$_POST["sale_id"]."' ";


        $sale_id = $_POST["sale_name"];
        $sale_name = $_POST["sale_name"];
        $sale_email = $_POST["email"];
        $sale_tel = $_POST["tel"];
        
	$query = $db->query($sql);
	$query = $db->execute();
        
        
?>
<html>
    <head>
        <title>กำลังกำหนดสิทธิ์..</title>
        <meta http-equiv="refresh" content="2; url=assign_menu.php" />
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
                <span style="color:#ffffff;">กำลังกำหนดสิทธิ์ <img src="media/images/spinners/circle-bub_ocean.gif"></span>
            </h3>
            </div>
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                <table class="table table-bordered" style="border:solid white 1px">
                    <tr class="text-center">
                        <td>รหัสพนักงาน</td>
                        <td>ชื่อ-นามสกุล </td>
                        <td>Email</td>
                        <td>เบอร์โทร</td>
                    </tr>
                    <tr class="text-center">
                        <td><?php echo $sale_id ; ?></td>
                        <td><?php echo $sale_name ; ?></td>
                        <td><?php echo $sale_email ; ?></td>
                        <td><?php echo $sale_tel ; ?></td>
                    </tr>
                    <tr  class= "text-center" style="background-color: #ffffff;color: #164761;">
                        <td>เมนู</td>
                        <td colspan="3"><?php echo $menu ; ?></td>
                    </tr>
                </table>
                </div>
                
            </div>
        </div>
                        
    </body>
</html>
