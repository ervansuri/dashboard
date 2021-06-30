/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 8.0.21 : Database - formialt
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`formialt` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `formialt`;

/*Table structure for table `dpa` */

DROP TABLE IF EXISTS `dpa`;

CREATE TABLE `dpa` (
  `kd_dpa` int NOT NULL AUTO_INCREMENT,
  `program` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` double NOT NULL,
  `year` year NOT NULL,
  PRIMARY KEY (`kd_dpa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `dpa` */

insert  into `dpa`(`kd_dpa`,`program`,`jumlah`,`year`) values 
(1,'test',123,2021),
(2,'testing DPA',1000000,2021);

/*Table structure for table `identitas` */

DROP TABLE IF EXISTS `identitas`;

CREATE TABLE `identitas` (
  `kd_user` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `dif` enum('a','b','c','d','e','f') DEFAULT NULL,
  PRIMARY KEY (`kd_user`),
  CONSTRAINT `identitas_ibfk_1` FOREIGN KEY (`kd_user`) REFERENCES `user` (`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `identitas` */

/*Table structure for table `komponen` */

DROP TABLE IF EXISTS `komponen`;

CREATE TABLE `komponen` (
  `kd_komponen` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `spec` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  PRIMARY KEY (`kd_komponen`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `komponen` */

insert  into `komponen`(`kd_komponen`,`nama`,`spec`,`satuan`,`harga`) values 
(1,'Box File','Biru','buah',45000),
(2,'Cetak','Buku Panduan','buku',50000),
(3,'Cutter','L-500 Besar','buah',16000),
(4,'Hekter Besar','MAX HD 50','buah',70000),
(5,'Isi Staples Besar','No. 50 / Isi 20 dus besar','Pak',61000),
(6,'Isi Staples Kecil','No. 10','Dus',3000),
(7,'Kertas HVS','80 gram F4','Rim',60000),
(8,'Kertas HVS','80 gram A4','Rim',44780),
(9,'Staples','Ukuran No.10','Buah',25000),
(10,'Ballpoint','Pulpen Meja / Pen Stand Ball Pen PSBP-177','Buah',6000),
(11,'Map Plastik','Jaring pocket','Buah',10000),
(12,'Amplop','4/4 jaya','Dus',18000),
(13,'Binder Clip','No 200','Pak',145229),
(14,'Map Plastik','Folio','Buah',3000),
(15,'Pensil','2B','Buah',4000),
(16,'Map Plastik','Inter X Folder','Lembar',1500),
(17,'Map Sneilhecter','Folio','Buah',3000),
(18,'Fotocopy','F4','Lembar',250),
(19,'Cetak','Spanduk/Baliho/Banner/Backdrop','Meter',25000),
(20,'Cetak','Leaflet A4','Lembar',4600),
(21,'Cetak','X Banner 60x160','Pcs',172500),
(22,'Cetak','Sertifikat','Lembar',30000),
(23,'Materai','-','Buah',10000),
(24,'Reffil Toner','Refil Toner (Black / Mono) CE-278A78A - HP LJ P1156','Unit',100000),
(25,'PIN / Gantungan Kunci','-','Buah',7500),
(26,'Honorarium Jasa Moderator','-','Orang/Kegiatan',700000),
(27,'Honorarium Jasa Narasumber','Narasumber Non PNS (Pakar/Praktisi/Pembicara khusus) Maksimal 3 Jam','OJ',1700000),
(28,'Honorarium Harian/Kegiatan/Pertemuan Non PNS untuk Kegiatan Tertentu','Juri/Penguji','Orang/Kegiatan',2500000),
(29,'Publikasi Meida Cetak','Media Cetak','Kali',1500000),
(30,'Bensin','RON 90 (Petralite dan sejenisnya)','Liter',7800),
(31,'Uang Harian Perjalanan Dinas Dalam Daerah','-','Orang/Hari',430000),
(32,'Biaya Rapat/Pertemuan di Luar Kantor - Fullday','setingkat Eselon II ke bawah','Orang/Paket',350000),
(33,'Uang Harian Kegiatan Rapat/Pertemuan Di Luar Kantor','Fullboard di Dalam Kota/Kabupaten untuk Panitia','Orang/hari',150000),
(34,'Biaya Transportasi untuk Non PNS dan PNS non Provinsi Jawa Barat','Kegiatan penataran / pelatihan / seminar / kursus / diseminasi / sosialisasi / rapat kerja / kegiatan sejenisnya di Lingkungan Pemerintah Daerah Provinsi Jawa Barat','OH',300000),
(35,'Biaya Rapat/Pertemuan di Luar Kantor - Fullboard','setingkat Eselon II ke bawah','Orang/Paket',450000),
(36,'Belanja Hibah Uang','-','Kegiatan',1);

/*Table structure for table `komponen_ring` */

DROP TABLE IF EXISTS `komponen_ring`;

CREATE TABLE `komponen_ring` (
  `kd_kr` int NOT NULL AUTO_INCREMENT,
  `kd_komponen` int NOT NULL,
  `kd_ring` varchar(17) NOT NULL,
  PRIMARY KEY (`kd_komponen`,`kd_ring`,`kd_kr`),
  KEY `kd_ring` (`kd_ring`),
  KEY `kd_kr` (`kd_kr`),
  CONSTRAINT `komponen_ring_ibfk_1` FOREIGN KEY (`kd_komponen`) REFERENCES `komponen` (`kd_komponen`),
  CONSTRAINT `komponen_ring_ibfk_2` FOREIGN KEY (`kd_ring`) REFERENCES `ring` (`kd_ring`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `komponen_ring` */

insert  into `komponen_ring`(`kd_kr`,`kd_komponen`,`kd_ring`) values 
(1,1,'01.01.01'),
(2,2,'01.01.01'),
(3,3,'01.01.02'),
(4,4,'01.01.02'),
(5,5,'01.02.01'),
(6,6,'02.02.01'),
(7,7,'02.02.01'),
(8,8,'02.02.02'),
(9,9,'02.02.02'),
(12,10,'02.02.03'),
(13,11,'02.02.03'),
(14,12,'02.02.04'),
(15,13,'02.02.04'),
(16,14,'02.02.05'),
(17,15,'02.02.05'),
(18,16,'02.01.01'),
(19,17,'02.01.01'),
(21,18,'02.01.02'),
(22,19,'02.01.02'),
(23,20,'02.01.03'),
(24,21,'02.01.03'),
(25,22,'02.01.04'),
(26,23,'02.01.04'),
(27,24,'02.01.05'),
(28,25,'02.01.05'),
(29,26,'02.02.06'),
(30,27,'02.02.06'),
(31,28,'02.02.07'),
(32,29,'02.02.07'),
(33,30,'02.02.08'),
(34,31,'02.02.08'),
(35,32,'02.03.01'),
(36,33,'02.03.01'),
(37,34,'02.03.02'),
(38,35,'02.03.02'),
(39,36,'02.03.03'),
(42,35,'02.03.03'),
(43,34,'02.03.04'),
(44,33,'02.03.04');

/*Table structure for table `perusahaan` */

DROP TABLE IF EXISTS `perusahaan`;

CREATE TABLE `perusahaan` (
  `kd_perusahaan` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tlp` varchar(25) NOT NULL,
  `fax` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `npwp` int NOT NULL,
  `ktp` int NOT NULL,
  PRIMARY KEY (`kd_perusahaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perusahaan` */

/*Table structure for table `ring` */

DROP TABLE IF EXISTS `ring`;

CREATE TABLE `ring` (
  `kd_ring` varchar(17) NOT NULL,
  `p_ring` varchar(17) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`kd_ring`),
  KEY `kd_ring` (`kd_ring`),
  KEY `p_ring` (`p_ring`),
  CONSTRAINT `ring_ibfk_1` FOREIGN KEY (`p_ring`) REFERENCES `ring` (`kd_ring`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ring` */

insert  into `ring`(`kd_ring`,`p_ring`,`nama`) values 
('01',NULL,'Belanja Gaji dan Tunjangan'),
('01.01','01','Belanja Gaji dan Tunjangan Pegawai'),
('01.01.01','01.01','Belanja Gaji Pegawai'),
('01.01.02','01.01','Belanja Tunjangan Pegawai'),
('01.02','01','Belanja Gaji dan Tunjangan Pengurus'),
('01.02.01','01.02','Belanja Tunjangan Jabatan'),
('01.02.02','01.02','Belanja Tunjangan Transportasi'),
('02',NULL,'Belanja Operasional Kegiatan'),
('02.01','02','Belanja Operasional Kantor/Sekretariat'),
('02.01.01','02.01','Belanja Alat Tulis Kantor'),
('02.01.02','02.01','Belanja Langganan Layanan Kantor'),
('02.01.03','02.01','Belanja Pajak/Retribusi'),
('02.01.04','02.01','Belanja Perawatan Aset/Peralatan'),
('02.01.05','02.01','Belanja Sewa Sekretariatan/Kantor'),
('02.02','02','Belanja Penyelenggaraan Kegiatan'),
('02.02.01','02.02','Belanja Akomodasi'),
('02.02.02','02.02','Belanja Sewa Ruang/Gedung/Lapangan'),
('02.02.03','02.02','Belanja Sewa Perlengkapan Acara/Kegiatan'),
('02.02.04','02.02','Belanja Honor Perangkat Kegiatan'),
('02.02.05','02.02','Belanja Pakaian/Seagam'),
('02.02.06','02.02','Belanja Makan Minum Rapat/Kegiatan'),
('02.02.07','02.02','Belanja Pengganti Transportasi'),
('02.02.08','02.02','Belanja Peralatan/Alat Kesehatan'),
('02.02.09','02.02','Belanja Publikasi dan Dokumentasi'),
('02.02.10','02.02','Belanja Perlengkapan Olahraga'),
('02.02.11','02.02','Belanja Cetak'),
('02.02.12','02.02','Belanja Jasa Penulisan/Desain Grafis/Konten Medsos'),
('02.02.13','02.02','Belanja Plakat/Piala dan Cenderamata'),
('02.02.14','02.02','Belanja Jasa Pengisi dan Pengarah Acara (EO)'),
('02.02.15','02.02','Belanja Jasa Penelitian/Pengembangan'),
('02.02.16','02.02','Belanja Jasa Pembuatan Aplikasi'),
('02.03','02','Belanja Perjalanan Dinas'),
('02.03.01','02.03','Belanja Perjalanan Dinas Dalam Kota'),
('02.03.02','02.03','Belanja Perjalanan Dinas Dalam Daerah/Provinsi'),
('02.03.03','02.03','Belanja Perjalanan Dinas Luar Provinsi'),
('02.03.04','02.03','Belanja Perjalanan Dinas Luar Negeri'),
('03',NULL,'Belanja Hadiah dan Bantuan Operasional'),
('03.01','03','Belanja Hadiah'),
('03.01.01','03.01','Belanja Hadiah Even TK Kabupaten/Kota'),
('03.01.02','03.01','Belanja Hadiah Even Tingkat Provinsi'),
('03.01.03','03.01','Belanja Hadiah Even Tingkat Nasional'),
('03.02','03','Belanja Bantuan Operasional'),
('03.02.01','03.02','Belanja Bantuan Operasional Rutin'),
('03.02.02','03.02','Belanja Bantuan Operasional Insidensial'),
('04',NULL,'Belanja Modal'),
('04.01','04','Belanja Modal Perlengkapan Kantor'),
('04.01.01','04.01','Belanja Modal Mebeulair'),
('04.01.02','04.01','Belanja Modal Penyediaan Sistem Informasi'),
('04.01.03','04.01','Belanja Modal Perlengkapan Kantor Lainnya'),
('04.02','04','Belanja Modal Operasional Kegiatan'),
('04.02.01','04.02','Belanja Modal Perlengkapan Kegiatan'),
('04.02.02','04.02','Belanja Modal Kendaraan Operasional');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `kd_user` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(12) DEFAULT NULL,
  `password` varchar(12) DEFAULT NULL,
  `jns_user` int DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

/*Table structure for table `wk` */

DROP TABLE IF EXISTS `wk`;

CREATE TABLE `wk` (
  `kd_wk` int NOT NULL AUTO_INCREMENT,
  `kd_dpa` int NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `s_uraian` varchar(255) DEFAULT NULL,
  `kd_komponen` int NOT NULL,
  `qty` int NOT NULL,
  `kegiatan` int NOT NULL,
  PRIMARY KEY (`kd_wk`),
  KEY `kd_dpa` (`kd_dpa`),
  KEY `kd_komponen` (`kd_komponen`),
  CONSTRAINT `wk_ibfk_2` FOREIGN KEY (`kd_komponen`) REFERENCES `komponen` (`kd_komponen`),
  CONSTRAINT `wk_ibfk_3` FOREIGN KEY (`kd_dpa`) REFERENCES `dpa` (`kd_dpa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `wk` */

/* Function  structure for function  `fRupiah` */

/*!50003 DROP FUNCTION IF EXISTS `fRupiah` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `fRupiah`(number BIGINT) RETURNS varchar(255) CHARSET latin1
    DETERMINISTIC
BEGIN  
DECLARE hasil VARCHAR(255);  
SET hasil = REPLACE(REPLACE(REPLACE(FORMAT(number, 0), '.', '|'), ',', '.'), '|', ',');  
RETURN (hasil);  
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
