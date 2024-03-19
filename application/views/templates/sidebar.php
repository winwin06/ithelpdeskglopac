<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Sidebar -->
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Dropdown user menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" id="userDropdown" role="button">
            <i class="far fa-user"></i>
            <!-- <i class="right fas fa-angle-right"></i> -->
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">User Options</span>
            <div class="dropdown-divider">
            </div>
            <a href="<?= site_url('dashboard/my_profile') ?>" class="dropdown-item">
              <i class="fas fa-user mr-2"></i>My Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= site_url('dashboard') ?>" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
              </i>
            </a>
          </div>
        </li>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/') ?>dist/img/logo_glopac.png" alt="Glopac Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Glopac Slayy</span>
      </a>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
            <a href="<?= site_url('dashboard/dashboard') ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          <li class="nav-header">Job Request</li>
          <li class="nav-item">
            <a href="<?= site_url('dashboard/job_request') ?>" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>Job Request</p>
            </a>
          </li>
          <li class="nav-header">My Profile</li>
          <li class="nav-item">
            <a href="<?= site_url('dashboard/my_profile') ?>" class="nav-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>My Profile</p>
            </a>
          </li>

          <hr class="mt-5 mb-5">
          <li class="nav-item">
            <a href="<?= site_url('') ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>

      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $title ?></h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      </div>