-- Sửa lỗi database cho CMS Văn Hiệp
-- Tạo bởi Claude AI

-- Tạo bảng company
CREATE TABLE IF NOT EXISTS `db_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `diachi` text NOT NULL,
  `dienthoai` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(255) NOT NULL,
  `fanpage` varchar(255) DEFAULT NULL,
  `hotline` varchar(100) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `slogan` text DEFAULT NULL,
  `bando` text DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'vi',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dữ liệu mẫu cho bảng company
INSERT INTO `db_company` (`id`, `ten`, `diachi`, `dienthoai`, `email`, `website`, `fanpage`, `hotline`, `copyright`, `slogan`, `bando`, `photo`, `lang`) VALUES
(1, 'CMS Văn Hiệp', 'Hồ Chí Minh, Việt Nam', '0123456789', 'info@example.com', 'vanhiep.com', 'https://facebook.com', '0123456789', 'Copyright © 2024 CMS Văn Hiệp', 'Slogan của công ty', '<iframe src="https://www.google.com/maps/embed"></iframe>', 'logo.png', 'vi'),
(2, 'CMS Van Hiep', 'Ho Chi Minh City, Vietnam', '0123456789', 'info@example.com', 'vanhiep.com', 'https://facebook.com', '0123456789', 'Copyright © 2024 CMS Van Hiep', 'Company slogan', '<iframe src="https://www.google.com/maps/embed"></iframe>', 'logo.png', 'en');

-- Tạo bảng banner
CREATE TABLE IF NOT EXISTS `db_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'logo,favicon,banner,background,slider,doitac,mangxahoi',
  `link` varchar(255) DEFAULT NULL,
  `hienthi` tinyint(1) NOT NULL DEFAULT 1,
  `ngaytao` int(11) NOT NULL DEFAULT 0,
  `stt` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dữ liệu mẫu cho bảng banner
INSERT INTO `db_banner` (`id`, `photo`, `type`, `link`, `hienthi`, `ngaytao`, `stt`) VALUES
(1, 'logo.png', 'logo', '', 1, 0, 1),
(2, 'favicon.png', 'favicon', '', 1, 0, 1),
(3, 'banner.jpg', 'banner', '', 1, 0, 1);

-- Tạo bảng counter để đếm lượt truy cập
CREATE TABLE IF NOT EXISTS `db_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `last_visit` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tạo bảng người dùng admin
CREATE TABLE IF NOT EXISTS `db_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tai_khoan` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `dien_thoai` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `hienthi` tinyint(1) NOT NULL DEFAULT 1,
  `role` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:User, 1:Admin',
  `ngaytao` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dữ liệu mẫu cho bảng người dùng
INSERT INTO `db_user` (`id`, `tai_khoan`, `password`, `ho_ten`, `dien_thoai`, `email`, `token`, `hienthi`, `role`, `ngaytao`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', '0123456789', 'admin@example.com', '', 1, 1, 0);

-- Tạo bảng thông tin tĩnh
CREATE TABLE IF NOT EXISTS `db_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `noidung` text NOT NULL,
  `mota` text DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'vi',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dữ liệu mẫu cho bảng thông tin
INSERT INTO `db_info` (`id`, `ten`, `noidung`, `mota`, `type`, `photo`, `lang`) VALUES
(1, 'Giới thiệu', '<p>Nội dung giới thiệu</p>', 'Mô tả ngắn về giới thiệu', 'gioi-thieu', NULL, 'vi'),
(2, 'About Us', '<p>About us content</p>', 'Short description about us', 'gioi-thieu', NULL, 'en'),
(3, 'Dịch vụ', '<p>Nội dung dịch vụ</p>', 'Mô tả ngắn về dịch vụ', 'dich-vu', NULL, 'vi'),
(4, 'Services', '<p>Services content</p>', 'Short description about services', 'dich-vu', NULL, 'en');

-- Tạo bảng liên hệ
CREATE TABLE IF NOT EXISTS `db_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(255) NOT NULL,
  `dien_thoai` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `noidung` text NOT NULL,
  `ngaytao` int(11) NOT NULL DEFAULT 0,
  `tinhtrang` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng đăng ký nhận tin
CREATE TABLE IF NOT EXISTS `db_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `hienthi` tinyint(1) NOT NULL DEFAULT 1,
  `ngaytao` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 