<?php
if (!isset($_SESSION)) {
    session_start();
}

@define('_template', './templates/');
@define('_source', './sources/');
@define('_lib', './lib/');
@define('_upload_hinhanh', '../uploads/images/');
@define('_upload_hinhanh_l', '../uploads/images/');

include "lib/config.php";
include "lib/function.php";
include "lib/class.php";
global $d, $lang;
$d = new func_index($config['database']);
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'vi';

// Kiểm tra cookie login
if (isset($_COOKIE['key_ad']) && $_COOKIE['key_ad'] != '0') {
    $token = addslashes($_COOKIE['key_ad']);
    $d->reset();
    $sql = "SELECT * FROM #_user WHERE token='$token' LIMIT 0,1";
    $login = $d->fetch_array($sql);
    
    if (!empty($login)) {
        $_SESSION['id_user'] = $login[0]['id'];
        $_SESSION['user_admin'] = $login[0]['tai_khoan'];
        $_SESSION['login']['role'] = $login[0]['role'];
        $_SESSION['login']['username'] = $login[0]['tai_khoan'];
        $_SESSION['login']['name'] = $login[0]['ho_ten'];
        $_SESSION['user_hash'] = session_id();
        
        // Tạo token mới để tăng cường bảo mật
        $newToken = md5(time() . rand(0, 9999) . $_SESSION['user_admin']);
        $_SESSION['login']['token'] = $newToken;
        
        // Cập nhật token mới vào database
        $d->reset();
        $sql = "UPDATE #_user SET token='$newToken' WHERE id='".$login[0]['id']."'";
        $d->query($sql);
        
        // Cập nhật cookie
        setcookie('key_ad', $newToken, time() + 24 * 60 * 60, '/');
        
        // Chuyển hướng về trang chính
        header('Location: index.php');
        exit();
    }
}

// Xử lý đăng nhập
$message = '';
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = addslashes($_POST['username']);
    $password = md5($_POST['password']);
    
    $d->reset();
    $sql = "SELECT * FROM #_user WHERE tai_khoan='$username' AND password='$password' LIMIT 0,1";
    $login = $d->fetch_array($sql);
    
    if (!empty($login)) {
        $_SESSION['id_user'] = $login[0]['id'];
        $_SESSION['user_admin'] = $login[0]['tai_khoan'];
        $_SESSION['login']['role'] = $login[0]['role'];
        $_SESSION['login']['username'] = $login[0]['tai_khoan'];
        $_SESSION['login']['name'] = $login[0]['ho_ten'];
        $_SESSION['user_hash'] = session_id();
        
        // Tạo token mới
        $token = md5(time() . rand(0, 9999) . $_SESSION['user_admin']);
        $_SESSION['login']['token'] = $token;
        
        // Cập nhật token vào database
        $d->reset();
        $sql = "UPDATE #_user SET token='$token' WHERE id='".$login[0]['id']."'";
        $d->query($sql);
        
        // Lưu cookie nếu người dùng chọn "Ghi nhớ đăng nhập"
        if (isset($_POST['remember_me']) && $_POST['remember_me'] == 1) {
            setcookie('key_ad', $token, time() + 24 * 60 * 60, '/');
        }
        
        // Chuyển hướng về trang chính
        header('Location: index.php');
        exit();
    } else {
        $message = 'Tên đăng nhập hoặc mật khẩu không đúng!';
    }
}

$d->reset();
$sql_company = "SELECT * FROM #_company WHERE lang='$lang' LIMIT 0,1";
$company_arr = $d->fetch_array($sql_company);
$company = (!empty($company_arr)) ? $company_arr[0] : array();

$d->reset();
$sql_banner = "SELECT photo FROM #_banner WHERE type='favicon' LIMIT 0,1";
$favicon_arr = $d->fetch_array($sql_banner);
$favicon = (!empty($favicon_arr)) ? $favicon_arr[0] : array();

$d->reset();
$sql_logo = "SELECT photo FROM #_banner WHERE type='logo' LIMIT 0,1";
$logo_arr = $d->fetch_array($sql_logo);
$logo = (!empty($logo_arr)) ? $logo_arr[0] : array();

// Load template login
include _template . "login_tpl.php";
?>