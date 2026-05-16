-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2026 at 03:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(7, '2026_05_14_142523_create_products_table', 4);

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
  `image` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Keripik Pisang Premium', 'Keripik pisang renyah dengan rasa original', 25000.00, 'products/SVnTTfnWn5L3D0b3v4Elr894FNfU0G3x6jXgo4He.jpg', 1, 2, '2026-05-14 08:41:39', '2026-05-14 08:41:39'),
(2, 'Es Kopi Susu', 'Minuman kopi susu gula aren', 18000.00, 'products/FzwJrYXQt6YuaAIO3p6Vr5wFbnTBhws7ytjbUyjb.jpg', 2, 2, '2026-05-14 19:02:27', '2026-05-14 19:02:27'),
(3, 'Speaker Bluetooth', 'Speaker portable dengan suara bass kuat', 275000.00, 'products/k9HAMkvP7ImiSmMGvf3wBBKXpqmrJWf5I0hvAIUo.jpg', 4, 2, '2026-05-14 19:04:58', '2026-05-14 19:04:58'),
(4, 'Kaos Oversize', 'Kaos cotton combed premium', 85000.00, 'products/yccizg2QUZZTYK2sG1GRBqcw8yJarI6ebkHp6n7i.jpg', 3, 2, '2026-05-14 19:14:55', '2026-05-14 19:14:55'),
(5, 'Tas Anyaman Rotan', 'Tas handmade berbahan rotan alami', 150000.00, 'products/S6p90nGP6zRqPgceM7fhZwPfd7Y09OrKcrx6qNzA.jpg', 5, 2, '2026-05-14 19:16:42', '2026-05-14 19:16:42'),
(6, 'Brownies Coklat', 'Brownies lembut dengan topping coklat premium', 45000.00, 'products/7FZcq636JaeujvNq1k1nCPpjwABEzNjqu8V3fvEj.png', 6, 1, '2026-05-14 20:56:03', '2026-05-14 20:56:16'),
(7, 'Thai Tea Original', 'Minuman thai tea segar ukuran jumbo', 22000.00, 'products/b6wYuiX3lh2oosA3YKGxQL3yqJTah2Rd5xkJ5www.jpg', 7, 1, '2026-05-14 20:57:41', '2026-05-14 20:57:41'),
(8, 'Topi Baseball', 'Topi casual untuk pria dan wanita', 50000.00, 'products/F17xoy7410tdT4fBLPMSdNT4DgHQGWgjfL7qG8oY.jpg', 8, 1, '2026-05-14 20:59:35', '2026-05-14 20:59:35'),
(9, 'Mouse Wireless', 'Mouse wireless rechargeable', 95000.00, 'products/1aucxNXL8bon2VvMT0ejbUFKXFLzr8BSitgtptAp.jpg', 9, 1, '2026-05-14 21:02:54', '2026-05-14 21:02:54'),
(10, 'Keyboard Mechanical', 'Keyboard gaming RGB mechanical', 350000.00, 'products/pUj8StzcBO7Z4pueY4kxkNhnYDW2ELiastR9nXOj.jpg', 9, 1, '2026-05-14 21:04:35', '2026-05-14 21:04:35'),
(11, 'Gelang Handmade', 'Gelang handmade motif etnik', 30000.00, 'products/Vg64uOE5WBx9fOZQZNzmBWxkIrsLvYeJQacJ0Gvx.jpg', 10, 1, '2026-05-14 21:05:56', '2026-05-14 21:05:56'),
(12, 'Vas Bambu', 'Vas bunga dari bambu alami', 70000.00, 'products/XVoEQURwgPWklc3FyKX10eWazcfXL0xSniFVKw8P.jpg', 10, 1, '2026-05-14 21:07:14', '2026-05-14 21:07:14'),
(13, 'Raket Badminton', 'Raket ringan untuk latihan', 175000.00, 'products/LY9NEaq7lLi39uCr1qF8A7xNeH26dLpGKgiAC5BH.jpg', 11, 1, '2026-05-14 21:08:30', '2026-05-14 21:08:30'),
(14, 'Serum Wajah', 'Serum vitamin C glowing', 99000.00, 'products/7GDUtpUFjC2gmsGokS5CXZ2IKtXSK3oZvLBwDii1.jpg', 12, 1, '2026-05-14 21:10:49', '2026-05-14 21:10:49');

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
('7GMtH4kxknth2SRJq1ITZEPpzJdd4dnh7RFeRtwW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkNQdlFzSkJwcXlDQWlOMDFZaVVVaW1kR1Z4R3BpQ0NLQ3RsQ25FWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778893745),
('qF0mSOvXPl26v64UhEGpHHo5JYYFfvGpEHFB8NwH', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMjJIUFFCWjZ0YTJhMHRLV2ptdE5EVExndVlxZTdSWjh3RjY2UVA2byI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1778827957),
('W4LxdAzocYjT7hZ5pjrlWZSCswHj7fMK9HPprp5y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHVLaGF5RTdjRkNlVGZnMG5raW05VmRBQXBydWFkR01KRHh4YXR2NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778826837);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
