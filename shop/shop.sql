-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th12 22, 2023 lúc 04:00 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Category 1', 0, '', NULL, '2023-12-01 03:27:02', NULL),
(12, 'Thao', 0, 'thao', '2023-12-01 03:31:59', '2023-12-01 03:31:59', NULL),
(13, 'Iphone 4', 0, 'iphone-4', '2023-12-01 04:45:20', '2023-12-01 04:45:20', NULL),
(14, 'fdgdfgs', 0, 'fdgdfgs', '2023-12-01 04:45:44', '2023-12-01 04:45:44', NULL),
(15, 'Menu 1.1 xin chao', 12, 'menu-11-xin-chao', '2023-12-01 04:50:37', '2023-12-01 04:50:37', NULL),
(16, 'Thao', 1, 'thao', '2023-12-01 04:54:40', '2023-12-01 04:54:40', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `name`, `parent_id`, `created_at`, `updated_at`, `slug`, `deleted_at`) VALUES
(1, 'Menu 1 Chao', 0, NULL, '2023-11-26 09:43:29', 'menu-1-chao', '2023-11-26 09:43:29'),
(2, 'Menu 2', 0, NULL, '2023-11-26 20:10:52', '', '2023-11-26 20:10:52'),
(3, 'Menu 3', 0, NULL, NULL, '', NULL),
(4, 'Menu 1.1', 1, NULL, '2023-11-24 01:33:37', 'menu-11', NULL),
(9, 'Menu 2.1', 2, '2023-11-24 00:39:42', '2023-11-24 01:44:22', '', '2023-11-24 01:44:22'),
(10, 'Menu 3.1', 3, '2023-11-24 01:01:27', '2023-11-24 01:01:27', 'menu-31', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_17_071945_create_categories_table', 1),
(6, '2023_11_22_021541_add_collum_deleted_at_table_categories', 2),
(7, '2023_11_22_025810_create_menus_table', 3),
(8, '2023_11_24_075221_add_colum_slug_to_menus_table', 4),
(9, '2023_11_24_083906_add_column_soft_delete_to_menus_table', 5),
(10, '2023_11_27_032313_create_products_table', 6),
(11, '2023_11_27_061801_create_product_images_table', 6),
(12, '2023_11_27_062151_create_tags_table', 6),
(13, '2023_11_27_062256_create_product_tags_table', 6),
(14, '2023_12_01_061454_add_column_feature_image_name', 7),
(15, '2023_12_01_070906_add_column_image_name_to_table_product_image', 8),
(16, '2023_12_05_003124_add_column_delete_at_to_product_table', 9),
(17, '2023_12_08_150228_create_sliders_table', 10),
(18, '2023_12_12_005213_add_column_delete_at_to_sliders', 11),
(19, '2023_12_12_010542_create_roles_table', 12),
(20, '2023_12_12_010613_create_permisstions_table', 12),
(21, '2023_12_12_010804_create_table_user_role', 12),
(22, '2023_12_12_010914_create_table_permisstion_role', 12),
(23, '2023_12_21_125733_add_column_delete_at_table_users', 13),
(24, '2023_12_21_143749_add_colum_parent_id_permission', 14),
(25, '2023_12_21_174102_add_column_key_permission_table', 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `display_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `key_code` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `created_at`, `updated_at`, `parent_id`, `key_code`) VALUES
(1, 'Danh mục sản phẩm', 'Danh mục sản phẩm', NULL, NULL, 0, ''),
(2, 'Danh sách danh mục', 'Danh sách danh mục sản phẩm', NULL, NULL, 1, 'list_category'),
(3, 'Thêm danh mục', 'Thêm danh mục', NULL, NULL, 1, 'add_category'),
(4, 'Sửa danh mục', 'Sửa danh mục', NULL, NULL, 1, 'edit_category'),
(5, 'Xóa danh mục', 'Xóa danh mục', NULL, NULL, 1, 'delete_category'),
(6, 'Menu', 'Menu', NULL, NULL, 0, ''),
(7, 'Danh sách menu', 'Danh sách menu', NULL, NULL, 6, 'list_menu'),
(8, 'Sửa menu', 'Sửa menu', NULL, NULL, 6, 'add_menu'),
(9, 'Xóa menu', 'Xóa menu', NULL, NULL, 6, 'edit_menu'),
(10, 'Thêm menu', 'Thêm menu', NULL, NULL, 6, 'delete_menu'),
(11, 'Slider', 'Slider', NULL, NULL, 0, ''),
(12, 'Danh sách slider', 'Danh sách slider', NULL, NULL, 11, 'list_slider'),
(13, 'Thêm slider', 'Thêm slider', NULL, NULL, 11, 'add_slider'),
(14, 'Sửa slider', 'Sửa slider', NULL, NULL, 11, 'edit_slider'),
(15, 'Xóa slider', 'Xóa slider', NULL, NULL, 11, 'delete_slider'),
(16, 'Sản phẩm', 'Sản phẩm', NULL, NULL, 0, ''),
(17, 'Danh sách sản phẩm', 'Danh sách sản phẩm', NULL, NULL, 16, 'list_product'),
(18, 'Thêm sản phẩm', 'Thêm sản phẩm', NULL, NULL, 16, 'add_product'),
(19, 'Sửa sản phẩm', 'Sửa sản phẩm', NULL, NULL, 16, 'edit_product'),
(20, 'Xóa sản phẩm', 'Xóa sản phẩm', NULL, NULL, 16, 'delete_product'),
(21, 'Setting', 'Setting', NULL, NULL, 0, ''),
(22, 'Danh sách Setting', 'Danh sách Setting', NULL, NULL, 21, 'list_setting'),
(23, 'Thêm Setting', 'Thêm Setting', NULL, NULL, 21, 'add_setting'),
(24, 'Sửa Setting', 'Sửa Setting', NULL, NULL, 21, 'edit_setting'),
(25, 'Xóa Setting', 'Xóa Setting', NULL, NULL, 21, 'delete_setting'),
(26, 'User', 'User', NULL, NULL, 0, ''),
(27, 'Danh sách User', 'Danh sách User', NULL, NULL, 26, 'list_user'),
(28, 'Thêm User', 'Thêm User', NULL, NULL, 26, 'add_user'),
(29, 'Sửa User', 'Sửa User', NULL, NULL, 26, 'edit_user'),
(30, 'Xóa User', 'Xóa User', NULL, NULL, 26, 'delete_user'),
(31, 'Role', 'Role\r\n', NULL, NULL, 0, ''),
(32, 'Danh sách role', 'Danh sách role', NULL, NULL, 31, 'list_role'),
(33, 'Thêm role', 'Thêm role', NULL, NULL, 31, 'add_role'),
(34, 'Sửa role', 'Sửa role', NULL, NULL, 31, 'edit_role'),
(35, 'Xóa role', 'Xóa role', NULL, NULL, 31, 'delete_role');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permisstion_role`
--

CREATE TABLE `permisstion_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `permistion_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permisstion_role`
--

INSERT INTO `permisstion_role` (`id`, `role_id`, `permistion_id`, `created_at`, `updated_at`) VALUES
(1, 5, 2, NULL, NULL),
(2, 5, 3, NULL, NULL),
(3, 5, 4, NULL, NULL),
(4, 5, 5, NULL, NULL),
(5, 1, 2, NULL, NULL),
(6, 1, 3, NULL, NULL),
(7, 1, 4, NULL, NULL),
(8, 1, 5, NULL, NULL),
(9, 1, 7, NULL, NULL),
(10, 1, 8, NULL, NULL),
(11, 1, 9, NULL, NULL),
(12, 1, 10, NULL, NULL),
(13, 1, 12, NULL, NULL),
(14, 1, 13, NULL, NULL),
(15, 1, 14, NULL, NULL),
(16, 1, 15, NULL, NULL),
(17, 1, 17, NULL, NULL),
(18, 1, 18, NULL, NULL),
(19, 1, 19, NULL, NULL),
(20, 1, 20, NULL, NULL),
(21, 1, 22, NULL, NULL),
(22, 1, 23, NULL, NULL),
(23, 1, 24, NULL, NULL),
(24, 1, 25, NULL, NULL),
(25, 1, 27, NULL, NULL),
(26, 1, 28, NULL, NULL),
(27, 1, 29, NULL, NULL),
(28, 1, 30, NULL, NULL),
(29, 1, 32, NULL, NULL),
(30, 1, 33, NULL, NULL),
(31, 1, 34, NULL, NULL),
(32, 1, 35, NULL, NULL),
(35, 2, 2, NULL, NULL),
(36, 2, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `price` double NOT NULL,
  `feature_image_path` varchar(191) DEFAULT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `feature_image_name` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `feature_image_path`, `content`, `user_id`, `category_id`, `created_at`, `updated_at`, `feature_image_name`, `deleted_at`) VALUES
(14, 'Le Thi Thao', 12443545465, '/storage/product/1/arH41XfD93aFALDi7wAr.jpg', 'dfg', 1, 0, '2023-12-01 06:12:02', '2023-12-21 14:33:09', 'remix-rumble-1080x1080.jpg', '2023-12-21 14:33:09'),
(16, 'nguyendo247', 10000000, '/storage/product/1/rEAmDMDVz0AhHePYlQmN.jpg', 'sdf', 1, 16, '2023-12-04 17:27:44', '2023-12-08 09:14:09', 'khung-vien-cua-nhung-phien-ban-iphone-14-duoc-lam-tu-titan-1-750x536.jpg', NULL),
(17, 'Iphone 4dsf sdf', 10000000, '/storage/product/1/auaJgZOZ8uvqC1RMeYWB.jpg', 'sdfsdf', 1, 12, '2023-12-08 07:41:50', '2023-12-08 09:13:58', 'khung-vien-cua-nhung-phien-ban-iphone-14-duoc-lam-tu-titan-1-750x536.jpg', NULL),
(18, 'Thaod dfgdfgdfgdg', 10000000, '/storage/product/1/PKQRJVaLzMBA1bVrcRdb.jpg', 'asdfasf', 1, 12, '2023-12-08 07:43:47', '2023-12-08 07:44:14', 'remix-rumble-1080x1080.jpg', NULL),
(19, 'Category 3.1.blue', 10000000, '/storage/product/1/A4qY54Mvv6XtXBq1qboR.jpg', 'Boring night', 1, 12, '2023-12-08 10:37:03', '2023-12-08 10:37:03', 'game-background-vector-7485405.jpg', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img_path` varchar(191) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_name` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `img_path`, `product_id`, `created_at`, `updated_at`, `image_name`) VALUES
(1, '/storage/product/1/IuAnCOh2EjGV15Cfa0hN.jpg', 7, '2023-12-01 00:41:33', '2023-12-01 00:41:33', 'remix-rumble-1080x1080.jpg'),
(5, '/storage/product/1/e4vQdknFCsEis4dPTXFZ.jpg', 9, '2023-12-01 00:54:30', '2023-12-01 00:54:30', 'remix-rumble-1080x1080.jpg'),
(7, '/storage/product/1/YhWqBBdsaRASgHPfYVsl.jpg', 10, '2023-12-01 01:16:36', '2023-12-01 01:16:36', 'IMG_20220818_101036.jpg'),
(8, '/storage/product/1/fMeGa40qpA6gPdJ9IsYE.jpg', 13, '2023-12-01 01:20:28', '2023-12-01 01:20:28', 'remix-rumble-1080x1080.jpg'),
(9, '/storage/product/1/fMeGa40qpA6gPdJ9IsYE.jpg', 13, '2023-12-01 01:20:28', '2023-12-01 01:20:28', 'IMG_20220818_101036.jpg'),
(10, '/storage/product/1/fMeGa40qpA6gPdJ9IsYE.jpg', 13, '2023-12-01 04:58:04', '2023-12-01 04:58:04', 'IMG_20220818_101036.jpg'),
(11, '/storage/product/1/E9pR1nN2tt6M1wf0qm3v.jpg', 15, '2023-12-01 17:33:03', '2023-12-01 17:33:03', 'khung-vien-cua-nhung-phien-ban-iphone-14-duoc-lam-tu-titan-1-750x536.jpg'),
(12, '/storage/product/1/yoqxfSv40xPvuazkW1T3.jpg', 18, '2023-12-08 07:43:47', '2023-12-08 07:43:47', 'khung-vien-cua-nhung-phien-ban-iphone-14-duoc-lam-tu-titan-1-750x536.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_tags`
--

CREATE TABLE `product_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_tags`
--

INSERT INTO `product_tags` (`id`, `product_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2023-12-01 00:04:45', '2023-12-01 00:04:45'),
(3, 4, 3, '2023-12-01 00:04:45', '2023-12-01 00:04:45'),
(5, 10, 5, NULL, NULL),
(8, 12, 6, '2023-12-01 01:53:07', '2023-12-01 01:53:07'),
(9, 13, 7, '2023-12-01 04:58:04', '2023-12-01 04:58:04'),
(10, 13, 8, '2023-12-01 04:58:04', '2023-12-01 04:58:04'),
(12, 14, 10, '2023-12-01 06:54:32', '2023-12-01 06:54:32'),
(13, 14, 11, '2023-12-01 06:59:16', '2023-12-01 06:59:16'),
(14, 15, 7, '2023-12-01 17:33:03', '2023-12-01 17:33:03'),
(15, 15, 12, '2023-12-01 17:33:03', '2023-12-01 17:33:03'),
(16, 16, 13, '2023-12-04 17:27:44', '2023-12-04 17:27:44'),
(17, 17, 14, '2023-12-08 07:41:50', '2023-12-08 07:41:50'),
(18, 18, 15, '2023-12-08 07:43:47', '2023-12-08 07:43:47'),
(19, 19, 16, '2023-12-08 10:37:03', '2023-12-08 10:37:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `display_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Quản trị hệ thống', NULL, NULL),
(2, 'guest', 'Khách hàng', NULL, NULL),
(3, 'developer', 'Phát triển hệ thống', NULL, NULL),
(4, 'content', 'Chỉnh sửa nội dung', NULL, NULL),
(5, 'Nhân quyền', 'B52, Dioxin', '2023-12-21 11:09:25', '2023-12-21 11:09:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` varchar(191) NOT NULL,
  `image_path` varchar(191) NOT NULL,
  `image_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `description`, `image_path`, `image_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Thao', 'Nothing', '/storage/slider/1/hP9mWGKGHqktZQMeNXf3.jpg', 'game-background-vector-7485405.jpg', '2023-12-08 12:22:16', '2023-12-08 12:22:16', NULL),
(2, 'Menu 1.1', 'sdfsdf', '/storage/slider/1/d1TGw5RATVqK5XEEBhN4.jpg', 'wallpaperflare.com_wallpaper.jpg', '2023-12-08 12:33:49', '2023-12-11 17:54:47', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'iphone4', '2023-12-01 00:04:45', '2023-12-01 00:04:45'),
(2, 'iphone5', '2023-12-01 00:04:45', '2023-12-01 00:04:45'),
(3, 'hello', '2023-12-01 00:04:45', '2023-12-01 00:04:45'),
(7, 'Iphone', '2023-12-01 04:58:04', '2023-12-01 04:58:04'),
(8, 'cobasaigon', '2023-12-01 04:58:04', '2023-12-01 04:58:04'),
(9, 'dfg', '2023-12-01 06:12:02', '2023-12-01 06:12:02'),
(10, 'hhj', '2023-12-01 06:54:32', '2023-12-01 06:54:32'),
(11, 'test 123', '2023-12-01 06:59:16', '2023-12-01 06:59:16'),
(12, 'iphone 4', '2023-12-01 17:33:03', '2023-12-01 17:33:03'),
(13, 'gh', '2023-12-04 17:27:44', '2023-12-04 17:27:44'),
(14, 'sdfsdf', '2023-12-08 07:41:50', '2023-12-08 07:41:50'),
(15, 'sdfsdfsdfsdfs', '2023-12-08 07:43:47', '2023-12-08 07:43:47'),
(16, 'dasf', '2023-12-08 10:37:03', '2023-12-08 10:37:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@', NULL, '$2y$12$NjCFsRwSEvyRR8002FuB/.aggwne95OgYbpv955gJmsEACkuTRs/a', NULL, NULL, NULL, NULL),
(2, 'admin1', 'admin1@', NULL, '$2y$12$NjCFsRwSEvyRR8002FuB/.aggwne95OgYbpv955gJmsEACkuTRs/a', NULL, NULL, NULL, NULL),
(3, 'nguyendo247', 'nguyenhuudo1206@gmail.com', NULL, '$2y$12$BD0KcCYmZmhxNalv6AfCoOcIDLMRgPBqGjN7Z2RP2LVk4NgrMqO4i', NULL, '2023-12-13 11:36:16', '2023-12-13 11:36:16', NULL),
(4, 'abc1234', 'fdfg@gmail.com', NULL, '$2y$12$BD0KcCYmZmhxNalv6AfCoOcIDLMRgPBqGjN7Z2RP2LVk4NgrMqO4i', NULL, '2023-12-13 11:45:44', '2023-12-21 06:25:02', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_role`
--

CREATE TABLE `user_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(2, 3, 2, NULL, NULL),
(6, 1, 2, NULL, NULL),
(8, 1, 1, NULL, NULL),
(9, 2, 1, NULL, NULL),
(10, 2, 2, NULL, NULL),
(11, 4, 4, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `permisstion_role`
--
ALTER TABLE `permisstion_role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `permisstion_role`
--
ALTER TABLE `permisstion_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
