
$(document).ready(function() {
      $(document).on('click', '.admin', function() {
        var token = $('#tokens').val();
        var user = $('#username').val();
        var pass = $('#password').val();
        $.ajax({
            type: 'POST',
            url:  '/login',
            data: {login: 'login', username: user, password: pass, token: token},
            // here
            beforeSend: function() {
                Swal.fire({
                    title: 'Harap tunggu...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didRender: function() {
                        Swal.showLoading()
                    }
                });
            },
            success: function(data) {
                if (data == 'nosession_token') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'sesi token tidak ditemukan!'
                    });
                } else if (data == 'empty_token') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'token tidak ada/kosong!'
                    }); 
                } else if (data == 'invalid_token') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'token tidak sama!'
                    });
                } else if (data == 'invalid_username') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Username atau Email tidak dikenal!'
                    });
                } else if (data == 'invalid_password') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Password yang anda masukkan salah!'
                    });
                } else if (data == 'login_success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Selamat datang!'
                    });
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Error tidak diketahui!'
                    });
                    console.log(data);
                    return false;
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error tidak diketahui!'
                });
                return false;
            }
        });
        swal.clickConfirm();
    });
    $(document).on('click', '.dokter', function() {
        var token = $('#tokens').val();
        var user = $('#username').val();
        var pass = $('#password').val();
        $.ajax({
            type: 'POST',
            url:  '/login',
            data: {login_dokter: 'login_dokter', username: user, password: pass, token: token},
            // here
            beforeSend: function() {
                Swal.fire({
                    title: 'Harap tunggu...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didRender: function() {
                        Swal.showLoading()
                    }
                });
            },
            success: function(data) {
                if (data == 'nosession_token') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'sesi token tidak ditemukan!'
                    });
                } else if (data == 'empty_token') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'token tidak ada/kosong!'
                    }); 
                } else if (data == 'invalid_token') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'token tidak sama!'
                    });
                } else if (data == 'invalid_username') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Username atau Email tidak dikenal!'
                    });
                } else if (data == 'invalid_password') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Password yang anda masukkan salah!'
                    });
                } else if (data == 'login_success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Selamat datang!'
                    });
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Error tidak diketahui!'
                    });
                    console.log(data);
                    return false;
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error tidak diketahui!'
                });
                return false;
            }
        });
    });
    $(document).on('click', '.pelanggan', function() {
        var token = $('#tokens').val();
        var user = $('#username').val();
        var pass = $('#password').val();
        $.ajax({
            type: 'POST',
            url:  '/login',
            data: {login_pelanggan: 'login_pelanggan', username: user, password: pass, token: token},
            // here
            beforeSend: function() {
                Swal.fire({
                    title: 'Harap tunggu...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didRender: function() {
                        Swal.showLoading()
                    }
                });
            },
            success: function(data) {
                if (data == 'nosession_token') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'sesi token tidak ditemukan!'
                    });
                } else if (data == 'empty_token') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'token tidak ada/kosong!'
                    }); 
                } else if (data == 'invalid_token') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'token tidak sama!'
                    });
                } else if (data == 'invalid_username') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Username atau Email tidak dikenal!'
                    });
                } else if (data == 'invalid_password') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Password yang anda masukkan salah!'
                    });
                } else if (data == 'login_success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Selamat datang!'
                    });
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Error tidak diketahui!'
                    });
                    console.log(data);
                    return false;
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error tidak diketahui!'
                });
                return false;
            }
        });
    });
    $('#login').submit(function (e) {
        var user = $('#username').val();
        var pass = $('#password').val();
        if (user == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi username atau email anda!'
            });
        } else if (pass == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi kata sandi anda!'
            });
        } else {
            Swal.fire({
                title: 'Masuk sebagai',
                html:
                    '<button type="button" role="button" tabindex="0" class="admin btn btn-outline-success">' + 'Admin' + '</button> ' +
                    '<button type="button" role="button" tabindex="0" class="dokter btn btn-outline-warning">' + 'Dokter' + '</button> '+
                    '<button type="button" role="button" tabindex="0" class="pelanggan btn btn-outline-light">' + 'Pelanggan' + '</button>',
                showCancelButton: false,
                showConfirmButton: false
            });
        }
        e.preventDefault();
    })
    $('#register').submit(function (e) {
        var nama = $('#nama').val();
        var notelp = $('#notelp').val();
        var email = $('#email').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var repassword = $('#repassword').val();
        if (nama == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi nama anda!'
            });
        } else if (notelp == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi nomor telepon anda!'
            });
        } else if (email == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi email anda!'
            });
        } else if (username == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi username anda!'
            });
        } else if (password == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi kata sandi anda!'
            });
        } else if (repassword == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap ketik ulang kata sandi anda!'
            });
        } else if (password !== repassword) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Kata sandi tidak cocok!'
            });
        } else {
            $.ajax({
                type: 'POST',
                url:  '/login',
                data: {register_pelanggan: 'register_pelanggan', nama: nama, notelp: notelp, email: email, username: username, password: password},
                // here
                beforeSend: function() {
                    Swal.fire({
                        title: 'Harap tunggu...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didRender: function() {
                            Swal.showLoading()
                        }
                    });
                },
                success: function(data) {
                    if (data == 'nosession_token') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'sesi token tidak ditemukan!'
                        });
                    } else if (data == 'empty_token') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'token tidak ada/kosong!'
                        }); 
                    } else if (data == 'invalid_token') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'token tidak sama!'
                        });
                    } else if (data == 'invalid_username') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Username atau Email tidak dikenal!'
                        });
                    } else if (data == 'invalid_password') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Password yang anda masukkan salah!'
                        });
                    } else if (data == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Pendaftaran berhasil, silahkan login!'
                        });
                        window.location.href = '/login';
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Error tidak diketahui!'
                        });
                        console.log(data);
                        return false;
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Error tidak diketahui!'
                    });
                    return false;
                }
            });
        }
        e.preventDefault();
    })
});