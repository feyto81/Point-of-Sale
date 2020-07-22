-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 05 Jun 2020 pada 04.19
-- Versi server: 5.7.24
-- Versi PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `discount_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Trigger `carts`
--
DELIMITER $$
CREATE TRIGGER `cart_del` AFTER DELETE ON `carts` FOR EACH ROW BEGIN
     UPDATE items SET stock = stock + OLD.qty
     WHERE item_id = OLD.item_id;
 END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cart_insert` AFTER INSERT ON `carts` FOR EACH ROW BEGIN
	UPDATE items SET stock = stock-NEW.qty
    WHERE item_id=NEW.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Pakaian', '2020-05-27 15:55:44', '2020-05-27 15:55:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `gender`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Yolla', 'perempuan', '08437483784', 'Jepara', '2020-05-27 14:36:45', '2020-05-27 14:36:45'),
(2, 'feyto', 'laki-laki', '93843849', 'Jepara', '2020-06-04 18:26:54', '2020-06-04 18:26:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `unit_id` int(10) UNSIGNED DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(10) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`item_id`, `barcode`, `name`, `category_id`, `unit_id`, `price`, `stock`, `image`, `created_at`, `updated_at`) VALUES
(1, 'A001', 'Kaos', 2, 2, '20000', 13, 'images/SzqTVvCgnnlQabrK1zI5OUJuBg966J8Z7uYZOoTd.jpeg', '2020-05-28 13:21:18', NULL),
(6, 'A002', 'feyto', 2, 2, '20000', 19, 'images/P0v7PTVxJusI3kyX50HU8R16hJSzvFVkn1ogVV7e.jpeg', '2020-05-28 06:31:27', '2020-05-29 14:40:27'),
(7, 'A003', 'wikrama', 2, 2, '70000', 78, 'images/qoa4EUoIzltLiYyf6wFOvMmFQeBCp9Ew0GIJ21cT.jpeg', '2020-05-28 06:32:32', '2020-05-28 06:32:32'),
(11, 'A004', 'Pakaian', 2, 2, '90000', 18, 'images/gRdHxDT84DEyry3X1xnbJSX52pcsjPvSoZxLMQ7T.jpeg', '2020-05-28 11:12:35', '2020-05-28 11:12:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2020-05-27 14:17:59', '2020-05-27 14:17:59'),
(2, 'Kasir', '2020-05-30 03:11:28', '2020-05-30 03:11:28'),
(3, 'Manager', '2020-05-30 03:11:28', '2020-05-30 03:11:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_activity`
--

CREATE TABLE `log_activity` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `log_activity`
--

INSERT INTO `log_activity` (`id`, `subject`, `url`, `method`, `ip`, `agent`, `user_id`, `created_at`, `updated_at`) VALUES
(50, 'Menambahkan Supplier Tok sas', 'http://localhost:8000/supplier/saveAdd', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 1, '2020-06-05 02:06:50', '2020-06-05 02:06:50'),
(51, 'Mengupdate Supplier Toko Atuk', 'http://localhost:8000/supplier/update-supplier/8', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 1, '2020-06-05 02:07:45', '2020-06-05 02:07:45'),
(52, 'Menghapus Supplier Toko Atuk', 'http://localhost:8000/supplier/delete-supplier/8', 'GET', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 1, '2020-06-05 02:07:56', '2020-06-05 02:07:56'),
(53, 'Menambahkan Category Buah', 'http://localhost:8000/save-category', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 1, '2020-06-05 02:08:40', '2020-06-05 02:08:40'),
(54, 'Delete Category ', 'http://localhost:8000/delete-category/3', 'GET', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 1, '2020-06-05 02:08:49', '2020-06-05 02:08:49'),
(55, 'Menambahkan Stock In ', 'http://localhost:8000/stock-in/save-stock-in', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 1, '2020-06-05 02:10:38', '2020-06-05 02:10:38'),
(56, 'Menambahkan Transaksi ', 'http://localhost:8000/sales/transaction', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 1, '2020-06-05 02:11:58', '2020-06-05 02:11:58'),
(57, 'Menambahkan Pengeluaran 90000', 'http://localhost:8000/pengeluaran/add', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 1, '2020-06-05 02:12:46', '2020-06-05 02:12:46'),
(58, 'Menambahkan User admin', 'http://localhost:8000/user/add', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 1, '2020-06-05 02:14:41', '2020-06-05 02:14:41'),
(59, 'Mengupdate Password 1', 'http://localhost:8000/update-password', 'PUT', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 1, '2020-06-05 02:15:04', '2020-06-05 02:15:04'),
(60, 'Menambahkan Transaksi ', 'http://localhost:8000/sales/transaction', 'POST', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 1, '2020-06-05 04:09:38', '2020-06-05 04:09:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_05_27_135948_create_table_level', 1),
(4, '2020_05_27_140944_create_levels_table', 2),
(5, '2014_10_12_000000_create_users_table', 3),
(6, '2020_05_27_142714_create_users_table', 4),
(7, '2020_05_27_152354_create_suppliers_table', 5),
(8, '2020_05_27_205402_create_customers_table', 6),
(9, '2020_05_27_221326_create_categories_table', 7),
(10, '2020_05_27_225721_create_units_table', 8),
(11, '2020_05_27_231737_create_items_table', 9),
(12, '2020_05_28_190306_create_stock_table', 10),
(13, '2020_05_28_222444_create_stockouts_table', 11),
(14, '2020_05_29_004505_create_carts_table', 12),
(15, '2020_05_29_124537_create_sales_table', 13),
(16, '2020_05_29_155916_create_sales_table', 14),
(17, '2020_05_29_154350_create_sale_details_table', 15),
(18, '2020_05_29_165235_create_sales_table', 16),
(19, '2020_05_29_165522_create_sale_details_table', 17),
(20, '2020_05_29_165930_create_carts_table', 18),
(21, '2020_05_29_194932_create_carts_table', 19),
(22, '2020_05_29_195808_create_sale_details_table', 20),
(23, '2020_05_30_143350_create_log_activity', 21),
(24, '2020_06_02_135440_create_pemasukans_table', 22),
(25, '2020_06_03_094417_create_pengeluarans_table', 23);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukans`
--

CREATE TABLE `pemasukans` (
  `pemasukan_id` int(10) UNSIGNED NOT NULL,
  `pemasukan_count` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemasukans`
--

INSERT INTO `pemasukans` (`pemasukan_id`, `pemasukan_count`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, '20000', 'Pemasukan Hari Rabu', '2020-06-02 08:52:57', '2020-06-02 10:08:54'),
(3, '500000', 'pemasukan hari selasa', '2020-06-03 15:43:39', '2020-06-03 15:43:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluarans`
--

CREATE TABLE `pengeluarans` (
  `pengeluaran_id` int(10) UNSIGNED NOT NULL,
  `pengeluaran_count` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengeluarans`
--

INSERT INTO `pengeluarans` (`pengeluaran_id`, `pengeluaran_count`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, '100000', 'Beli Stock pakaian', '2020-06-03 03:14:47', '2020-06-05 00:43:50'),
(3, '90000', 'Pembelian Stock baju', '2020-06-05 02:12:46', '2020-06-05 02:12:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `sale_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `final_price` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`sale_id`, `total_price`, `discount`, `final_price`, `cash`, `remaining`, `note`, `date`, `user_id`, `created`, `updated_at`) VALUES
('INV000001', 20000, 900, 19100, 90000, 70900, 'sa', '2020-05-29', 1, '2019-11-28 20:04:47', NULL),
('INV000002', 20000, 900, 19100, 90000, 70900, 'lsa', '2020-05-29', 1, '2020-05-29 20:07:01', NULL),
('INV000003', 40000, 900, 39100, 90000, 50900, 'sa', '2020-05-29', 1, '2020-05-29 20:07:56', NULL),
('INV000004', 20000, 2000, 18000, 20000, 2000, 'sas', '2020-05-29', 1, '2020-05-29 20:51:26', NULL),
('INV000005', 70000, 900, 69100, 90000, 20900, 'sa', '2020-06-01', 1, '2020-06-01 18:27:06', NULL),
('INV000006', 220000, 90000, 130000, 130000, 0, 'lunas', '2020-06-01', 1, '2020-06-01 18:28:22', NULL),
('INV000007', 20000, 9000, 11000, 89999, 78999, 'kubas', '2020-06-01', 1, '2020-06-01 18:29:17', NULL),
('INV000008', 210000, 900, 209100, 90000, -119100, 'lunas', '2020-06-01', 1, '2020-06-01 19:02:18', NULL),
('INV000009', 3600, 20, 3580, 9000, 5420, 'sa', '2020-06-01', 1, '2020-06-01 21:56:07', NULL),
('INV000010', 140000, 0, 140000, 0, 0, 'sa', '2020-06-02', 1, '2020-06-02 12:43:10', NULL),
('INV000011', 70000, 200, 69800, 70000, 200, 'lunas', '2020-06-04', 1, '2020-06-03 20:08:36', NULL),
('INV000012', 40000, 900, 39100, 90000, 50900, 'lunas', '2020-06-05', 1, '2020-06-05 02:11:58', NULL),
('INV000013', 60000, 900, 59100, 90000, 30900, 'Lunas', '2020-06-05', 1, '2020-06-05 04:09:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sale_details`
--

CREATE TABLE `sale_details` (
  `detail_id` int(10) UNSIGNED NOT NULL,
  `sale_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sale_details`
--

INSERT INTO `sale_details` (`detail_id`, `sale_id`, `item_id`, `price`, `qty`, `discount_item`, `total`, `customer_name`, `created_at`, `updated_at`) VALUES
(1, 'INV000001', 6, '20000', '1', '0', '20000', 'umum', NULL, NULL),
(2, 'INV000002', 1, '20000', '1', '0', '20000', 'umum', NULL, NULL),
(3, 'INV000003', 6, '20000', '1', '0', '20000', 'Yolla', NULL, NULL),
(4, 'INV000003', 1, '20000', '1', '0', '20000', 'Yolla', NULL, NULL),
(5, 'INV000004', 6, '20000', '1', '0', '20000', 'umum', NULL, NULL),
(6, 'INV000005', 7, '70000', '1', '0', '70000', 'umum', '2020-06-01 18:27:06', NULL),
(7, 'INV000006', 7, '70000', '2', '0', '140000', 'umum', '2020-06-01 18:28:22', NULL),
(8, 'INV000006', 1, '20000', '2', '0', '40000', 'umum', '2020-06-01 18:28:22', NULL),
(9, 'INV000006', 6, '20000', '2', '0', '40000', 'umum', '2020-06-01 18:28:22', NULL),
(10, 'INV000007', 6, '20000', '1', '0', '20000', 'umum', '2020-06-01 18:29:17', NULL),
(11, 'INV000008', 7, '70000', '1', '0', '70000', 'umum', '2020-06-01 19:02:18', NULL),
(12, 'INV000008', 7, '70000', '2', '0', '140000', 'umum', '2020-06-01 19:02:18', NULL),
(13, 'INV000009', 7, '900', '2', '90', '1620', 'umum', '2020-06-01 21:56:07', NULL),
(14, 'INV000009', 6, '2000', '1', '20', '1980', 'umum', '2020-06-01 21:56:07', NULL),
(15, 'INV000010', 7, '70000', '2', '0', '140000', 'Yolla', '2020-06-02 12:43:10', NULL),
(16, 'INV000011', 7, '70000', '1', '0', '70000', 'umum', '2020-06-03 20:08:36', NULL),
(17, 'INV000012', 1, '20000', '1', '0', '20000', 'umum', '2020-06-05 02:11:58', NULL),
(18, 'INV000012', 6, '20000', '1', '0', '20000', 'umum', '2020-06-05 02:11:58', NULL),
(19, 'INV000013', 6, '20000', '2', '0', '40000', 'umum', '2020-06-05 04:09:38', NULL),
(20, 'INV000013', 1, '20000', '1', '0', '20000', 'umum', '2020-06-05 04:09:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('in','out') COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`stock_id`, `item_id`, `type`, `detail`, `supplier_id`, `qty`, `date`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 1, 'in', 'Kulakan', 2, 10, '2020-05-28', 1, '2020-05-28 22:49:44', NULL),
(7, 6, 'in', 'tambahan', 2, 30, '2020-05-29', 1, '2020-05-29 14:38:27', NULL),
(8, 7, 'in', 'tambahan', 2, 90, '2020-05-29', 1, '2020-05-29 21:43:54', NULL),
(9, 11, 'in', 'tambahan', 2, 20, '2020-06-04', 1, '2020-06-03 19:53:35', NULL),
(10, 1, 'in', 'tambahan', 2, 10, '2020-06-05', 1, '2020-06-05 02:10:38', NULL);

--
-- Trigger `stock`
--
DELIMITER $$
CREATE TRIGGER `stock_in` AFTER INSERT ON `stock` FOR EACH ROW BEGIN
UPDATE items
SET stock = stock + NEW.qty
WHERE
item_id = NEW.item_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stock_in_del` AFTER DELETE ON `stock` FOR EACH ROW BEGIN
     UPDATE items SET stock = stock - OLD.qty
     WHERE item_id = OLD.item_id;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stockouts`
--

CREATE TABLE `stockouts` (
  `stockout_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('in','out') COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Trigger `stockouts`
--
DELIMITER $$
CREATE TRIGGER `stock_out` AFTER INSERT ON `stockouts` FOR EACH ROW BEGIN
UPDATE items
SET stock = stock - NEW.qty
WHERE
item_id = NEW.item_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stock_out_del` AFTER DELETE ON `stockouts` FOR EACH ROW BEGIN
     UPDATE items SET stock = stock + OLD.qty
     WHERE item_id = OLD.item_id;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `phone`, `address`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Toko As', '08773764', 'Jepara', 'sas', '2020-05-27 10:58:18', '2020-05-27 13:46:33'),
(2, 'Toko B', '0743748', 'Jepara', 'sasa', '2020-05-27 12:43:00', '2020-05-27 12:43:00'),
(3, 'Toko C', '0848374387437', 'Jepara', 'ksas', '2020-05-27 12:47:10', '2020-05-27 12:50:31'),
(5, 'Toko Atuk', '8384738', 'Jepara', 'sas', '2020-06-04 14:35:39', '2020-06-04 14:35:39'),
(6, 'Toko Keling', '085290042313', 'Jepara', 'Supplier Pakaian', '2020-06-05 01:04:33', '2020-06-05 01:04:33'),
(7, 'Tok sas', '084347837478', 'Jepara', 'sas', '2020-06-05 02:06:50', '2020-06-05 02:06:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `units`
--

CREATE TABLE `units` (
  `unit_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `units`
--

INSERT INTO `units` (`unit_id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Kilogram', '2020-05-27 16:14:21', '2020-05-27 16:14:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `address`, `email`, `level_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'feyto dewangga', 'feyto', 'Jepara', 'feyto81@gmail.com', 1, NULL, '$2y$10$C2vnwFxOSHbodU0pyu6IbesSBeGykJUqeyryxr.9w7GA2c3HL36Eu', NULL, '2020-05-27 07:31:17', '2020-06-05 02:15:04'),
(3, 'akbar', 'akbar', 'Jepara', NULL, 2, NULL, '$2y$10$E/NEoXTw.mupZT9JKsV9/OmWrECyfUdxSpr/p4n0y1SF/Y2RPyeNq', NULL, '2020-05-29 20:58:34', '2020-05-29 21:12:10'),
(4, 'yolla', 'yolla', 'Jepara', NULL, 3, NULL, '$2y$10$jyQ/5JhcFk467lnLu17F..iz9EZ6ky5qcb1jXZO3XXtWuDtMpUyzq', NULL, '2020-05-30 05:58:06', '2020-06-03 20:44:55'),
(5, 'admin', 'admin', 'jepara', NULL, 1, NULL, '$2y$10$NgE/sedmp4Bde.KRYmjOpuVKhyVG.Vmu2JXKmpthywYiWid5hZqDe', NULL, '2020-06-05 02:14:41', '2020-06-05 02:14:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `carts_item_id_foreign` (`item_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `items_category_id_foreign` (`category_id`),
  ADD KEY `items_unit_id_foreign` (`unit_id`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_activity_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemasukans`
--
ALTER TABLE `pemasukans`
  ADD PRIMARY KEY (`pemasukan_id`);

--
-- Indeks untuk tabel `pengeluarans`
--
ALTER TABLE `pengeluarans`
  ADD PRIMARY KEY (`pengeluaran_id`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `sale_details_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_details_item_id_foreign` (`item_id`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `stock_item_id_foreign` (`item_id`),
  ADD KEY `stock_supplier_id_foreign` (`supplier_id`),
  ADD KEY `stock_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `stockouts`
--
ALTER TABLE `stockouts`
  ADD PRIMARY KEY (`stockout_id`),
  ADD KEY `stockouts_item_id_foreign` (`item_id`),
  ADD KEY `stockouts_supplier_id_foreign` (`supplier_id`),
  ADD KEY `stockouts_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indeks untuk tabel `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_level_id_foreign` (`level_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `pemasukans`
--
ALTER TABLE `pemasukans`
  MODIFY `pemasukan_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengeluarans`
--
ALTER TABLE `pengeluarans`
  MODIFY `pengeluaran_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `detail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `stockouts`
--
ALTER TABLE `stockouts`
  MODIFY `stockout_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  ADD CONSTRAINT `log_activity_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stockouts`
--
ALTER TABLE `stockouts`
  ADD CONSTRAINT `stockouts_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stockouts_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stockouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
