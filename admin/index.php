<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["user_hash"]) && !isset($_SESSION["login"])) {
    header("location: login.php");
    die;
}

@define('_template', './templates/');
@define('_source', './sources/');
@define('_lib', './lib/');
@define('_upload_hinhanh', '../uploads/images/');
@define('_upload_hinhanh_l', '../uploads/images/');

include "lib/config.php";
include "lib/function.php";
include "lib/class.php";

// Thiết lập hằng số URL
$config_url = URLPATH;

global $d, $lang;
$d = new func_index($config['database']);
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'vi';

date_default_timezone_set('Asia/Ho_Chi_Minh');
@include "lib/file_router_admin.php";

// Hàm đếm lượt truy cập
function count_online($type = '')
{
    global $d;
    $time = time();
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $d->reset();
    $sql = "SELECT COUNT(*) AS count, MAX(id) AS max_id FROM #_counter";
    $data = $d->fetch_array($sql);
    $result = array();
    
    if (!empty($data)) {
        $result['truy_cap'] = $data[0]['count'];
        
        if ($type == 'online') {
            $time_check = $time - 300; // 5 phút
            $d->reset();
            $sql = "SELECT COUNT(*) AS online FROM #_counter WHERE last_visit >= $time_check";
            $online = $d->fetch_array($sql);
            return (!empty($online)) ? $online[0]['online'] : 0;
        } elseif ($type == 'day') {
            $today = date('Y-m-d');
            $d->reset();
            $sql = "SELECT COUNT(*) AS today FROM #_counter WHERE DATE(FROM_UNIXTIME(last_visit)) = '$today'";
            $today_data = $d->fetch_array($sql);
            return (!empty($today_data)) ? $today_data[0]['today'] : 0;
        }
        
        return $result;
    }
    
    return array('truy_cap' => 0);
}

// Hàm lấy dữ liệu biểu đồ truy cập
function get_access_chart_data() {
    global $d;
    $result = [];
    
    // Lấy dữ liệu truy cập của 7 ngày gần nhất
    for($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $d->reset();
        $sql = "SELECT COUNT(*) AS count FROM #_counter WHERE DATE(FROM_UNIXTIME(last_visit)) = '$date'";
        $data = $d->fetch_array($sql);
        $count = (!empty($data)) ? $data[0]['count'] : 0;
        
        $result['labels'][] = date('d/m', strtotime("-$i days"));
        $result['data'][] = $count;
    }
    
    return $result;
}

// Load company info
$d->reset();
$sql_company = "SELECT * FROM #_company WHERE lang='$lang' LIMIT 0,1";
$company_arr = $d->fetch_array($sql_company);
$company = (!empty($company_arr)) ? $company_arr[0] : array();

// Load favicon
$d->reset();
$sql_banner = "SELECT photo FROM #_banner WHERE type='favicon' LIMIT 0,1";
$favicon_arr = $d->fetch_array($sql_banner);
$favicon = (!empty($favicon_arr)) ? $favicon_arr[0] : array();

// Ensure photos folder exists
if (!file_exists('../uploads/images/')) {
    @mkdir('../uploads/images/', 0777, true);
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="<?php echo $lang; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $lang == 'vi' ? 'Quản trị website' : 'Website Admin'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="<?php echo $lang == 'vi' ? 'Quản trị website' : 'Website Admin'; ?>">
    <meta name="author" content="Van Hiep">
    
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo isset($favicon['photo']) ? _upload_hinhanh_l.$favicon['photo'] : '../uploads/images/favicon.png'; ?>">
    
    <!-- jQuery FIRST - Tải jQuery trước khi tải Bootstrap và các script khác -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap CSS và JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- ArchitectUI Pro CSS -->
    <link href="dist/assets/css/main.css" rel="stylesheet">
    <link href="dist/assets/css/custom.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    
    <!-- Original scripts - External JS và CKEditor --> 
    <script type="text/javascript" src="js/external.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckfinder/ckfinder.js"></script>
    
    <!-- Scripts from ArchitectUI -->
    <script type="text/javascript" src="dist/assets/js/main.js"></script>
</head>
<body class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <!-- Header start -->
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <div class="logo-src">
                <?php
                $d->reset();
                $sql_logo = "select photo from #_banner where type='logo' limit 0,1";
                $logo_arr = $d->fetch_array($sql_logo);
                $logo = (!empty($logo_arr)) ? $logo_arr[0] : array();
                ?>
                <img src="<?php echo isset($logo['photo']) ? _upload_hinhanh_l.$logo['photo'] : '../uploads/images/logo.png'; ?>" alt="<?php echo isset($company['ten']) ? $company['ten'] : 'Admin'; ?>">
            </div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-right">
                <!-- Language selector -->
                <div class="mr-3">
                    <div class="btn-group">
                        <a href="?lang=vi" class="btn <?php echo $lang == 'vi' ? 'btn-primary' : 'btn-light'; ?> btn-sm">
                            <img src="../img/flag-vi.png" alt="Tiếng Việt" width="18"> Tiếng Việt
                        </a>
                        <a href="?lang=en" class="btn <?php echo $lang == 'en' ? 'btn-primary' : 'btn-light'; ?> btn-sm">
                            <img src="../img/flag-en.png" alt="English" width="18"> English
                        </a>
                    </div>
                </div>
                
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                        <img width="42" class="rounded-circle" src="<?php echo $config_url; ?>/img/user-circle.png" alt="">
                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                        <a href="index.php?com=user&act=admin_edit"><button type="button" tabindex="0" class="dropdown-item"><?php echo $lang == 'vi' ? 'Thông tin tài khoản' : 'Account Info'; ?></button></a>
                                        <a href="index.php?com=about&act=capnhat"><button type="button" tabindex="0" class="dropdown-item"><?php echo $lang == 'vi' ? 'Cấu hình website' : 'Website Settings'; ?></button></a>
                                        <div tabindex="-1" class="dropdown-divider"></div>
                                        <a href="login.php?logout=1"><button type="button" tabindex="0" class="dropdown-item text-danger"><?php echo $lang == 'vi' ? 'Đăng xuất' : 'Logout'; ?></button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left ml-3">
                                <div class="widget-heading">
                                    <?php echo isset($_SESSION['login']['username']) ? $_SESSION['login']['username'] : 'Admin'; ?>
                                </div>
                                <div class="widget-subheading">
                                    <?php if(isset($_SESSION['login']['role']) && $_SESSION['login']['role']==1) echo $lang == 'vi' ? 'Quản trị viên' : 'Administrator'; else echo $lang == 'vi' ? 'Nhân viên' : 'Staff'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header end -->
    
    <div class="app-main">
        <!-- Sidebar start -->
        <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading"><?php echo $lang == 'vi' ? 'Trang Chủ' : 'Home'; ?></li>
                        <li>
                            <a href="index.php" class="<?php echo (!isset($_GET['com']) || $_GET['com']=='')?'mm-active':'' ?>">
                                <i class="metismenu-icon fa fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        
                        <?php include _template."left_tpl.php"; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Sidebar end -->
        
        <!-- Main content start -->
        <div class="app-main__outer">
            <div class="app-main__inner">
                <?php if(!isset($_GET['com']) || $_GET['com']=='') { ?>
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="fa fa-tachometer-alt icon-gradient bg-mean-fruit"></i>
                            </div>
                            <div>
                                Dashboard
                                <div class="page-title-subheading"><?php echo $lang == 'vi' ? 'Tổng quan về hoạt động của website' : 'Website activity overview'; ?></div>
                            </div>
                        </div>
                        <div class="page-title-actions">
                            <button type="button" data-toggle="tooltip" title="<?php echo $lang == 'vi' ? 'Làm mới' : 'Refresh'; ?>" class="btn-shadow mr-3 btn btn-info" onclick="window.location.reload()">
                                <i class="fa fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-midnight-bloom">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading"><?php echo $lang == 'vi' ? 'Tổng lượt truy cập' : 'Total visits'; ?></div>
                                    <div class="widget-subheading"><?php echo $lang == 'vi' ? 'Tất cả các thiết bị' : 'All devices'; ?></div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span><?php $count=count_online(); echo $count['truy_cap']; ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-arielle-smile">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading"><?php echo $lang == 'vi' ? 'Đang trực tuyến' : 'Online now'; ?></div>
                                    <div class="widget-subheading"><?php echo $lang == 'vi' ? 'Người dùng hiện tại' : 'Current users'; ?></div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span><?php echo count_online('online'); ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-grow-early">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading"><?php echo $lang == 'vi' ? 'Hôm nay' : 'Today'; ?></div>
                                    <div class="widget-subheading"><?php echo $lang == 'vi' ? 'Lượt truy cập hôm nay' : 'Today\'s visits'; ?></div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span><?php echo count_online('day'); ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title">
                                    <i class="header-icon fa fa-chart-line mr-3 text-primary"></i>
                                    <?php echo $lang == 'vi' ? 'Thống kê truy cập' : 'Traffic Statistics'; ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container" style="position: relative; height:50vh; width:100%">
                                    <canvas id="accessChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="main-card mb-3 card">
                            <div class="card-header">
                                <i class="header-icon fa fa-calendar-check icon-gradient bg-mean-fruit"></i>
                                <?php echo $lang == 'vi' ? 'Hoạt động gần đây' : 'Recent Activities'; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $lang == 'vi' ? 'Chào mừng quay trở lại!' : 'Welcome back!'; ?></h5>
                                <p><?php echo $lang == 'vi' ? 'Hệ thống quản trị nội dung website đã được cập nhật với giao diện mới.' : 'The content management system has been updated with a new interface.'; ?></p>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <i class="fa fa-check-circle text-success mr-2"></i> 
                                        <?php echo $lang == 'vi' ? 'Giao diện mới với nhiều cải tiến' : 'New interface with many improvements'; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-check-circle text-success mr-2"></i> 
                                        <?php echo $lang == 'vi' ? 'Tương thích trên tất cả thiết bị' : 'Compatible on all devices'; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-check-circle text-success mr-2"></i> 
                                        <?php echo $lang == 'vi' ? 'Hỗ trợ nhiều ngôn ngữ' : 'Multi-language support'; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-check-circle text-success mr-2"></i> 
                                        <?php echo $lang == 'vi' ? 'Biểu đồ thống kê trực quan' : 'Visual statistics charts'; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php } else { ?>
                    <?php include _template.$template."_tpl.php"; ?>
                <?php } ?>
                
            </div>
            <div class="app-wrapper-footer">
                <div class="app-footer">
                    <div class="app-footer__inner">
                        <div class="app-footer-left">
                            <div class="footer-dots">
                                <div class="dropdown">
                                    <a href="http://<?php echo isset($company['website']) ? $company['website'] : ''; ?>" target="_blank"><?php echo isset($company['website']) ? $company['website'] : ''; ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="app-footer-right">
                            <ul class="nav">
                                <li class="nav-item">
                                    <span class="nav-link">
                                        &copy; <?php echo date('Y'); ?> - <?php echo isset($company['ten']) ? $company['ten'] : 'CMS Văn Hiệp'; ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content end -->
    </div>
    
    <?php if(!isset($_GET['com']) || $_GET['com']=='') { 
        $chartData = get_access_chart_data();
    ?>
    <script>
        // Biểu đồ thống kê truy cập
        $(document).ready(function() {
            var ctx = document.getElementById('accessChart').getContext('2d');
            var accessChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($chartData['labels']); ?>,
                    datasets: [{
                        label: '<?php echo $lang == 'vi' ? 'Lượt truy cập' : 'Visits'; ?>',
                        data: <?php echo json_encode($chartData['data']); ?>,
                        backgroundColor: 'rgba(63, 106, 216, 0.2)',
                        borderColor: 'rgba(63, 106, 216, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(63, 106, 216, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(63, 106, 216, 1)',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            padding: 10,
                            cornerRadius: 4,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
    </script>
    <?php } ?>
</body>
</html>