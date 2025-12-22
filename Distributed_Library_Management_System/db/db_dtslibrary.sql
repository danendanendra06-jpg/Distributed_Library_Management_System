-- phpMyAdmin SQL Dump
-- version 5.2.1
-- Generation Time: Nov 04, 2025 at 07:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `tbl_buku` (
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `sampul` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `pengarang` varchar(255) DEFAULT NULL,
  `thn_buku` varchar(255) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `tgl_masuk` varchar(255) DEFAULT NULL,
  `gambar_buku` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `id_kategori`, `sampul`, `isbn`, `lampiran`, `title`, `penerbit`, `pengarang`, `thn_buku`, `isi`, `jml`, `tgl_masuk`, `gambar_buku`) VALUES
(11, 10, '0', '132-123-234-231', '0', 'Potter', 'sikudel', 'BUDI RAHARJO ', '2025', '0', 2, '2025-10-14 09:59:29', '1760787142_img1.jpg'),
(12, 5, NULL, '1', NULL, 'Buku', 'Dan', 'Danen', '2014', '0', 5, '2025-10-18 08:15:16', '1760934872_human.jpg'),
(13, 9, NULL, '132-123-234-231', NULL, 'm', 'Dan', 'Danen', '2019', '0', 2, '2025-10-19 16:36:42', '1760934769_alchemist.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_denda`
--

CREATE TABLE `tbl_denda` (
  `id_denda` int(11) NOT NULL,
  `pinjam_id` varchar(255) NOT NULL,
  `denda` varchar(255) NOT NULL,
  `lama_waktu` int(11) NOT NULL,
  `tgl_denda` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_denda`
--

INSERT INTO `tbl_denda` (`id_denda`, `pinjam_id`, `denda`, `lama_waktu`, `tgl_denda`) VALUES
(10, 'PJ391', '52000', 13, '2025-11-08'),
(11, 'PJ555', '20000', 5, '2025-10-25'),
(12, 'PJ555', '4000', 1, '2025-11-08'),
(13, 'PJ697', '36000', 9, '2025-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(5, 'Comedy'),
(8, 'Horror'),
(9, 'Action'),
(10, 'Romance'),
(11, 'Fantasy'),
(12, 'Bebas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `id_member` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '123456',
  `alamat` text DEFAULT NULL,
  `nomor_telepon` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tgl_lahir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id_member`, `nama_lengkap`, `username`, `alamat`, `nomor_telepon`, `email`, `tgl_lahir`) VALUES
(1, 'Danendra', 'Danen', 'JL.gunung gede', '085812345678', 'danen@gmail.com', '2000-01-01'),
(2, 'Dika Danendra', 'Dika', 'jepang', '085812345698', 'dika@gmail.com', '2001-05-20'),
(3, 'ken', 'Ken', 'bogor', '085812345698', 'ken@gmail.com', '1999-12-12'),
(4, 'Danendra', 'admin', 'bogor', '085812345698', 'admin@dts.com', '1995-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_petugas`
--

CREATE TABLE `tbl_petugas` (
  `id_petugas` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tgl_bergabung` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_petugas`
--

INSERT INTO `tbl_petugas` (`id_petugas`, `user`, `pass`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `telepon`, `email`, `tgl_bergabung`, `foto`) VALUES
('AG767', 'erere', '202cb962ac59075b964b07152d234b70', 'irier', '', '', '', '081336985966', '23jdusd@gmail.com', '', ''),
('AG944', 'Dnmpu', '52eec856144c5cf4607cec2e53e321a9', 'Danen', '', '', '', '085812345678', 'danen@gmail.com', '', ''),
('AG770', 'james', '9ba36afc4e560bf811caefc0c7fddddf', 'james', '', '', '', '085812345678', 'jame2@gmail.com', '', ''),
('AG221', 'mmm', 'bc022864f419e5f201abb67179ee4acf', 'Mahar', '', '', '', '', 'afafggw@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `pinjam_id` varchar(255) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `id_buku` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_pinjam` varchar(255) NOT NULL,
  `lama_pinjam` int(11) NOT NULL,
  `tgl_balik` varchar(255) NOT NULL,
  `tgl_kembali` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id_pinjam`, `pinjam_id`, `id_member`, `id_buku`, `status`, `tgl_pinjam`, `lama_pinjam`, `tgl_balik`, `tgl_kembali`) VALUES
(16, 'PJ391', 1, 12, 'Dikembalikan', '2025-10-19', 7, '2025-10-26', '2025-11-08'),
(17, 'PJ555', 2, 11, 'Dikembalikan', '2025-10-19', 1, '2025-10-20', '2025-10-25'),
(18, 'PJ697', 1, 12, 'Dikembalikan', '2025-10-25', 5, '2025-10-30', '2025-11-08');

--
-- Triggers `tbl_pinjam`
--
DELIMITER $$
CREATE TRIGGER `tr_denda_otomatis` AFTER UPDATE ON `tbl_pinjam` FOR EACH ROW BEGIN
    SET @harga_denda_per_hari = 4000;
    
    IF NEW.status = 'Dikembalikan' AND NEW.tgl_kembali > NEW.tgl_balik THEN
        SET @lama_denda = DATEDIFF(NEW.tgl_kembali, NEW.tgl_balik);
        SET @total_denda = @lama_denda * @harga_denda_per_hari;
        
        INSERT INTO tbl_denda (pinjam_id, denda, lama_waktu, tgl_denda)
        VALUES (NEW.pinjam_id, @total_denda, @lama_denda, NEW.tgl_kembali);
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--



--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `fk_buku_kategori` (`id_kategori`);

--
-- Indexes for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  ADD PRIMARY KEY (`id_denda`),
  ADD KEY `fk_denda_pinjam` (`pinjam_id`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`id_member`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD UNIQUE KEY `pinjam_id_unique` (`pinjam_id`),
  ADD KEY `fk_pinjam_member` (`id_member`),
  ADD KEY `fk_pinjam_buku` (`id_buku`);

--
-- AUTO_INCREMENT for dumped tables
--



ALTER TABLE `tbl_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `tbl_denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `tbl_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;



ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD CONSTRAINT `fk_buku_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  ADD CONSTRAINT `fk_denda_pinjam` FOREIGN KEY (`pinjam_id`) REFERENCES `tbl_pinjam` (`pinjam_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD CONSTRAINT `fk_pinjam_buku` FOREIGN KEY (`id_buku`) REFERENCES `tbl_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pinjam_member` FOREIGN KEY (`id_member`) REFERENCES `tbl_member` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;