<?php

// Kiểm tra xem Zalo có nằm trong danh sách ứng dụng đang chạy không
// Sử dụng WMI trên Windows
$wmi = new \COM('winmgmts://');
$processes = $wmi->ExecQuery('SELECT Name FROM Win32_Process WHERE Name LIKE "%zalo%"');

if (count($processes) > 0) {
    // Có tìm thấy Zalo trong danh sách process
    echo 'installed';
} else {
    // Không tìm thấy Zalo
    echo 'not_installed';
}
