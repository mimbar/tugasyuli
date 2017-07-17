/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : kredit

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2017-07-13 15:52:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(35) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(32) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for kriteria
-- ----------------------------
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of kriteria
-- ----------------------------
INSERT INTO `kriteria` VALUES ('1', 'Jenis Pekerjaan');
INSERT INTO `kriteria` VALUES ('2', 'Kemampuan Bayar');
INSERT INTO `kriteria` VALUES ('3', 'Kondisi Ekonomi');
INSERT INTO `kriteria` VALUES ('4', 'Umur');
INSERT INTO `kriteria` VALUES ('5', 'Karakter');

-- ----------------------------
-- Table structure for months
-- ----------------------------
DROP TABLE IF EXISTS `months`;
CREATE TABLE `months` (
  `months_id` int(11) NOT NULL AUTO_INCREMENT,
  `months` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`months_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of months
-- ----------------------------
INSERT INTO `months` VALUES ('1', 'Januari');
INSERT INTO `months` VALUES ('2', 'Februari');
INSERT INTO `months` VALUES ('3', 'Maret');
INSERT INTO `months` VALUES ('4', 'April');
INSERT INTO `months` VALUES ('5', 'Mei ');
INSERT INTO `months` VALUES ('6', 'Juni');
INSERT INTO `months` VALUES ('7', 'Juli');
INSERT INTO `months` VALUES ('8', 'Agustus');
INSERT INTO `months` VALUES ('9', 'September');
INSERT INTO `months` VALUES ('10', 'Oktober');
INSERT INTO `months` VALUES ('11', 'November');
INSERT INTO `months` VALUES ('12', 'Desember');

-- ----------------------------
-- Table structure for nilai_hasil
-- ----------------------------
DROP TABLE IF EXISTS `nilai_hasil`;
CREATE TABLE `nilai_hasil` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `nilai` double(11,4) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of nilai_hasil
-- ----------------------------

-- ----------------------------
-- Table structure for nilai_kriteria
-- ----------------------------
DROP TABLE IF EXISTS `nilai_kriteria`;
CREATE TABLE `nilai_kriteria` (
  `id_nilai_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria_1` int(11) NOT NULL,
  `id_kriteria_2` int(11) NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`id_nilai_kriteria`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of nilai_kriteria
-- ----------------------------
INSERT INTO `nilai_kriteria` VALUES ('1', '1', '2', '4');
INSERT INTO `nilai_kriteria` VALUES ('2', '1', '3', '4');
INSERT INTO `nilai_kriteria` VALUES ('3', '1', '4', '1');
INSERT INTO `nilai_kriteria` VALUES ('4', '1', '5', '5');
INSERT INTO `nilai_kriteria` VALUES ('5', '2', '3', '1');
INSERT INTO `nilai_kriteria` VALUES ('6', '2', '4', '1');
INSERT INTO `nilai_kriteria` VALUES ('7', '2', '5', '5');
INSERT INTO `nilai_kriteria` VALUES ('8', '3', '4', '1');
INSERT INTO `nilai_kriteria` VALUES ('9', '3', '5', '7');
INSERT INTO `nilai_kriteria` VALUES ('10', '4', '5', '5');

-- ----------------------------
-- Table structure for nilai_pemohon
-- ----------------------------
DROP TABLE IF EXISTS `nilai_pemohon`;
CREATE TABLE `nilai_pemohon` (
  `id_nilai_pemohon` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `id_pemohon_1` int(11) NOT NULL,
  `id_pemohon_2` int(11) NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`id_nilai_pemohon`)
) ENGINE=MyISAM AUTO_INCREMENT=286 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of nilai_pemohon
-- ----------------------------
INSERT INTO `nilai_pemohon` VALUES ('225', '5', '14', '15', '3');
INSERT INTO `nilai_pemohon` VALUES ('213', '4', '14', '15', '5');
INSERT INTO `nilai_pemohon` VALUES ('237', '3', '14', '15', '1');
INSERT INTO `nilai_pemohon` VALUES ('285', '0', '14', '15', '8');
INSERT INTO `nilai_pemohon` VALUES ('284', '0', '13', '15', '8');
INSERT INTO `nilai_pemohon` VALUES ('283', '0', '13', '14', '5');
INSERT INTO `nilai_pemohon` VALUES ('282', '0', '12', '15', '2');
INSERT INTO `nilai_pemohon` VALUES ('281', '0', '12', '14', '2');
INSERT INTO `nilai_pemohon` VALUES ('280', '0', '12', '13', '2');
INSERT INTO `nilai_pemohon` VALUES ('273', '2', '14', '15', '2');
INSERT INTO `nilai_pemohon` VALUES ('272', '2', '13', '15', '3');
INSERT INTO `nilai_pemohon` VALUES ('271', '2', '13', '14', '4');
INSERT INTO `nilai_pemohon` VALUES ('270', '2', '12', '15', '4');
INSERT INTO `nilai_pemohon` VALUES ('269', '2', '12', '14', '3');
INSERT INTO `nilai_pemohon` VALUES ('268', '2', '12', '13', '2');
INSERT INTO `nilai_pemohon` VALUES ('236', '3', '13', '15', '3');
INSERT INTO `nilai_pemohon` VALUES ('235', '3', '13', '14', '5');
INSERT INTO `nilai_pemohon` VALUES ('234', '3', '12', '15', '5');
INSERT INTO `nilai_pemohon` VALUES ('233', '3', '12', '14', '3');
INSERT INTO `nilai_pemohon` VALUES ('232', '3', '12', '13', '1');
INSERT INTO `nilai_pemohon` VALUES ('212', '4', '13', '15', '3');
INSERT INTO `nilai_pemohon` VALUES ('211', '4', '13', '14', '5');
INSERT INTO `nilai_pemohon` VALUES ('210', '4', '12', '15', '3');
INSERT INTO `nilai_pemohon` VALUES ('209', '4', '12', '14', '5');
INSERT INTO `nilai_pemohon` VALUES ('208', '4', '12', '13', '3');
INSERT INTO `nilai_pemohon` VALUES ('224', '5', '13', '15', '2');
INSERT INTO `nilai_pemohon` VALUES ('223', '5', '13', '14', '3');
INSERT INTO `nilai_pemohon` VALUES ('222', '5', '12', '15', '2');
INSERT INTO `nilai_pemohon` VALUES ('221', '5', '12', '14', '3');
INSERT INTO `nilai_pemohon` VALUES ('220', '5', '12', '13', '2');

-- ----------------------------
-- Table structure for pemohon
-- ----------------------------
DROP TABLE IF EXISTS `pemohon`;
CREATE TABLE `pemohon` (
  `id_pemohon` int(11) NOT NULL AUTO_INCREMENT,
  `no_ktp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `istri_suami` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `jlh_tanggungan` int(10) NOT NULL,
  `pekerjaan` varchar(30) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_pemohon`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of pemohon
-- ----------------------------
INSERT INTO `pemohon` VALUES ('13', '3279046107950003', 'liana', 'Rancabulus Rt01/03 Rejsari Langensari Banjar', 'lingga', '2', 'wiraswasta');
INSERT INTO `pemohon` VALUES ('12', '3279046107950002', 'Yeni', 'Rancabulus Rt01/03 Rejsari Langensari Banjar', 'adam', '3', 'PNS');
INSERT INTO `pemohon` VALUES ('14', '3279046107950004', 'andrea', 'Sindanggalih Rt03/05', 'Yani', '4', 'Buruh');
INSERT INTO `pemohon` VALUES ('15', '3279046107950001', 'yudistira', 'Sindanggalih Rt03/03', 'umi', '5', 'Petani');

-- ----------------------------
-- Table structure for tb_angsuran
-- ----------------------------
DROP TABLE IF EXISTS `tb_angsuran`;
CREATE TABLE `tb_angsuran` (
  `kode_angsuran` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pinjaman` int(11) NOT NULL,
  `angsuran` double NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `denda` int(255) DEFAULT NULL,
  `tgl_angsuran` date NOT NULL,
  PRIMARY KEY (`kode_angsuran`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_angsuran
-- ----------------------------
INSERT INTO `tb_angsuran` VALUES ('34', '13', '1180000', '0', null, '2018-07-13');
INSERT INTO `tb_angsuran` VALUES ('35', '13', '1180000', '0', null, '2017-08-08');
INSERT INTO `tb_angsuran` VALUES ('36', '13', '1180000', '0', null, '2017-09-09');
INSERT INTO `tb_angsuran` VALUES ('37', '13', '1180000', '0', null, '2017-10-13');
INSERT INTO `tb_angsuran` VALUES ('38', '13', '1180000', '0', null, '2017-11-13');
INSERT INTO `tb_angsuran` VALUES ('39', '13', '1180000', '0', null, '2017-12-13');
INSERT INTO `tb_angsuran` VALUES ('40', '14', '590000', '0', null, '2017-07-13');
INSERT INTO `tb_angsuran` VALUES ('41', '14', '590000', '0', null, '2017-07-13');
INSERT INTO `tb_angsuran` VALUES ('42', '14', '590000', '0', null, '2017-07-13');
INSERT INTO `tb_angsuran` VALUES ('43', '14', '590000', '0', null, '2017-07-13');

-- ----------------------------
-- Table structure for tb_pinjaman
-- ----------------------------
DROP TABLE IF EXISTS `tb_pinjaman`;
CREATE TABLE `tb_pinjaman` (
  `kode_pinjaman` int(11) NOT NULL AUTO_INCREMENT,
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
  `danabekucair` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`kode_pinjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_pinjaman
-- ----------------------------
INSERT INTO `tb_pinjaman` VALUES ('13', '12', '2017-07-13', '6000000', '18', '1080000', '7080000', '6', '1180000', '0', '0', '150000', '1');
INSERT INTO `tb_pinjaman` VALUES ('14', '13', '2017-07-13', '6000000', '18', '1080000', '7080000', '12', '590000', '0', '0', '150000', '0');

-- ----------------------------
-- View structure for v_tb_angsuran
-- ----------------------------
DROP VIEW IF EXISTS `v_tb_angsuran`;
CREATE VIEW `v_tb_angsuran` AS select `tb_angsuran`.`kode_angsuran` AS `kode_angsuran`,`pemohon`.`nama` AS `nama`,`tb_angsuran`.`tgl_angsuran` AS `tgl_angsuran`,`tb_pinjaman`.`kode_pinjaman` AS `kode_pinjaman`,`tb_pinjaman`.`id_pemohon` AS `id_pemohon`,`tb_pinjaman`.`tgl_pinjaman` AS `tgl_pinjaman`,`tb_pinjaman`.`besar_pinjaman` AS `besar_pinjaman`,`tb_pinjaman`.`bunga` AS `bunga`,`tb_pinjaman`.`nilai_bunga` AS `nilai_bunga`,`tb_pinjaman`.`total_pinjaman` AS `total_pinjaman`,`tb_pinjaman`.`lama_pinjaman` AS `lama_pinjaman`,`tb_pinjaman`.`pembayaran` AS `pembayaran`,`tb_pinjaman`.`sisa_cicilan` AS `sisa_cicilan`,`tb_pinjaman`.`danabeku` AS `danabeku`,`tb_pinjaman`.`danabekucair` AS `danabekucair`,`tb_angsuran`.`angsuran` AS `angsuran`,`tb_angsuran`.`denda` AS `denda` from ((`tb_angsuran` left join `tb_pinjaman` on((`tb_angsuran`.`kode_pinjaman` = `tb_pinjaman`.`kode_pinjaman`))) left join `pemohon` on((`tb_pinjaman`.`id_pemohon` = `pemohon`.`id_pemohon`))) ; ;

-- ----------------------------
-- View structure for v_tb_jumlahangsuran
-- ----------------------------
DROP VIEW IF EXISTS `v_tb_jumlahangsuran`;
CREATE VIEW `v_tb_jumlahangsuran` AS SELECT 
YEAR(tgl_angsuran) as tahun,
MONTH(tgl_angsuran) as bulan_id,
months.months as bulan,
sum(angsuran) as totalangsuran
FROM
tb_angsuran
LEFT JOIN months on (months.months_id = MONTH(tgl_angsuran) )
GROUP BY MONTH(tgl_angsuran), YEAR(tgl_angsuran) ;

-- ----------------------------
-- View structure for v_tb_pinjaman
-- ----------------------------
DROP VIEW IF EXISTS `v_tb_pinjaman`;
CREATE VIEW `v_tb_pinjaman` AS select `tb_pinjaman`.`kode_pinjaman` AS `kode_pinjaman`,`tb_pinjaman`.`id_pemohon` AS `id_pemohon`,`tb_pinjaman`.`tgl_pinjaman` AS `tgl_pinjaman`,`tb_pinjaman`.`besar_pinjaman` AS `besar_pinjaman`,`tb_pinjaman`.`bunga` AS `bunga`,`tb_pinjaman`.`total_pinjaman` AS `total_pinjaman`,`tb_pinjaman`.`lama_pinjaman` AS `lama_pinjaman`,`tb_pinjaman`.`angsuran` AS `angsuran`,`tb_pinjaman`.`pembayaran` AS `pembayaran`,`tb_pinjaman`.`sisa_cicilan` AS `sisa_cicilan`,`pemohon`.`no_ktp` AS `no_ktp`,`pemohon`.`nama` AS `nama`,`pemohon`.`alamat` AS `alamat`,`pemohon`.`istri_suami` AS `istri_suami`,`pemohon`.`jlh_tanggungan` AS `jlh_tanggungan`,`tb_pinjaman`.`nilai_bunga` AS `nilai_bunga`,`tb_pinjaman`.`danabeku` AS `danabeku`,`tb_pinjaman`.`danabekucair` AS `danabekucair` from (`tb_pinjaman` left join `pemohon` on((`tb_pinjaman`.`id_pemohon` = `pemohon`.`id_pemohon`))) ; ;
