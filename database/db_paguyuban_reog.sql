-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Bulan Mei 2021 pada 09.29
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
  `nama_jasa` int(11) NOT NULL,
  `deskripsi_jasa` text NOT NULL,
  `foto_jasa` varchar(255) NOT NULL,
  `harga_jasa` int(11) NOT NULL,
  `jasa_created` int(11) NOT NULL,
  `jasa_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `paguyuban_created` int(11) NOT NULL,
  `paguyuban_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_reservasi`
--

CREATE TABLE `tb_reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `id_paguyuban` int(11) NOT NULL,
  `tanggal_reservasi` date NOT NULL,
  `deskripsi_reservasi` text NOT NULL,
  `status_reservasi` int(1) NOT NULL,
  `reservasi_created` int(11) NOT NULL,
  `reservasi_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `user_created` int(11) NOT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `id_paguyuban` (`id_paguyuban`);

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
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_paguyuban`
--
ALTER TABLE `tb_paguyuban`
  MODIFY `id_paguyuban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_token`
--
ALTER TABLE `tb_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `tb_reservasi_ibfk_2` FOREIGN KEY (`id_paguyuban`) REFERENCES `tb_paguyuban` (`id_paguyuban`) ON DELETE CASCADE ON UPDATE CASCADE;

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
