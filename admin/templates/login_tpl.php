<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="<?php echo $lang; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Đăng nhập hệ thống</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="Đăng nhập hệ thống quản trị website">
    <meta name="author" content="Van Hiep">
    
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <?php
    @define('_upload_hinhanh_l', '../uploads/images/');
    
    $d->reset();
    $sql_company = "select *,ten$lang as ten,diachi$lang as diachi from #_company limit 0,1";
    $d->query($sql_company);
    $company = $d->fetch_array();
    
    $d->reset();
    $sql_banner = "select photo from #_banner where type='favicon' limit 0,1";
    $d->query($sql_banner);
    $favicon = $d->fetch_array();
    ?>
    <link rel="shortcut icon" href="<?php echo isset($favicon['photo']) ? _upload_hinhanh_l.$favicon['photo'] : ''; ?>">
    
    <style>
        :root {
            --primary-color: #3f6ad8;
            --secondary-color: #6c757d;
            --success-color: #3ac47d;
            --danger-color: #d92550;
        }
        html, body {
            height: 100%;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }
        
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        
        .app-logo {
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .app-logo img {
            max-height: 80px;
            max-width: 100%;
        }
        
        .login-box {
            width: 100%;
            max-width: 400px;
            margin: auto;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0.46875rem 2.1875rem rgba(4, 9, 20, 0.03), 
                        0 0.9375rem 1.40625rem rgba(4, 9, 20, 0.03), 
                        0 0.25rem 0.53125rem rgba(4, 9, 20, 0.05), 
                        0 0.125rem 0.1875rem rgba(4, 9, 20, 0.03);
            padding: 2rem;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .login-title {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 500;
            color: var(--primary-color);
        }
        
        .input-group-text {
            background-color: #e9ecef;
            color: #495057;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(63, 106, 216, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #2955c8;
            border-color: #2955c8;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(63, 106, 216, 0.2);
        }
        
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: var(--secondary-color);
        }
        
        .login-error {
            color: var(--danger-color);
            font-size: 0.85rem;
            text-align: center;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background-color: rgba(217, 37, 80, 0.1);
            border-radius: 0.25rem;
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .form-check {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .form-check-input {
            margin-top: 0.2rem;
            margin-left: -1.5rem;
        }
        
        .language-selector {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        
        .language-selector a {
            margin-left: 10px;
            opacity: 0.7;
            transition: opacity 0.3s;
        }
        
        .language-selector a:hover, 
        .language-selector a.active {
            opacity: 1;
        }
        
        .language-selector img {
            width: 24px;
            height: auto;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <!-- Chọn ngôn ngữ -->
    <div class="language-selector">
        <a href="?lang=vi" class="<?php echo $lang == 'vi' ? 'active' : ''; ?>">
            <img src="../img/flag-vi.png" alt="Tiếng Việt">
        </a>
        <a href="?lang=en" class="<?php echo $lang == 'en' ? 'active' : ''; ?>">
            <img src="../img/flag-en.png" alt="English">
        </a>
    </div>
    
    <div class="container">
        <div class="login-box">
            <div class="app-logo">
                <?php
                $d->reset();
                $sql_logo = "select photo from #_banner where type='logo' limit 0,1";
                $d->query($sql_logo);
                $logo = $d->fetch_array();
                ?>
                <img src="<?php echo isset($logo['photo']) ? _upload_hinhanh_l.$logo['photo'] : '../img/user-circle.png'; ?>" alt="<?php echo isset($company['ten']) ? $company['ten'] : 'CMS Văn Hiệp'; ?>">
            </div>
            
            <h4 class="login-title">
                <?php echo $lang == 'vi' ? 'Đăng nhập hệ thống' : 'Login to System'; ?>
            </h4>
            
            <?php if(isset($message) && $message) { ?>
            <div class="login-error">
                <?php echo $message; ?>
            </div>
            <?php } ?>
            
            <form action="login.php" method="post" autocomplete="off">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="<?php echo $lang == 'vi' ? 'Tên đăng nhập' : 'Username'; ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="<?php echo $lang == 'vi' ? 'Mật khẩu' : 'Password'; ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me" value="1">
                        <label class="form-check-label" for="remember_me">
                            <?php echo $lang == 'vi' ? 'Ghi nhớ đăng nhập' : 'Remember me'; ?>
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        <?php echo $lang == 'vi' ? 'Đăng nhập' : 'Login'; ?>
                    </button>
                </div>
            </form>
            
            <div class="login-footer">
                &copy; <?php echo date('Y'); ?> - <?php echo isset($company['ten']) ? $company['ten'] : 'CMS Văn Hiệp'; ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 