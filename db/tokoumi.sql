-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 21, 2018 at 01:24 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokoumi`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `idAkses` int(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `nama` varchar(50) NOT NULL,
  `akses` varchar(10) NOT NULL,
  `toko` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`idAkses`, `username`, `password`, `salt`, `nama`, `akses`, `toko`) VALUES
(5, 'Yuanita', '92275bdab41402677de804f757122e7b4b64f593d49e707e75cbb2e21238c054', '5b6cfabb3232d0.29642000', 'Yuanita Pratiwi', 'owner', NULL),
(6, 'Yuniati', '4fa496fec0f2c7918bd9548e3637adca869a738336839589d3979249f2fe74e7', '5b6cfaedb95df3.18907853', 'Yuniati dwi', 'supervisor', NULL),
(9, 'Zea', '02f618f504d9506270e9e9a6fc614f65a9baaa3ffd8f7dbf12e8daf84812dc87', '5b70af3fc00a10.42896684', 'Zea minka', 'penjaga', '3'),
(10, 'Iwi', '5ea5a55868d019b7dff4e7752cff83b345b7639204d57bafb77525819ae850bd', '5b7113a3c0a324.23572954', 'Iwi Pratiwi', 'penjaga', '4'),
(11, 'minka', 'c94aa920c07a0d84b0162ffe6435a25967d04380e424b9be34cf7429402b7294', '5b6fb41fdb7076.09989055', 'minka', 'penjaga', '1'),
(13, 'dina', 'd479a229f93623b95940bb5826e0b8b1178ab4922407901508ff48adc344c93b', '5b792dc169f558.07037134', 'dina', 'penjaga', '5');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idBarang` int(6) NOT NULL,
  `kode` varchar(13) NOT NULL,
  `jumlahBarang` int(6) NOT NULL,
  `toko` int(2) NOT NULL,
  `lemari` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idBarang`, `kode`, `jumlahBarang`, `toko`, `lemari`) VALUES
(6, '8995255410592', 2, 1, 'A1'),
(7, '8995255410592', 4, 1, 'A2'),
(8, '8992203077286', 30, 1, 'A1'),
(9, '8991532707192', 20, 1, 'A3'),
(10, '8996171014875', 38, 1, 'A5'),
(11, '8996171014875', 10, 1, 'A2'),
(12, '8995255410592', 15, 3, 'B1'),
(13, '8995255410592', 8, 3, 'B2'),
(14, '8996171014875', 4, 3, 'B2'),
(15, '8995255410592', 3, 3, 'B3');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `idPenjualan` int(7) NOT NULL,
  `kode` varchar(13) NOT NULL,
  `toko` int(2) NOT NULL,
  `harga` int(7) NOT NULL,
  `tawar` int(7) DEFAULT NULL,
  `jumlahJual` int(6) NOT NULL,
  `total` int(8) NOT NULL,
  `tglTransaksi` datetime NOT NULL,
  `lemari` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`idPenjualan`, `kode`, `toko`, `harga`, `tawar`, `jumlahJual`, `total`, `tglTransaksi`, `lemari`) VALUES
(4, '8995255410592', 3, 60000, 0, 3, 180000, '2018-08-19 15:24:20', 'B2'),
(5, '8996171014875', 3, 100000, 90000, 1, 90000, '2018-08-19 15:30:28', 'B2'),
(7, '8996171014875', 1, 100000, 80000, 2, 160000, '2018-08-20 16:23:41', 'A5');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `idPinjam` int(6) NOT NULL,
  `kode` varchar(13) NOT NULL,
  `jumlahPinjam` int(5) NOT NULL,
  `tglPinjam` datetime NOT NULL,
  `toko1` int(2) NOT NULL,
  `toko2` int(2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`idPinjam`, `kode`, `jumlahPinjam`, `tglPinjam`, `toko1`, `toko2`, `status`) VALUES
(4, '8995255410592', 11, '2018-08-19 15:38:30', 1, 3, 'ambil'),
(5, '8995255410592', 2, '2018-08-20 16:25:07', 3, 1, 'ambil');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `idRiwayat` int(7) NOT NULL,
  `kode` varchar(13) NOT NULL,
  `tglMasuk` datetime NOT NULL,
  `toko` int(2) NOT NULL,
  `jumlahStok` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`idRiwayat`, `kode`, `tglMasuk`, `toko`, `jumlahStok`) VALUES
(13, '8995255410592', '2018-08-19 14:31:31', 1, 10),
(14, '8995255410592', '2018-08-19 14:57:46', 3, 20),
(15, '8995255410592', '2018-08-19 14:58:37', 1, 5),
(16, '8992203077286', '2018-08-19 14:59:24', 1, 30),
(17, '8992203077286', '2018-08-19 14:59:57', 1, 10),
(18, '8992203077286', '2018-08-19 15:00:31', 5, 5),
(19, '8991532707192', '2018-08-19 15:01:55', 1, 20),
(20, '8995255410592', '2018-08-19 15:02:57', 5, 20),
(21, '8996171014875', '2018-08-19 15:03:59', 1, 50),
(22, '8996171014875', '2018-08-19 15:04:49', 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `idStok` int(7) NOT NULL,
  `kode` varchar(13) NOT NULL,
  `jenisBarang` varchar(40) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `ukuran` varchar(8) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `harga` int(8) NOT NULL,
  `toko` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`idStok`, `kode`, `jenisBarang`, `merk`, `ukuran`, `jumlah`, `harga`, `toko`) VALUES
(9, '8995255410592', 'batik', 'bateeq', 'L', 0, 60000, 1),
(10, '8995255410592', 'batik', 'bateeq', 'L', 0, 60000, 3),
(11, '8992203077286', 'Kaos', 'tshirt', 'XL', 10, 30000, 1),
(12, '8992203077286', 'Kaos', 'tshirt', 'XL', 5, 30000, 5),
(13, '8991532707192', 'Kaos', 'tshirt', 'L', 0, 15000, 1),
(14, '8995255410592', 'batik', 'bateeq', 'L', 20, 60000, 5),
(15, '8996171014875', 'batik', 'bateeq', 'XL', 0, 100000, 1),
(16, '8996171014875', 'batik', 'bateeq', 'XL', 0, 100000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `idToko` int(2) NOT NULL,
  `nama` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`idToko`, `nama`) VALUES
(1, 'A001'),
(2, 'A002'),
(3, 'A003'),
(4, 'A004'),
(5, 'A005'),
(6, 'A006'),
(7, 'A007'),
(8, 'A008'),
(9, 'A009'),
(10, 'A010');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`idAkses`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idBarang`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idPenjualan`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`idPinjam`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`idRiwayat`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`idStok`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`idToko`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `idAkses` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `idBarang` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `idPenjualan` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `idPinjam` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `idRiwayat` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `idStok` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `idToko` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
