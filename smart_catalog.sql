-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2026 at 06:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_catalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', 'Kategori produk makanan dan cemilan', 2, '2026-05-14 08:37:14', '2026-05-14 08:37:14'),
(2, 'Minuman', 'Kategori berbagai jenis minuman', 2, '2026-05-14 08:37:54', '2026-05-14 08:37:54'),
(3, 'Fashion', 'Kategori pakaian dan aksesoris', 2, '2026-05-14 08:38:10', '2026-05-14 08:38:10'),
(4, 'Elektronik', 'Kategori perangkat elektronik', 2, '2026-05-14 08:38:20', '2026-05-14 08:38:20'),
(5, 'Kerajinan', 'Kategori produk handmade dan kerajinan', 2, '2026-05-14 08:38:30', '2026-05-14 08:38:30'),
(6, 'Makanan', 'Produk makanan dan cemilan', 1, '2026-05-14 20:41:41', '2026-05-14 20:41:41'),
(7, 'Minuman', 'Produk minuman segar', 1, '2026-05-14 20:41:58', '2026-05-14 20:41:58'),
(8, 'Fashion', 'Pakaian dan aksesoris', 1, '2026-05-14 20:42:07', '2026-05-14 20:42:07'),
(9, 'Elektronik', 'Perangkat elektronik', 1, '2026-05-14 20:42:22', '2026-05-14 20:42:22'),
(10, 'Kerajinan', 'Produk handmade UMKM', 1, '2026-05-14 20:42:33', '2026-05-14 20:42:33'),
(11, 'Olahraga', 'Peralatan olahraga', 1, '2026-05-14 20:42:53', '2026-05-14 20:42:53'),
(12, 'Kecantikan', 'Produk skincare dan kosmetik', 1, '2026-05-14 20:43:05', '2026-05-14 20:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(5, '2026_05_14_083923_add_role_to_users_table', 2),
(6, '2026_05_14_142247_create_categories_table', 3),
(7, '2026_05_14_142523_create_products_table', 4),
(8, '2026_07_08_151027_add_stock_to_products_table', 5),
(9, '2026_07_08_151209_create_sales_transaction_table', 5),
(10, '2026_07_08_151228_create_stock_transaction_table', 5),
(11, '2026_07_12_064511_add_ending_stock_to_stock_transactions_table', 6),
(12, '2026_07_12_070204_add_ending_stock_to_sales_transactions_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `image`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Keripik Pisang Premium', 'Keripik pisang renyah dengan rasa original', 25000.00, 17, 'products/SVnTTfnWn5L3D0b3v4Elr894FNfU0G3x6jXgo4He.jpg', 1, 2, '2026-05-14 08:41:39', '2026-07-17 15:46:44'),
(2, 'Es Kopi Susu', 'Minuman kopi susu gula aren', 18000.00, 50, 'products/FzwJrYXQt6YuaAIO3p6Vr5wFbnTBhws7ytjbUyjb.jpg', 2, 2, '2026-05-14 19:02:27', '2026-07-17 15:46:24'),
(3, 'Speaker Bluetooth', 'Speaker portable dengan suara bass kuat', 275000.00, 2, 'products/k9HAMkvP7ImiSmMGvf3wBBKXpqmrJWf5I0hvAIUo.jpg', 4, 2, '2026-05-14 19:04:58', '2026-07-17 15:47:04'),
(4, 'Kaos Oversize', 'Kaos cotton combed premium', 85000.00, 0, 'products/yccizg2QUZZTYK2sG1GRBqcw8yJarI6ebkHp6n7i.jpg', 3, 2, '2026-05-14 19:14:55', '2026-07-17 15:46:34'),
(5, 'Tas Anyaman Rotan', 'Tas handmade berbahan rotan alami', 150000.00, 15, 'products/S6p90nGP6zRqPgceM7fhZwPfd7Y09OrKcrx6qNzA.jpg', 5, 2, '2026-05-14 19:16:42', '2026-07-17 15:47:13'),
(6, 'Brownies Coklat', 'Brownies lembut dengan topping coklat premium', 45000.00, 85, 'products/7FZcq636JaeujvNq1k1nCPpjwABEzNjqu8V3fvEj.png', 6, 1, '2026-05-14 20:56:03', '2026-07-17 15:41:55'),
(7, 'Thai Tea Original', 'Minuman thai tea segar ukuran jumbo', 22000.00, 0, 'products/b6wYuiX3lh2oosA3YKGxQL3yqJTah2Rd5xkJ5www.jpg', 7, 1, '2026-05-14 20:57:41', '2026-07-13 02:25:24'),
(8, 'Topi Baseball', 'Topi casual untuk pria dan wanita', 50000.00, 0, 'products/F17xoy7410tdT4fBLPMSdNT4DgHQGWgjfL7qG8oY.jpg', 8, 1, '2026-05-14 20:59:35', '2026-07-17 15:42:45'),
(9, 'Mouse Wireless', 'Mouse wireless rechargeable', 95000.00, 15, 'products/1aucxNXL8bon2VvMT0ejbUFKXFLzr8BSitgtptAp.jpg', 9, 1, '2026-05-14 21:02:54', '2026-07-12 22:07:55'),
(10, 'Keyboard Mechanical', 'Keyboard gaming RGB mechanical', 350000.00, 20, 'products/pUj8StzcBO7Z4pueY4kxkNhnYDW2ELiastR9nXOj.jpg', 9, 1, '2026-05-14 21:04:35', '2026-07-17 15:42:32'),
(11, 'Gelang Handmade', 'Gelang handmade motif etnik', 30000.00, 36, 'products/Vg64uOE5WBx9fOZQZNzmBWxkIrsLvYeJQacJ0Gvx.jpg', 10, 1, '2026-05-14 21:05:56', '2026-07-17 15:42:09'),
(12, 'Vas Bambu', 'Vas bunga dari bambu alami', 70000.00, 3, 'products/XVoEQURwgPWklc3FyKX10eWazcfXL0xSniFVKw8P.jpg', 10, 1, '2026-05-14 21:07:14', '2026-07-17 15:42:54'),
(13, 'Raket Badminton', 'Raket ringan untuk latihan', 175000.00, 25, 'products/LY9NEaq7lLi39uCr1qF8A7xNeH26dLpGKgiAC5BH.jpg', 11, 1, '2026-05-14 21:08:30', '2026-07-16 15:34:50'),
(14, 'Serum Wajah', 'Serum vitamin C glowing', 99000.00, 7, 'products/7GDUtpUFjC2gmsGokS5CXZ2IKtXSK3oZvLBwDii1.jpg', 12, 1, '2026-05-14 21:10:49', '2026-07-17 15:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `sales_transactions`
--

CREATE TABLE `sales_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_code` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `merchant_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `ending_stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_transactions`
--

INSERT INTO `sales_transactions` (`id`, `transaction_code`, `transaction_date`, `product_id`, `merchant_id`, `qty`, `ending_stock`, `created_at`, `updated_at`) VALUES
(2, 'TRX-20260712-0001', '2026-07-12', 6, 1, 10, 20, '2026-07-12 01:44:46', '2026-07-12 01:44:46'),
(3, 'TRX-20260713-0002', '2026-07-13', 6, 1, 30, 90, '2026-07-12 22:03:18', '2026-07-12 22:03:18'),
(4, 'TRX-20260713-0003', '2026-07-13', 11, 1, 28, 42, '2026-07-12 22:06:17', '2026-07-12 22:06:17'),
(5, 'TRX-20260713-0004', '2026-07-13', 10, 1, 2, 18, '2026-07-12 22:07:20', '2026-07-12 22:07:20'),
(6, 'TRX-20260713-0005', '2026-07-13', 9, 1, 5, 15, '2026-07-12 22:07:55', '2026-07-12 22:07:55'),
(7, 'TRX-20260713-0006', '2026-07-13', 7, 1, 12, 0, '2026-07-13 02:25:24', '2026-07-13 02:25:24'),
(8, 'TRX-20260716-0007', '2026-07-16', 12, 1, 2, 5, '2026-07-16 15:34:23', '2026-07-16 15:34:23'),
(9, 'TRX-20260716-0008', '2026-07-16', 14, 1, 3, 12, '2026-07-16 15:34:36', '2026-07-16 15:34:36'),
(10, 'TRX-20260716-0009', '2026-07-16', 13, 1, 5, 25, '2026-07-16 15:34:50', '2026-07-16 15:34:50'),
(11, 'TRX-20260716-0010', '2026-07-16', 11, 1, 11, 31, '2026-07-16 15:35:05', '2026-07-16 15:35:05'),
(12, 'TRX-20260716-0011', '2026-07-16', 6, 1, 15, 75, '2026-07-16 15:35:17', '2026-07-16 15:35:17'),
(13, 'TRX-20260717-0012', '2026-07-17', 8, 1, 5, 0, '2026-07-17 15:42:45', '2026-07-17 15:42:45'),
(14, 'TRX-20260717-0013', '2026-07-17', 12, 1, 2, 3, '2026-07-17 15:42:54', '2026-07-17 15:42:54'),
(15, 'TRX-20260717-0014', '2026-07-17', 14, 1, 5, 7, '2026-07-17 15:43:11', '2026-07-17 15:43:11'),
(16, 'TRX-20260717-0015', '2026-07-17', 2, 2, 50, 50, '2026-07-17 15:46:24', '2026-07-17 15:46:24'),
(17, 'TRX-20260717-0016', '2026-07-17', 4, 2, 20, 0, '2026-07-17 15:46:34', '2026-07-17 15:46:34'),
(18, 'TRX-20260717-0017', '2026-07-17', 1, 2, 33, 17, '2026-07-17 15:46:44', '2026-07-17 15:46:44'),
(19, 'TRX-20260717-0018', '2026-07-17', 3, 2, 9, 2, '2026-07-17 15:47:04', '2026-07-17 15:47:04'),
(20, 'TRX-20260717-0019', '2026-07-17', 5, 2, 3, 15, '2026-07-17 15:47:13', '2026-07-17 15:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('17RItxBWCZ6QmMlm3pFCfs7V6tZmqv2SWPXRGvUB', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWmRtdThrT3JHcUJReUowck9VbWNwODdTYU0yYkpKYXNtcGZDWllUcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXBvcnRzL3NhbGVzIjtzOjU6InJvdXRlIjtzOjEzOiJyZXBvcnRzLnNhbGVzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1784330030),
('GzvwKEJtj4YwjUv3MXhAwH5gjv5Gzvu5cux44JBK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.129.0 Chrome/148.0.7778.280 Electron/42.6.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1pNUVRXb3ZtaTlaOFdWbjBNNW5QRm9rb21tRGFwMG41dHE5SEhXciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1784327514);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transactions`
--

CREATE TABLE `stock_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_code` varchar(255) NOT NULL,
  `stock_date` date NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `merchant_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `ending_stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_transactions`
--

INSERT INTO `stock_transactions` (`id`, `stock_code`, `stock_date`, `product_id`, `merchant_id`, `qty`, `ending_stock`, `created_at`, `updated_at`) VALUES
(2, 'STK-20260712-0002', '2026-07-12', 6, 1, 10, 10, '2026-07-12 01:41:51', '2026-07-12 01:41:51'),
(3, 'STK-20260712-0003', '2026-07-12', 6, 1, 20, 30, '2026-07-12 01:44:23', '2026-07-12 01:44:23'),
(4, 'STK-20260713-0004', '2026-07-13', 6, 1, 100, 120, '2026-07-12 21:50:38', '2026-07-12 21:50:38'),
(5, 'STK-20260713-0005', '2026-07-13', 11, 1, 70, 70, '2026-07-12 21:50:54', '2026-07-12 21:50:54'),
(6, 'STK-20260713-0006', '2026-07-13', 10, 1, 20, 20, '2026-07-12 21:51:06', '2026-07-12 21:51:06'),
(7, 'STK-20260713-0007', '2026-07-13', 9, 1, 20, 20, '2026-07-12 21:51:22', '2026-07-12 21:51:22'),
(8, 'STK-20260713-0008', '2026-07-13', 13, 1, 30, 30, '2026-07-12 21:51:41', '2026-07-12 21:51:41'),
(9, 'STK-20260713-0009', '2026-07-13', 14, 1, 15, 15, '2026-07-12 21:51:59', '2026-07-12 21:51:59'),
(10, 'STK-20260713-0010', '2026-07-13', 7, 1, 12, 12, '2026-07-12 21:52:14', '2026-07-12 21:52:14'),
(11, 'STK-20260713-0011', '2026-07-13', 8, 1, 5, 5, '2026-07-12 21:52:26', '2026-07-12 21:52:26'),
(12, 'STK-20260713-0012', '2026-07-13', 12, 1, 7, 7, '2026-07-12 21:52:36', '2026-07-12 21:52:36'),
(13, 'STK-20260717-0013', '2026-07-17', 6, 1, 10, 85, '2026-07-17 15:41:56', '2026-07-17 15:41:56'),
(14, 'STK-20260717-0014', '2026-07-17', 11, 1, 5, 36, '2026-07-17 15:42:09', '2026-07-17 15:42:09'),
(15, 'STK-20260717-0015', '2026-07-17', 10, 1, 2, 20, '2026-07-17 15:42:32', '2026-07-17 15:42:32'),
(16, 'STK-20260717-0016', '2026-07-17', 2, 2, 100, 100, '2026-07-17 15:44:24', '2026-07-17 15:44:24'),
(17, 'STK-20260717-0017', '2026-07-17', 4, 2, 20, 20, '2026-07-17 15:44:34', '2026-07-17 15:44:34'),
(18, 'STK-20260717-0018', '2026-07-17', 1, 2, 50, 50, '2026-07-17 15:44:44', '2026-07-17 15:44:44'),
(19, 'STK-20260717-0019', '2026-07-17', 3, 2, 11, 11, '2026-07-17 15:44:53', '2026-07-17 15:44:53'),
(20, 'STK-20260717-0020', '2026-07-17', 5, 2, 18, 18, '2026-07-17 15:46:02', '2026-07-17 15:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'merchant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'merchant1', 'merchant1@gmail.com', NULL, '$2y$12$tWEypLR4NKaiFdJ0OPjIO.SjoHMLMmUxm2Xk2rmzfoULHirHjnY3W', NULL, '2026-05-14 01:25:38', '2026-05-14 01:25:38', 'merchant'),
(2, 'merchant2', 'merchant2@gmail.com', NULL, '$2y$12$Ic.WQAbc1IMMUK1Dy8YuEOQhsnzlpmP/hKtAXNWG4O1hv0ZShuA6.', NULL, '2026-05-14 06:50:38', '2026-05-14 06:50:38', 'merchant'),
(4, 'admin', 'admin@gmail.com', NULL, '$2y$12$knsHHdnQK56B6lR23Q247eeT7oExPr1Kz5KEhaIyvYZMuoDcaWgvK', NULL, '2026-05-14 23:38:56', '2026-05-14 23:38:56', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `sales_transactions`
--
ALTER TABLE `sales_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_transactions_transaction_code_unique` (`transaction_code`),
  ADD KEY `sales_transactions_product_id_foreign` (`product_id`),
  ADD KEY `sales_transactions_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_transactions_stock_code_unique` (`stock_code`),
  ADD KEY `stock_transactions_product_id_foreign` (`product_id`),
  ADD KEY `stock_transactions_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales_transactions`
--
ALTER TABLE `sales_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_transactions`
--
ALTER TABLE `sales_transactions`
  ADD CONSTRAINT `sales_transactions_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD CONSTRAINT `stock_transactions_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
