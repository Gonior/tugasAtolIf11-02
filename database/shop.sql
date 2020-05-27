-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Bulan Mei 2020 pada 12.35
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--
CREATE DATABASE IF NOT EXISTS `shop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shop`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id_order`, `id_pelanggan`, `tanggal_order`, `status`) VALUES
(3, 1, '2019-03-28 17:00:00', 'pending'),
(4, 1, '2019-03-28 17:00:00', 'pending'),
(5, 1, '2019-03-28 17:00:00', 'pending'),
(6, 1, '2019-03-28 22:16:18', 'pending'),
(7, 1, '2019-03-28 22:17:58', 'pending'),
(8, 1, '2019-03-28 22:20:36', 'pending'),
(9, 0, '2019-04-01 23:02:42', 'pending'),
(10, 1, '2019-04-01 23:03:22', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int(255) NOT NULL,
  `jumlah_produk` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_detail`
--

INSERT INTO `order_detail` (`id_order`, `nama_produk`, `harga_produk`, `jumlah_produk`) VALUES
(3, 'Kaos Tonari no Totoro', 120000, 1),
(4, 'Kaos Tonari no Totoro', 120000, 1),
(5, 'Kaos Tonari no Totoro', 150000, 1),
(6, 'Tas totoro', 167000, 1),
(7, 'Tas punggung', 150000, 1),
(8, 'Tas totoro', 167000, 1),
(9, 'Tas punggung', 150000, 1),
(10, 'Kaos Tonari no Totoro', 150000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `gambar_produk` varchar(100) NOT NULL,
  `harga_produk` int(255) NOT NULL,
  `deskripsi_produk` varchar(255) NOT NULL,
  `pemilik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `gambar_produk`, `harga_produk`, `deskripsi_produk`, `pemilik`) VALUES
(1, 'Tas punggung', '1.jpg', 150000, 'Dengan desain yang modern dan minimalis', 'arthemuss14'),
(3, 'Tas totoro', 'totoro.jpg', 167000, 'lorem ipsum some text here...', 'arthemuss14'),
(7, 'Kaos Tonari no Totoro', '21147_3c7cdd27-83b4-4b2c-b4cd-a906148da57d.jpg', 120000, 'something text...', 'arthemuss14'),
(8, 'Kaos Tonari no Totoro', 'TTR05 Totoro Sugar Bus-438x438.jpg', 150000, 'some text...', 'naniyagn14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kode_pos` int(255) NOT NULL,
  `provinsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama_depan`, `nama_belakang`, `username`, `password`, `alamat`, `kode_pos`, `provinsi`) VALUES
(1, 'dedi', 'cahya', 'arthemuss14', '$2y$10$37K8M0ldi0KSNWPTd2jwK.79ramM9Dnf8gIQbZb.2fRs0T8P9kXH.', 'jl raya ciumbuleuit atas no 12', 41201, 'jawa barat'),
(2, 'dedi', 'fitri', 'naniyagn14', '$2y$10$Mutiemr66HUnVMNgeCKoD.Xyk8j6WtiltMk2LKZCz.qur28Fb6odi', 'asjdansjdnalsndlaks', 41251, 'jawa barat');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
