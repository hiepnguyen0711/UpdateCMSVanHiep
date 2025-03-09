// ArchitectUI Pro main.js
$(document).ready(function() {
    'use strict';

    // Tạo hàm metisMenu nếu chưa có
    if(typeof $.fn.metisMenu !== 'function') {
        $.fn.metisMenu = function(options) {
            return this.each(function() {
                var $this = $(this);
                
                // Xác định trạng thái mở rộng ban đầu dựa trên class mm-show
                $this.find('ul.mm-show').each(function() {
                    $(this).parent('li').addClass('mm-active');
                });
                
                // Đặt sự kiện click cho các liên kết có menu con
                $this.find('li > a').on('click', function(e) {
                    var $parent = $(this).parent('li');
                    var $list = $parent.find('> ul');
                    
                    if ($list.length > 0) {
                        e.preventDefault();
                        
                        if ($list.hasClass('mm-show')) {
                            $list.slideUp(200, function() {
                                $list.removeClass('mm-show');
                                $parent.removeClass('mm-active');
                            });
                        } else {
                            $list.slideDown(200, function() {
                                $list.addClass('mm-show');
                                $parent.addClass('mm-active');
                            });
                        }
                    }
                });
            });
        };
    }

    // Chức năng sidebar
    function initSidebar() {
        var $body = $('body');
        var $sidebarToggle = $('.hamburger');
        var $mobileToggle = $('.mobile-toggle-nav');
        
        // Đóng/mở sidebar
        $sidebarToggle.on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('is-active');
            $body.toggleClass('closed-sidebar');
            
            // Lưu trạng thái vào localStorage
            if (typeof(Storage) !== "undefined") {
                localStorage.setItem('sidebar-closed', $body.hasClass('closed-sidebar'));
            }
        });
        
        // Toggle mobile sidebar
        $mobileToggle.on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('is-active');
            $body.toggleClass('sidebar-mobile-open');
        });
        
        // Đóng sidebar khi click bên ngoài (mobile)
        $(document).on('click touchstart', function(e) {
            if ($body.hasClass('sidebar-mobile-open') && 
                !$(e.target).closest('.app-sidebar').length && 
                !$(e.target).closest('.mobile-toggle-nav').length) {
                $body.removeClass('sidebar-mobile-open');
                $mobileToggle.removeClass('is-active');
            }
        });
        
        // Khôi phục trạng thái sidebar từ localStorage
        if (typeof(Storage) !== "undefined") {
            var sidebarClosed = localStorage.getItem('sidebar-closed');
            if (sidebarClosed === 'true') {
                $body.addClass('closed-sidebar');
                $sidebarToggle.addClass('is-active');
            }
        }
    }
    
    // Dropdown animation
    function initDropdowns() {
        $('.dropdown').on('show.bs.dropdown', function() {
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
        });
        
        $('.dropdown').on('hide.bs.dropdown', function() {
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp(150);
        });
    }
    
    // Kích hoạt menu theo trang hiện tại
    function activateCurrentMenu() {
        var currentUrl = window.location.pathname + window.location.search;
        
        $('.vertical-nav-menu li a').each(function() {
            var menuUrl = $(this).attr('href');
            if (menuUrl && currentUrl.indexOf(menuUrl) !== -1 && menuUrl !== 'index.php') {
                $(this).addClass('mm-active');
                
                // Mở rộng menu cha
                var $parentUl = $(this).closest('ul.mm-collapse');
                if ($parentUl.length) {
                    $parentUl.addClass('mm-show');
                    $parentUl.parent('li').addClass('mm-active');
                }
            }
        });
    }
    
    // Chức năng responsive
    function initResponsive() {
        var width = $(window).width();
        
        if (width < 992) {
            $('body').addClass('closed-sidebar-mobile');
        } else {
            $('body').removeClass('closed-sidebar-mobile sidebar-mobile-open');
        }
        
        $(window).resize(function() {
            var width = $(window).width();
            
            if (width < 992) {
                $('body').addClass('closed-sidebar-mobile');
            } else {
                $('body').removeClass('closed-sidebar-mobile sidebar-mobile-open');
            }
        });
    }
    
    // Khởi tạo scrollbar mượt mà cho sidebar
    function initScrollbar() {
        $('.scrollbar-sidebar').css({
            'overflow-y': 'auto',
            'height': '100%'
        });
    }
    
    // Khởi tạo tooltip và popover
    function initBootstrapComponents() {
        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();
        
        // Popover
        $('[data-toggle="popover"]').popover();
    }
    
    // Khởi tạo tất cả các thành phần
    function initAll() {
        // Khởi tạo metisMenu
        $('.vertical-nav-menu').metisMenu();
        
        // Kích hoạt menu hiện tại
        activateCurrentMenu();
        
        // Khởi tạo các component
        initSidebar();
        initDropdowns();
        initResponsive();
        initScrollbar();
        initBootstrapComponents();
    }
    
    // Gọi khởi tạo
    initAll();
}); 