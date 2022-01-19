<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Petgroomingsoq - Product</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../assets/AdminLTE/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="../../assets/module/sweetalert2/sweetalert2.css">
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/summernote/summernote-bs4.min.css">
        <link rel="stylesheet" href="../../assets/AdminLTE/dist/css/ubaiid.css">
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
                                <a href="/admin" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p> Beranda 
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link active">
                                    <i class="nav-icon fas fa-cube"></i>
                                    <p> Stok Produk 
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
                                <h1 class="m-0">Stok produk </h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="/">Halaman utama</a>
                                    </li>
                                    <li class="breadcrumb-item active">Stok produk</li>
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
                        <!-- Main row -->
                        <div class="row">
                            <!-- general form elements disabled -->
                            <div class="card card-success col-12">
                            <div class="card-header">
                                <h3 class="card-title">Tambah / Edit Produk</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form id="product_main">
                                    <input type="hidden" id="main_product" value="add">
                                    <input type="hidden" id="product_id" value="0">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label for="product_name">Nama Produk</label>
                                            <input type="text" class="form-control" id="product_name" placeholder="Nama Produk">
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label for="category_product">Kategori Produk</label>
                                            <div class="select2-purple">
                                                <select class="select2" id="category_product" multiple="multiple" data-placeholder="Pilih Kategori" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                            <?php
                                                $sqlStatement = "SELECT * FROM tb_category ORDER BY category_id ASC LIMIT 500";
                                                $runStatement = $conn->query($sqlStatement);
                                                $dataStatement = $runStatement->fetchAll();
                                                foreach($dataStatement as $row){
                                                    ?>
        <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
                                            <?php } ?>
    </select>
                                            </div>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label for="desc_product">Deskripsi Produk</label>
                                            <textarea class="form-control" rows="3" id="desc_product" placeholder="Deskripsi Produk"></textarea>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="input_harga">Harga Produk</label>
                                            <input type="number" id="input_harga" class="form-control" placeholder="Harga Produk">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_status">Tampilkan Produk</label>
                                            <input type="checkbox" name="my-checkbox" id="product_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                        </div>
                                        <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="product_image">Upload gambar produk</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="product_image">
                                                    <label class="custom-file-label gambarproduk" for="product_image">Pilih gambar</label>
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
                            <div class="col-md-12">
                                <!-- TABLE: LATEST ORDERS -->
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data produk yang sudah ada</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sqlStatement = "SELECT * FROM tb_product ORDER BY product_id DESC";
                                            $runStatement = $conn->query($sqlStatement);
                                            $dataStatement = $runStatement->fetchAll();
                                            foreach($dataStatement as $row){
                                                $prepareCategoroy = $row['category_id'];
                                                $pisahin = explode(', ', $prepareCategoroy);
                                                $categoryBanyak = [];
                                                if(!isset($pisahin[1])){
                                                    $ambilCategoroy = $conn->query("SELECT * FROM tb_category WHERE category_id = '".$row['category_id']."'");
                                                    $arrr = $ambilCategoroy->fetch();
                                                    $category = $arrr['category_name'];
                                                } else {
                                                    $ambilCategoroy = $conn->query("SELECT * FROM tb_category WHERE category_id = '".$row['category_id']."'");
                                                    $arrr = $ambilCategoroy->fetch();
                                                    $category = $arrr['category_name'];
                                                }
                                                ?><tr>
                                            <td><?php echo $row['product_name']; ?></td>
                                            <td><?php echo $category; ?></td>
                                            <td><?php echo strip_tags(short_str($row['product_description'])); ?></td>
                                            <td><?php echo $row['product_price']; ?>0</td>
                                            <td><img src="../../assets/images/product_image/<?php echo $row['product_image']; ?>" name="<?php echo $row['product_image']; ?>" title="<?php echo $row['product_image']; ?>" width="60" height="60"></td>
                                            <td><?php echo $row['product_status']; ?></td>
                                            <td><button type="button" class="btn bg-gradient-primary btn-sm edit_product_action" name="<?php echo $row['product_name']; ?>" value="<?php echo $row['product_id']; ?>"><i class="fa fa-edit"></i> Ubah</button><button type="button" class="btn bg-gradient-danger btn-sm delete_item" name="<?php echo $row['product_name']; ?>" value="<?php echo $row['product_id']; ?>"><i class="fa fa-trash"></i> Hapus</button></td>
                                        </tr><?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
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