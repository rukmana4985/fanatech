-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Des 2023 pada 19.07
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fanatech`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventories`
--

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `inventories`
--

INSERT INTO `inventories` (`id`, `code`, `name`, `price`, `stock`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Magnum Blue', 20000, 28, '2023-12-27 16:31:01', '2023-12-28 17:02:19', '2023-12-27 16:31:01'),
(2, 2, 'Baju', 30000, 200, '2023-12-28 15:33:35', '2023-12-28 17:39:22', '2023-12-28 15:33:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `id_menu` varchar(45) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `urutan` varchar(45) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `id_menu`, `url`, `urutan`, `icon`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Inventori', NULL, 'inventories', NULL, 'icon-diamond', '2023-12-28 17:40:36', '2023-12-28 17:40:36', NULL),
(2, NULL, 'Penjualan', NULL, 'sales', NULL, 'icon-diamond', '2023-12-28 17:40:59', '2023-12-28 17:40:59', NULL),
(3, NULL, 'Pembelian', NULL, 'purchases', NULL, 'icon-diamond', '2023-12-28 17:41:20', '2023-12-28 17:41:20', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `purchases`
--

INSERT INTO `purchases` (`id`, `number`, `date`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2023-12-28', 1, '2023-12-28 14:03:32', '2023-12-28 14:03:32', '2023-12-28 14:03:32'),
(2, 2, '2023-12-28', 1, '2023-12-28 14:06:03', '2023-12-28 14:06:03', '2023-12-28 14:06:03'),
(3, 3, '2023-12-28', 1, '2023-12-28 14:07:11', '2023-12-28 14:07:11', '2023-12-28 14:07:11'),
(4, 4, '2023-12-28', 1, '2023-12-28 14:08:18', '2023-12-28 14:08:18', '2023-12-28 14:08:18'),
(5, 21, '2023-12-28', 1, '2023-12-28 14:09:04', '2023-12-28 14:09:04', '2023-12-28 14:09:04'),
(6, 10, '2023-12-28', 1, '2023-12-28 14:09:45', '2023-12-28 14:09:45', '2023-12-28 14:09:45'),
(7, 30, '2023-12-28', 1, '2023-12-28 14:10:34', '2023-12-28 14:10:34', '2023-12-28 14:10:34'),
(8, 2, '2023-12-28', 1, '2023-12-28 14:11:18', '2023-12-28 14:11:18', '2023-12-28 14:11:18'),
(10, 312, '2023-12-29', 1, '2023-12-28 17:39:22', '2023-12-28 17:39:22', '2023-12-28 17:39:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `inventory_id`, `qty`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 2, 3, 90000, '2023-12-28 17:39:22', '2023-12-28 17:39:22', '2023-12-28 17:39:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `slug` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', NULL, '2017-11-10 00:22:01', '2023-12-28 17:41:43', NULL),
(2, 'Sales', NULL, '2023-12-28 17:42:02', '2023-12-28 17:42:02', NULL),
(3, 'Purchase', NULL, '2023-12-28 17:42:19', '2023-12-28 17:42:19', NULL),
(4, 'Manager', NULL, '2023-12-28 17:42:30', '2023-12-28 17:42:30', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_menus`
--

CREATE TABLE `role_menus` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `role_menus`
--

INSERT INTO `role_menus` (`id`, `role_id`, `menu_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL),
(3, 1, 3, NULL, NULL, NULL),
(4, 2, 2, NULL, NULL, NULL),
(5, 3, 3, NULL, NULL, NULL),
(6, 4, 2, NULL, NULL, NULL),
(7, 4, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id`, `number`, `date`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2023-12-27', 1, '2023-12-27 16:41:38', '2023-12-27 16:41:38', '2023-12-27 16:41:38'),
(3, 3, '2023-12-28', 1, '2023-12-28 16:40:05', '2023-12-28 16:40:05', '2023-12-28 16:40:05'),
(5, 1, '2023-12-29', 1, '2023-12-28 17:02:19', '2023-12-28 17:02:19', '2023-12-28 17:02:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_details`
--

CREATE TABLE `sales_details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sales_details`
--

INSERT INTO `sales_details` (`id`, `sales_id`, `inventory_id`, `qty`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 1, 2, 1, 30000, '2023-12-28 17:01:33', '2023-12-28 17:01:33', '2023-12-28 17:01:33'),
(5, 1, 1, 2, 40000, '2023-12-28 17:02:19', '2023-12-28 17:02:19', '2023-12-28 17:02:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'superadmin', '$2y$10$PIhiSIHui.HqMt88x0fmO.27YeuVTs8aM3PaoAjK2ukwnO/f/D0ti', NULL, NULL, NULL, NULL),
(2, 2, 'sales', '$2y$10$PIhiSIHui.HqMt88x0fmO.27YeuVTs8aM3PaoAjK2ukwnO/f/D0ti', NULL, NULL, NULL, NULL),
(3, 3, 'purchase', '$2y$10$PIhiSIHui.HqMt88x0fmO.27YeuVTs8aM3PaoAjK2ukwnO/f/D0ti', NULL, NULL, NULL, NULL),
(4, 4, 'manager', '$2y$10$PIhiSIHui.HqMt88x0fmO.27YeuVTs8aM3PaoAjK2ukwnO/f/D0ti', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_menus_menus1_idx` (`parent_id`) USING BTREE;

--
-- Indeks untuk tabel `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `role_menus`
--
ALTER TABLE `role_menus`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_role_menu_role1_idx` (`role_id`) USING BTREE,
  ADD KEY `fk_role_menu_menu1_idx` (`menu_id`) USING BTREE;

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_users_roles1_idx` (`role_id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `role_menus`
--
ALTER TABLE `role_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
