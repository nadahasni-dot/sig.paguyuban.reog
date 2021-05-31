-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Bulan Mei 2021 pada 09.50
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_paguyuban_reog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jasa`
--

CREATE TABLE `tb_jasa` (
  `id_jasa` int(11) NOT NULL,
  `id_paguyuban` int(11) NOT NULL,
  `nama_jasa` varchar(255) NOT NULL,
  `deskripsi_jasa` text NOT NULL,
  `foto_jasa` varchar(255) NOT NULL,
  `harga_jasa` int(11) NOT NULL,
  `jasa_created` int(11) NOT NULL,
  `jasa_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jasa`
--

INSERT INTO `tb_jasa` (`id_jasa`, `id_paguyuban`, `nama_jasa`, `deskripsi_jasa`, `foto_jasa`, `harga_jasa`, `jasa_created`, `jasa_updated`) VALUES
(8, 7, 'Pertunjukan Reog (REGULAR)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi velit, culpa possimus eveniet fuga vero quos quia aspernatur facere optio ea, soluta vitae consequuntur quidem illo accusamus ut nostrum vel.', 'bbb2607cfca77f6c98bb44cfa67dbf96.jpg', 250000, 1622443809, 1622445533),
(9, 8, 'Reog Panas Matahari', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi tempore omnis dolorem incidunt totam, fugiat recusandae illo error cumque enim. Ratione, consequuntur. Nostrum quis eius, provident eveniet veniam expedita repudiandae.', '8b233e6087d498397cc6ba2b0a49cd4e.jpg', 300000, 1622445035, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_paguyuban`
--

CREATE TABLE `tb_paguyuban` (
  `id_paguyuban` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_paguyuban` varchar(255) NOT NULL,
  `deskripsi_paguyuban` text NOT NULL,
  `alamat_paguyuban` varchar(255) NOT NULL,
  `telepon_paguyuban` varchar(16) NOT NULL,
  `foto_paguyuban` varchar(255) NOT NULL,
  `lat_paguyuban` double NOT NULL,
  `lng_paguyuban` double NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `pemilik_rekening` varchar(255) NOT NULL,
  `paguyuban_created` int(11) NOT NULL,
  `paguyuban_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_paguyuban`
--

INSERT INTO `tb_paguyuban` (`id_paguyuban`, `id_user`, `nama_paguyuban`, `deskripsi_paguyuban`, `alamat_paguyuban`, `telepon_paguyuban`, `foto_paguyuban`, `lat_paguyuban`, `lng_paguyuban`, `no_rekening`, `pemilik_rekening`, `paguyuban_created`, `paguyuban_updated`) VALUES
(7, 4, 'Sanggar Seni Reog Ponorogo Sardulo Argo Saguno', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi velit, culpa possimus eveniet fuga vero quos quia aspernatur facere optio ea, soluta vitae consequuntur quidem illo accusamus ut nostrum vel.', 'Jl jalan boy', '0895387228138', 'ad244570d0882a098bd9072bdfe59aa7.jpg', -8.1579093598359, 113.71430307626726, '777222138821', 'Hasyim (BNI)', 1622443726, 1622445521),
(8, 6, 'Reog Matahari', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus voluptates facilis eveniet totam autem nam omnis beatae ducimus accusantium veniam inventore repellat, ullam libero at officiis dolores quaerat, eaque quis.', 'Jl diponegoro VII', '0895387228138', '8e7feb2e47020ab65bbc5bc9dd207ca7.jpg', -8.173329691598852, 113.69760364294055, '666123772182', 'HERi (BCA)', 1622444712, 1622445565);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_reservasi`
--

CREATE TABLE `tb_reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `id_paguyuban` int(11) NOT NULL,
  `tanggal_reservasi` date NOT NULL,
  `deskripsi_reservasi` text NOT NULL,
  `status_reservasi` int(1) NOT NULL,
  `reservasi_created` int(11) NOT NULL,
  `reservasi_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_reservasi`
--

INSERT INTO `tb_reservasi` (`id_reservasi`, `id_user`, `id_jasa`, `id_paguyuban`, `tanggal_reservasi`, `deskripsi_reservasi`, `status_reservasi`, `reservasi_created`, `reservasi_updated`) VALUES
(9, 3, 8, 7, '2021-06-01', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi velit, culpa possimus eveniet fuga vero quos quia aspernatur facere optio ea, soluta vitae consequuntur quidem illo accusamus ut nostrum vel.', 1, 1622443907, 1622443975),
(10, 3, 9, 8, '2021-06-01', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi tempore omnis dolorem incidunt totam, fugiat recusandae illo error cumque enim. Ratione, consequuntur. Nostrum quis eius, provident eveniet veniam expedita repudiandae.', 1, 1622445121, 1622445222);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_token`
--

CREATE TABLE `tb_token` (
  `id_token` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token_created` int(11) NOT NULL,
  `token_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_reservasi` int(11) NOT NULL,
  `bukti_transaksi` varchar(255) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `nominal_transaksi` int(11) NOT NULL,
  `status_transaksi` int(1) NOT NULL,
  `transaksi_created` int(11) NOT NULL,
  `transaksi_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_reservasi`, `bukti_transaksi`, `tanggal_transaksi`, `nominal_transaksi`, `status_transaksi`, `transaksi_created`, `transaksi_updated`) VALUES
(7, 9, 'be3ddba392729056a3adeb3b4593dd94.jpg', '2021-05-31', 250000, 1, 1622444267, 1622447365);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `telepon_user` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `foto_user` varchar(255) NOT NULL,
  `status_user` int(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `telepon_user`, `email`, `role`, `foto_user`, `status_user`, `password`, `user_created`, `user_updated`) VALUES
(2, 'Admin Satu', '085735678159', 'NADASTHING@GMAIL.COM', 1, '249e51582e5b99ef4f3442913506554c.jpg', 1, '$2y$10$le6QX73fx7cdx0lfmCySAeWRugLM5G9OEoauNk8vSKcMQ14m/wmkC', 1621941297, 1622201107),
(3, 'Umum 1', '081234567890', 'umum1@gmail.com', 3, 'user-no-image.jpg', 1, '$2y$10$tUL95YQqpYLUwLa1N2mheeHXeik9WapnZHJlDeKSvImXjk9A.nTlW', 1621943558, 1621944186),
(4, 'Paguyuban 1', '089765432123', 'PAGUYUBAN@GMAIL.COM', 2, '72c819736923f2c190e38823bcde8860.jpg', 1, '$2y$10$PgeI4RTyp4xeQRi2KIuYau87M3q8J4kYf8d2cfP16Wc4bqKod8bES', 1621943628, 1622205346),
(6, 'Paguyuban 2', '081234567890', 'PAGUYUBAN2@GMAIL.COM', 2, '0a21ccf4458d7b638c5f17742f673232.jpg', 1, '$2y$10$nq2i6CGm5P2pY/oYplKRhOiShxx2ObTR1fcUr5Pgk8A4w2J6t5Wdm', 1622203301, 1622205505);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jasa`
--
ALTER TABLE `tb_jasa`
  ADD PRIMARY KEY (`id_jasa`),
  ADD KEY `id_paguyuban` (`id_paguyuban`);

--
-- Indeks untuk tabel `tb_paguyuban`
--
ALTER TABLE `tb_paguyuban`
  ADD PRIMARY KEY (`id_paguyuban`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `id_jasa` (`id_jasa`),
  ADD KEY `id_paguyuban` (`id_paguyuban`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`id_token`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_reservasi` (`id_reservasi`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jasa`
--
ALTER TABLE `tb_jasa`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_paguyuban`
--
ALTER TABLE `tb_paguyuban`
  MODIFY `id_paguyuban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_token`
--
ALTER TABLE `tb_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_jasa`
--
ALTER TABLE `tb_jasa`
  ADD CONSTRAINT `tb_jasa_ibfk_1` FOREIGN KEY (`id_paguyuban`) REFERENCES `tb_paguyuban` (`id_paguyuban`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_paguyuban`
--
ALTER TABLE `tb_paguyuban`
  ADD CONSTRAINT `tb_paguyuban_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  ADD CONSTRAINT `tb_reservasi_ibfk_1` FOREIGN KEY (`id_jasa`) REFERENCES `tb_jasa` (`id_jasa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_reservasi_ibfk_2` FOREIGN KEY (`id_paguyuban`) REFERENCES `tb_paguyuban` (`id_paguyuban`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_reservasi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_token`
--
ALTER TABLE `tb_token`
  ADD CONSTRAINT `tb_token_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_reservasi`) REFERENCES `tb_reservasi` (`id_reservasi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
