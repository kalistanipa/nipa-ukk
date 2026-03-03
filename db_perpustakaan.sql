-- Database: `peminjaman_buku`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

-- Table structure for table `users` (Admin)
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` enum('admin','petugas') NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `users`
-- password: admin (MD5: 21232f297a57a5a743894a0e4a801fc3)
INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin');

-- Table structure for table `anggota` (Siswa/User)
CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id_anggota`),
  UNIQUE KEY `nis` (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `anggota`
-- password: siswa (MD5: bcd724d15cde8c47650fda962968f102)
INSERT INTO `anggota` (`id_anggota`, `nis`, `nama_lengkap`, `kelas`, `jurusan`, `alamat`, `password`) VALUES
(1, '12345', 'Siswa Contoh', 'XII', 'RPL', 'Jl. Contoh No. 1', 'bcd724d15cde8c47650fda962968f102');

-- Table structure for table `buku`
CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `kode_buku` varchar(20) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` int(4) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_buku`),
  UNIQUE KEY `kode_buku` (`kode_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `buku`
INSERT INTO `buku` (`id_buku`, `kode_buku`, `judul_buku`, `penulis`, `penerbit`, `tahun_terbit`, `stok`) VALUES
(1, 'BK001', 'Belajar PHP Native', 'Budi Santoso', 'Informatika', 2023, 10),
(2, 'BK002', 'Dasar Algoritma', 'Rina Wati', 'Elex Media', 2022, 5);

-- Table structure for table `peminjaman`
CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL COMMENT 'Petugas yang melayani',
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status_peminjaman` enum('dipinjam','dikembalikan') NOT NULL DEFAULT 'dipinjam',
  PRIMARY KEY (`id_peminjaman`),
  KEY `id_anggota` (`id_anggota`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `detail_peminjaman`
CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_peminjaman` (`id_peminjaman`),
  KEY `id_buku` (`id_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Constraints
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;

ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `detail_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE;

COMMIT;
