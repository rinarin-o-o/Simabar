-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 03:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simabar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `foto_admin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_admin`, `foto_admin`) VALUES
('ADM001', 'admindinkominfotikbbs@gmail.com', 'dinkominfotikbbs12345', 'Yoga', 'images/admin.png'),
('ADM002', 'admin', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang_rusak`
--

CREATE TABLE `barang_rusak` (
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `desk_kerusakan` text DEFAULT NULL,
  `tgl_kerusakan` date DEFAULT NULL,
  `ruang_sekarang` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_rusak`
--

INSERT INTO `barang_rusak` (`kode_barang`, `nama_barang`, `desk_kerusakan`, `tgl_kerusakan`, `ruang_sekarang`) VALUES
('1.3.2.05.003.001.101', 'Kursi Plastik', 'Pecah', '2024-09-01', 'Gudang'),
('1.3.2.05.003.004.021', 'Mesin deasel', 'sjgjgsja', '2024-09-06', 'Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `barcode_barang`
--

CREATE TABLE `barcode_barang` (
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `ruang_sekarang` varchar(100) DEFAULT NULL,
  `barcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `no_regristrasi` varchar(50) DEFAULT NULL,
  `kode_pemilik` varchar(50) DEFAULT NULL,
  `ruang_asal` varchar(100) DEFAULT NULL,
  `ruang_sekarang` varchar(100) DEFAULT NULL,
  `bid_ruang` varchar(50) DEFAULT NULL,
  `tempat_ruang` varchar(50) DEFAULT NULL,
  `tgl_pembelian` date DEFAULT NULL,
  `tgl_pembukuan` date DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `ukuran_CC` varchar(50) DEFAULT NULL,
  `no_pabrik` varchar(50) DEFAULT NULL,
  `no_rangka` varchar(50) DEFAULT NULL,
  `no_bpkb` varchar(50) DEFAULT NULL,
  `bahan` varchar(100) DEFAULT NULL,
  `no_mesin` varchar(50) DEFAULT NULL,
  `no_polisi` varchar(50) DEFAULT NULL,
  `kondisi_barang` varchar(50) DEFAULT NULL,
  `masa_manfaat` varchar(50) DEFAULT NULL,
  `harga_awal` decimal(15,2) DEFAULT NULL,
  `harga_total` decimal(15,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `foto_barang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`kode_barang`, `nama_barang`, `no_regristrasi`, `kode_pemilik`, `ruang_asal`, `ruang_sekarang`, `bid_ruang`, `tempat_ruang`, `tgl_pembelian`, `tgl_pembukuan`, `merk`, `type`, `kategori`, `ukuran_CC`, `no_pabrik`, `no_rangka`, `no_bpkb`, `bahan`, `no_mesin`, `no_polisi`, `kondisi_barang`, `masa_manfaat`, `harga_awal`, `harga_total`, `keterangan`, `foto_barang`) VALUES
('1.3.2.05.003.001.008', 'Meja Kerja Pegawai Non struktural', '1', '12', 'Ruang 14', 'Ruang 14', 'Bidang Komunikasi dan Kehumasan', 'Dinkominfotik Kab. Brebes', '1976-01-30', '1976-01-30', 'Meja Tulis', NULL, 'Peralatan', NULL, NULL, NULL, NULL, 'Kayu', NULL, NULL, 'Kurang Baik', '60 Bulan', 68750.00, 68750.00, NULL, 'images/1325318.jpeg'),
('1.3.2.05.003.001.101', 'kursi plastik', '15', '10', 'Dapur', 'Gudang', NULL, 'Dinkominfotik Kab. Brebes', '1976-01-30', '1976-01-30', NULL, NULL, 'Peralatan', NULL, NULL, NULL, NULL, 'Plastik', NULL, NULL, 'Rusak', NULL, 12000.00, 12000.00, 'kakkaj', NULL),
('1.3.2.05.003.004.015', 'Meja Rapat', '2', NULL, 'Ruang 14', 'Ruang 14', 'Bidang Komunikasi dan Kehumasan', 'Dinkominfotik Kab. Brebes', '2024-09-01', '2024-09-01', 'Meja', NULL, 'Peralatan', NULL, NULL, NULL, NULL, 'Besi', NULL, NULL, NULL, NULL, 70000.00, 70000.00, NULL, NULL),
('1.3.2.05.003.004.016', 'PC kantor', '5', NULL, 'Ruang Sekretariat', 'Ruang Sekretariat', 'Bidang Komunikasi dan Kehumasan', 'Dinkominfotik Kab. Brebes', '2024-05-14', '2024-06-18', 'Lenovo', NULL, 'Mesin dan Elektronik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5000000.00, 6000000.00, NULL, NULL),
('1.3.2.05.003.004.020', 'Sepeda Motor', '9', '12', 'Parkiran', 'Parkiran', NULL, 'Dinkominfotik Kab. Brebes', '2024-01-16', '2024-01-16', 'Honda Revo', NULL, 'kendaraan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19000000.00, 20000000.00, NULL, NULL),
('1.3.2.05.003.004.021', 'Mesin Deasel', '10', '12', 'Ruang 14', 'Ruang tamu', NULL, 'Dinkominfotik Kab. Brebes', '2020-09-09', '2020-09-09', NULL, NULL, 'Mesin dan Elektronik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rusak', '3 tahun', 3000000.00, 3000000.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_pemeliharaan`
--

CREATE TABLE `data_pemeliharaan` (
  `kode_barang` varchar(50) DEFAULT NULL,
  `desk_pemeliharaan` text DEFAULT NULL,
  `perbaikan` text DEFAULT NULL,
  `tgl_perbaikan` date DEFAULT NULL,
  `lama_perbaikan` varchar(50) DEFAULT NULL,
  `biaya_perbaikan` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pemeliharaan`
--

INSERT INTO `data_pemeliharaan` (`kode_barang`, `desk_pemeliharaan`, `perbaikan`, `tgl_perbaikan`, `lama_perbaikan`, `biaya_perbaikan`) VALUES
('1.3.2.05.003.004.016', 'Hardisk Rusalk', 'Pembelian Hardisk', '2024-07-09', '3 hari', 1000000.00),
('1.3.2.05.003.004.020', 'Servis', 'Pembelian Oli', '2024-05-13', '1 hari', 750000.00),
('1.3.2.05.003.004.020', 'servis kedua', 'pembelian dan penggantian kampas, knalpot', '2024-08-13', '2 hari', 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `inventaris_ruangan`
--

CREATE TABLE `inventaris_ruangan` (
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `no_pabrik` varchar(50) DEFAULT NULL,
  `ukuran_CC` varchar(50) DEFAULT NULL,
  `bahan` varchar(100) DEFAULT NULL,
  `tgl_pembelian` date DEFAULT NULL,
  `harga_awal` decimal(15,2) DEFAULT NULL,
  `kondisi_barang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventaris_ruangan`
--

INSERT INTO `inventaris_ruangan` (`kode_barang`, `nama_barang`, `merk`, `no_pabrik`, `ukuran_CC`, `bahan`, `tgl_pembelian`, `harga_awal`, `kondisi_barang`) VALUES
('1.3.2.05.003.001.008', 'Meja Kerja Pegawai Non Struktural', 'Meja Tulis', NULL, NULL, 'Kayu', '1976-01-30', 68750.00, 'Kurang Baik'),
('1.3.2.05.003.001.008', 'Meja Kerja Pegawai Non Struktural', 'Meja Tulis', NULL, NULL, 'Kayu', '1976-01-30', 68750.00, 'Kurang Baik'),
('1.3.2.05.003.001.008', 'Meja Kerja Pegawai Non Struktural', 'Meja Tulis', NULL, NULL, 'Kayu', '1976-01-30', 68750.00, 'Kurang Baik');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_fasum`
--

CREATE TABLE `jadwal_fasum` (
  `id_lokasi` varchar(50) DEFAULT NULL,
  `nama_lokasi` varchar(100) DEFAULT NULL,
  `bid_lokasi` varchar(50) DEFAULT NULL,
  `tempat_lokasi` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `tgl_penggunaan` date DEFAULT NULL,
  `waktu_penggunaan` time DEFAULT NULL,
  `acara` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_fasum`
--

INSERT INTO `jadwal_fasum` (`id_lokasi`, `nama_lokasi`, `bid_lokasi`, `tempat_lokasi`, `kategori`, `tgl_penggunaan`, `waktu_penggunaan`, `acara`) VALUES
('12.11.09.21.01.01.19', 'Parkiran', NULL, 'Dinkominfotik Kab. Brebes', 'Fasum', '2024-09-10', '09:00:00', NULL),
('12.11.09.21.01.01.19', 'Parkiran', NULL, 'Dinkominfotik Kab. Brebes', 'Fasum', '2024-09-10', '09:30:00', 'Tempat parkir pengunjung visitasi');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kendaraan`
--

CREATE TABLE `jadwal_kendaraan` (
  `kode_barang` varchar(50) DEFAULT NULL,
  `kategori_barang` varchar(100) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `id_supir` varchar(50) DEFAULT NULL,
  `tgl_penggunaan` date DEFAULT NULL,
  `waktu_penggunaan` time DEFAULT NULL,
  `pengguna` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_kendaraan`
--

INSERT INTO `jadwal_kendaraan` (`kode_barang`, `kategori_barang`, `nama_barang`, `id_supir`, `tgl_penggunaan`, `waktu_penggunaan`, `pengguna`) VALUES
('1.3.2.05.003.004.020', 'Kendaraan', 'Sepeda Motor Honda Revo', 'SPR001', '2024-09-09', '13:00:00', 'Berkunjung ke Radio FM');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_ruang`
--

CREATE TABLE `jadwal_ruang` (
  `id_lokasi` varchar(50) DEFAULT NULL,
  `nama_lokasi` varchar(100) DEFAULT NULL,
  `bid_lokasi` varchar(50) DEFAULT NULL,
  `tempat_lokasi` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `tgl_penggunaan` date DEFAULT NULL,
  `waktu_penggunaan` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` varchar(50) NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL,
  `bid_lokasi` varchar(50) DEFAULT NULL,
  `tempat_lokasi` varchar(100) DEFAULT NULL,
  `kategori_lokasi` varchar(50) DEFAULT NULL,
  `desk_lokasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `nama_lokasi`, `bid_lokasi`, `tempat_lokasi`, `kategori_lokasi`, `desk_lokasi`) VALUES
('12.11.09.21.01.01.01', 'Ruang Operasional', NULL, 'Dinkominfotik Kab. Brebes', 'ruangan', 'Ruang operasional digunakan untuk pertemuan internal, diskusi kebijakan, rapat, dan pertemuan dengan stakeholder eksternal, serta dilengkapi dengan perangkat teknologi untuk mendukung berbagai kegiatan.'),
('12.11.09.21.01.01.02', 'Ruang tamu', NULL, 'Dinkominfotik Kab. Brebes', 'ruangan', 'Digunakan untuk menyambut dan melayani tamu, menyediakan tempat yang nyaman untuk pertemuan, diskusi, atau penerimaan pengunjung.'),
('12.11.09.21.01.01.14', 'Ruang 14', 'Bidang Komunikasi dan Kehumasan', 'Dinkominfotik Kab. Brebes', 'ruangan', 'Ruang Bid Humas'),
('12.11.09.21.01.01.19', 'Parkiran', NULL, 'Dinkominfotik Kab. Brebes', 'fasilitas_umum', 'tempat parkir'),
('12.11.09.21.01.01.45', 'Gudang', NULL, 'Dinkominfotik Kab. Brebes', 'ruangan', 'Gudang Barang'),
('12.11.09.21.01.01.50', 'Dapur', NULL, 'Dinkominfotik Kab.Brebes', 'ruangan', 'dapur'),
('121332425.2424', 'Ruang Produksi', 'Humas', 'Dinkominfotik BBs', 'ruangan', 'jdjw'),
('121332425.2424.7919', 'Ruang sekretariat', 'gaxkjgkjag', 'Dinkominfotik BBs', 'ruangan', 'njkjj');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_barang`
--

CREATE TABLE `mutasi_barang` (
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `ruang_awal` varchar(100) DEFAULT NULL,
  `ruang_sekarang` varchar(100) DEFAULT NULL,
  `jenis_mutasi` varchar(100) DEFAULT NULL,
  `tgl_mutasi` date DEFAULT NULL,
  `PIC` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `Kode_pemilik` varchar(50) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`Kode_pemilik`, `nama_pemilik`) VALUES
('10', 'Dinkominfotik Kab. Brebes'),
('12', 'Pemerintah Kab/Kota');

-- --------------------------------------------------------

--
-- Table structure for table `supir`
--

CREATE TABLE `supir` (
  `id_supir` varchar(50) NOT NULL,
  `nama_supir` varchar(100) NOT NULL,
  `nama_kendaraan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supir`
--

INSERT INTO `supir` (`id_supir`, `nama_supir`, `nama_kendaraan`) VALUES
('SPR001', 'Supriyadi', 'Honda Revo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `barcode_barang`
--
ALTER TABLE `barcode_barang`
  ADD PRIMARY KEY (`barcode`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `kode_pemilik` (`kode_pemilik`);

--
-- Indexes for table `data_pemeliharaan`
--
ALTER TABLE `data_pemeliharaan`
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `inventaris_ruangan`
--
ALTER TABLE `inventaris_ruangan`
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `jadwal_fasum`
--
ALTER TABLE `jadwal_fasum`
  ADD KEY `id_lokasi` (`id_lokasi`);

--
-- Indexes for table `jadwal_kendaraan`
--
ALTER TABLE `jadwal_kendaraan`
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `id_supir` (`id_supir`);

--
-- Indexes for table `jadwal_ruang`
--
ALTER TABLE `jadwal_ruang`
  ADD KEY `id_lokasi` (`id_lokasi`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `mutasi_barang`
--
ALTER TABLE `mutasi_barang`
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`Kode_pemilik`);

--
-- Indexes for table `supir`
--
ALTER TABLE `supir`
  ADD PRIMARY KEY (`id_supir`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  ADD CONSTRAINT `barang_rusak_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `data_barang` (`kode_barang`);

--
-- Constraints for table `barcode_barang`
--
ALTER TABLE `barcode_barang`
  ADD CONSTRAINT `barcode_barang_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `data_barang` (`kode_barang`);

--
-- Constraints for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD CONSTRAINT `data_barang_ibfk_1` FOREIGN KEY (`kode_pemilik`) REFERENCES `pemilik` (`Kode_pemilik`);

--
-- Constraints for table `data_pemeliharaan`
--
ALTER TABLE `data_pemeliharaan`
  ADD CONSTRAINT `data_pemeliharaan_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `data_barang` (`kode_barang`);

--
-- Constraints for table `inventaris_ruangan`
--
ALTER TABLE `inventaris_ruangan`
  ADD CONSTRAINT `inventaris_ruangan_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `data_barang` (`kode_barang`);

--
-- Constraints for table `jadwal_fasum`
--
ALTER TABLE `jadwal_fasum`
  ADD CONSTRAINT `jadwal_fasum_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`);

--
-- Constraints for table `jadwal_kendaraan`
--
ALTER TABLE `jadwal_kendaraan`
  ADD CONSTRAINT `jadwal_kendaraan_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `data_barang` (`kode_barang`),
  ADD CONSTRAINT `jadwal_kendaraan_ibfk_2` FOREIGN KEY (`id_supir`) REFERENCES `supir` (`id_supir`);

--
-- Constraints for table `jadwal_ruang`
--
ALTER TABLE `jadwal_ruang`
  ADD CONSTRAINT `jadwal_ruang_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`);

--
-- Constraints for table `mutasi_barang`
--
ALTER TABLE `mutasi_barang`
  ADD CONSTRAINT `mutasi_barang_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `data_barang` (`kode_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
