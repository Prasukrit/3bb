<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
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
        <a class="navbar-brand bg-white" href="#">
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
          <li <?php if ($page == 'index.php') { ?>class="active"<?php } ?> >
            <a href="index.php">
              <i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;โครงการ
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li <?php if ($page == 'importfile.php') { ?>class="active"<?php } ?>>
            <a href="importfile.php">
              <i class="glyphicon glyphicon-import"></i>&nbsp;&nbsp;Import
            </a>
          </li>
          <li <?php if ($page == 'manageproject.php') { ?>class="active"<?php } ?>>
            <a href="manageproject.php">
              <i class="glyphicon glyphicon-check"></i>&nbsp;&nbsp;จัดสรรโครงการ
            </a>
          </li>
          <!--<li <?php if ($page == 'importfile.php') { ?>class="active dropdown"<?php } ?> >
            <a href="importfile.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="  glyphicon glyphicon-saved"></i>Import/Export
              
            </a>
            <ul class="dropdown-menu">
              <li <?php if ($page == 'importfile.php') { ?>class="active"<?php } ?>>
                <a href="importfile.php"><i class="glyphicon glyphicon-import"></i>Import</a>
              </li>
              <li role="separator" class="divider"></li>
              <li <?php if ($page == 'exportfile.php') { ?>class="active"<?php } ?>>
                <a href="exportfile.php"><i class="glyphicon glyphicon-export"></i>Export</a>
              </li>
              

            </ul>
          </li>-->
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