<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ECO Management System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- Icon Title -->
  <link rel="shortcut icon" href="<?= base_url() ?>uploads/logo/logo.jpg">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-red sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?= base_url('Dashboard') ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>EMS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><i class="fa fa-cube"></i> <b>EMS</b> ECO</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> ECO Management System</a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs" hidden>
                  <?=
                  $id = $this->fungsi->user_login()->id_user;
                  ?></span>
                <span class="hidden-xs"><?= $this->fungsi->user_login()->nama; ?></span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?= base_url() ?>uploads/logo/logo.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <a href="<?= base_url('dashboard'); ?>">
              <span>
                <h5><i class="fa fa-circle text-success"></i> <?= $this->fungsi->user_login()->nama; ?></h5>
              </span>
            </a>
          </div>
        </div>

        <!-- Administrator -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php if ($this->session->userdata('level') == 1) { ?>
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
              <a href="<?= base_url('dashboard'); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="header">MASTER DATA</li>
            <li <?= $this->uri->segment(1) == 'User' ? 'class="active"' : '' ?>>
              <a href="<?= base_url('User') ?>">
                <i class="fa fa-users"></i> <span> User Data</span></a>
            </li>
            <li class="header">ECO Management</li>
            <li <?= $this->uri->segment(1) == 'ECO' ? 'class="active"' : '' ?>>
              <a href="<?= base_url('ECO') ?>">
                <i class="fa fa-cubes"></i> <span>ECO Data</span>
              </a>
            </li>
            <li <?= $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
              <a href="<?= base_url('eco/status_report') ?>">
                <i class="fa fa-list"></i> <span>ECO Status Report</span>
              </a>
            </li>
            <!-- <li class="treeview menu-open">
              <a href="">
                <i class="fa fa-cubes"></i> <span>Item Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                <ul class="treeview-menu">
                  <li <?= $this->uri->segment(1) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('#') ?>"><i class="fa fa-circle-o"></i> Finish Good</a></li>
                  <li <?= $this->uri->segment(1) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('#') ?>"><i class="fa fa-circle-o"></i> Sub Materials</a></li>
                </ul>
              </a>
            </li>
            <li <?= $this->uri->segment(1) == 'User' ? 'class="active"' : '' ?>>
              <a href="<?= base_url('Bom') ?>">
                <i class="fa fa-list"></i> <span> BOM</span></a>
            </li>
            <li class="header">APPROVAL DATA</li>
            <li class="treeview menu-open">
              <a href="">
                <i class="fa fa-exchange"></i> <span>List Approval</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                <ul class="treeview-menu">
                  <li <?= $this->uri->segment(1) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('#') ?>"><i class="fa fa-circle-o"></i> Bill Off Materials</a></li>
                  <li <?= $this->uri->segment(1) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('#') ?>"><i class="fa fa-circle-o"></i> Cost Table</a></li>
                </ul>
              </a>
            </li> -->
          <?php } ?>

          <!-- Manager -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php if ($this->session->userdata('level') == 2) { ?>
            <ul class="sidebar-menu" data-widget="tree">
              <li class="header">MAIN NAVIGATION</li>
              <li <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
                <a href="<?= base_url('dashboard'); ?>">
                  <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
              </li>
              <li class="header">MASTER DATA</li>
              <li <?= $this->uri->segment(1) == 'User' ? 'class="active"' : '' ?>>
                <a href="<?= base_url('User') ?>">
                  <i class="fa fa-users"></i> <span> User Data</span></a>
              </li>
            <?php } ?>

            <!-- SPV -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php if ($this->session->userdata('level') == 3) { ?>
              <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
                  <a href="<?= base_url('dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                  </a>
                </li>
                <li class="header">MASTER DATA</li>
                <li <?= $this->uri->segment(1) == 'User' ? 'class="active"' : '' ?>>
                  <a href="<?= base_url('User') ?>">
                    <i class="fa fa-users"></i> <span> User Data</span></a>
                </li>
              <?php } ?>

              <!-- User -->
              <!-- sidebar menu: : style can be found in sidebar.less -->
              <?php if ($this->session->userdata('level') == 4) { ?>
                <ul class="sidebar-menu" data-widget="tree">
                  <li class="header">MAIN NAVIGATION</li>
                  <li <?= $this->uri->segment(4) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
                    <a href="<?= base_url('dashboard'); ?>">
                      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                  </li>
                <?php } ?>
                <!-- \\User -->

                <li class="header">USER</li>
                <li><a href="<?= site_url('Auth/logout') ?>"><i class="fa fa-caret-square-o-right text-red"></i> <span>Logout</span></a></li>
                </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php echo $contents ?>
    </div>
    <!-- /.content-wrapper -->
    <!-- ================================================== -->

    <footer class="main-footer">
      <strong>Copyright &copy; 2025</strong> Had's Project : PT. Habdong Indonesia - Bekasi
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?= base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?= base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url() ?>assets/bower_components/chart.js/Chart.js"></script>
  <!-- Page script -->
  <script>
    $(document).ready(function() {
      $('.sidebar-menu').tree()
    })
  </script>
  <!-- page script -->
  <script>
    $(function() {
      $('#example1').DataTable()
      $('#example2').DataTable()
    })
  </script>
</body>

</html>