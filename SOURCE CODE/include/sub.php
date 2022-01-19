<?php



# LISTING PAGE
$slim_page = [
    'login',
    'register',
    'logout',
    'product',
    'admin',
    'accounts',
    'petshop',
    'doctor',
    ''
];

# IMPORT REQUIRE FILE AND FUNCTION
function prevent($string) {
    $sqli = str_replace('\'', '', $string);
    return $sqli;
}
function forcing($num) {
    return str_replace('0', '+62', $num);
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function naming($namefile) {
    $namefiles = str_replace(' ', '_', $namefile);
    return $namefiles . '_' . date('d-m-Y');
}

function array_to_string($array) {
    $ref = implode(', ', $array);
    return $ref;
}

function short_str($str, $max = 50) {
    $str = trim($str);
    if (strlen($str) > $max) {
        $s_pos = strpos($str, ' ');
        $cut = $s_pos === false || $s_pos > $max;
        $str = wordwrap($str, $max, ';;', $cut);
        $str = explode(';;', $str);
        $str = $str[0] . ' ...';
    }
    return $str;
}

function encrypt($value){
    $salt = '/x!a@r-$r%an¨.&e&+f*f(f(f)'; // u can change the salt maybe :D
	return hash_hmac('sha1', $value, $salt);
}

 

# DECLARE PARAMETER
$p = explode("/",$_SERVER['REQUEST_URI']);
$valid_extension = ['jpg', 'jpeg', 'png', 'gif'];
$pathProductImage = "assets/images/product_image";
$pathProductProfile = "assets/images/profile_image";
$dateNow = date('d-m-Y H:i:s');


# CHECK IN ARRAY AND MACHING
# THIS IS IMPORTANT CODE, PLEASE BE CAREFUL
if(in_array($p[1], $slim_page)) {
    if($p[1] == '') {
        include_once('./views/home.php');
    } elseif($p[1] == 'petshop') {
        include_once('./views/petshop_list.php');
    } elseif($p[1] == 'doctor') {
        include_once('./views/doctor_list.php');
    } elseif($p[1] == 'login') {
        if(isset($_POST['login'])) {
            if(isset($_SESSION['token'])){
                $username = prevent($_POST['username']);
                $password = prevent($_POST['password']);
                if ($_POST['token'] == ''){
                    print('empty_token'); 
                } elseif ($_POST['token'] !== $_SESSION['token']) {
                    print('invalid_token');
                } else {
                    $stmt = $conn->prepare("SELECT * FROM tb_admin WHERE username = ? OR admin_email = ?");
                    $stmt->execute(array($username, $username));
                    $data = $stmt->fetch();
                    if($data == '') {
                        print('invalid_username');
                    } else {
                        if($data['password'] == encrypt($password)) {
                            if($data['admin_level'] == 'superadmin') {
                                $_SESSION['admin'] = $data['admin_name'];
                                print('login_success');
                            } elseif($data['admin_level'] == 'seller') {
                                $_SESSION['seller'] = $data['admin_name'];
                                print('login_success');
                            } else {
                                print('error.');
                            }
                        } else {
                            print('invalid_password');
                        }
                    }
                }
            } else {
                $_SESSION['token'] = generateRandomString();
                print('nosession_token');
            }
        }elseif(isset($_POST['login_dokter'])) {
            if(isset($_SESSION['token'])){
                $username = prevent($_POST['username']);
                $password = prevent($_POST['password']);
                if ($_POST['token'] == ''){
                    print('empty_token'); 
                } elseif ($_POST['token'] !== $_SESSION['token']) {
                    print('invalid_token');
                } else {
                    $stmt = $conn->prepare("SELECT * FROM tb_doctor WHERE username = ? OR doctor_email = ?");
                    $stmt->execute(array($username, $username));
                    $data = $stmt->fetch();
                    if($data == '') {
                        print('invalid_username');
                    } else {
                        if($data['password'] == encrypt($password)) {
                            $_SESSION['dokter'] = $data['doctor_id'];
                            print('login_success');
                        } else {
                            print('invalid_password');
                        }
                    }
                }
            } else {
                $_SESSION['token'] = generateRandomString();
                print('nosession_token');
            }
        }elseif(isset($_POST['login_pelanggan'])) {
            if(isset($_SESSION['token'])){
                $username = prevent($_POST['username']);
                $password = prevent($_POST['password']);
                if ($_POST['token'] == ''){
                    print('empty_token'); 
                } elseif ($_POST['token'] !== $_SESSION['token']) {
                    print('invalid_token');
                } else {
                    $stmt = $conn->prepare("SELECT * FROM tb_user WHERE username = ? OR user_email = ?");
                    $stmt->execute(array($username, $username));
                    $data = $stmt->fetch();
                    if($data == '') {
                        print('invalid_username');
                    } else {
                        if($data['password'] == encrypt($password)) {
                            $_SESSION['pelanggan'] = $data['user_id'];
                            print('login_success');
                        } else {
                            print('invalid_password');
                        }
                    }
                }
            } else {
                $_SESSION['token'] = generateRandomString();
                print('nosession_token');
            }
        }elseif(isset($_POST['register_pelanggan'])) {
            if(isset($_SESSION['token'])){
                $password = encrypt($_POST['password']);
                $prepareSql = $conn->prepare("INSERT INTO tb_user (user_name, username, password, user_telp, user_email) VALUES (?, ?, ?, ?, ?)");
                $prepareSql->bindParam(1, $_POST['nama'], PDO::PARAM_STR);
                $prepareSql->bindParam(2, $_POST['username'], PDO::PARAM_STR);
                $prepareSql->bindParam(3, $password, PDO::PARAM_STR);
                $prepareSql->bindParam(4, $_POST['notelp'], PDO::PARAM_STR);
                $prepareSql->bindParam(5, $_POST['email'], PDO::PARAM_STR);
                if($prepareSql->execute()) {
                    print('success');
                } else {
                    print('error');
                }
            } else {
                $_SESSION['token'] = generateRandomString();
                print('nosession_token');
            }
        }else {
            if(isset($_SESSION['admin'])){
                header('location: /admin');
                exit();
            }elseif(isset($_SESSION['dokter'])){
                header('location: /accounts');
                exit();
            }elseif(isset($_SESSION['seller'])){
                header('location: /admin');
                exit();
            }elseif(isset($_SESSION['pelanggan'])){
                header('location: /accounts');
                exit();
            }else {
                $_SESSION['token'] = generateRandomString();
                include_once('./views/login.php');
            }
        }
    } elseif($p[1] == 'register') {
        if(isset($_SESSION['admin'])){
            header('location: /admin');
            exit();
        }elseif(isset($_SESSION['dokter'])){
            header('location: /accounts');
            exit();
        }elseif(isset($_SESSION['pelanggan'])){
            header('location: /accounts');
            exit();
        }else {
            $_SESSION['token'] = generateRandomString();
            include_once('./views/register.php');
        }
    } elseif($p[1] == 'product') {
        if(isset($p[2])) {
            if(is_numeric($p[2])){
                $pid = $p[2];
                $stmt = $conn->prepare("SELECT * FROM tb_product WHERE product_id = ?");
                $stmt->execute(array($pid));
                $data = $stmt->fetch();
                $product_name = $data['product_name'];
                $product_price = $data['product_price'];
                $product_description = $data['product_description'];
                $product_image = $data['product_image'];
                $getToko = $conn->prepare("SELECT * FROM tb_petshop WHERE petshop_id = ?");
                $getToko->execute(array($data['petshop_id']));
                $data2 = $getToko->fetch();
                $namaToko = $data2['petshop_name'];
                $nomorToko = $data2['petshop_telp'];
                include_once('./views/product_details.php');
            }else{
                print('YOU HAVE AN tapi boong:v');
            }
        } else{
            include_once('./views/product_list.php');
        }
    } elseif($p[1] == 'logout') {
        session_destroy();
        header('location: /login');
    } elseif($p[1] == 'admin') {
        if(isset($_SESSION['admin'])){
            if(isset($p[2])) {
                if($p[2] == 'product') {
                    include_once('./views/admin_all_product.php');
                } elseif($p[2] == 'service_settings') {
                    include_once('./views/admin_all_services.php');
                } elseif($p[2] == 'category') {
                    include_once('./views/admin_all_category.php');
                } elseif($p[2] == 'data_admin') {
                    include_once('./views/admin_all_admin.php');
                } elseif($p[2] == 'data_doctor') {
                    include_once('./views/admin_all_doctor.php');
                } elseif($p[2] == 'data_seller') {
                    include_once('./views/admin_all_seller.php');
                } elseif($p[2] == 'data_users') {
                    include_once('./views/admin_all_users.php');
                } elseif($p[2] == 'petshop') {
                    include_once('./views/admin_petshop.php');
                } elseif($p[2] == 'ajax_call') {
                    if(isset($_POST['add_category'])) {
                        $category_name = $_POST['category_name'];
                        $checkSql = $conn->prepare("SELECT * FROM tb_category WHERE category_name = ?");
                        $checkSql->bindParam(1, $category_name, PDO::PARAM_STR);
                        $checkSql->execute();
                        if($checkSql->fetch(PDO::FETCH_ASSOC)){
                            print('exist');
                        } else {
                            $data = [
                                'category_name' => $category_name
                            ];
                            $sql = "INSERT INTO tb_category (category_name) VALUES (:category_name)";
                            $stmt= $conn->prepare($sql);
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        }
                    }elseif(isset($_POST['edit_category'])) {
                        $category_name = $_POST['category_name'];
                        $category_id = $_POST['cat_id'];
                        $data = [
                            'category_name' => $category_name,
                            'category_id' => $category_id
                        ];
                        $sql = "UPDATE tb_category SET category_name = :category_name WHERE category_id = :category_id";
                        $stmt= $conn->prepare($sql);
                        if($stmt->execute($data)) {
                            print('success');
                        } else {
                            print('failed');
                        }
                    }elseif(isset($_POST['delete_category'])) {
                        $category_id = $_POST['cat_id'];
                        $data = [
                            'category_id' => $category_id
                        ];
                        $sql = "DELETE FROM tb_category WHERE category_id = :category_id";
                        $stmt= $conn->prepare($sql);
                        if($stmt->execute($data)) {
                            print('success');
                        } else {
                            print('failed');
                        }
                    }elseif(isset($_POST['product_main'])) {
                        if($_POST['product_main'] == 'add'){ 
                            $product_name = $_POST['product_name'];
                            $category_product = $_POST['category_product'];
                            $desc_product = $_POST['desc_product'];
                            $input_harga = $_POST['input_harga'];
                            $product_image = $_POST['product_image'];
                            $product_status = $_POST['product_status'];
                            $pemisahanExtensi = explode('.', $_FILES['produkgambar']['name']);
                            $prepareNameImage = naming($pemisahanExtensi[0]).'.'.$pemisahanExtensi[1];
                            if(!in_array($pemisahanExtensi[1], $valid_extension)) {
                                print('invalid_extension');
                            } else {
                                $prepareSql = $conn->prepare("INSERT INTO tb_product (category_id, product_name, product_price, product_description, product_image, product_status, date_created) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                $prepareSql->bindParam(1, $category_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(2, $product_name, PDO::PARAM_STR);
                                $prepareSql->bindParam(3, $input_harga, PDO::PARAM_STR);
                                $prepareSql->bindParam(4, $desc_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(5, $prepareNameImage, PDO::PARAM_STR);
                                $prepareSql->bindParam(6, $product_status, PDO::PARAM_STR);
                                $prepareSql->bindParam(7, $dateNow, PDO::PARAM_STR);
                                if($prepareSql->execute()) {
                                    if(move_uploaded_file($_FILES['produkgambar']['tmp_name'], "$pathProductImage/$prepareNameImage")){
                                        print('success');
                                    } else {
                                        print('file_failed');
                                    }
                                } else {
                                    print('error');
                                }
                            }
                        }elseif($_POST['product_main'] == 'del'){ 
                            $product_id = $_POST['pid'];
                            $data = [
                                'product_id' => $product_id
                            ];
                            $sql = "DELETE FROM tb_product WHERE product_id = :product_id";
                            $stmt= $conn->prepare($sql);
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        }elseif($_POST['product_main'] == 'edit'){ 
                            $product_id = $_POST['product_id'];
                            $product_name = $_POST['product_name'];
                            $category_product = $_POST['category_product'];
                            $desc_product = $_POST['desc_product'];
                            $input_harga = $_POST['input_harga'];
                            $product_image = $_POST['product_image'];
                            $product_status = $_POST['product_status'];
                            if(isset($_FILES['produkgambar'])){
                                $pemisahanExtensi = explode('.', $_FILES['produkgambar']['name']);
                                $prepareNameImage = naming($pemisahanExtensi[0]).'.'.$pemisahanExtensi[1];
                                if(!in_array($pemisahanExtensi[1], $valid_extension)) {
                                    print('invalid_extension');
                                } else {
                                    $prepareSql = $conn->prepare("UPDATE tb_product SET category_id = ?, product_name = ?, product_price = ?, product_description = ?, product_image = ?, product_status = ? WHERE product_id = ?");
                                    $prepareSql->bindParam(1, $category_product, PDO::PARAM_STR);
                                    $prepareSql->bindParam(2, $product_name, PDO::PARAM_STR);
                                    $prepareSql->bindParam(3, $input_harga, PDO::PARAM_STR);
                                    $prepareSql->bindParam(4, $desc_product, PDO::PARAM_STR);
                                    $prepareSql->bindParam(5, $prepareNameImage, PDO::PARAM_STR);
                                    $prepareSql->bindParam(6, $product_status, PDO::PARAM_STR);
                                    $prepareSql->bindParam(7, $product_id, PDO::PARAM_INT);
                                    if($prepareSql->execute()) {
                                        if(move_uploaded_file($_FILES['produkgambar']['tmp_name'], "$pathProductImage/$prepareNameImage")){
                                            print('success');
                                        } else {
                                            print('file_failed');
                                        }
                                    } else {
                                        print('error');
                                    }
                                }
                            } else {
                                $prepareSql = $conn->prepare("UPDATE tb_product SET category_id = ?, product_name = ?, product_price = ?, product_description = ?, product_status = ? WHERE product_id = ?");
                                $prepareSql->bindParam(1, $category_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(2, $product_name, PDO::PARAM_STR);
                                $prepareSql->bindParam(3, $input_harga, PDO::PARAM_STR);
                                $prepareSql->bindParam(4, $desc_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(5, $product_status, PDO::PARAM_STR);
                                $prepareSql->bindParam(6, $product_id, PDO::PARAM_INT);
                                if($prepareSql->execute()) {
                                    print('success');
                                } else {
                                    print('error');
                                }
                            }
                        } else {
                            print('0');
                        }
                    }elseif(isset($_POST['petshop_main'])) {
                        if($_POST['petshop_main'] == 'add'){ 
                            $petshop_name = $_POST['petshop_name'];
                            $petshop_telp = $_POST['petshop_telp'];
                            $petshop_desc = $_POST['petshop_desc'];
                            $petshop_adress = $_POST['petshop_adress'];
                            $pemisahanExtensi = explode('.', $_FILES['petshop_image']['name']);
                            $prepareNameImage = naming($pemisahanExtensi[0]).'.'.$pemisahanExtensi[1];
                            if(!in_array($pemisahanExtensi[1], $valid_extension)) {
                                print('invalid_extension');
                            } else {
                                $prepareSql = $conn->prepare("INSERT INTO tb_petshop (petshop_name, addby, petshop_telp, petshop_info, petshop_adress, petshop_img) VALUES (?, ?, ?, ?, ?, ?)");
                                $prepareSql->bindParam(1, $petshop_name, PDO::PARAM_STR);
                                $prepareSql->bindParam(2, $_SESSION['admin'], PDO::PARAM_STR);
                                $prepareSql->bindParam(3, $petshop_telp, PDO::PARAM_STR);
                                $prepareSql->bindParam(4, $petshop_desc, PDO::PARAM_STR);
                                $prepareSql->bindParam(5, $petshop_adress, PDO::PARAM_STR);
                                $prepareSql->bindParam(6, $prepareNameImage, PDO::PARAM_STR);
                                if($prepareSql->execute()) {
                                    if(move_uploaded_file($_FILES['petshop_image']['tmp_name'], "$pathProductImage/$prepareNameImage")){
                                        print('success');
                                    } else {
                                        print('file_failed');
                                    }
                                } else {
                                    print('error');
                                }
                            }
                        }elseif($_POST['petshop_main'] == 'del'){ 
                            $product_id = $_POST['pid'];
                            $data = [
                                'product_id' => $product_id
                            ];
                            $sql = "DELETE FROM tb_petshop WHERE petshop_id = :product_id";
                            $stmt= $conn->prepare($sql);
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        }elseif($_POST['petshop_main'] == 'edit'){ 
                            $petshop_id = $_POST['petshop_id'];
                            $petshop_name = $_POST['petshop_name'];
                            $petshop_telp = $_POST['petshop_telp'];
                            $petshop_info = $_POST['petshop_desc'];
                            $petshop_adress = $_POST['petshop_adress'];
                            if(isset($_FILES['petshop_image'])){
                                $pemisahanExtensi = explode('.', $_FILES['petshop_image']['name']);
                                $prepareNameImage = naming($pemisahanExtensi[0]).'.'.$pemisahanExtensi[1];
                                if(!in_array($pemisahanExtensi[1], $valid_extension)) {
                                    print('invalid_extension');
                                } else {
                                    $prepareSql = $conn->prepare("UPDATE tb_petshop SET petshop_name = ?, petshop_telp = ?, petshop_info = ?, petshop_adress = ?, petshop_img = ? WHERE petshop_id = ?");
                                    $prepareSql->bindParam(1, $petshop_name, PDO::PARAM_STR);
                                    $prepareSql->bindParam(2, $petshop_telp, PDO::PARAM_STR);
                                    $prepareSql->bindParam(3, $petshop_info, PDO::PARAM_STR);
                                    $prepareSql->bindParam(4, $petshop_adress, PDO::PARAM_STR);
                                    $prepareSql->bindParam(5, $prepareNameImage, PDO::PARAM_STR);
                                    $prepareSql->bindParam(6, $petshop_id, PDO::PARAM_STR);
                                    if($prepareSql->execute()) {
                                        if(move_uploaded_file($_FILES['petshop_image']['tmp_name'], "$pathProductImage/$prepareNameImage")){
                                            print('success');
                                        } else {
                                            print('file_failed');
                                        }
                                    } else {
                                        print('error');
                                    }
                                }
                            } else {
                                $prepareSql = $conn->prepare("UPDATE tb_product SET category_id = ?, product_name = ?, product_price = ?, product_description = ?, product_status = ? WHERE product_id = ?");
                                $prepareSql->bindParam(1, $category_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(2, $product_name, PDO::PARAM_STR);
                                $prepareSql->bindParam(3, $input_harga, PDO::PARAM_STR);
                                $prepareSql->bindParam(4, $desc_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(5, $product_status, PDO::PARAM_STR);
                                $prepareSql->bindParam(6, $product_id, PDO::PARAM_INT);
                                if($prepareSql->execute()) {
                                    print('success');
                                } else {
                                    print('error');
                                }
                            }
                        }elseif($_POST['petshop_main'] == 'edit_act'){ 
                            $pet_id = $_POST['petshop_id'];
                            if(is_numeric($pet_id)){
                                $stmt = $conn->prepare("SELECT * FROM tb_petshop WHERE petshop_id = ?");
                                $stmt->execute(array($pet_id));
                                $data = $stmt->fetch();
                                if($data == '') {
                                    print('0');
                                } else {
                                    $product = json_encode($data);
                                    print($product);
                                }
                            }else {
                                return false;
                            }
                        } else {
                            print('0');
                        }
                    }elseif(isset($_POST['admin_main'])) {
                        if($_POST['admin_main'] == 'add'){ 
                            $password = encrypt($_POST['password']);
                            $level = 'superadmin';
                            $prepareSql = $conn->prepare("INSERT INTO tb_admin (admin_name, username, password, admin_telp, admin_email, admin_adress, admin_level) VALUES (?, ?, ?, ?, ?, ?, ?)");
                            $prepareSql->bindParam(1, $_POST['admin_name'], PDO::PARAM_STR);
                            $prepareSql->bindParam(2, $_POST['username'], PDO::PARAM_STR);
                            $prepareSql->bindParam(3, $password, PDO::PARAM_STR);
                            $prepareSql->bindParam(4, $_POST['admin_telp'], PDO::PARAM_STR);
                            $prepareSql->bindParam(5, $_POST['admin_email'], PDO::PARAM_STR);
                            $prepareSql->bindParam(6, $_POST['admin_adress'], PDO::PARAM_STR);
                            $prepareSql->bindParam(7, $level, PDO::PARAM_STR);
                            if($prepareSql->execute()) {
                                print('success');
                            } else {
                                print('error');
                            }
                        }elseif($_POST['admin_main'] == 'add_seller'){ 
                            $password = encrypt($_POST['password']);
                            $level = 'seller';
                            $prepareSql = $conn->prepare("INSERT INTO tb_admin (admin_name, username, password, admin_telp, admin_email, admin_adress, admin_level) VALUES (?, ?, ?, ?, ?, ?, ?)");
                            $prepareSql->bindParam(1, $_POST['admin_name'], PDO::PARAM_STR);
                            $prepareSql->bindParam(2, $_POST['username'], PDO::PARAM_STR);
                            $prepareSql->bindParam(3, $password, PDO::PARAM_STR);
                            $prepareSql->bindParam(4, $_POST['admin_telp'], PDO::PARAM_STR);
                            $prepareSql->bindParam(5, $_POST['admin_email'], PDO::PARAM_STR);
                            $prepareSql->bindParam(6, $_POST['admin_adress'], PDO::PARAM_STR);
                            $prepareSql->bindParam(7, $level, PDO::PARAM_STR);
                            if($prepareSql->execute()) {
                                print('success');
                            } else {
                                print('error');
                            }
                        }elseif($_POST['admin_main'] == 'del'){ 
                            $admin_id = $_POST['aid'];
                            $data = [
                                'admin_id' => $admin_id
                            ];
                            $sql = "DELETE FROM tb_admin WHERE admin_id = :admin_id";
                            $stmt= $conn->prepare($sql);
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        }elseif($_POST['admin_main'] == 'edit'){ 
                            $data = [
                                'admin_name' => $_POST['admin_name'],
                                'username' => $_POST['username'],
                                'password' => encrypt($_POST['password']),
                                'admin_telp' => $_POST['admin_telp'],
                                'admin_email' => $_POST['admin_email'],
                                'admin_adress' => $_POST['admin_adress'],
                                'admin_id' => $_POST['admin_id']
                            ];
                            $stmt= $conn->prepare("UPDATE tb_admin SET admin_name = :admin_name, username = :username, password = :password, admin_telp = :admin_telp, admin_email = :admin_email, admin_adress = :admin_adress WHERE admin_id = :admin_id");
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        }elseif($_POST['admin_main'] == 'edit_act'){ 
                            $prod_id = $_POST['admin_id'];
                            if(is_numeric($prod_id)){
                                $stmt = $conn->prepare("SELECT * FROM tb_admin WHERE admin_id = ?");
                                $stmt->execute(array($prod_id));
                                $data = $stmt->fetch();
                                if($data == '') {
                                    print('0');
                                } else {
                                    $x = json_encode($data);
                                    print($x);
                                }
                            }else {
                                return false;
                            }
                        } else {
                            print('0');
                        }
                    }elseif(isset($_POST['doctor_main'])) {
                        if($_POST['doctor_main'] == 'add'){ 
                            $password = encrypt($_POST['password']);
                            $pemisahanExtensi = explode('.', $_FILES['profile_img']['name']);
                            $prepareNameImage = naming($pemisahanExtensi[0]).'.'.$pemisahanExtensi[1];
                            $prepareSql = $conn->prepare("INSERT INTO tb_doctor (doctor_name, username, password, doctor_telp, doctor_email, doctor_adress, doctor_info, doctor_profile_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                            $prepareSql->bindParam(1, $_POST['doctor_name'], PDO::PARAM_STR);
                            $prepareSql->bindParam(2, $_POST['username'], PDO::PARAM_STR);
                            $prepareSql->bindParam(3, $password, PDO::PARAM_STR);
                            $prepareSql->bindParam(4, $_POST['doctor_telp'], PDO::PARAM_STR);
                            $prepareSql->bindParam(5, $_POST['doctor_email'], PDO::PARAM_STR);
                            $prepareSql->bindParam(6, $_POST['doctor_adress'], PDO::PARAM_STR);
                            $prepareSql->bindParam(7, $_POST['doctor_info'], PDO::PARAM_STR);
                            $prepareSql->bindParam(8, $prepareNameImage, PDO::PARAM_STR);
                            if($prepareSql->execute()) {
                                if(move_uploaded_file($_FILES['profile_img']['tmp_name'], "$pathProductProfile/$prepareNameImage")){
                                    print('success');
                                } else {
                                    print('file_failed');
                                }
                            } else {
                                print('error');
                            }
                        }elseif($_POST['doctor_main'] == 'del'){ 
                            $doctor_id = $_POST['did'];
                            $data = [
                                'doctor_id' => $doctor_id
                            ];
                            $sql = "DELETE FROM tb_doctor WHERE doctor_id = :doctor_id";
                            $stmt= $conn->prepare($sql);
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        }elseif($_POST['doctor_main'] == 'edit'){ 
                            if(isset($_FILES['profile_img'])){
                                $pemisahanExtensi = explode('.', $_FILES['profile_img']['name']);
                                $prepareNameImage = naming($pemisahanExtensi[0]).'.'.$pemisahanExtensi[1];
                                $data = [
                                    'doctor_name' => $_POST['doctor_name'],
                                    'username' => $_POST['username'],
                                    'password' => encrypt($_POST['password']),
                                    'doctor_telp' => $_POST['doctor_telp'],
                                    'doctor_email' => $_POST['doctor_email'],
                                    'doctor_adress' => $_POST['doctor_adress'],
                                    'doctor_info' => $_POST['doctor_info'],
                                    'doctor_profile_img' => $prepareNameImage,
                                    'doctor_id' => $_POST['doctor_id']
                                ];
                                $stmt= $conn->prepare("UPDATE tb_doctor SET doctor_name = :doctor_name, username = :username, password = :password, doctor_telp = :doctor_telp, doctor_email = :doctor_email, doctor_adress = :doctor_adress, doctor_info = :doctor_info, doctor_profile_img = :doctor_profile_img WHERE doctor_id = :doctor_id");
                                if($stmt->execute($data)) {
                                    if(move_uploaded_file($_FILES['profile_img']['tmp_name'], "$pathProductProfile/$prepareNameImage")){
                                        print('success');
                                    } else {
                                        print('file_failed');
                                    }
                                } else {
                                    print('failed');
                                }
                            } else {
                                $data = [
                                    'doctor_name' => $_POST['doctor_name'],
                                    'username' => $_POST['username'],
                                    'password' => encrypt($_POST['password']),
                                    'doctor_telp' => $_POST['doctor_telp'],
                                    'doctor_email' => $_POST['doctor_email'],
                                    'doctor_adress' => $_POST['doctor_adress'],
                                    'doctor_info' => $_POST['doctor_info'],
                                    'doctor_id' => $_POST['doctor_id']
                                ];
                                $stmt= $conn->prepare("UPDATE tb_doctor SET doctor_name = :doctor_name, username = :username, password = :password, doctor_telp = :doctor_telp, doctor_email = :doctor_email, doctor_adress = :doctor_adress, doctor_info = :doctor_info WHERE doctor_id = :doctor_id");
                                if($stmt->execute($data)) {
                                    print('success');
                                } else {
                                    print('failed');
                                }
                            }
                        }elseif($_POST['doctor_main'] == 'edit_act'){ 
                            $prod_id = $_POST['doctor_id'];
                            if(is_numeric($prod_id)){
                                $stmt = $conn->prepare("SELECT * FROM tb_doctor WHERE doctor_id = ?");
                                $stmt->execute(array($prod_id));
                                $data = $stmt->fetch();
                                if($data == '') {
                                    print('0');
                                } else {
                                    $x = json_encode($data);
                                    print($x);
                                }
                            }else {
                                return false;
                            }
                        } else {
                            print('0');
                        }
                    }elseif(isset($_POST['user_main'])) {
                        if($_POST['user_main'] == 'add'){ 
                            $password = encrypt($_POST['password']);
                            $prepareSql = $conn->prepare("INSERT INTO tb_user (user_name, username, password, user_telp, user_email, user_adress) VALUES (?, ?, ?, ?, ?, ?)");
                            $prepareSql->bindParam(1, $_POST['user_name'], PDO::PARAM_STR);
                            $prepareSql->bindParam(2, $_POST['username'], PDO::PARAM_STR);
                            $prepareSql->bindParam(3, $password, PDO::PARAM_STR);
                            $prepareSql->bindParam(4, $_POST['user_telp'], PDO::PARAM_STR);
                            $prepareSql->bindParam(5, $_POST['user_email'], PDO::PARAM_STR);
                            $prepareSql->bindParam(6, $_POST['user_adress'], PDO::PARAM_STR);
                            if($prepareSql->execute()) {
                                print('success');
                            } else {
                                print('error');
                            }
                        }elseif($_POST['user_main'] == 'del'){ 
                            $user_id = $_POST['uid'];
                            $data = [
                                'user_id' => $user_id
                            ];
                            $sql = "DELETE FROM tb_user WHERE user_id = :user_id";
                            $stmt= $conn->prepare($sql);
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        }elseif($_POST['user_main'] == 'edit'){ 
                            $data = [
                                'user_name' => $_POST['user_name'],
                                'username' => $_POST['username'],
                                'password' => encrypt($_POST['password']),
                                'user_telp' => $_POST['user_telp'],
                                'user_email' => $_POST['user_email'],
                                'user_adress' => $_POST['user_adress'],
                                'user_id' => $_POST['user_id']
                            ];
                            $stmt= $conn->prepare("UPDATE tb_user SET user_name = :user_name, username = :username, password = :password, user_telp = :user_telp, user_email = :user_email, user_adress = :user_adress WHERE user_id = :user_id");
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        }elseif($_POST['user_main'] == 'edit_act'){ 
                            $prod_id = $_POST['userid'];
                            if(is_numeric($prod_id)){
                                $stmt = $conn->prepare("SELECT * FROM tb_user WHERE user_id = ?");
                                $stmt->execute(array($prod_id));
                                $data = $stmt->fetch();
                                if($data == '') {
                                    print('0');
                                } else {
                                    $x = json_encode($data);
                                    print($x);
                                }
                            }else {
                                return false;
                            }
                        } else {
                            print('0');
                        }
                    }elseif(isset($_POST['edit_product_action'])) {
                        $prod_id = $_POST['item_id'];
                        if(is_numeric($prod_id)){
                            $stmt = $conn->prepare("SELECT * FROM tb_product WHERE product_id = ?");
                            $stmt->execute(array($prod_id));
                            $data = $stmt->fetch();
                            $stmtcat = $conn->prepare("SELECT * FROM tb_category WHERE category_id = ?");
                            $stmtcat->execute(array($data['category_id']));
                            $datacat = $stmtcat->fetch();
                            if($data == '') {
                                print('0');
                            } else {
                                array_push($data, $datacat);
                                $product = json_encode($data);
                                print($product);
                            }
                        }else {
                            return false;
                        }
                    }else{
                        return false;
                    }
                } else {
                    include_once('./views/admin_dashboard.php');
                }
            } else {
                include_once('./views/admin_dashboard.php');
            }
        }elseif(isset($_SESSION['seller'])){
            if(isset($p[2])) {
                if($p[2] == 'product') {
                    $prepareSelect = $conn->prepare("SELECT * FROM tb_petshop WHERE addby = '".$_SESSION['seller']."'");
                    $prepareSelect->execute();
                    $data = $prepareSelect->fetch();
                    include_once('./views/seller_all_product.php');
                } elseif($p[2] == 'service_settings') {
                    include_once('./views/admin_all_services.php');
                } elseif($p[2] == 'category') {
                    $prepareSelect = $conn->prepare("SELECT * FROM tb_petshop WHERE addby = '".$_SESSION['seller']."'");
                    $prepareSelect->execute();
                    $data = $prepareSelect->fetch();
                    include_once('./views/seller_all_category.php');
                } elseif($p[2] == 'data_admin') {
                    include_once('./views/admin_all_admin.php');
                } elseif($p[2] == 'data_doctor') {
                    include_once('./views/admin_all_doctor.php');
                } elseif($p[2] == 'data_seller') {
                    include_once('./views/admin_all_seller.php');
                } elseif($p[2] == 'data_users') {
                    include_once('./views/admin_all_users.php');
                } elseif($p[2] == 'petshop') {
                    $prepareSelect = $conn->prepare("SELECT * FROM tb_petshop WHERE addby = '".$_SESSION['seller']."'");
                    $prepareSelect->execute();
                    $data = $prepareSelect->fetch();
                    include_once('./views/seller_petshop.php');
                } elseif($p[2] == 'ajax_call') {
                    if(isset($_POST['add_category'])) {
                        $prepareSelect = $conn->prepare("SELECT * FROM tb_petshop WHERE addby = '".$_SESSION['seller']."'");
                        $prepareSelect->execute();
                        $datax = $prepareSelect->fetch();
                        $category_name = $_POST['category_name'];
                        $checkSql = $conn->prepare("SELECT * FROM tb_category WHERE petshop_id = ? AND category_name = ?");
                        $checkSql->bindParam(1, $datax['petshop_id'], PDO::PARAM_INT);
                        $checkSql->bindParam(2, $category_name, PDO::PARAM_STR);
                        $checkSql->execute();
                        if($checkSql->fetch(PDO::FETCH_ASSOC)){
                            print('exist');
                        } else {
                            $data = [
                                'petshop_id' => $datax['petshop_id'],
                                'category_name' => $category_name
                            ];
                            $sql = "INSERT INTO tb_category (petshop_id, category_name) VALUES (:petshop_id, :category_name)";
                            $stmt= $conn->prepare($sql);
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        }
                    }elseif(isset($_POST['edit_category'])) {
                        $category_name = $_POST['category_name'];
                        $category_id = $_POST['cat_id'];
                        $data = [
                            'category_name' => $category_name,
                            'category_id' => $category_id
                        ];
                        $sql = "UPDATE tb_category SET category_name = :category_name WHERE category_id = :category_id";
                        $stmt= $conn->prepare($sql);
                        if($stmt->execute($data)) {
                            print('success');
                        } else {
                            print('failed');
                        }
                    }elseif(isset($_POST['delete_category'])) {
                        $category_id = $_POST['cat_id'];
                        $data = [
                            'category_id' => $category_id
                        ];
                        $sql = "DELETE FROM tb_category WHERE category_id = :category_id";
                        $stmt= $conn->prepare($sql);
                        if($stmt->execute($data)) {
                            print('success');
                        } else {
                            print('failed');
                        }
                    }elseif(isset($_POST['product_main'])) {
                        if($_POST['product_main'] == 'add'){ 
                            $prepareSelect = $conn->prepare("SELECT * FROM tb_petshop WHERE addby = '".$_SESSION['seller']."'");
                            $prepareSelect->execute();
                            $data = $prepareSelect->fetch();
                            $petshop_id = $data['petshop_id'];
                            $product_name = $_POST['product_name'];
                            $category_product = $_POST['category_product'];
                            $desc_product = $_POST['desc_product'];
                            $input_harga = $_POST['input_harga'];
                            $product_image = $_POST['product_image'];
                            $product_status = $_POST['product_status'];
                            $pemisahanExtensi = explode('.', $_FILES['produkgambar']['name']);
                            $prepareNameImage = naming($pemisahanExtensi[0]).'.'.$pemisahanExtensi[1];
                            if(!in_array($pemisahanExtensi[1], $valid_extension)) {
                                print('invalid_extension');
                            } else {
                                $prepareSql = $conn->prepare("INSERT INTO tb_product (category_id, product_name, petshop_id, product_price, product_description, product_image, product_status, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                                $prepareSql->bindParam(1, $category_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(2, $product_name, PDO::PARAM_STR);
                                $prepareSql->bindParam(3, $petshop_id, PDO::PARAM_INT);
                                $prepareSql->bindParam(4, $input_harga, PDO::PARAM_STR);
                                $prepareSql->bindParam(5, $desc_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(6, $prepareNameImage, PDO::PARAM_STR);
                                $prepareSql->bindParam(7, $product_status, PDO::PARAM_STR);
                                $prepareSql->bindParam(8, $dateNow, PDO::PARAM_STR);
                                if($prepareSql->execute()) {
                                    if(move_uploaded_file($_FILES['produkgambar']['tmp_name'], "$pathProductImage/$prepareNameImage")){
                                        print('success');
                                    } else {
                                        print('file_failed');
                                    }
                                } else {
                                    print('error');
                                }
                            }
                        }elseif($_POST['product_main'] == 'del'){ 
                            $product_id = $_POST['pid'];
                            $data = [
                                'product_id' => $product_id
                            ];
                            $sql = "DELETE FROM tb_product WHERE product_id = :product_id";
                            $stmt= $conn->prepare($sql);
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        }elseif($_POST['product_main'] == 'edit'){ 
                            $product_id = $_POST['product_id'];
                            $product_name = $_POST['product_name'];
                            $category_product = $_POST['category_product'];
                            $desc_product = $_POST['desc_product'];
                            $input_harga = $_POST['input_harga'];
                            $product_image = $_POST['product_image'];
                            $product_status = $_POST['product_status'];
                            if(isset($_FILES['produkgambar'])){
                                $pemisahanExtensi = explode('.', $_FILES['produkgambar']['name']);
                                $prepareNameImage = naming($pemisahanExtensi[0]).'.'.$pemisahanExtensi[1];
                                if(!in_array($pemisahanExtensi[1], $valid_extension)) {
                                    print('invalid_extension');
                                } else {
                                    $prepareSql = $conn->prepare("UPDATE tb_product SET category_id = ?, product_name = ?, product_price = ?, product_description = ?, product_image = ?, product_status = ? WHERE product_id = ?");
                                    $prepareSql->bindParam(1, $category_product, PDO::PARAM_STR);
                                    $prepareSql->bindParam(2, $product_name, PDO::PARAM_STR);
                                    $prepareSql->bindParam(3, $input_harga, PDO::PARAM_STR);
                                    $prepareSql->bindParam(4, $desc_product, PDO::PARAM_STR);
                                    $prepareSql->bindParam(5, $prepareNameImage, PDO::PARAM_STR);
                                    $prepareSql->bindParam(6, $product_status, PDO::PARAM_STR);
                                    $prepareSql->bindParam(7, $product_id, PDO::PARAM_INT);
                                    if($prepareSql->execute()) {
                                        if(move_uploaded_file($_FILES['produkgambar']['tmp_name'], "$pathProductImage/$prepareNameImage")){
                                            print('success');
                                        } else {
                                            print('file_failed');
                                        }
                                    } else {
                                        print('error');
                                    }
                                }
                            } else {
                                $prepareSql = $conn->prepare("UPDATE tb_product SET category_id = ?, product_name = ?, product_price = ?, product_description = ?, product_status = ? WHERE product_id = ?");
                                $prepareSql->bindParam(1, $category_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(2, $product_name, PDO::PARAM_STR);
                                $prepareSql->bindParam(3, $input_harga, PDO::PARAM_STR);
                                $prepareSql->bindParam(4, $desc_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(5, $product_status, PDO::PARAM_STR);
                                $prepareSql->bindParam(6, $product_id, PDO::PARAM_INT);
                                if($prepareSql->execute()) {
                                    print('success');
                                } else {
                                    print('error');
                                }
                            }
                        } else {
                            print('0');
                        }
                    }elseif(isset($_POST['petshop_main'])) {
                        if($_POST['petshop_main'] == 'add'){ 
                            $petshop_name = $_POST['petshop_name'];
                            $petshop_telp = $_POST['petshop_telp'];
                            $petshop_desc = $_POST['petshop_desc'];
                            $petshop_adress = $_POST['petshop_adress'];
                            $pemisahanExtensi = explode('.', $_FILES['petshop_image']['name']);
                            $prepareNameImage = naming($pemisahanExtensi[0]).'.'.$pemisahanExtensi[1];
                            if(!in_array($pemisahanExtensi[1], $valid_extension)) {
                                print('invalid_extension');
                            } else {
                                $prepareSql = $conn->prepare("INSERT INTO tb_petshop (petshop_name, addby, petshop_telp, petshop_info, petshop_adress, petshop_img) VALUES (?, ?, ?, ?, ?, ?)");
                                $prepareSql->bindParam(1, $petshop_name, PDO::PARAM_STR);
                                $prepareSql->bindParam(2, $_SESSION['seller'], PDO::PARAM_STR);
                                $prepareSql->bindParam(3, $petshop_telp, PDO::PARAM_STR);
                                $prepareSql->bindParam(4, $petshop_desc, PDO::PARAM_STR);
                                $prepareSql->bindParam(5, $petshop_adress, PDO::PARAM_STR);
                                $prepareSql->bindParam(6, $prepareNameImage, PDO::PARAM_STR);
                                if($prepareSql->execute()) {
                                    if(move_uploaded_file($_FILES['petshop_image']['tmp_name'], "$pathProductImage/$prepareNameImage")){
                                        print('success');
                                    } else {
                                        print('file_failed');
                                    }
                                } else {
                                    print('error');
                                }
                            }
                        }elseif($_POST['petshop_main'] == 'edit'){ 
                            $petshop_id = $_POST['petshop_id'];
                            $petshop_name = $_POST['petshop_name'];
                            $petshop_telp = $_POST['petshop_telp'];
                            $petshop_info = $_POST['petshop_desc'];
                            $petshop_adress = $_POST['petshop_adress'];
                            if(isset($_FILES['petshop_image'])){
                                $pemisahanExtensi = explode('.', $_FILES['petshop_image']['name']);
                                $prepareNameImage = naming($pemisahanExtensi[0]).'.'.$pemisahanExtensi[1];
                                if(!in_array($pemisahanExtensi[1], $valid_extension)) {
                                    print('invalid_extension');
                                } else {
                                    $prepareSql = $conn->prepare("UPDATE tb_petshop SET petshop_name = ?, petshop_telp = ?, petshop_info = ?, petshop_adress = ?, petshop_img = ? WHERE petshop_id = ?");
                                    $prepareSql->bindParam(1, $petshop_name, PDO::PARAM_STR);
                                    $prepareSql->bindParam(2, $petshop_telp, PDO::PARAM_STR);
                                    $prepareSql->bindParam(3, $petshop_info, PDO::PARAM_STR);
                                    $prepareSql->bindParam(4, $petshop_adress, PDO::PARAM_STR);
                                    $prepareSql->bindParam(5, $prepareNameImage, PDO::PARAM_STR);
                                    $prepareSql->bindParam(6, $petshop_id, PDO::PARAM_STR);
                                    if($prepareSql->execute()) {
                                        if(move_uploaded_file($_FILES['petshop_image']['tmp_name'], "$pathProductImage/$prepareNameImage")){
                                            print('success');
                                        } else {
                                            print('file_failed');
                                        }
                                    } else {
                                        print('error');
                                    }
                                }
                            } else {
                                $prepareSql = $conn->prepare("UPDATE tb_product SET category_id = ?, product_name = ?, product_price = ?, product_description = ?, product_status = ? WHERE product_id = ?");
                                $prepareSql->bindParam(1, $category_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(2, $product_name, PDO::PARAM_STR);
                                $prepareSql->bindParam(3, $input_harga, PDO::PARAM_STR);
                                $prepareSql->bindParam(4, $desc_product, PDO::PARAM_STR);
                                $prepareSql->bindParam(5, $product_status, PDO::PARAM_STR);
                                $prepareSql->bindParam(6, $product_id, PDO::PARAM_INT);
                                if($prepareSql->execute()) {
                                    print('success');
                                } else {
                                    print('error');
                                }
                            }
                        }elseif($_POST['petshop_main'] == 'edit_act'){ 
                            $pet_id = $_POST['petshop_id'];
                            if(is_numeric($pet_id)){
                                $stmt = $conn->prepare("SELECT * FROM tb_petshop WHERE petshop_id = ?");
                                $stmt->execute(array($pet_id));
                                $data = $stmt->fetch();
                                if($data == '') {
                                    print('0');
                                } else {
                                    $product = json_encode($data);
                                    print($product);
                                }
                            }else {
                                return false;
                            }
                        } else {
                            print('0');
                        }
                    }else{
                        return false;
                    }
                } else {
                    exit;
                }
            } else {
                $prepareSelect = $conn->prepare("SELECT * FROM tb_petshop WHERE addby = '".$_SESSION['seller']."'");
                $prepareSelect->execute();
                $data = $prepareSelect->fetch();
                if(isset($data['petshop_id'])) {
                    $prepareSelectCat = $conn->prepare("SELECT *  FROM tb_product WHERE petshop_id = '".$data['petshop_id']."'");
                    $prepareSelectCat->execute();
                    $totalProdukSeller = $prepareSelectCat->rowCount();
                    $prepareSelect2 = $conn->prepare("SELECT * FROM tb_category WHERE petshop_id = '".$data['petshop_id']."'");
                    $prepareSelect2->execute();
                    $data2 = $prepareSelect2->fetch();
                    $totalKategoriSeller = $prepareSelect2->rowCount();
                    include_once('./views/seller_dashboard.php');
                } else {
                    include_once('./views/seller_dashboard.php');
                }
            }
        } else {
            header('location: /login');
            exit();
        }
    } elseif($p[1] == 'accounts') {
        if(isset($_SESSION['dokter'])){
            if(isset($p[2])) {
                if($p[2] == 'settings'){
                    $stmt = $conn->prepare("SELECT * FROM tb_doctor WHERE doctor_id = ?");
                    $stmt->execute(array($_SESSION['dokter']));
                    $data = $stmt->fetch();
                    $did = $data['doctor_id'];
                    $fotoProfile = $data['doctor_profile_img'];
                    $nama = $data['doctor_name'];
                    $no_telp = $data['doctor_telp'];
                    $email = $data['doctor_email'];
                    $adress = $data['doctor_adress'];
                    $info = $data['doctor_info'];
                    include_once('./views/dokter_edit_profil.php');
                } elseif($p[2] == 'ajax_call'){
                    if(isset($_POST['doctor_main'])) {
                        if($_POST['doctor_main'] == 'profiling'){ 
                            if(isset($_FILES['profile_img'])){
                                $pemisahanExtensi = explode('.', $_FILES['profile_img']['name']);
                                $prepareNameImage = naming($pemisahanExtensi[0]).'.'.$pemisahanExtensi[1];
                                $data = [
                                    'doctor_name' => $_POST['doctor_name'],
                                    'doctor_telp' => $_POST['doctor_telp'],
                                    'doctor_email' => $_POST['doctor_email'],
                                    'doctor_adress' => $_POST['doctor_adress'],
                                    'doctor_info' => $_POST['doctor_info'],
                                    'doctor_profile_img' => $prepareNameImage,
                                    'doctor_id' => $_POST['doctor_id']
                                ];
                                $stmt= $conn->prepare("UPDATE tb_doctor SET doctor_name = :doctor_name, doctor_telp = :doctor_telp, doctor_email = :doctor_email, doctor_adress = :doctor_adress, doctor_info = :doctor_info, doctor_profile_img = :doctor_profile_img WHERE doctor_id = :doctor_id");
                                if($stmt->execute($data)) {
                                    if(move_uploaded_file($_FILES['profile_img']['tmp_name'], "$pathProductProfile/$prepareNameImage")){
                                        print('success');
                                    } else {
                                        print('file_failed');
                                    }
                                } else {
                                    print('failed');
                                }
                            } else {
                                $data = [
                                    'doctor_name' => $_POST['doctor_name'],
                                    'doctor_telp' => $_POST['doctor_telp'],
                                    'doctor_email' => $_POST['doctor_email'],
                                    'doctor_adress' => $_POST['doctor_adress'],
                                    'doctor_info' => $_POST['doctor_info'],
                                    'doctor_id' => $_POST['doctor_id']
                                ];
                                $stmt= $conn->prepare("UPDATE tb_doctor SET doctor_name = :doctor_name, doctor_telp = :doctor_telp, doctor_email = :doctor_email, doctor_adress = :doctor_adress, doctor_info = :doctor_info WHERE doctor_id = :doctor_id");
                                if($stmt->execute($data)) {
                                    print('success');
                                } else {
                                    print('failed');
                                }
                            }
                        } elseif($_POST['doctor_main'] == 'change_password') {
                            $did = $_POST['doctor_id'];
                            $oldpass = encrypt($_POST['oldpass']);
                            $newpass = encrypt($_POST['newpass']);
                            $stmt = $conn->prepare("SELECT * FROM tb_doctor WHERE doctor_id = ?");
                            $stmt->execute(array($did));
                            $data = $stmt->fetch();
                            if ($data['password'] == $oldpass) {
                                $data = [
                                    'password' => $newpass,
                                    'doctor_id' => $did
                                ];
                                $sql = "UPDATE tb_doctor SET password = :password WHERE doctor_id = :doctor_id";
                                $stmt= $conn->prepare($sql);
                                if($stmt->execute($data)) {
                                    print('success');
                                } else {
                                    print('failed');
                                }
                            } else {
                                print('wrong_old');
                            }
                        } elseif($_POST['doctor_main'] == 'reply_consultant') {
                            $data = [
                                'reply' => $_POST['reply'],
                                'reply_by' => $_SESSION['dokter'],
                                'cid' => $_POST['cid']
                            ];
                            $stmt= $conn->prepare("UPDATE tb_consultant SET reply = :reply, reply_by = :reply_by WHERE consultant_id = :cid");
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        } else {
                            print('0');
                        }
                    }
                }
            } else {
                $stmt = $conn->prepare("SELECT * FROM tb_doctor WHERE doctor_id = ?");
                $stmt->execute(array($_SESSION['dokter']));
                $data = $stmt->fetch();
                $did = $data['doctor_id'];
                $fotoProfile = $data['doctor_profile_img'];
                $nama = $data['doctor_name'];
                $no_telp = $data['doctor_telp'];
                $email = $data['doctor_email'];
                $adress = $data['doctor_adress'];
                $info = $data['doctor_info'];
                include_once('./views/dokter_dashboard.php');
            }
        }elseif(isset($_SESSION['pelanggan'])){
            if(isset($p[2])) {
                if($p[2] == 'settings'){
                    $stmt = $conn->prepare("SELECT * FROM tb_user WHERE user_id = ?");
                    $stmt->execute(array($_SESSION['pelanggan']));
                    $data = $stmt->fetch();
                    $did = $data['user_id'];
                    $fotoProfile = $data['user_profile_img'];
                    $nama = $data['user_name'];
                    $telp = $data['user_telp'];
                    $email = $data['user_email'];
                    $adress = $data['user_adress'];
                    $info = $data['user_info'];
                    include_once('./views/user_edit_profil.php');
                } elseif($p[2] == 'consultant'){
                    $stmt = $conn->prepare("SELECT * FROM tb_user WHERE user_id = ?");
                    $stmt->execute(array($_SESSION['pelanggan']));
                    $data = $stmt->fetch();
                    $did = $data['user_id'];
                    $fotoProfile = $data['user_profile_img'];
                    $nama = $data['user_name'];
                    $username = $data['username'];
                    $telp = $data['user_telp'];
                    $email = $data['user_email'];
                    $adress = $data['user_adress'];
                    $info = $data['user_info'];
                    include_once('./views/user_create_consultant.php');
                } elseif($p[2] == 'ajax_call'){
                    if(isset($_POST['user_main'])) {
                        if($_POST['user_main'] == 'profiling'){ 
                            $data = [
                                'user_name' => $_POST['user_name'],
                                'user_telp' => $_POST['user_telp'],
                                'user_email' => $_POST['user_email'],
                                'user_adress' => $_POST['user_adress'],
                                'user_info' => $_POST['user_info'],
                                'user_id' => $_POST['user_id']
                            ];
                            $stmt= $conn->prepare("UPDATE tb_user SET user_name = :user_name, user_telp = :user_telp, user_email = :user_email, user_adress = :user_adress, user_info = :user_info WHERE user_id = :user_id");
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        } elseif($_POST['user_main'] == 'change_password') {
                            $did = $_POST['user_id'];
                            $oldpass = encrypt($_POST['oldpass']);
                            $newpass = encrypt($_POST['newpass']);
                            $stmt = $conn->prepare("SELECT * FROM tb_user WHERE user_id = ?");
                            $stmt->execute(array($did));
                            $data = $stmt->fetch();
                            if ($data['password'] == $oldpass) {
                                $data = [
                                    'password' => $newpass,
                                    'user_id' => $did
                                ];
                                $sql = "UPDATE tb_user SET password = :password WHERE user_id = :user_id";
                                $stmt= $conn->prepare($sql);
                                if($stmt->execute($data)) {
                                    print('success');
                                } else {
                                    print('failed');
                                }
                            } else {
                                print('wrong_old');
                            }
                        } elseif($_POST['user_main'] == 'add_consultant') {
                            $data = [
                                'consultant_by' => $_POST['username'],
                                'consultant_date' => $dateNow,
                                'consultant' => $_POST['konsultasi']
                            ];
                            $stmt= $conn->prepare("INSERT INTO tb_consultant (consultant_by, consultant_date, consultant) VALUES (:consultant_by, :consultant_date, :consultant)");
                            if($stmt->execute($data)) {
                                print('success');
                            } else {
                                print('failed');
                            }
                        } else {
                            print('0');
                        }
                    }
                }
            } else {
                $stmt = $conn->prepare("SELECT * FROM tb_user WHERE user_id = ?");
                $stmt->execute(array($_SESSION['pelanggan']));
                $data = $stmt->fetch();
                $did = $data['user_id'];
                $fotoProfile = $data['user_profile_img'];
                $nama = $data['user_name'];
                $username = $data['username'];
                $no_telp = $data['user_telp'];
                $email = $data['user_email'];
                $adress = $data['user_adress'];
                $info = $data['user_info'];
                include_once('./views/user_dashboard.php');
            }
        } else {
            header('location: /login');
            exit();
        }
    } else {
        print('not found');
    }
} else {
    print('not found');
}

?>