# ArchitectUI Pro Template

Đây là thư mục chứa các tài nguyên của template ArchitectUI Pro đã được tích hợp vào hệ thống admin.

## Cấu trúc thư mục

- `/assets/architectui-pro/main.css` - File CSS chính của template
- `/assets/architectui-pro/custom.css` - CSS tùy chỉnh cho hệ thống
- `/assets/architectui-pro/assets/scripts/main.js` - JavaScript chính của template

## Cách sử dụng

File CSS và JavaScript đã được tích hợp vào file `index.php` của thư mục admin.

```php
<link href="../assets/architectui-pro/main.css" rel="stylesheet">
<link href="../assets/architectui-pro/custom.css" rel="stylesheet">

<script type="text/javascript" src="../assets/architectui-pro/assets/scripts/main.js"></script>
```

## Hướng dẫn sửa đổi

Nếu bạn muốn tùy chỉnh giao diện, hãy chỉnh sửa file `custom.css` thay vì chỉnh sửa file `main.css` để tránh mất các thay đổi khi cập nhật template.

## Chú ý

Template này được áp dụng từ ArchitectUI Pro và đã được tùy chỉnh để phù hợp với hệ thống admin hiện tại, giữ nguyên toàn bộ logic xử lý PHP và database. 