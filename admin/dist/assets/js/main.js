/*!
 * ArchitectUI Pro - Admin Template (https://dashboardpack.com/live-preview-architectui-html-pro/)
 * JavaScript chính cho hệ thống admin
 */

// Document Ready
$(document).ready(function() {
    'use strict';
    
    // Sidebar Toggle
    var $body = $('body');
    var $sidebarToggle = $('.hamburger.close-sidebar-btn');
    var $sidebarMobileToggle = $('.hamburger.mobile-toggle-nav');
    
    // Toggle sidebar on desktop
    $sidebarToggle.on('click', function(e) {
        e.preventDefault();
        
        $sidebarToggle.toggleClass('is-active');
        $body.toggleClass('closed-sidebar');
        
        // Save state to localStorage
        if (typeof(Storage) !== "undefined") {
            localStorage.setItem('sidebar-closed', $body.hasClass('closed-sidebar'));
        }
    });
    
    // Mobile sidebar toggle
    $sidebarMobileToggle.on('click', function(e) {
        e.preventDefault();
        
        $sidebarMobileToggle.toggleClass('is-active');
        $body.toggleClass('sidebar-mobile-open');
    });
    
    // Close sidebar when clicking outside
    $(document).on('click', function(e) {
        if ($(window).width() < 992 && 
            $body.hasClass('sidebar-mobile-open') && 
            !$(e.target).closest('.app-sidebar').length && 
            !$(e.target).closest('.mobile-toggle-nav').length) {
            $body.removeClass('sidebar-mobile-open');
            $sidebarMobileToggle.removeClass('is-active');
        }
    });
    
    // Restore sidebar state from localStorage
    if (typeof(Storage) !== "undefined") {
        var sidebarClosed = localStorage.getItem('sidebar-closed');
        if (sidebarClosed === 'true') {
            $body.addClass('closed-sidebar');
            $sidebarToggle.addClass('is-active');
        }
    }
    
    // Add submenu indicators to parent links
    $('.vertical-nav-menu li a').each(function() {
        if ($(this).next('ul').length > 0) {
            $(this).append('<i class="metismenu-state-icon fa fa-angle-down caret-left"></i>');
        }
    });
    
    // Toggle menu items
    $('.vertical-nav-menu li a').on('click', function(e) {
        var $parent = $(this).parent('li');
        var $list = $parent.find('ul').first();
        
        if ($list.length > 0) {
            e.preventDefault();
            
            if ($list.hasClass('mm-show')) {
                $list.slideUp('fast', function() {
                    $list.removeClass('mm-show');
                    $parent.removeClass('mm-active');
                });
            } else {
                // Close other open menus at same level
                var $parentUl = $parent.parent('ul');
                $parentUl.find('ul.mm-show').slideUp('fast').removeClass('mm-show');
                $parentUl.find('li.mm-active').removeClass('mm-active');
                
                $list.slideDown('fast', function() {
                    $list.addClass('mm-show');
                    $parent.addClass('mm-active');
                });
            }
        }
    });
    
    // Activate current menu based on URL
    var currentUrl = window.location.href;
    
    $('.vertical-nav-menu li a').each(function() {
        var $link = $(this);
        var href = $link.attr('href');
        
        if (href && href !== '#' && currentUrl.indexOf(href) !== -1) {
            $link.addClass('mm-active');
            
            // Open parent menu items
            $link.parents('ul').addClass('mm-show');
            $link.parents('li').addClass('mm-active');
        }
    });
    
    // Handle responsive behavior
    $(window).on('resize', function() {
        if ($(this).width() < 992 && !$body.hasClass('closed-sidebar-mobile')) {
            $body.addClass('closed-sidebar-mobile');
        } else if ($(this).width() > 992 && $body.hasClass('closed-sidebar-mobile')) {
            $body.removeClass('closed-sidebar-mobile');
            $body.removeClass('sidebar-mobile-open');
        }
    }).resize(); // Trigger once on load
    
    // Bootstrap tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Bootstrap popovers
    $('[data-toggle="popover"]').popover();
    
    // Other initializations...
    
    // Set active class for dropdown menu items
    $('.dropdown-menu .dropdown-item').on('click', function() {
        $(this).addClass('active').siblings().removeClass('active');
    });
}); 