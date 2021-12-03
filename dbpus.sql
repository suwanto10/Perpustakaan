-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2021 at 09:22 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `nm_admin` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `nm_admin`, `username`, `password`) VALUES
(1, 'Admin', 'jwd', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tbanggota`
--

CREATE TABLE `tbanggota` (
  `idanggota` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jeniskelamin` varchar(10) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL,
  `foto` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbanggota`
--

INSERT INTO `tbanggota` (`idanggota`, `nama`, `jeniskelamin`, `alamat`, `status`, `foto`) VALUES
('AG001', 'Mutiara Rahmanda Tri Rizkia', 'Wanita', 'Malang  ', 'Tidak Meminjam', 'https://objectstorage.ap-osaka-1.oraclecloud.com/n/ax9vujnwdmvy/b/Ujian_Tengah_Semester/o/images%2FAG001.jpeg'),
('AG002', 'Retno', 'Wanita', 'Kediri', 'Sedang Meminjam', 'https://objectstorage.ap-osaka-1.oraclecloud.com/n/ax9vujnwdmvy/b/Ujian_Tengah_Semester/o/images%2FAG002.JPG'),
('AG003', 'Wike Audy Vivian', 'Wanita', 'Jakarta', 'Tidak Meminjam', 'https://objectstorage.ap-osaka-1.oraclecloud.com/n/ax9vujnwdmvy/b/Ujian_Tengah_Semester/o/images%2FAG003.jpg'),
('AG004', 'Riza Amalia', 'Wanita', 'Jombang', 'Sedang Meminjam', 'https://objectstorage.ap-osaka-1.oraclecloud.com/n/ax9vujnwdmvy/b/Ujian_Tengah_Semester/o/images%2FAG004.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbbuku`
--

CREATE TABLE `tbbuku` (
  `idbuku` varchar(5) NOT NULL,
  `judulbuku` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `pengarang` varchar(40) NOT NULL,
  `penerbit` varchar(40) NOT NULL,
  `jumlahbuku` varchar(35) NOT NULL,
  `status` varchar(40) NOT NULL,
  `foto` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbbuku`
--

INSERT INTO `tbbuku` (`idbuku`, `judulbuku`, `kategori`, `pengarang`, `penerbit`, `jumlahbuku`, `status`, `foto`) VALUES
('BK001', 'Menanti Hari Berganti', 'Karya Sastra', 'Titi Sanaria', 'Jakarta', '12', 'Tersedia', 'https://objectstorage.ap-osaka-1.oraclecloud.com/n/ax9vujnwdmvy/b/Ujian_Tengah_Semester/o/images%2FBK001.jpeg'),
('BK002', 'Senja Kehidupan', 'Novel', 'Sri Hartini', 'Bandung', '13', 'Dipinjam', 'https://objectstorage.ap-osaka-1.oraclecloud.com/n/ax9vujnwdmvy/b/Ujian_Tengah_Semester/o/images%2FBK002.jpg'),
('BK003', 'Dasar Informatika', 'Ilmu Komputer', 'Novega Pratama', 'Lampung', '21', 'Tersedia', 'https://objectstorage.ap-osaka-1.oraclecloud.com/n/ax9vujnwdmvy/b/Ujian_Tengah_Semester/o/images%2FBK003.jpg'),
('BK004', 'Pendidikan Agama Islam', 'Ilmu Agama', 'Samsul Arifin', 'Bandung', '45', 'Dipinjam', 'https://objectstorage.ap-osaka-1.oraclecloud.com/n/ax9vujnwdmvy/b/Ujian_Tengah_Semester/o/images%2FBK004.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbtransaksi`
--

CREATE TABLE `tbtransaksi` (
  `idtransaksi` varchar(5) NOT NULL,
  `idanggota` varchar(5) NOT NULL,
  `idbuku` varchar(5) NOT NULL,
  `tglpinjam` date NOT NULL,
  `tglkembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbtransaksi`
--

INSERT INTO `tbtransaksi` (`idtransaksi`, `idanggota`, `idbuku`, `tglpinjam`, `tglkembali`) VALUES
('TR001', 'AG001', 'BK001', '2021-09-01', '2021-09-01'),
('TR002', 'AG002', 'BK002', '2021-09-01', '0000-00-00'),
('TR003', 'AG003', 'BK003', '2021-09-01', '2021-09-01'),
('TR004', 'AG004', 'BK004', '2021-09-01', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `iduser` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`iduser`, `nama`, `alamat`) VALUES
('U001', 'Mutiara Rahmanda Tri Rizkia', 'Malang,jawa timur'),
('U002', 'Rahmanda', 'Jakarta'),
('U003', 'Putra', 'Lumajang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `tbanggota`
--
ALTER TABLE `tbanggota`
  ADD PRIMARY KEY (`idanggota`);

--
-- Indexes for table `tbbuku`
--
ALTER TABLE `tbbuku`
  ADD PRIMARY KEY (`idbuku`);

--
-- Indexes for table `tbtransaksi`
--
ALTER TABLE `tbtransaksi`
  ADD PRIMARY KEY (`idtransaksi`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
