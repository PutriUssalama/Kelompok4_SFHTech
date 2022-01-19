function displayClock(){
    var display = new Date().toLocaleTimeString();
    $('#displayClock').html(display);
    setTimeout(displayClock, 1000); 
}

function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
}

$(document).ready(function() {
    displayClock();
    $('.select2').select2({
        maximumSelectionLength: 1
    });
    $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": true, "searching": true,"buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#input_harga').keyup(function(e) {
        $('#input_harga').val(formatRupiah($('#input_harga').val()));
    });
    $('#category_main').submit(function (e) {
        var main = $('#main').val();
        var category_name = $('#name_category').val();
        if (main == 'add') {
            var cat_name = $('#name_category').val();
            if (cat_name == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi nama Kategori Produk!'
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: {add_category: 'add_category', category_name: category_name},
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Berhasil menambah kategori produk!'
                            });
                            location.reload();
                        } else if (data == 'exist') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Kategori dengan nama yang sama sudah ada!'
                            });
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
        } else if (main == 'edit') {
            var cat_name = $('#name_category').val();
            var cat_id = $('#category_id').val();
            if (cat_name == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi nama Kategori Produk!'
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: {edit_category: 'edit_category', category_name: cat_name, cat_id: cat_id},
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Berhasil mengubah kategori produk!'
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
            }
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Selamat datang!'
            });
        }
        e.preventDefault();
    });
    $('#product_main').submit(function (e) {
        var pid = $('#product_id').val();
        var main = $('#main_product').val();
        var fd = new FormData();
        if($("input[data-bootstrap-switch]").is(":checked")) {
            product_stat = 'Tampilkan';
        } else {
            product_stat = 'Sembunyikan';
        }
        fd.append('product_main', main);
        fd.append('product_id', pid);
        fd.append('product_name', $('#product_name').val());
        fd.append('category_product', $('#category_product').val());
        fd.append('desc_product', $('#desc_product').val());
        fd.append('input_harga', $('#input_harga').val());
        fd.append('product_status', product_stat);
        fd.append('product_image', $('#product_image').val());
        fd.append('produkgambar', $('#product_image')[0].files[0]);
        if($('#product_name').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi nama produk!'
            });
        } else if($('#category_product').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi kategori produk!'
            });
        } else if (!$.trim($("#desc_product").val())) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi deskripsi produk!'
            });
        } else if($('#input_harga').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi harga produk!'
            });
        } else {
            $.ajax({
                type: 'POST',
                url:  '/admin/ajax_call',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
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
                    if (data == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Aksi Berhasil!'
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
        }
        e.preventDefault();
    });
    $('#petshop_main').submit(function (e) {
        var pid = $('#petshop_id').val();
        var main = $('#main_petshop').val();
        var fd = new FormData();
        fd.append('petshop_main', main);
        fd.append('petshop_id', pid);
        fd.append('petshop_name', $('#petshop_name').val());
        fd.append('petshop_telp', $('#petshop_telp').val());
        fd.append('petshop_desc', $('#petshop_desc').val());
        fd.append('petshop_adress', $('#petshop_adress').val());
        fd.append('petshop_image', $('#petshop_image')[0].files[0]);
        if($('#petshop_name').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi nama petshop!'
            });
        } else if($('#petshop_telp').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi nomor telp petshop!'
            });
        } else if ($("#petshop_desc").val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi deskripsi petshop!'
            });
        } else if($('#petshop_adress').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi alamat petshop!'
            });
        } else if($('#petshop_image').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi foto petshop!'
            });
        } else {
            $.ajax({
                type: 'POST',
                url:  '/admin/ajax_call',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
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
                    if (data == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Aksi Berhasil!'
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
        }
        e.preventDefault();
    });
    $('#admin_main').submit(function (e) {
        var main = $('#main_admin').val();
        var fd = new FormData();
        fd.append('admin_main', main);
        fd.append('admin_id', $('#admin_id').val());
        fd.append('admin_name', $('#nama_admin').val());
        fd.append('username', $('#username').val());
        fd.append('password', $('#pass').val());
        fd.append('admin_telp', $('#no_telp').val());
        fd.append('admin_email', $('#email').val());
        fd.append('admin_adress', $('#adress').val());
        if($('#nama_admin').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi Nama!'
            });
        } else if($('#no_telp').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi nomor telepon!'
            });
        } else if($('#email').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi email!'
            });
        } else if($('#adress').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi alamat tinggal!'
            });
        } else if($('#username').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi Nama Pengguna!'
            });
        } else if($('#pass').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi Kata Sandi!'
            });
        } else if($('#repass').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap ketik ulang Kata Sandi!'
            });
        } else if($('#pass').val() !== $('#repass').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Kata sandi tidak sama!'
            });
        } else {
            $.ajax({
                type: 'POST',
                url:  '/admin/ajax_call',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
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
                    if (data == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Aksi Berhasil!'
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
        }
        e.preventDefault();
    });
    $('#doctor_main').submit(function (e) {
        var main = $('#main_doctor').val();
        var fd = new FormData();
        fd.append('doctor_main', main);
        fd.append('doctor_id', $('#doctor_id').val());
        fd.append('doctor_name', $('#nama_dokter').val());
        fd.append('username', $('#username').val());
        fd.append('password', $('#pass').val());
        fd.append('doctor_telp', $('#no_telp').val());
        fd.append('doctor_email', $('#email').val());
        fd.append('doctor_adress', $('#adress').val());
        fd.append('doctor_info', $('#info').val());
        fd.append('profile_image', $('#profile_img').val());
        fd.append('profile_img', $('#profile_img')[0].files[0]);
        if(main == 'add'){
            if($('#nama_dokter').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Nama dokter!'
                });
            } else if($('#no_telp').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi nomor telepon dokter!'
                });
            } else if($('#email').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi email dokter!'
                });
            } else if($('#adress').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi alamat tinggal dokter!'
                });
            } else if($('#profile_img').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap pilih foto profil! dokter'
                });
            } else if($('#username').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Nama Pengguna dokter!'
                });
            } else if($('#pass').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Kata Sandi dokter!'
                });
            } else if($('#repass').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap ketik ulang Kata Sandi dokter!'
                });
            } else if($('#pass').val() !== $('#repass').val()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Kata sandi tidak sama!'
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Aksi Berhasil!'
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
            }
        } else if(main == 'edit'){
            if($('#nama_dokter').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Nama dokter yang baru!'
                });
            } else if($('#no_telp').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi nomor telepon dokter yang baru!'
                });
            } else if($('#email').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi email dokter yang baru!'
                });
            } else if($('#adress').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi alamat tinggal dokter yang baru!'
                });
            } else if($('#username').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Nama Pengguna dokter yang baru!'
                });
            } else if($('#pass').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Kata Sandi dokter yang baru!'
                });
            } else if($('#repass').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap ketik ulang Kata Sandi dokter yang baru!'
                });
            } else if($('#pass').val() !== $('#repass').val()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Kata sandi tidak sama!'
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Aksi Berhasil!'
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
            }
        } else if(main == 'profiling'){
            if($('#nama_dokter').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Nama dokter yang baru!'
                });
            } else if($('#no_telp').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi nomor telepon dokter yang baru!'
                });
            } else if($('#email').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi email dokter yang baru!'
                });
            } else if($('#adress').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi alamat tinggal dokter yang baru!'
                });
            } else if($('#username').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Nama Pengguna dokter yang baru!'
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url:  '/accounts/ajax_call',
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Berhasil menyimpan akun anda!'
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
            }
        } else {
            return false;
        }
        e.preventDefault();
    });
    $('#changepassword').submit(function (e) {
        e.preventDefault();
        var oldpass = $('#oldpass').val();
        var newpass = $('#newpass').val();
        var renewpass = $('#renewpass').val();
        var main = 'change_password';
        var fd = new FormData();
        fd.append('doctor_main', main);
        fd.append('doctor_id', $('#doctor_id').val());
        fd.append('oldpass', oldpass);
        fd.append('newpass', newpass);
        if(oldpass == ''){
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi kata sandi lama anda!'
            });
        } else if(newpass == ''){
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi kata sandi baru anda!'
            });
        } else if(newpass !== renewpass){
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Kata sandi baru tidak sama!'
            });
        } else {
            $.ajax({
                type: 'POST',
                url:  '/accounts/ajax_call',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
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
                    if (data == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Berhasil mengganti kata sandi akun anda!'
                        });
                        location.reload();
                    } else if (data == 'wrong_old') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Kata sandi lama anda salah!'
                        });
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
    });
    $('#user_main').submit(function (e) {
        var main = $('#main_user').val();
        var fd = new FormData();
        fd.append('user_main', main);
        fd.append('user_id', $('#user_id').val());
        fd.append('user_name', $('#nama_pelanggan').val());
        fd.append('username', $('#username').val());
        fd.append('password', $('#pass').val());
        fd.append('user_telp', $('#no_telp').val());
        fd.append('user_info', $('#info').val());
        fd.append('user_email', $('#email').val());
        fd.append('user_adress', $('#adress').val());
        if(main == 'add'){
            if($('#nama_user').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Nama pelanggan!'
                });
            } else if($('#no_telp').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi nomor telepon pelanggan!'
                });
            } else if($('#email').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi email pelanggan!'
                });
            } else if($('#adress').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi alamat tinggal pelanggan!'
                });
            } else if($('#username').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Nama Pengguna pelanggan!'
                });
            } else if($('#pass').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Kata Sandi pelanggan!'
                });
            } else if($('#repass').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap ketik ulang Kata Sandi pelanggan!'
                });
            } else if($('#pass').val() !== $('#repass').val()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Kata sandi tidak sama!'
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Aksi Berhasil!'
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
            }
        } else if(main == 'edit'){
            if($('#nama_pelanggan').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Nama pelanggan yang baru!'
                });
            } else if($('#no_telp').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi nomor telepon pelanggan yang baru!'
                });
            } else if($('#email').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi email pelanggan yang baru!'
                });
            } else if($('#adress').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi alamat tinggal pelanggan yang baru!'
                });
            } else if($('#username').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Nama Pengguna pelanggan yang baru!'
                });
            } else if($('#pass').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Kata Sandi pelanggan yang baru!'
                });
            } else if($('#repass').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap ketik ulang Kata Sandi pelanggan yang baru!'
                });
            } else if($('#pass').val() !== $('#repass').val()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Kata sandi tidak sama!'
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Aksi Berhasil!'
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
            }
        } else if(main == 'profiling'){
            if($('#nama_pelanggan').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi Nama anda!'
                });
            } else if($('#no_telp').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi nomor telepon anda!'
                });
            } else if($('#email').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi email anda!'
                });
            } else if($('#adress').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi alamat tinggal anda!'
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url:  '/accounts/ajax_call',
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Aksi Berhasil!'
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
            }
        } else {
            return false;
        }
        e.preventDefault();
    });
    $('#product_image').change(function(){
        var namefile = $(this).val();
        var validExtension = ['jpg', 'jpeg', 'png', 'gif'];
        splitting = namefile.split('.',);
        if(validExtension.includes(splitting[1])){
            $('.gambarproduk').html($(this).val());
        } else {
            $('.gambarproduk').html('Pilih gambar');
            $(this).val('');
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Ekstensi tidak diperbolehkan!'
            });
        }
    });
    $('#profile_img').change(function(){
        var namefile = $(this).val();
        var validExtension = ['jpg', 'jpeg', 'png', 'gif'];
        splitting = namefile.split('.',);
        if(validExtension.includes(splitting[1])){
            $('.profilimg').html($(this).val());
        } else {
            $('.profilimg').html('Pilih gambar');
            $(this).val('');
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Ekstensi tidak diperbolehkan!'
            });
        }
    });
    $('#example1').on('draw.dt', function() {
        $('.edit').click(function(){
            $('#main').val('edit');
            $('#name_category').val($(this).prop('name'));
            $('.submiting').html('Ubah');
            if($("#category_id").length > 0 ){
                $("#category_id").val($(this).prop('value'));
            }else{
                $("#category_id").val($(this).prop('value'));
             }
            document.body.scrollTop = document.documentElement.scrollTop = 0;
        });
        $('.edit_product_action').click(function(e){
            e.preventDefault();
            document.body.scrollTop = document.documentElement.scrollTop = 0;
            var item_id = $(this).prop('value');
            $('#product_id').val($(this).prop('value'));
            $.ajax({
                type: 'POST',
                url:  '/admin/ajax_call',
                data: {edit_product_action: 'edit_product_action', item_id: item_id},
                success: function(data) {
                    decode = JSON.parse(data);
                    Swal.close();
                    $('#main_product').val('edit');
                    $('#product_name').val(decode.product_name);
                    $('#category_product').val(decode.category_id);
                    $('#category_product').trigger('change');
                    if(decode.product_status == 'Tampilkan') {
                        $('#product_status').prop('checked', true).trigger('change');
                    } else {
                        $('#product_status').prop('checked', false).trigger('change');
                    }
                    $('#desc_product').summernote('code', decode.product_description);
                    $('#input_harga').val(decode.product_price+0);
                    $('.productAction').html('Ubah');
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
        $('.delete-cat').click(function(){
            var cat_id = $(this).prop('value');
            var cat_name = $(this).prop('name');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Aksi ini tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url:  '/admin/ajax_call',
                        data: {delete_category: 'delete_category', cat_id: cat_id},
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
                            if (data == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Kategori '+cat_name+' dihapus.'
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
                }
            })          
        });
        $('.delete_item').click(function(){
            var pid = $(this).prop('value');
            var product_name = $(this).prop('name');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Aksi ini tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url:  '/admin/ajax_call',
                        data: {product_main: 'del', pid: pid},
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
                            if (data == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Produk '+product_name+' berhasil dihapus.'
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
                }
            })          
        });
        $('.delete_admin').click(function(){
            var aid = $(this).prop('value');
            var admin_name = $(this).prop('name');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Aksi ini tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url:  '/admin/ajax_call',
                        data: {admin_main: 'del', aid: aid},
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
                            if (data == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Akun '+admin_name+' berhasil dihapus.'
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
                }
            })          
        });
        $('.edit_admin').click(function(e){
            e.preventDefault();
            document.body.scrollTop = document.documentElement.scrollTop = 0;
            var admin_id = $(this).prop('value');
            $('#admin_id').val(admin_id);
            $.ajax({
                type: 'POST',
                url:  '/admin/ajax_call',
                data: {admin_main: 'edit_act', admin_id: admin_id},
                success: function(data) {
                    decode = JSON.parse(data);
                    $('#main_admin').val('edit');
                    $('#nama_admin').val(decode.admin_name);
                    $('#no_telp').val(decode.admin_telp);
                    $('#email').val(decode.admin_email);
                    $('#adress').val(decode.admin_adress);
                    $('#username').val(decode.username);
                    $('.inputAction').html('Ubah');
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
        $('.delete_doctor').click(function(){
            var did = $(this).prop('value');
            var doctor_name = $(this).prop('name');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Aksi ini tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url:  '/admin/ajax_call',
                        data: {doctor_main: 'del', did: did},
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
                            if (data == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Akun '+doctor_name+' berhasil dihapus.'
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
                }
            })          
        });
        $('.edit_doctor').click(function(e){
            e.preventDefault();
            document.body.scrollTop = document.documentElement.scrollTop = 0;
            var doctor_id = $(this).prop('value');
            $('#doctor_id').val($(this).prop('value'));
            $.ajax({
                type: 'POST',
                url:  '/admin/ajax_call',
                data: {doctor_main: 'edit_act', doctor_id: doctor_id},
                success: function(data) {
                    decode = JSON.parse(data);
                    Swal.close();
                    $('#main_doctor').val('edit');
                    $('#doctor_id').val(decode.doctor_id);
                    $('#nama_dokter').val(decode.doctor_name);
                    $('#username').val(decode.username);
                    $('#no_telp').val(decode.doctor_telp);
                    $('#adress').val(decode.doctor_adress);
                    $('#email').val(decode.doctor_email);
                    $('#info').val(decode.doctor_info);
                    $('.inputAction').html('Ubah');
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
    });
    $('.edit').click(function(){
        $('#main').val('edit');
        $('#name_category').val($(this).prop('name'));
        $('.submiting').html('Ubah');
        if($("#category_id").length > 0 ){
            $("#category_id").val($(this).prop('value'));
        }else{
            $("#category_id").val($(this).prop('value'));
         }
        document.body.scrollTop = document.documentElement.scrollTop = 0;
    });
    $('.reply').click(function(){
        $('#reply').modal('show');
        $('#consultant').val($('#cons').html());
        $('#cid').val($(this).val());
    });
    $('.edit_product_action').click(function(e){
        e.preventDefault();
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        var item_id = $(this).prop('value');
        $('#product_id').val($(this).prop('value'));
        $.ajax({
            type: 'POST',
            url:  '/admin/ajax_call',
            data: {edit_product_action: 'edit_product_action', item_id: item_id},
            success: function(data) {
                decode = JSON.parse(data);
                Swal.close();
                $('#main_product').val('edit');
                $('#product_name').val(decode.product_name);
                $('#category_product').val(decode.category_id);
                $('#category_product').trigger('change');
                if(decode.product_status == 'Tampilkan') {
                    $('#product_status').prop('checked', true).trigger('change');
                } else {
                    $('#product_status').prop('checked', false).trigger('change');
                }
                $('#desc_product').summernote('code', decode.product_description);
                $('#input_harga').val(decode.product_price+0);
                $('.productAction').html('Ubah');
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
    $('.petshop_edit').click(function(e){
        e.preventDefault();
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        var item_id = $(this).prop('value');
        $('#petshop_id').val($(this).prop('value'));
        $.ajax({
            type: 'POST',
            url:  '/admin/ajax_call',
            data: {petshop_main: 'edit_act', petshop_id: item_id},
            success: function(data) {
                decode = JSON.parse(data);
                Swal.close();
                $('#main_petshop').val('edit');
                $('#petshop_name').val(decode.petshop_name);
                $('#petshop_telp').val(decode.petshop_telp);
                $('#petshop_desc').val(decode.petshop_info);
                $('#petshop_adress').val(decode.petshop_adress);
                $('.productAction').html('Ubah');
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
    $('.edit_doctor').click(function(e){
        e.preventDefault();
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        var doctor_id = $(this).prop('value');
        $('#doctor_id').val($(this).prop('value'));
        $.ajax({
            type: 'POST',
            url:  '/admin/ajax_call',
            data: {doctor_main: 'edit_act', doctor_id: doctor_id},
            success: function(data) {
                decode = JSON.parse(data);
                Swal.close();
                $('#main_doctor').val('edit');
                $('#doctor_id').val(decode.doctor_id);
                $('#nama_dokter').val(decode.doctor_name);
                $('#username').val(decode.username);
                $('#no_telp').val(decode.doctor_telp);
                $('#adress').val(decode.doctor_adress);
                $('#email').val(decode.doctor_email);
                $('#info').val(decode.doctor_info);
                $('.inputAction').html('Ubah');
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
    $('.edit_user').click(function(e){
        e.preventDefault();
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        var userid = $(this).prop('value');
        $('#user_id').val($(this).prop('value'));
        $.ajax({
            type: 'POST',
            url:  '/admin/ajax_call',
            data: {user_main: 'edit_act', userid: userid},
            success: function(data) {
                decode = JSON.parse(data);
                Swal.close();
                $('#main_user').val('edit');
                $('#user_id').val(decode.user_id);
                $('#nama_pelanggan').val(decode.user_name);
                $('#username').val(decode.username);
                $('#no_telp').val(decode.user_phone);
                $('#adress').val(decode.user_adress);
                $('#email').val(decode.user_email);
                $('.inputAction').html('Ubah');
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
    $('.edit_admin').click(function(e){
        e.preventDefault();
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        var admin_id = $(this).prop('value');
        $('#admin_id').val(admin_id);
        $.ajax({
            type: 'POST',
            url:  '/admin/ajax_call',
            data: {admin_main: 'edit_act', admin_id: admin_id},
            success: function(data) {
                decode = JSON.parse(data);
                $('#main_admin').val('edit');
                $('#nama_admin').val(decode.admin_name);
                $('#no_telp').val(decode.admin_telp);
                $('#email').val(decode.admin_email);
                $('#adress').val(decode.admin_adress);
                $('#username').val(decode.username);
                $('.inputAction').html('Ubah');
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
    $('.delete-cat').click(function(){
        var cat_id = $(this).prop('value');
        var cat_name = $(this).prop('name');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Aksi ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: {delete_category: 'delete_category', cat_id: cat_id},
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Kategori '+cat_name+' dihapus.'
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
            }
        })          
    });
    $('.delete_item').click(function(){
        var pid = $(this).prop('value');
        var product_name = $(this).prop('name');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Aksi ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: {product_main: 'del', pid: pid},
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Produk '+product_name+' berhasil dihapus.'
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
            }
        })          
    });
    $('.petshop_delete').click(function(){
        var pid = $(this).prop('value');
        var petshop_name = $(this).prop('name');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Aksi ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: {petshop_main: 'del', pid: pid},
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Petshop '+petshop_name+' berhasil dihapus.'
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
            }
        })          
    });
    $('.delete_admin').click(function(){
        var aid = $(this).prop('value');
        var admin_name = $(this).prop('name');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Aksi ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: {admin_main: 'del', aid: aid},
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Akun '+admin_name+' berhasil dihapus.'
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
            }
        })          
    });
    $('.delete_doctor').click(function(){
        var did = $(this).prop('value');
        var doctor_name = $(this).prop('name');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Aksi ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: {doctor_main: 'del', did: did},
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Akun '+doctor_name+' berhasil dihapus.'
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
            }
        })          
    });
    $('.delete_user').click(function(){
        var uid = $(this).prop('value');
        var user_name = $(this).prop('name');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Aksi ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url:  '/admin/ajax_call',
                    data: {user_main: 'del', uid: uid},
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
                        if (data == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Akun '+user_name+' berhasil dihapus.'
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
            }
        })          
    });
    $('#desc_product').summernote({
        maxHeight: 250,
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']]
        ]
    });
    $('#info').keyup(function() {
        var maxlength = $(this).attr("maxlength");
        var currentLength = $(this).val().length;
        if (currentLength >= maxlength) {
            $('#maxlength').html('Karakter sudah maksimal.');
        } else if(currentLength === 0){
            $('#maxlength').html('Maksimal karakter: 50');
        } else {
            var len = maxlength - currentLength;
            $('#maxlength').html('Tersisa ' + len + ' karakter lagi.');
        }
    });
    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    $('#consultant_reply').submit(function(e) {
        e.preventDefault();
        reply = $('#replys').val();
        cid = $('#cid').val();
        if(reply == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi balasan anda!'
            });
        } else {
            $.ajax({
                type: 'POST',
                url:  '/accounts/ajax_call',
                data: {doctor_main: 'reply_consultant', reply: reply, cid: cid},
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
                    if (data == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Berhasil membalas konsultasi.'
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
        }
    });
    $('#add_consultant').submit(function(e) {
        e.preventDefault();
        username = $('#username').val();
        konsultasi = $('#konsultasi').val();
        if(konsultasi == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap isi keluhan anda!'
            });
        } else {
            $.ajax({
                type: 'POST',
                url:  '/accounts/ajax_call',
                data: {user_main: 'add_consultant', konsultasi: konsultasi, username: username},
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
                    if (data == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Berhasil membuat konsultasi.'
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
        }
    });
});
