<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Petgroomingsoq - Admin</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../assets/AdminLTE/dist/css/adminlte.min.css">
    </head>
    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__wobble" src="../../assets/AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
            </div>
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item">
                        <a class="nav-link">
                            <h5 id="displayClock">00:00</h5>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <span class="brand-text font-weight-light">Petgroomingsoq</span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="../../assets/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?php print($_SESSION['admin']) ?></a>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p> Beranda 
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/product" class="nav-link">
                                    <i class="nav-icon fas fa-cube"></i>
                                    <p> Stock Produk
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/category" class="nav-link">
                                    <i class="nav-icon fas fa-cubes"></i>
                                    <p> Kategori Produk
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/petshop" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p> Data Petshop
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p> Akun <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/data_admin" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Admin</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/data_seller" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Seller</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/data_doctor" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dokter</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/admin/data_users" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pelanggan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-header">More Features</li>
                            <li class="nav-item">
                                <a href="/logout" class="nav-link">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p> Keluar </p>
                                </a>
                            </li>
                        </ul>
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
                                <h1 class="m-0">Selamat datang <?php print($_SESSION['admin']) ?>!</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="/">Halaman utama</a>
                                    </li>
                                    <li class="breadcrumb-item active">Halaman admin</li>
                                </ol>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Info boxes -->
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success elevation-1">
                                        <i class="nav-icon fas fa-cube"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Produk</span>
                                        <?php
                                            $sqlPrep = "SELECT * FROM tb_product";
                                            $prepare = $conn->prepare($sqlPrep);
                                            $prepare->execute();
                                            $count = $prepare->rowCount();
                                            echo '<span class="info-box-number">'.$count.'</span>';
                                        ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-info elevation-1">
                                        <i class="nav-icon fas fa-cubes"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Kategori</span>
                                        <?php
                                            $sqlPrep = "SELECT * FROM tb_category";
                                            $prepare = $conn->prepare($sqlPrep);
                                            $prepare->execute();
                                            $count = $prepare->rowCount();
                                            echo '<span class="info-box-number">'.$count.'</span>';
                                        ?>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <!-- fix for small devices only -->
                            <div class="clearfix hidden-md-up"></div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-success elevation-1">
                                        <i class="fas fa-user-nurse"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Dokter</span>
                                        <?php
                                            $sqlPrep = "SELECT * FROM tb_doctor";
                                            $prepare = $conn->prepare($sqlPrep);
                                            $prepare->execute();
                                            $count = $prepare->rowCount();
                                            echo '<span class="info-box-number">'.$count.'</span>';
                                        ?>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-info elevation-1">
                                        <i class="fas fa-users"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Akun Admin</span>
                                        <?php
                                            $sqlPrep = "SELECT * FROM tb_admin";
                                            $prepare = $conn->prepare($sqlPrep);
                                            $prepare->execute();
                                            $count = $prepare->rowCount();
                                            echo '<span class="info-box-number">'.$count.'</span>';
                                        ?>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>. </strong> All rights reserved. <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.2.0-rc
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->
        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="../../assets/AdminLTE/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="../../assets/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../assets/AdminLTE/dist/js/adminlte.js"></script>
        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="../../assets/AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
        <script src="../../assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../../assets/AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="../../assets/AdminLTE/plugins/select2/js/select2.full.min.js"></script>
        <script src="../../assets/module/sweetalert2/sweetalert2.min.js"></script>
        <script src="../../assets/AdminLTE/dist/js/ubaiid.js"></script>
    </body>
</html>