-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Apr 2017 pada 15.23
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yuli`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(35) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(32) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`) VALUES
(1, 'Jenis Pekerjaan'),
(2, 'Kemampuan Bayar'),
(3, 'Kondisi Ekonomi'),
(4, 'Umur'),
(5, 'Karakter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_hasil`
--

CREATE TABLE `nilai_hasil` (
  `id_nilai` int(11) NOT NULL,
  `nilai` double(11,4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_nilai_kriteria` int(11) NOT NULL,
  `id_kriteria_1` int(11) NOT NULL,
  `id_kriteria_2` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_nilai_kriteria`, `id_kriteria_1`, `id_kriteria_2`, `nilai`) VALUES
(1, 1, 2, 4),
(2, 1, 3, 4),
(3, 1, 4, 1),
(4, 1, 5, 5),
(5, 2, 3, 1),
(6, 2, 4, 1),
(7, 2, 5, 5),
(8, 3, 4, 1),
(9, 3, 5, 7),
(10, 4, 5, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_pemohon`
--

CREATE TABLE `nilai_pemohon` (
  `id_nilai_pemohon` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_pemohon_1` int(11) NOT NULL,
  `id_pemohon_2` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `nilai_pemohon`
--

INSERT INTO `nilai_pemohon` (`id_nilai_pemohon`, `id_kriteria`, `id_pemohon_1`, `id_pemohon_2`, `nilai`) VALUES
(225, 5, 14, 15, 3),
(213, 4, 14, 15, 5),
(237, 3, 14, 15, 1),
(279, 0, 14, 15, 1),
(278, 0, 13, 15, 1),
(277, 0, 13, 14, 1),
(276, 0, 12, 15, 1),
(275, 0, 12, 14, 1),
(274, 0, 12, 13, 1),
(273, 2, 14, 15, 2),
(272, 2, 13, 15, 3),
(271, 2, 13, 14, 4),
(270, 2, 12, 15, 4),
(269, 2, 12, 14, 3),
(268, 2, 12, 13, 2),
(236, 3, 13, 15, 3),
(235, 3, 13, 14, 5),
(234, 3, 12, 15, 5),
(233, 3, 12, 14, 3),
(232, 3, 12, 13, 1),
(212, 4, 13, 15, 3),
(211, 4, 13, 14, 5),
(210, 4, 12, 15, 3),
(209, 4, 12, 14, 5),
(208, 4, 12, 13, 3),
(224, 5, 13, 15, 2),
(223, 5, 13, 14, 3),
(222, 5, 12, 15, 2),
(221, 5, 12, 14, 3),
(220, 5, 12, 13, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemohon`
--

CREATE TABLE `pemohon` (
  `id_pemohon` int(11) NOT NULL,
  `no_ktp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `istri_suami` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `jlh_tanggungan` int(10) NOT NULL,
  `pekerjaan` varchar(30) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `pemohon`
--

INSERT INTO `pemohon` (`id_pemohon`, `no_ktp`, `nama`, `alamat`, `istri_suami`, `jlh_tanggungan`, `pekerjaan`) VALUES
(13, '3279046107950003', 'liana', 'Rancabulus Rt01/03 Rejsari Langensari Banjar', 'lingga', 2, 'wiraswasta'),
(12, '3279046107950002', 'Yeni', 'Rancabulus Rt01/03 Rejsari Langensari Banjar', 'adam', 3, 'PNS'),
(14, '3279046107950004', 'andrea', 'Sindanggalih Rt03/05', 'Yani', 4, 'Buruh'),
(15, '3279046107950001', 'yudistira', 'Sindanggalih Rt03/03', 'umi', 5, 'Petani');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_angsuran`
--

CREATE TABLE `tb_angsuran` (
  `kode_angsuran` int(11) NOT NULL,
  `kode_pinjaman` int(11) NOT NULL,
  `angsuran` double NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `denda` int(255) DEFAULT NULL,
  `tgl_angsuran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_angsuran`
--

INSERT INTO `tb_angsuran` (`kode_angsuran`, `kode_pinjaman`, `angsuran`, `angsuran_ke`, `denda`, `tgl_angsuran`) VALUES
(1, 2, 100000, 0, NULL, '0000-00-00'),
(2, 2, 250000, 0, NULL, '0000-00-00'),
(3, 2, 200000, 0, NULL, '0000-00-00'),
(4, 2, 0, 0, NULL, '2017-03-21'),
(5, 3, 983.333, 0, NULL, '2017-03-21'),
(6, 3, 983.333, 0, NULL, '2017-03-21'),
(7, 3, 983.333, 0, NULL, '2017-03-21'),
(8, 3, 983.333, 0, NULL, '2017-03-21'),
(9, 3, 983.333, 0, NULL, '2017-03-21'),
(10, 3, 983.333, 0, NULL, '2017-03-21'),
(11, 3, 983.333, 0, NULL, '2017-03-21'),
(12, 2, 0, 0, NULL, '2017-03-21'),
(13, 2, 0, 0, NULL, '2017-03-21'),
(14, 2, 0, 0, NULL, '2017-03-21'),
(15, 2, 0, 0, NULL, '2017-03-21'),
(16, 2, 0, 0, NULL, '2017-03-21'),
(17, 2, 0, 0, NULL, '2017-03-21'),
(18, 6, 1.18, 0, NULL, '2017-03-23'),
(19, 6, 1180000, 0, NULL, '2017-03-23'),
(20, 6, 1180000, 0, NULL, '2017-03-26'),
(21, 6, 1180000, 0, NULL, '2017-03-26'),
(22, 8, 983333.33333333, 0, NULL, '2017-03-26'),
(23, 9, 196700, 0, NULL, '2017-04-07'),
(24, 9, 196700, 0, NULL, '2017-04-07'),
(25, 9, 196700, 0, NULL, '2017-04-07'),
(26, 9, 196700, 0, NULL, '2017-04-07'),
(27, 9, 196700, 0, NULL, '2017-04-07'),
(28, 9, 196700, 0, NULL, '2017-04-07'),
(29, 8, 983333.33333333, 0, NULL, '2017-04-07'),
(30, 8, 983333.33333333, 0, NULL, '2017-04-07'),
(31, 8, 983333.33333333, 0, NULL, '2017-04-07'),
(32, 8, 983333.33333333, 0, NULL, '2017-04-07'),
(33, 8, 983333.33333333, 0, NULL, '2017-04-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pinjaman`
--

CREATE TABLE `tb_pinjaman` (
  `kode_pinjaman` int(11) NOT NULL,
  `id_pemohon` int(11) NOT NULL,
  `tgl_pinjaman` date NOT NULL,
  `besar_pinjaman` double NOT NULL,
  `bunga` float NOT NULL,
  `nilai_bunga` bigint(255) DEFAULT NULL,
  `total_pinjaman` double NOT NULL,
  `lama_pinjaman` int(11) NOT NULL,
  `angsuran` double NOT NULL,
  `pembayaran` double NOT NULL,
  `sisa_cicilan` double NOT NULL,
  `danabeku` bigint(255) DEFAULT NULL,
  `danabekucair` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pinjaman`
--

INSERT INTO `tb_pinjaman` (`kode_pinjaman`, `id_pemohon`, `tgl_pinjaman`, `besar_pinjaman`, `bunga`, `nilai_bunga`, `total_pinjaman`, `lama_pinjaman`, `angsuran`, `pembayaran`, `sisa_cicilan`, `danabeku`, `danabekucair`) VALUES
(10, 12, '2017-04-07', 1000000, 18, 180000, 1180000, 6, 196700, 0, 0, 25000, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tb_angsuran`
--
CREATE TABLE `v_tb_angsuran` (
`kode_angsuran` int(11)
,`nama` varchar(30)
,`tgl_angsuran` date
,`kode_pinjaman` int(11)
,`id_pemohon` int(11)
,`tgl_pinjaman` date
,`besar_pinjaman` double
,`bunga` float
,`nilai_bunga` bigint(255)
,`total_pinjaman` double
,`lama_pinjaman` int(11)
,`pembayaran` double
,`sisa_cicilan` double
,`danabeku` bigint(255)
,`danabekucair` tinyint(1)
,`angsuran` double
,`denda` int(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tb_pinjaman`
--
CREATE TABLE `v_tb_pinjaman` (
`kode_pinjaman` int(11)
,`id_pemohon` int(11)
,`tgl_pinjaman` date
,`besar_pinjaman` double
,`bunga` float
,`total_pinjaman` double
,`lama_pinjaman` int(11)
,`angsuran` double
,`pembayaran` double
,`sisa_cicilan` double
,`no_ktp` varchar(20)
,`nama` varchar(30)
,`alamat` varchar(50)
,`istri_suami` varchar(30)
,`jlh_tanggungan` int(10)
,`nilai_bunga` bigint(255)
,`danabeku` bigint(255)
,`danabekucair` tinyint(1)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_tb_angsuran`
--
DROP TABLE IF EXISTS `v_tb_angsuran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tb_angsuran`  AS  select `tb_angsuran`.`kode_angsuran` AS `kode_angsuran`,`pemohon`.`nama` AS `nama`,`tb_angsuran`.`tgl_angsuran` AS `tgl_angsuran`,`tb_pinjaman`.`kode_pinjaman` AS `kode_pinjaman`,`tb_pinjaman`.`id_pemohon` AS `id_pemohon`,`tb_pinjaman`.`tgl_pinjaman` AS `tgl_pinjaman`,`tb_pinjaman`.`besar_pinjaman` AS `besar_pinjaman`,`tb_pinjaman`.`bunga` AS `bunga`,`tb_pinjaman`.`nilai_bunga` AS `nilai_bunga`,`tb_pinjaman`.`total_pinjaman` AS `total_pinjaman`,`tb_pinjaman`.`lama_pinjaman` AS `lama_pinjaman`,`tb_pinjaman`.`pembayaran` AS `pembayaran`,`tb_pinjaman`.`sisa_cicilan` AS `sisa_cicilan`,`tb_pinjaman`.`danabeku` AS `danabeku`,`tb_pinjaman`.`danabekucair` AS `danabekucair`,`tb_angsuran`.`angsuran` AS `angsuran`,`tb_angsuran`.`denda` AS `denda` from ((`tb_angsuran` left join `tb_pinjaman` on((`tb_angsuran`.`kode_pinjaman` = `tb_pinjaman`.`kode_pinjaman`))) left join `pemohon` on((`tb_pinjaman`.`id_pemohon` = `pemohon`.`id_pemohon`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_tb_pinjaman`
--
DROP TABLE IF EXISTS `v_tb_pinjaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tb_pinjaman`  AS  select `tb_pinjaman`.`kode_pinjaman` AS `kode_pinjaman`,`tb_pinjaman`.`id_pemohon` AS `id_pemohon`,`tb_pinjaman`.`tgl_pinjaman` AS `tgl_pinjaman`,`tb_pinjaman`.`besar_pinjaman` AS `besar_pinjaman`,`tb_pinjaman`.`bunga` AS `bunga`,`tb_pinjaman`.`total_pinjaman` AS `total_pinjaman`,`tb_pinjaman`.`lama_pinjaman` AS `lama_pinjaman`,`tb_pinjaman`.`angsuran` AS `angsuran`,`tb_pinjaman`.`pembayaran` AS `pembayaran`,`tb_pinjaman`.`sisa_cicilan` AS `sisa_cicilan`,`pemohon`.`no_ktp` AS `no_ktp`,`pemohon`.`nama` AS `nama`,`pemohon`.`alamat` AS `alamat`,`pemohon`.`istri_suami` AS `istri_suami`,`pemohon`.`jlh_tanggungan` AS `jlh_tanggungan`,`tb_pinjaman`.`nilai_bunga` AS `nilai_bunga`,`tb_pinjaman`.`danabeku` AS `danabeku`,`tb_pinjaman`.`danabekucair` AS `danabekucair` from (`tb_pinjaman` left join `pemohon` on((`tb_pinjaman`.`id_pemohon` = `pemohon`.`id_pemohon`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai_hasil`
--
ALTER TABLE `nilai_hasil`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id_nilai_kriteria`);

--
-- Indexes for table `nilai_pemohon`
--
ALTER TABLE `nilai_pemohon`
  ADD PRIMARY KEY (`id_nilai_pemohon`);

--
-- Indexes for table `pemohon`
--
ALTER TABLE `pemohon`
  ADD PRIMARY KEY (`id_pemohon`);

--
-- Indexes for table `tb_angsuran`
--
ALTER TABLE `tb_angsuran`
  ADD PRIMARY KEY (`kode_angsuran`);

--
-- Indexes for table `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  ADD PRIMARY KEY (`kode_pinjaman`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `nilai_hasil`
--
ALTER TABLE `nilai_hasil`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilai_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `nilai_pemohon`
--
ALTER TABLE `nilai_pemohon`
  MODIFY `id_nilai_pemohon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;
--
-- AUTO_INCREMENT for table `pemohon`
--
ALTER TABLE `pemohon`
  MODIFY `id_pemohon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_angsuran`
--
ALTER TABLE `tb_angsuran`
  MODIFY `kode_angsuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  MODIFY `kode_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
