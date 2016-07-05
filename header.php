<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
<?php 
    
    include('Classes/connection_mysqli.php');
    
    $sql_menu = "SELECT * FROM sale_user WHERE user_email ='".$_SESSION['ro10app']."'" ;
    $query_menu = mysqli_query($conn, $sql_menu);
    $row_menu_id = mysqli_fetch_assoc($query_menu);
    $sale_perrmission_menu = $row_menu_id["permission_menu_id"];
    //echo $sale_perrmission_menu;
    
//    echo "<br> menu_id1 : ".  strpos($sale_perrmission_menu, "menu_id1");
//    echo "<br> menu_id2 : ".  strpos($sale_perrmission_menu, "menu_id2");
//    echo "<br> menu_id3 : ".  strpos($sale_perrmission_menu, "menu_id3");
    
?>

<nav class="navbar navbar-default ">

    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand bg-white" href="index.php">
                <div>
                    <img class="logo-box" src="2/img/logo_3bb.png" alt=""  />
                    <span style="font-size:22px;font-weight:500;font-style:italic;">
                        -
                        <span style="color:orange">N</span>
                        ode3
                    </span>
                </div>

            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav">
                <?php if(strpos(trim($sale_perrmission_menu),"menu_id1") == "0"  ) { ?>
                <li <?php if ($page == 'index.php' || $page =='detail.php' ) { ?>class="active"<?php } ?> >
                    <a href="index.php?menu_id=1">
                        <i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;โครงการ
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php } ?>
                
                <?php if(strpos($sale_perrmission_menu,"menu_id2") != ""  ) { ?>
                <li <?php if ($page == 'importfile.php') { ?>class="active"<?php } ?>>
                    <a href="importfile.php?menu_id=2">
                        <i class="glyphicon glyphicon-import"></i>&nbsp;&nbsp;Import
                    </a>
                </li>
                <?php } ?>
                
                <?php if(strpos($sale_perrmission_menu,"menu_id3") != "" ) { ?>
                <li <?php if ($page == 'manageproject.php' || $page =='manageproject_1.php' || $page == 'update_manageproject.php' ) { ?>class="active"<?php } ?>>
                    <a href="manageproject.php?menu_id=3">
                        <i class="glyphicon glyphicon-check"></i>&nbsp;&nbsp;จัดสรรโครงการ
                    </a>
                </li>
                <?php } ?>
                
                <?php if(strpos($sale_perrmission_menu,"menu_id4") != "" ) { ?>
                <li <?php if ($page == 'assign_menu.php' || $page == 'update_assign_menu.php') { ?>class="active"<?php } ?>>
                    <a href="assign_menu.php?menu_id=4">
                        <i class="glyphicon glyphicon-wrench"></i>&nbsp;&nbsp;กำหนดสิทธิ์เมนู
                    </a>
                </li>
                <?php }
                
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php echo $row_sale_match_name; ?>

                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">ออกจากระบบ</a>
                        </li>

                    </ul>

                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse --> </div>
    <!-- /.container --> </nav>
