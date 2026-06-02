-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Bulan Mei 2026 pada 13.43
-- Versi server: 8.0.30
-- Versi PHP: 8.5.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('sdit-labitech-insan-mulia-cache-setting.group.about', 'a:10:{s:19:\"about_description_1\";s:256:\"Labschool UNJ (Laboratory School Universitas Negeri Jakarta) adalah institusi pendidikan yang berdiri di bawah naungan Universitas Negeri Jakarta. Kami berkomitmen untuk menjadi pusat pembelajaran yang menggabungkan teori pendidikan dengan praktik terbaik.\";s:19:\"about_description_2\";s:190:\"Dengan visi menjadi sekolah pilihan yang menghasilkan lulusan berkarakter, berprestasi, dan berkompetensi global, kami terus berinovasi dalam mengembangkan kurikulum dan metode pembelajaran.\";s:19:\"about_description_3\";s:170:\"Labschool memiliki beberapa cabang di berbagai lokasi di Jakarta dan sekitarnya untuk menjangkau lebih banyak peserta didik yang ingin mendapatkan pendidikan berkualitas.\";s:12:\"about_vision\";s:101:\"Menjadi sekolah pilihan yang menghasilkan lulusan berkarakter, berprestasi, dan berkompetensi global.\";s:13:\"about_mission\";s:136:\"Menyelenggarakan pendidikan berkualitas dengan metode pembelajaran inovatif dan membentuk generasi yang berdisiplin dan bermoral tinggi.\";s:12:\"about_values\";s:109:\"Integritas, Keunggulan, Inovasi, Kerjasama, dan Pengabdian untuk menciptakan lingkungan belajar yang positif.\";s:19:\"about_stat_branches\";s:1:\"5\";s:19:\"about_stat_teachers\";s:4:\"150+\";s:19:\"about_stat_students\";s:5:\"2000+\";s:16:\"about_stat_years\";s:3:\"25+\";}', 2088402786),
('sdit-labitech-insan-mulia-cache-setting.group.contact', 'a:0:{}', 2088402786),
('sdit-labitech-insan-mulia-cache-setting.group.homepage', 'a:0:{}', 2088402786);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '0001_01_01_000000_create_users_table', 1),
(6, '0001_01_01_000001_create_cache_table', 1),
(7, '0001_01_01_000002_create_jobs_table', 1),
(8, '2026_02_20_000000_create_news_table', 1),
(9, '2026_02_21_000000_create_students_table', 2),
(10, '2026_03_01_000000_create_transfer_students_table', 3),
(11, '2026_03_01_000001_create_students_master_table', 4),
(12, '2026_03_02_000000_add_graduation_fields_to_students_table', 5),
(13, '2026_03_05_000001_create_site_settings_table', 6),
(14, '2026_03_05_000002_create_contact_messages_table', 7),
(15, '2026_03_05_000001_create_branches_table', 8),
(16, '2026_03_09_074642_add_updated_by_to_students_table', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `content`, `excerpt`, `featured_image`, `category`, `author`, `is_published`, `published_at`, `created_at`, `updated_at`) VALUES
(7, 'Kenangan Indah Siswa Kelas 6 SDIT Labitech Insan Mulia dalam Wisuda 2026', 'kenangan-indah-siswa-kelas-6-sdit-labitech-insan-mulia-dalam-wisuda-2026', 'Siswa kelas 6 SDIT Labitech Insan Mulia mengakhiri masa sekolah dasar mereka dengan penuh kesan mendalam melalui acara wisuda yang meriah. Kegiatan ini menjadi momen kebersamaan terakhir mereka bersama teman-teman dan guru di SDIT Labitech Insan Mulia. Antusiasme para siswa terlihat dari berbagai aktivitas seru yang mereka ikuti bersama.', 'Siswa kelas 6 SDIT Labitech Insan Mulia mengakhiri masa sekolah dasar mereka dengan penuh kesan...', 'news/wisuda-2026.jpg', 'Berita Sekolah', 'Admin Labitech', 1, '2026-02-22 02:18:13', '2026-03-08 02:16:29', '2026-03-08 02:18:13'),
(8, 'Menyambut Ramadan, SDIT Labitech Insan Mulia Gelar Tarhib Ramadan 1447 H', 'menyambut-ramadan-sdit-labitech-insan-mulia-gelar-tarhib-ramadan-1447-h', 'Dalam rangka menyiapkan diri untuk menyambut bulan Ramadan, SDIT Labitech Insan Mulia menyelenggarakan acara Tarhib Ramadan atau persiapan menyambut Ramadan. Acara ini melibatkan seluruh siswa dan guru untuk memahami nilai-nilai spiritual dan moral dalam bulan Ramadan.', 'Dalam rangka menyiapkan diri untuk menyambut bulan Ramadan, SDIT Labitech Insan Mulia...', 'news/tarhib-ramadan.jpg', 'Acara', 'Admin Labitech', 1, '2026-03-01 02:18:13', '2026-03-08 02:16:30', '2026-03-08 02:18:13'),
(9, 'Antusiasme Tinggi Calon Siswa Baru Ikuti PPDB SDIT Labitech Insan Mulia 2026', 'antusiasme-tinggi-calon-siswa-baru-ikuti-ppdb-sdit-labitech-insan-mulia-2026', 'Ratusan calon siswa baru mengikuti proses Penerimaan Peserta Didik Baru (PPDB) SDIT Labitech Insan Mulia tahun 2026. Tingginya minat calon siswa menunjukkan kepercayaan masyarakat terhadap kualitas pendidikan yang diberikan oleh SDIT Labitech Insan Mulia.', 'Ratusan calon siswa baru mengikuti proses Penerimaan Peserta Didik Baru (PPDB)...', 'news/ppdb-2026.jpg', 'Pendaftaran', 'Admin Labitech', 1, '2026-02-25 02:18:13', '2026-03-08 02:16:30', '2026-03-08 02:18:13'),
(10, 'Siswa SDIT Labitech Insan Mulia Raih Juara Lomba Tahfidz Quran Se-Kota Bekasi', 'siswa-sdit-labitech-insan-mulia-raih-juara-lomba-tahfidz-quran-se-kota-bekasi', 'Siswa-siswi SDIT Labitech Insan Mulia berhasil meraih juara dalam lomba Tahfidz Quran tingkat Kota Bekasi. Prestasi ini menunjukkan komitmen sekolah dalam membina generasi Qurani yang berprestasi dan berakhlak mulia.', 'Siswa-siswi SDIT Labitech Insan Mulia berhasil meraih juara dalam lomba Tahfidz Quran...', 'news/tahfidz-quran.jpg', 'Prestasi', 'Admin Labitech', 1, '2026-02-23 02:18:13', '2026-03-08 02:16:30', '2026-03-08 02:18:13'),
(11, 'Kegiatan Pramuka SDIT Labitech Insan Mulia Gelar Perkemahan Karakter', 'kegiatan-pramuka-sdit-labitech-insan-mulia-gelar-perkemahan-karakter', 'Sebagai bagian dari pengembangan karakter dan kepemimpinan, SDIT Labitech Insan Mulia menggelar kegiatan Perkemahan Karakter. Kegiatan ini melibatkan siswa kelas 4 hingga kelas 6 untuk belajar tentang kepemimpinan, kerja sama tim, kemandirian, dan kedisiplinan.', 'Sebagai bagian dari pengembangan karakter dan kepemimpinan, SDIT Labitech Insan Mulia...', 'news/pramuka.jpg', 'Acara', 'Admin Labitech', 1, '2026-03-04 02:18:13', '2026-03-08 02:16:30', '2026-03-08 02:18:13'),
(12, 'SDIT Labitech Insan Mulia Gelar Doa Bersama untuk Kelas 6 Jelang Ujian', 'sdit-labitech-insan-mulia-gelar-doa-bersama-untuk-kelas-6-jelang-ujian', 'SDIT Labitech Insan Mulia mengadakan kegiatan doa bersama untuk siswa kelas 6 dalam mempersiapkan ujian akhir. Kegiatan ini menunjukkan komitmen sekolah dalam memberikan dukungan moral dan spiritual kepada siswa.', 'SDIT Labitech Insan Mulia mengadakan kegiatan doa bersama untuk siswa kelas 6...', 'news/doa-bersama.jpg', 'Berita Sekolah', 'Admin Labitech', 1, '2026-02-20 02:18:13', '2026-03-08 02:16:30', '2026-03-08 02:18:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jxU0j5PbWX8U1nihPjkO6SEsS5PAgktXP0V9N5mI', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTHFZanVNY1Z2S1lna29IQkVJd2R2SWRsWkhvSkRBYzRocjdZVTNkdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1778154278),
('pVv2AZcO5dLwdeCsTISJ3Z6yOdmSZ3r5loIeL25r', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmFLVVRiM29OVXhsaHdJNVZlQXljVmtQblRzVVByVkp6aWlZb2VFQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778506972),
('wJDIAU5GYqQ2k3FghZiq2TAJUGZH2qS4cTGkot2o', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTltTFJIMWdnYnJEYlIzR0RzS21IM3RpRWlRN25MWjYwc1FiNGU0SCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778153352);

-- --------------------------------------------------------

--
-- Struktur dari tabel `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `site_settings`
--

INSERT INTO `site_settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
(1, 'about_description_1', 'Labschool UNJ (Laboratory School Universitas Negeri Jakarta) adalah institusi pendidikan yang berdiri di bawah naungan Universitas Negeri Jakarta. Kami berkomitmen untuk menjadi pusat pembelajaran yang menggabungkan teori pendidikan dengan praktik terbaik.', 'about', '2026-03-05 04:53:48', '2026-03-05 04:53:48'),
(2, 'about_description_2', 'Dengan visi menjadi sekolah pilihan yang menghasilkan lulusan berkarakter, berprestasi, dan berkompetensi global, kami terus berinovasi dalam mengembangkan kurikulum dan metode pembelajaran.', 'about', '2026-03-05 04:53:48', '2026-03-05 04:53:48'),
(3, 'about_description_3', 'Labschool memiliki beberapa cabang di berbagai lokasi di Jakarta dan sekitarnya untuk menjangkau lebih banyak peserta didik yang ingin mendapatkan pendidikan berkualitas.', 'about', '2026-03-05 04:53:48', '2026-03-05 04:53:48'),
(4, 'about_vision', 'Menjadi sekolah pilihan yang menghasilkan lulusan berkarakter, berprestasi, dan berkompetensi global.', 'about', '2026-03-05 04:53:48', '2026-03-05 04:53:48'),
(5, 'about_mission', 'Menyelenggarakan pendidikan berkualitas dengan metode pembelajaran inovatif dan membentuk generasi yang berdisiplin dan bermoral tinggi.', 'about', '2026-03-05 04:53:48', '2026-03-05 04:53:48'),
(6, 'about_values', 'Integritas, Keunggulan, Inovasi, Kerjasama, dan Pengabdian untuk menciptakan lingkungan belajar yang positif.', 'about', '2026-03-05 04:53:48', '2026-03-05 04:53:48'),
(7, 'about_stat_branches', '5', 'about', '2026-03-05 04:53:48', '2026-03-05 04:53:48'),
(8, 'about_stat_teachers', '150+', 'about', '2026-03-05 04:53:48', '2026-03-05 04:53:48'),
(9, 'about_stat_students', '2000+', 'about', '2026-03-05 04:53:49', '2026-03-05 04:53:49'),
(10, 'about_stat_years', '25+', 'about', '2026-03-05 04:53:49', '2026-03-05 04:53:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id_siswa` bigint UNSIGNED NOT NULL,
  `nisn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warga_negara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Indonesia',
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_awal` int DEFAULT NULL,
  `tahun_masuk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sekolah_asal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa.png',
  `anak_ke` int DEFAULT NULL,
  `status_keluarga` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` longtext COLLATE utf8mb4_unicode_ci,
  `rt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rw` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` int DEFAULT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir_ayah` date DEFAULT NULL,
  `pendidikan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nohp_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_ayah` longtext COLLATE utf8mb4_unicode_ci,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir_ibu` date DEFAULT NULL,
  `pendidikan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nohp_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_ibu` longtext COLLATE utf8mb4_unicode_ci,
  `nama_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir_wali` date DEFAULT NULL,
  `pendidikan_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nohp_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_wali` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','contacted','verified','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `nilai_akhir` decimal(5,2) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id_siswa`, `nisn`, `nis`, `nama`, `jenis_kelamin`, `nik`, `warga_negara`, `registration_number`, `username`, `password`, `uid`, `kelas_awal`, `tahun_masuk`, `sekolah_asal`, `tempat_lahir`, `tanggal_lahir`, `agama`, `hp`, `email`, `foto`, `anak_ke`, `status_keluarga`, `alamat`, `rt`, `rw`, `kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `nama_ayah`, `tgl_lahir_ayah`, `pendidikan_ayah`, `pekerjaan_ayah`, `nohp_ayah`, `alamat_ayah`, `nama_ibu`, `tgl_lahir_ibu`, `pendidikan_ibu`, `pekerjaan_ibu`, `nohp_ibu`, `alamat_ibu`, `nama_wali`, `tgl_lahir_wali`, `pendidikan_wali`, `pekerjaan_wali`, `nohp_wali`, `alamat_wali`, `status`, `admin_note`, `nilai_akhir`, `keterangan`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, NULL, 'PPDB-2026-001', 'Aufa Dzaky Zuhdi Wicaksono', 'L', NULL, 'Indonesia', 'REG-2026-001', 'aufadzakyzuhdiwicaksono1', '$2y$12$SMTdmLPUdHqwvRilYntAb.GSO5o.NTGAlP777Oz66aZMismMt0wfO', 'STD-C9QN9PEA', NULL, NULL, 'TK', 'Bekai', '2008-02-01', NULL, '08131651', NULL, 'siswa.png', NULL, NULL, 'Jl. Rawa Jaya No.37 8, RT.8/RW.4, Pd. Klp., Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13460', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Orang', NULL, NULL, NULL, '08131651', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, '2026-03-01 07:23:25', '2026-03-01 07:23:25', NULL, NULL),
(4, '1234567890', 'NIS-2026-001', 'Ahmad Fauzi', 'L', NULL, 'Indonesia', 'REG-2026-100', 'ahmadfauzi', '$2y$12$xW6R3UdfeAGT2F77Jmm7LOFoc.jmxCD7kx1irc9FrJtUfHbG6fxte', 'STD-AHMAD001', 1, '2021', NULL, 'Bekasi', '2015-05-10', 'Islam', '081234567890', 'ahmad@siswa.labitech.sch.id', 'siswa.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Budi Fauzi', NULL, NULL, NULL, '081298765432', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, '2026-03-01 07:40:06', '2026-03-05 04:05:40', NULL, NULL),
(5, '0987654321', 'NIS-2026-002', 'Siti Nurhaliza', 'P', NULL, 'Indonesia', 'REG-2026-101', 'sitinurhaliza', '$2y$12$9og3XlYIC1T0ga7a8xJKnuQw/womMUtzUwH8Dxs1Q455kZ7tAeQIC', 'STD-SITI0002', 1, '2021', NULL, 'Jakarta', '2015-08-22', 'Islam', '081345678901', 'siti@siswa.labitech.sch.id', 'siswa.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dewi Sartika', NULL, NULL, NULL, '081356789012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'contacted', NULL, NULL, NULL, '2026-03-01 07:40:06', '2026-03-05 04:05:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transfer_students`
--

CREATE TABLE `transfer_students` (
  `id` bigint UNSIGNED NOT NULL,
  `transfer_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `previous_school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_transfer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_short` text COLLATE utf8mb4_unicode_ci,
  `report_card_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_letter_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','contacted','verified','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-02-20 04:31:59', '$2y$12$fvOkLC24QGgl/Pt24cnE6e8kTISPfylwLAf9N6JDc565MdbcspPZS', 'KucZhEP0oH', '2026-02-20 04:32:00', '2026-02-20 04:32:00'),
(3, 'labschool', 'admin@labschool-unj.sch.id', NULL, '$2y$12$W0flMZ42LiZW1z8/XU/PCO/134kcSQqWDIA4iF1Z5XT/rOtepQO3G', NULL, '2026-03-01 02:01:03', '2026-03-01 07:37:14'),
(4, 'kepalasekolah', 'kepsek@labschool-unj.sch.id', NULL, '$2y$12$CAPP6Sdrusk53OObifw/NO0P/8JFDkcJsw6aUGOBJ5OKI4bzvlABO', NULL, '2026-03-01 02:01:03', '2026-03-01 07:37:14'),
(5, 'tatausaha', 'tu@labschool-unj.sch.id', NULL, '$2y$12$hK3oKy/kYQnjzPoShXCmu.0.m6/S78W6N9yojfoCb6Jn7Dyacp0Fm', NULL, '2026-03-01 02:01:03', '2026-03-01 07:37:14'),
(6, 'labitech', 'admin@labitech.sch.id', NULL, '$2y$12$5pCjaSAtBDMuVbmoX2woR.1qqwhN7NhdAV/YMWoTL0IOLAf.QUhWG', NULL, '2026-03-08 00:57:45', '2026-03-08 00:57:45'),
(7, 'kepalasekolah', 'kepsek@labitech.sch.id', NULL, '$2y$12$wb4vcfgVGyp7fYWyIyheiermL9v0shigxE/Q2IvqqtKQIwIpdeeRa', NULL, '2026-03-08 00:57:46', '2026-03-08 00:57:46'),
(8, 'tatausaha', 'tu@labitech.sch.id', NULL, '$2y$12$BjKD.ncjhywc/aZ6U7GL7egTSeDVzDpmZ8Cv9Fl/pC5u32kK3RFAi', NULL, '2026-03-08 00:57:46', '2026-03-08 00:57:46');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_slug_unique` (`slug`),
  ADD KEY `news_slug_index` (`slug`),
  ADD KEY `news_category_index` (`category`),
  ADD KEY `news_published_at_index` (`published_at`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_settings_key_unique` (`key`),
  ADD KEY `site_settings_group_index` (`group`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `students_nis_unique` (`nis`),
  ADD UNIQUE KEY `students_username_unique` (`username`),
  ADD UNIQUE KEY `students_uid_unique` (`uid`),
  ADD UNIQUE KEY `students_nisn_unique` (`nisn`),
  ADD UNIQUE KEY `students_registration_number_unique` (`registration_number`),
  ADD KEY `students_nisn_index` (`nisn`),
  ADD KEY `students_nis_index` (`nis`),
  ADD KEY `students_nama_index` (`nama`),
  ADD KEY `students_tahun_masuk_index` (`tahun_masuk`);

--
-- Indeks untuk tabel `transfer_students`
--
ALTER TABLE `transfer_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transfer_students_transfer_number_unique` (`transfer_number`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id_siswa` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transfer_students`
--
ALTER TABLE `transfer_students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
