<?php

$sidebar_normal = '
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
        <p> Petshop Saya
        </p>
    </a>
</li>
<li class="nav-header">More Features</li>
<li class="nav-item">
    <a href="/logout" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p> Keluar </p>
    </a>
</li>
</ul>';

$sidebar_nulled = '
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
<li class="nav-item">
    <a href="javascript:void(0)" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p> Beranda 
        </p>
    </a>
</li>
<li class="nav-header">More Features</li>
<li class="nav-item">
    <a href="/logout" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p> Keluar </p>
    </a>
</li>
</ul>
';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Petgroomingsoq - Dashboard</title>
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
                            <a href="#" class="d-block"><?php print($_SESSION['seller']) ?></a>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <?php
                            $prepareSelect = $conn->prepare("SELECT * FROM tb_petshop WHERE addby = '".$_SESSION['seller']."'");
                            $prepareSelect->execute();
                            $hitung = $prepareSelect->rowCount();
                            if ($hitung > 0) {
                                echo $sidebar_normal;
                            } else {
                                echo $sidebar_nulled;
                            }
                        ?>
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
                                <h1 class="m-0">Selamat datang <?php print($_SESSION['seller']) ?>!</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="/">Halaman seller</a>
                                    </li>
                                    <li class="breadcrumb-item active">Halaman seller</li>
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
                <?php
                    $prepareSelect = $conn->prepare("SELECT * FROM tb_petshop WHERE addby = '".$_SESSION['seller']."'");
                    $prepareSelect->execute();
                    $hitung = $prepareSelect->rowCount();
                    if ($hitung > 0) {
                        ?>
                <section class="content">
                    <div class="container-fluid">
                        <!-- Info boxes -->
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success elevation-1">
                                        <i class="nav-icon fas fa-cube"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Produk</span>
                                        <?php
                                            echo '<span class="info-box-number">'.$totalProdukSeller.'</span>';
                                        ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-6">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-info elevation-1">
                                        <i class="nav-icon fas fa-cubes"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Kategori</span>
                                        <?php
                                            echo '<span class="info-box-number">'.$totalKategoriSeller.'</span>';
                                        ?>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <!-- fix for small devices only -->
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!--/. container-fluid -->
                </section>
                        <?php
                    } else {
                        ?>
                <section class="content">
                    <div class="container-fluid">
                        <!-- Main row -->
                        <div class="row">
                            <!-- general form elements disabled -->
                            <div class="card card-success col-12">
                            <div class="card-header">
                                <h3 class="card-title">Harap tambahkan petshop anda.</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form id="petshop_main">
                                    <input type="hidden" id="main_petshop" value="add">
                                    <input type="hidden" id="petshop_id" value="0">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label for="petshop_name">Nama Petshop</label>
                                            <input type="text" class="form-control" id="petshop_name" placeholder="Nama Petshop">
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label for="petshop_telp">Nomor Telp Petshop</label>
                                            <input type="text" class="form-control" id="petshop_telp" placeholder="Nomor Telp Petshop">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label for="petshop_desc">Deskripsi Petshop</label>
                                            <textarea class="form-control" rows="3" id="petshop_desc" placeholder="Deskripsi Petshop"></textarea>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label for="petshop_adress">Alamat petshop</label>
                                            <input type="text" class="form-control" id="petshop_adress" placeholder="Alamat Petshop">
                                        </div>
                                        </div>
                                        <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="petshop_image">Upload gambar petshop</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="petshop_image">
                                                    <label class="custom-file-label gambarproduk" for="petshop_image">Pilih gambar</label>
                                                </div>
                                            </div>
                                            <span>Ekstensi file yang di izinkan : <?php $valid = implode(', ', $valid_extension); print_r($valid); ?></span>
                                        </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary productAction">Tambah</button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!--/. container-fluid -->
                </section>
                        <?php
                    }
                ?>
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