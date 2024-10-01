-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 09:22 AM
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
-- Database: `db_simabar_baru`
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
('ADM001', 'admindinkominfotikbbs@gmail.com', 'dinkominfotikbbs12345', 'Yoga', 'admin.png'),
('ADM002', 'admin', 'admin', 'admin', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `barang_rusak`
--

CREATE TABLE `barang_rusak` (
  `id_barang_rusak` varchar(50) NOT NULL,
  `id_barang_pemda` varchar(50) NOT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `desk_kerusakan` text DEFAULT NULL,
  `tgl_kerusakan` date DEFAULT NULL,
  `nama_ruang_sekarang` varchar(50) DEFAULT NULL,
  `bidang_ruang_sekarang` varchar(50) DEFAULT NULL,
  `tempat_ruang_sekarang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_rusak`
--

INSERT INTO `barang_rusak` (`id_barang_rusak`, `id_barang_pemda`, `kode_barang`, `nama_barang`, `desk_kerusakan`, `tgl_kerusakan`, `nama_ruang_sekarang`, `bidang_ruang_sekarang`, `tempat_ruang_sekarang`) VALUES
('RSK000001', 'PMD0000006', '1.3.2.05.003.004.006', 'Mesin Deasel', 'Rusak, tidak bisa beroperasi', '2024-09-01', 'Gudang', NULL, 'Dinkominfotik Kab. Brebes');

-- --------------------------------------------------------

--
-- Table structure for table `barcode_barang`
--

CREATE TABLE `barcode_barang` (
  `id_barcode` int(11) NOT NULL,
  `id_barang_pemda` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `ruang_sekarang` varchar(100) DEFAULT NULL,
  `barcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `id_barang_pemda` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `no_regristrasi` varchar(50) DEFAULT NULL,
  `kode_pemilik` varchar(50) DEFAULT NULL,
  `id_ruang_asal` varchar(100) DEFAULT NULL,
  `nama_ruang_asal` varchar(100) DEFAULT NULL,
  `bidang_ruang_asal` varchar(100) DEFAULT NULL,
  `tempat_ruang_asal` varchar(100) DEFAULT NULL,
  `id_ruang_sekarang` varchar(100) DEFAULT NULL,
  `bidang_ruang_sekarang` varchar(100) DEFAULT NULL,
  `tempat_ruang_sekarang` varchar(100) DEFAULT NULL,
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
  `foto_barang` varchar(255) DEFAULT NULL,
  `nama_ruang_sekarang` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`id_barang_pemda`, `kode_barang`, `nama_barang`, `no_regristrasi`, `kode_pemilik`, `id_ruang_asal`, `nama_ruang_asal`, `bidang_ruang_asal`, `tempat_ruang_asal`, `id_ruang_sekarang`, `bidang_ruang_sekarang`, `tempat_ruang_sekarang`, `tgl_pembelian`, `tgl_pembukuan`, `merk`, `type`, `kategori`, `ukuran_CC`, `no_pabrik`, `no_rangka`, `no_bpkb`, `bahan`, `no_mesin`, `no_polisi`, `kondisi_barang`, `masa_manfaat`, `harga_awal`, `harga_total`, `keterangan`, `foto_barang`, `nama_ruang_sekarang`) VALUES
('PMD0000001', '1.3.2.05.003.001.001', 'Meja Kerja Pegawai Non struktural', '1', '12', '12.11.09.21.01.01.03', 'Ruang 14', 'Bidang Komunikasi dan Kehumasan', 'Dinkominfotik Kab. Brebes', '12.11.09.21.01.01.03', 'Bidang Komunikasi dan Kehumasan', 'Dinkominfotik Kab. Brebes', '1976-01-30', '1976-01-30', 'Meja Tulis', NULL, 'Peralatan', NULL, NULL, NULL, NULL, 'Kayu', NULL, NULL, 'Kurang Baik', '60 Bulan', 70000.00, 70000.00, NULL, '1325318.jpeg', 'Ruang 14'),
('PMD0000002', '1.3.2.05.003.001.001', 'Meja Kerja Pegawai Non struktural', '2', '12', '12.11.09.21.01.01.03', 'Ruang 14', 'Bidang Komunikasi dan Kehumasan', 'Dinkominfotik Kab. Brebes', '12.11.09.21.01.01.03', 'Bidang Komunikasi dan Kehumasan', 'Dinkominfotik Kab. Brebes', '1998-12-30', '1999-01-28', 'Meja Tulis', NULL, 'Peralatan', NULL, NULL, NULL, NULL, 'Kayu', NULL, NULL, 'Kurang Baik', '60 Bulan', 70000.00, 70000.00, NULL, NULL, 'Ruang 14'),
('PMD0000003', '1.3.2.05.003.004.003', 'Meja Rapat', '1', '10', '12.11.09.21.01.01.01', 'Ruang Operasional', NULL, 'Dinkominfotik Kab. Brebes', '12.11.09.21.01.01.03', 'Bidang Komunikasi dan Kehumasan', 'Dinkominfotik Kab. Brebes', '2024-09-01', '2024-09-01', 'Meja', NULL, 'Peralatan', NULL, NULL, NULL, NULL, 'Besi', NULL, NULL, 'Baik', '100 Bulan', 79000.00, 79000.00, NULL, NULL, 'Ruang 14'),
('PMD0000004', '1.3.2.05.003.004.004', 'PC kantor', '1', '12', '12.11.09.21.01.01.07', 'Ruang Data Center', 'Bidang Innformatika', 'Dinkominfotik Kab. Brebes', '12.11.09.21.01.01.09', NULL, 'Dinkominfotik Kab. Brebes', '2024-05-14', '2024-06-18', 'Lenovo', NULL, 'Mesin dan Elektronik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Baik', '32 Bulan', 5000000.00, 6000000.00, NULL, NULL, 'Ruang Sekretariat'),
('PMD0000005', '1.3.2.05.003.004.005', 'Sepeda Motor', '1', '12', '12.11.09.21.01.01.04', 'Parkiran', NULL, 'Dinkominfotik Kab. Brebes', '12.11.09.21.01.01.04', NULL, 'Dinkominfotik Kab. Brebes', '2024-01-16', '2024-01-16', 'Honda Revo', NULL, 'kendaraan', NULL, NULL, NULL, NULL, 'Besi', NULL, NULL, 'Baik', NULL, 19000000.00, 20000000.00, NULL, NULL, 'Parkiran'),
('PMD0000006', '1.3.2.05.003.004.006', 'Mesin Deasel', '1', '12', '12.11.09.21.01.01.05', 'Gudang', NULL, 'Dinkominfotik Kab. Brebes', '12.11.09.21.01.01.05', NULL, 'Dinkominfotik Kab. Brebes', '2020-09-09', '2020-09-09', NULL, NULL, 'Mesin dan Elektronik', NULL, NULL, NULL, NULL, 'Besi', NULL, NULL, 'Rusak', '32 Bulan', 3000000.00, 3000000.00, NULL, NULL, 'Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `data_pemeliharaan`
--

CREATE TABLE `data_pemeliharaan` (
  `id_pemeliharaan` varchar(50) NOT NULL,
  `id_barang_pemda` varchar(50) DEFAULT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `desk_pemeliharaan` text DEFAULT NULL,
  `perbaikan` text DEFAULT NULL,
  `tgl_perbaikan` date DEFAULT NULL,
  `lama_perbaikan` varchar(50) DEFAULT NULL,
  `biaya_perbaikan` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pemeliharaan`
--

INSERT INTO `data_pemeliharaan` (`id_pemeliharaan`, `id_barang_pemda`, `kode_barang`, `desk_pemeliharaan`, `perbaikan`, `tgl_perbaikan`, `lama_perbaikan`, `biaya_perbaikan`) VALUES
('MNT0000001', 'PMD0000004', '1.3.2.05.003.004.004', 'Hardisk Rusak', 'Pembelian Hardisk', '2024-07-09', '3 hari', 1000000.00),
('MNT0000002', 'PMD0000005', '1.3.2.05.003.004.005', 'Servis', 'Pembelian Oli', '2024-05-13', '1 hari', 750000.00),
('MNT0000003', 'PMD0000005', '1.3.2.05.003.004.005', 'Servis', 'pembelian dan penggantian kampas, knalpot', '2024-08-13', '2 hari', 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `inventaris_ruangan`
--

CREATE TABLE `inventaris_ruangan` (
  `id_inventaris` int(11) NOT NULL,
  `id_barang_pemda` varchar(50) DEFAULT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `no_pabrik` varchar(50) DEFAULT NULL,
  `ukuran_CC` varchar(50) DEFAULT NULL,
  `bahan` varchar(100) DEFAULT NULL,
  `tgl_pembelian` date DEFAULT NULL,
  `harga_sekarang` decimal(15,2) DEFAULT NULL,
  `kondisi_barang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `acara` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_fasum`
--

INSERT INTO `jadwal_fasum` (`id_lokasi`, `nama_lokasi`, `bid_lokasi`, `tempat_lokasi`, `kategori`, `tgl_mulai`, `tgl_selesai`, `waktu_mulai`, `waktu_selesai`, `acara`) VALUES
('12.11.09.21.01.01.04', 'Parkiran', NULL, 'Dikomifotik Kab. Brebes', 'fasilitas_umum', '2024-07-15', '2024-07-15', '09:00:00', '13:00:00', 'Tempat Parkir Kegiatan Visitasi');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kendaraan`
--

CREATE TABLE `jadwal_kendaraan` (
  `id_barang_pemda` varchar(50) DEFAULT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `kategori_barang` varchar(100) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `id_supir` varchar(50) DEFAULT NULL,
  `nama_supir` varchar(100) DEFAULT NULL,
  `penanggungjawab` varchar(100) NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `acara` text DEFAULT NULL,
  `pengguna` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_kendaraan`
--

INSERT INTO `jadwal_kendaraan` (`id_barang_pemda`, `kode_barang`, `kategori_barang`, `nama_barang`, `id_supir`, `nama_supir`, `penanggungjawab`, `tgl_mulai`, `tgl_selesai`, `waktu_mulai`, `waktu_selesai`, `acara`, `pengguna`) VALUES
('PMD0000005', '1.3.2.05.003.004.005', 'Kendaraan', 'Sepeda Motor', 'SPR001', 'Supri', 'Kabid Humas', '2024-09-09', '2024-09-09', '13:00:00', '19:00:00', 'Berkunjung ke Radio FM', 'Bidang Komunikasi dan Kehumasa');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_ruang`
--

CREATE TABLE `jadwal_ruang` (
  `id_lokasi` varchar(50) NOT NULL,
  `nama_lokasi` varchar(100) DEFAULT NULL,
  `bid_lokasi` varchar(50) DEFAULT NULL,
  `tempat_lokasi` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL
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
('12.11.09.21.01.01.03', 'Ruang 14', 'Bidang Komunikasi dan Kehumasan', 'Dinkominfotik Kab. Brebes', 'ruangan', 'Ruang Bid Humas'),
('12.11.09.21.01.01.04', 'Parkiran', NULL, 'Dinkominfotik Kab. Brebes', 'fasilitas_umum', 'tempat parkir'),
('12.11.09.21.01.01.05', 'Gudang', NULL, 'Dinkominfotik Kab. Brebes', 'fasilitas_umum', 'Gudang Barang'),
('12.11.09.21.01.01.06', 'Dapur', NULL, 'Dinkominfotik Kab.Brebes', 'fasilitas_umum', 'dapur'),
('12.11.09.21.01.01.07', 'Ruang Data Center', 'Bidang Informatika', 'Dinkominfotik Kab.Brebes', 'ruangan', NULL),
('12.11.09.21.01.01.08', 'Ruang Produksi', 'Bidang Komunikasi dan Kehumasan', 'Dinkominfotik Kab.Brebes', 'ruangan', NULL),
('12.11.09.21.01.01.09', 'Ruang Sekretariat', NULL, 'Dinkominfotik Kab. Brebes', 'ruangan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_barang`
--

CREATE TABLE `mutasi_barang` (
  `id_mutasi` varchar(50) NOT NULL,
  `id_barang_pemda` varchar(50) DEFAULT NULL,
  `ruang_asal` varchar(100) NOT NULL,
  `ruang_tujuan` varchar(100) NOT NULL,
  `tgl_mutasi` date DEFAULT NULL,
  `penanggungjawab` varchar(100) DEFAULT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `jenis_mutasi` varchar(100) DEFAULT NULL,
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
  `id_barang_pemda` varchar(50) DEFAULT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supir`
--

INSERT INTO `supir` (`id_supir`, `nama_supir`, `id_barang_pemda`, `kode_barang`, `nama_barang`) VALUES
('SPR000001', 'Supri', 'PMD0000005', '1.3.2.05.003.004.005', 'Sepeda Motor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  ADD PRIMARY KEY (`id_barang_rusak`),
  ADD KEY `fk_barang_rusak` (`id_barang_pemda`);

--
-- Indexes for table `barcode_barang`
--
ALTER TABLE `barcode_barang`
  ADD PRIMARY KEY (`id_barcode`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `fk_barcode_barang` (`id_barang_pemda`);

--
-- Indexes for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_barang_pemda`);

--
-- Indexes for table `data_pemeliharaan`
--
ALTER TABLE `data_pemeliharaan`
  ADD PRIMARY KEY (`id_pemeliharaan`),
  ADD KEY `fk_pemeliharaan` (`id_barang_pemda`);

--
-- Indexes for table `inventaris_ruangan`
--
ALTER TABLE `inventaris_ruangan`
  ADD PRIMARY KEY (`id_inventaris`),
  ADD KEY `fk_inventaris` (`id_barang_pemda`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `mutasi_barang`
--
ALTER TABLE `mutasi_barang`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `fk_mutasi` (`id_barang_pemda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barcode_barang`
--
ALTER TABLE `barcode_barang`
  MODIFY `id_barcode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventaris_ruangan`
--
ALTER TABLE `inventaris_ruangan`
  MODIFY `id_inventaris` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  ADD CONSTRAINT `fk_barang_rusak` FOREIGN KEY (`id_barang_pemda`) REFERENCES `data_barang` (`id_barang_pemda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barcode_barang`
--
ALTER TABLE `barcode_barang`
  ADD CONSTRAINT `fk_barcode_barang` FOREIGN KEY (`id_barang_pemda`) REFERENCES `data_barang` (`id_barang_pemda`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `data_pemeliharaan`
--
ALTER TABLE `data_pemeliharaan`
  ADD CONSTRAINT `fk_pemeliharaan` FOREIGN KEY (`id_barang_pemda`) REFERENCES `data_barang` (`id_barang_pemda`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `inventaris_ruangan`
--
ALTER TABLE `inventaris_ruangan`
  ADD CONSTRAINT `fk_inventaris` FOREIGN KEY (`id_barang_pemda`) REFERENCES `data_barang` (`id_barang_pemda`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `mutasi_barang`
--
ALTER TABLE `mutasi_barang`
  ADD CONSTRAINT `fk_mutasi` FOREIGN KEY (`id_barang_pemda`) REFERENCES `data_barang` (`id_barang_pemda`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
