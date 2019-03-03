<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NYSC System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>css/bootstrap3-wysihtml5.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ui/'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/ui/'); ?>css/jquery.datetimepicker.css"/>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php base_url('admin') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D </b>E</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>NYSC </b>System</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="<?php echo base_url('logout') ?>"> Logout <i class="fa fa-lock"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li style = "text-align:center;" class="header">MAIN NAVIGATION</li>
        <?php if($user->role == "ROLE_ADMIN"): ?>
            <li><a href="<?php echo base_url('/add-batch'); ?>"><i class="fa fa-circle-o"></i> Profile Batch Information</a></li>
            <li><a href="<?php echo base_url('/edit-batch'); ?>"><i class="fa fa-circle-o"></i> Edit Batch Information</a></li>
            <li><a href="<?php echo base_url('/add-institution'); ?>"><i class="fa fa-circle-o"></i> Add Institution</a></li>
            <li><a href="<?php echo base_url('/view-institutions'); ?>"><i class="fa fa-circle-o"></i> Edit Institution</a></li>
            <li><a href="<?php echo base_url('/add-ppa'); ?>"><i class="fa fa-circle-o"></i> Add PPA</a></li>
            <li><a href="<?php echo base_url('/view-ppa'); ?>"><i class="fa fa-circle-o"></i> Edit PPA</a></li>
            <li><a href="<?php echo base_url('/upload'); ?>"><i class="fa fa-circle-o"></i> Upload Mobilized Students</a></li>
            <li><a href="<?php echo base_url('/deploy-students'); ?>"><i class="fa fa-circle-o"></i>Deploy Students (Batch)</a></li>
            <li><a href="<?php echo base_url('/redeploy-student'); ?>"><i class="fa fa-circle-o"></i> Redeploy Student</a></li>
            <li><a href="<?php echo base_url('/view-mobilization-list'); ?>"><i class="fa fa-circle-o"></i> View Mobilization List</a></li>
            <li><a href="<?php echo base_url('/view-mobilization-status'); ?>"><i class="fa fa-circle-o"></i> Student Mobilization Status</a></li>
            <li><a href="<?php echo base_url('/view-deployment-list'); ?>"><i class="fa fa-circle-o"></i> View Deployment List</a></li>
            <li><a href="<?php echo base_url('/view-deployment-status'); ?>"><i class="fa fa-circle-o"></i> Student Deployment Status</a></li>
            <li><a href="<?php echo base_url('/reset'); ?>"><i class="fa fa-circle-o"></i> Reset System for new Batch</a></li>
        <?php endif; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">