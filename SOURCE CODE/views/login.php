<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Petgroomingsoq - Login</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="../../assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/AdminLTE/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="../../assets/css/login.css">
        <link rel="stylesheet" href="../../assets/module/sweetalert2/sweetalert2.css">

    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1">
                        <b>Petgroomingsoq </b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Masuk untuk memulai sesi anda!</p>
                    <form id="login">
                        <div class="input-group mb-3">
                            <input type="hidden" id="tokens" value="<?php print($_SESSION['token']) ?>">
                            <input type="text" class="form-control" id="username" placeholder="Username Atau Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password" class="form-control" placeholder="Kata Sandi">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mb-1">
                        <a href="/register">Daftar</a>
                    </p>
                    <p class="mb-1">
                        <a href="/">Kembali</a>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->
        <!-- jQuery -->
        <script src="../../assets/AdminLTE/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../assets/AdminLTE/dist/js/adminlte.min.js"></script>
        <script src="../../assets/module/sweetalert2/sweetalert2.min.js"></script>
        <script src="../../assets/module/cryptoJS/cryptoJS.js"></script>
        <script src="../../assets/js/main.js"></script>
    </body>
</html>