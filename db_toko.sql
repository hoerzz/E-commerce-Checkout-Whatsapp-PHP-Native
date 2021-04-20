-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Apr 2021 pada 08.23
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_farm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `category`) VALUES
(1, 'Baju'),
(2, 'Celana'),
(3, 'Dompet'),
(4, 'Jam Tangan'),
(5, 'Topi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `penjual` varchar(250) NOT NULL,
  `nproduk` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `npembeli` varchar(250) NOT NULL,
  `no_pembeli` varchar(250) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `penjual`, `nproduk`, `jumlah`, `npembeli`, `no_pembeli`, `alamat`, `status`) VALUES
(1, 'Ryuzaki Shin', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '1', 'dd', 'chaerudin.dev@gmail.com', 'South Ogan Komering Ulu Regency\r\nSouth Ogan Komering Ulu Regency', 'Dalam Pengiriman'),
(2, 'Ryuzaki Shin', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '1', 'dd', 'chaerudin.dev@gmail.com', 'South Ogan Komering Ulu Regency\r\nSouth Ogan Komering Ulu Regency', 'Dalam Pengiriman'),
(3, 'Ryuzaki Shin', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '1', 'dd', 'chaerudin.dev@gmail.com', 'South Ogan Komering Ulu Regency\r\nSouth Ogan Komering Ulu Regency', 'Terkirim'),
(4, 'Ryuzaki Shin', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '5', 'Chaerudin', '6285886326980', 'JL Gang Mesjid Al-Akmal Kp-Raden', 'Terkirim'),
(5, 'Ryuzaki Shin', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '34444', 'dd', '33', 'JL Gang Mesjid Al-Akmal Kp-Raden\r\nJL Gang Mesjid Al-Akmal Kp-Raden', 'Proses'),
(6, 'Ryuzaki Shin', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '1', 'dd', '333', 'South Ogan Komering Ulu Regency', 'Proses'),
(7, 'Ryuzaki Shin', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '22002', 'Chaerudin', '0333', 'JL Gang Mesjid Al-Akmal Kp-Raden\r\nJL Gang Mesjid Al-Akmal Kp-Raden', 'Terkirim'),
(8, 'Ryuzaki Shin', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '34444', 'Chaerudin', '399393', 'JL Gang Mesjid Al-Akmal Kp-Raden\r\nJL Gang Mesjid Al-Akmal Kp-Raden', 'Proses'),
(9, 'Ryuzaki Shin', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '34444', 'Chaerudin', '33', 'South Ogan Komering Ulu Regency\r\nSouth Ogan Komering Ulu Regency', 'Dalam Pengiriman'),
(10, 'Ucup Pandeso', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '8', 'Ryuzaki', '6285886326980', 'Isekai', 'Proses'),
(11, '', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '8', 'Ryuzaki', '6285886326980', 'isekai', 'Proses'),
(12, '', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '4', 'Ryuzaki', '93213', 'isekai', 'Proses'),
(13, '', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', '2', 'Ryuzaki', '8333333', 'isekai', 'Proses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `product_id` int(11) NOT NULL,
  `penjual` varchar(500) NOT NULL,
  `notlp` varchar(50) NOT NULL,
  `namaproduk` varchar(100) NOT NULL,
  `harga` bigint(15) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `fldimage` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`product_id`, `penjual`, `notlp`, `namaproduk`, `harga`, `deskripsi`, `kategori`, `fldimage`) VALUES
(1, 'Nanang', '33333', 'VYATTA Fitme XP Smartwatch - Custom Watch Face, Full Touch, IPX7 - Emerald Blue', 300000, 'Kondisi: Baru\r\nBerat: 250 Gram\r\nKategori: Smart Watch\r\nEtalase: SMARTWATCH\r\n', 'baju', 'Apple-Watch-Series-6-1-1536x1234.jpg'),
(2, 'Ucup Pandeso', '6285886326980', 'Baju Iron Man', 5000000, 'IIII', 'Baju', '00318256.jpg'),
(3, 'Ayame Mizuki', '6285886326980', 'FILA Watches', 1920000, '- Jam tangan analog bernuansa all-black desain round dial\r\n- Warna hitam\r\n- Leather strap\r\n- Stainless steel dial\r\n- 3 hands movement\r\n- Detail numberless display\r\n- Adjustable pin buckle closure\r\n- Garansi internasional 1 tahun, hanya berlaku di service center resmi', 'Jam Tangan', 'fila-watches-4872-4655891-1.jpg'),
(4, 'Ayame Mizuki', '6285886326980', 'Topi fedora anyaman impor', 29000, 'Kondisi: Baru\r\nBerat: 220 Gram\r\nKategori: Topi Wanita\r\nEtalase: topi\r\ntopi fedora dewasa anyaman polos\r\nbahan jerami anyaman import\r\nReady warna:\r\n1. Putih /white\r\n2. Light brown /krem\r\n3. Black /hitam\r\n4. Brown/ coklat\r\n5. Karamel/ coklat muda\r\n6. Marun\r\n7. Navy\r\nukuran allsize dewasa\r\n**cantumkan keterangan warna dan alternatif warna lainnya ya...\r\nkalo tidak ada dikirim Random/warna mendekati!!!\r\nthanks', 'Topi', '716741_9fdee451-9e01-4488-aad5-73413ac0b033.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL COMMENT 'role_id',
  `role` varchar(255) DEFAULT NULL COMMENT 'role_text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0,
  `fld_address` varchar(500) NOT NULL,
  `fld_logo` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `email`, `password`, `mobile`, `roleid`, `isActive`, `fld_address`, `fld_logo`, `created_at`, `updated_at`) VALUES
(34, 'Ayame Mizuki', 'ryuzaki@gmail.com', '15c399baad566763d12d24c07d7a0cf176963703', '6285886326980', 1, 0, 'Isekai', 'Apple-Watch-Series-6-1-1536x1234.jpg', '2021-04-15 18:54:42', '2021-04-15 18:54:42'),
(57, 'Ucup Pandeso', 'ucup5@gmail.com', '193a4b262c60e1414f56f9e28e228fbdb2da3a5c', '6285886326980', 2, 0, 'isekai', '00318256.jpg', '2021-04-19 03:30:02', '2021-04-19 03:30:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeks untuk tabel `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'role_id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
