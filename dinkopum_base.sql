-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 09:55 AM
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
-- Database: `dinkopum_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(128) NOT NULL,
  `password_admin` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nomor_anggota` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `koperasi_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `username_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `password_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `NIK` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `foto_anggota` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `jabatan_anggota` varchar(128) DEFAULT NULL,
  `unit` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `keterangan` varchar(128) DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `nomor_telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `tempat_lahir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status_anggota` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `last_update` int(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nomor_anggota`, `koperasi_user`, `nama`, `username_user`, `password_user`, `NIK`, `foto_anggota`, `jabatan_anggota`, `unit`, `keterangan`, `alamat`, `nomor_telepon`, `email`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `status_anggota`, `last_update`) VALUES
(24, '024', 'KUD Telang', 'Abdan Lurus;', '', 'abdan123', '312631274617183187318131', 'WhatsApp Image 2024-04-04 at 09.11.43.jpeg', 'Ketua Guild', 'I', 'sehat', 'bangkalan', '09128123713', 'abdan@gmail.com', 'Bangkalan', '2024-04-11', 'Laki-Laki', 'Aktif', 1717728524),
(258, '020', NULL, 'maul jomok:', '', '020', '', NULL, '', 'II', '', '', '', '', '', '2024-05-13', 'Laki-Laki', 'Aktif', NULL),
(261, '2', NULL, 'rafl,  insyaAllah', '2', '2', NULL, NULL, NULL, 'I', 'tanda koma', 'bangkalan', '0', NULL, NULL, '2024-04-11', 'Perempuan', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aset_tetap`
--

CREATE TABLE `aset_tetap` (
  `id_aset_tetap` int(11) NOT NULL,
  `inventaris` decimal(10,0) NOT NULL,
  `penyusutan` decimal(10,0) NOT NULL,
  `tahun` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `aset_tetap`
--

INSERT INTO `aset_tetap` (`id_aset_tetap`, `inventaris`, `penyusutan`, `tahun`) VALUES
(6, 2, 0, '2024-06-03'),
(7, 0, 1, '2024-06-03'),
(10, 100000, 0, '2024-06-04'),
(11, 0, 50000, '2024-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `bank_record`
--

CREATE TABLE `bank_record` (
  `id_bank_rec` int(11) NOT NULL,
  `uang_masuk` decimal(10,0) NOT NULL DEFAULT 0,
  `uang_keluar` decimal(10,0) NOT NULL DEFAULT 0,
  `keterangan` varchar(128) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `bank_record`
--

INSERT INTO `bank_record` (`id_bank_rec`, `uang_masuk`, `uang_keluar`, `keterangan`, `tanggal`) VALUES
(1, 78760000, 0, '0', '2024-05-20'),
(2, 0, 18760000, 'tarik tunai', '2024-05-20'),
(3, 610000, 0, 'tf 2', '2024-05-27'),
(4, 3861263, 0, 'ok', '2024-05-27'),
(5, 90000000, 0, 'ok', '2024-05-27'),
(6, 0, 471263, 'ok', '2024-05-27'),
(7, 471263, 0, 'ok', '2024-05-27'),
(8, 0, 154471263, 'all in', '2024-05-31'),
(9, 71539899, 0, 'ok', '2024-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `beban`
--

CREATE TABLE `beban` (
  `id_beban` int(11) NOT NULL,
  `administrasi` decimal(10,0) NOT NULL DEFAULT 0,
  `pendapatan_lain` decimal(10,0) NOT NULL DEFAULT 0,
  `rapat_anggota` decimal(10,0) NOT NULL DEFAULT 0,
  `insentif` decimal(10,0) NOT NULL DEFAULT 0,
  `honor_ketua_kel` decimal(10,0) NOT NULL DEFAULT 0,
  `thr` decimal(10,0) NOT NULL DEFAULT 0,
  `atk` decimal(10,0) NOT NULL DEFAULT 0,
  `transportasi` decimal(10,0) NOT NULL DEFAULT 0,
  `sisih_gedung` decimal(10,0) NOT NULL DEFAULT 0,
  `sisih_piutang` decimal(10,0) NOT NULL DEFAULT 0,
  `susut_inventaris` decimal(10,0) NOT NULL DEFAULT 0,
  `konsumsi` decimal(10,0) NOT NULL DEFAULT 0,
  `rawat_aset` decimal(10,0) NOT NULL DEFAULT 0,
  `beban_lain` decimal(10,0) NOT NULL DEFAULT 0,
  `pajak_badan` decimal(10,0) NOT NULL DEFAULT 0,
  `tahun` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `beban`
--

INSERT INTO `beban` (`id_beban`, `administrasi`, `pendapatan_lain`, `rapat_anggota`, `insentif`, `honor_ketua_kel`, `thr`, `atk`, `transportasi`, `sisih_gedung`, `sisih_piutang`, `susut_inventaris`, `konsumsi`, `rawat_aset`, `beban_lain`, `pajak_badan`, `tahun`) VALUES
(10, 750000, 170000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-05-30'),
(22, 0, 0, 42409000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-05-30'),
(25, 750000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-05-31'),
(26, 0, 170000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-06-01'),
(27, 75000000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-05-30'),
(29, 100000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-06-12'),
(30, 0, 50000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-06-14'),
(34, 0, 0, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, '2024-06-13'),
(35, 0, 0, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, '2024-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasi`
--

CREATE TABLE `dokumentasi` (
  `id_dokumentasi` int(11) NOT NULL,
  `nama_gambar` varchar(1024) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `deskripsi` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `dokumentasi`
--

INSERT INTO `dokumentasi` (`id_dokumentasi`, `nama_gambar`, `judul`, `deskripsi`) VALUES
(7, 'WhatsApp Image 2024-04-29 at 09.17.08.jpeg', 'Makan Pentol enak', 'Makan Pentol di dinkop oke'),
(8, 'WhatsApp Image 2024-04-29 at 09.14.04.jpeg', 'Rapat', 'rapat dengan mas habi'),
(9, 'WhatsApp Image 2024-04-04 at 09.11.43.jpeg', 'Rapat', 'rapat dengan pak ari'),
(10, 'WhatsApp Image 2024-02-26 at 12.57.29.jpeg', 'Turu', 'maul turu'),
(11, 'WhatsApp Image 2024-03-13 at 09.09.13.jpeg', 'Acara dinkop', 'di setda'),
(12, 'WhatsApp Image 2024-03-13 at 09.07.51.jpeg', 'foto bersama', '');

-- --------------------------------------------------------

--
-- Table structure for table `ekuitas`
--

CREATE TABLE `ekuitas` (
  `id_ekuitas` int(11) NOT NULL,
  `hibah` decimal(10,0) DEFAULT 0,
  `modal` decimal(10,0) DEFAULT 0,
  `resiko` decimal(10,0) DEFAULT 0,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ekuitas`
--

INSERT INTO `ekuitas` (`id_ekuitas`, `hibah`, `modal`, `resiko`, `tahun`) VALUES
(2, 50000000, 34931156, 0, 2022),
(3, 50000000, 56250819, 5329916, 2023),
(5, 50000001, 56250820, 5329917, 2024),
(7, 1, 1, 1, 2028);

-- --------------------------------------------------------

--
-- Table structure for table `ekuitas_record`
--

CREATE TABLE `ekuitas_record` (
  `id_ekurecord` int(11) NOT NULL,
  `hibah_rec` decimal(10,0) DEFAULT 0,
  `modal_rec` decimal(10,0) DEFAULT 0,
  `resiko_rec` decimal(10,0) DEFAULT 0,
  `tanggal_ekuitas` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ekuitas_record`
--

INSERT INTO `ekuitas_record` (`id_ekurecord`, `hibah_rec`, `modal_rec`, `resiko_rec`, `tanggal_ekuitas`) VALUES
(3, 50000000, 34931156, 0, '2022-01-16'),
(4, 50000000, 56250819, 5329916, '2023-05-16'),
(7, 0, 0, 0, '2024-05-20'),
(8, 50000000, 56250819, 5329916, '2024-05-27'),
(13, 1, 1, 1, '2024-06-04'),
(14, 1, 1, 1, '2024-06-04'),
(15, 1, 1, 1, '2028-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `kewajiban`
--

CREATE TABLE `kewajiban` (
  `id_kewajiban` int(11) NOT NULL,
  `sewa_gedung` decimal(10,0) NOT NULL DEFAULT 0,
  `utang_pajak` decimal(10,0) NOT NULL DEFAULT 0,
  `dana_pengurus_pengawas` decimal(10,0) NOT NULL DEFAULT 0,
  `dana_pendidikan` decimal(10,0) NOT NULL DEFAULT 0,
  `dana_karyawan` decimal(10,0) NOT NULL DEFAULT 0,
  `dana_sosial` decimal(10,0) NOT NULL DEFAULT 0,
  `tanggal_kewajiban` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `kewajiban`
--

INSERT INTO `kewajiban` (`id_kewajiban`, `sewa_gedung`, `utang_pajak`, `dana_pengurus_pengawas`, `dana_pendidikan`, `dana_karyawan`, `dana_sosial`, `tanggal_kewajiban`) VALUES
(8, 11100000, 602951, 14534021, 16289991, 9221461, 12117511, '2024-06-03'),
(10, -5500000, 0, 0, 0, 0, 0, '2024-06-03'),
(11, 5500000, 0, 0, 0, 0, 0, '2024-06-03'),
(12, 111000000, 0, 0, 0, 0, 0, '2024-06-03'),
(13, 120000000, 0, 0, 0, 0, 0, '2024-06-03'),
(14, -200000000, 0, 0, 0, 0, 0, '2024-06-03'),
(16, 10000, 10000, 10000, 10000, 10000, 10000, '2024-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `list_kelompok`
--

CREATE TABLE `list_kelompok` (
  `id_kelompok` int(11) NOT NULL,
  `nama_kelompok` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `list_kelompok`
--

INSERT INTO `list_kelompok` (`id_kelompok`, `nama_kelompok`) VALUES
(18, 'I'),
(19, 'II'),
(20, 'III');

-- --------------------------------------------------------

--
-- Table structure for table `master_admin`
--

CREATE TABLE `master_admin` (
  `id_master` int(11) NOT NULL,
  `username_master` varchar(128) NOT NULL,
  `password_master` varchar(128) NOT NULL,
  `unit` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `master_admin`
--

INSERT INTO `master_admin` (`id_master`, `username_master`, `password_master`, `unit`) VALUES
(1, 'master', 'master123', ''),
(17, 'master2', 'master2', 'Telang 1');

-- --------------------------------------------------------

--
-- Table structure for table `master_kelompok`
--

CREATE TABLE `master_kelompok` (
  `id_master_kel` int(11) NOT NULL,
  `username_master` varchar(128) NOT NULL,
  `nama_kelompok` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `master_kelompok`
--

INSERT INTO `master_kelompok` (`id_master_kel`, `username_master`, `nama_kelompok`) VALUES
(27, 'master', 'I'),
(28, 'master2', 'II'),
(29, 'master', 'II');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `nama_materi` varchar(128) DEFAULT NULL,
  `tgl_pelatihan` varchar(64) DEFAULT NULL,
  `dokumen_materi` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `nama_materi`, `tgl_pelatihan`, `dokumen_materi`) VALUES
(37, 'Sedekah Ilmu 2', '2024-03-19', 'uploads/210411100023_Khumairoul Izzah_Minggu1 (1).pdf'),
(38, 'Pelatihan online pemasaran 1', '2024-02-29', 'uploads/210411100023_Khumairoul Izzah_Minggu1 (2).pdf'),
(42, 'Format Excel Tambah Anggota', '2024-05-29', 'uploads/format_anggota.xlsx'),
(43, 'Format Excel Tambah Simpanan', '2024-05-29', 'uploads/dump_simpanan.xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `nomor_anggota` varchar(11) NOT NULL,
  `nama_anggota` varchar(128) NOT NULL,
  `pinjaman_pokok` decimal(10,0) DEFAULT 0,
  `pinjaman_jasa` decimal(10,0) DEFAULT 0,
  `pinjaman_khusus_pokok` decimal(10,0) DEFAULT 0,
  `pinjaman_khusus_jasa` decimal(10,0) DEFAULT 0,
  `angsuran_pokok` decimal(10,0) DEFAULT 0,
  `angsuran_jasa` decimal(10,0) DEFAULT 0,
  `unit` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `nomor_anggota`, `nama_anggota`, `pinjaman_pokok`, `pinjaman_jasa`, `pinjaman_khusus_pokok`, `pinjaman_khusus_jasa`, `angsuran_pokok`, `angsuran_jasa`, `unit`) VALUES
(3, '024', 'Abdan Lurus;', 50000, 38000, 222000, 9000, 27000, 23000, 'I'),
(13, '020', 'maul jomok:', 500000, 300000, 150000, 600000, 250000, 2000000, 'II');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman_record`
--

CREATE TABLE `pinjaman_record` (
  `id_simpnan_rec` int(11) NOT NULL,
  `id_anggota` varchar(11) NOT NULL,
  `pinjaman_pokok_rec` decimal(10,0) DEFAULT NULL,
  `pinjaman_jasa_rec` decimal(10,0) DEFAULT NULL,
  `pinjaman_khusus_pokok` decimal(10,0) DEFAULT NULL,
  `pinjaman_khusus_jasa` decimal(10,0) DEFAULT NULL,
  `angsuran_pokok` decimal(10,0) DEFAULT NULL,
  `angsuran_jasa` decimal(10,0) DEFAULT NULL,
  `tanggal_pinjaman` date NOT NULL,
  `bulan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `pinjaman_record`
--

INSERT INTO `pinjaman_record` (`id_simpnan_rec`, `id_anggota`, `pinjaman_pokok_rec`, `pinjaman_jasa_rec`, `pinjaman_khusus_pokok`, `pinjaman_khusus_jasa`, `angsuran_pokok`, `angsuran_jasa`, `tanggal_pinjaman`, `bulan`) VALUES
(35, '024', 5000, 2000, NULL, NULL, 5000, 2000, '2024-04-22', '04'),
(36, '024', 5000, 2000, NULL, NULL, 5000, 2000, '2024-04-22', '01'),
(57, '024', 0, 0, 100000, 100000, 0, 0, '2024-05-14', '05'),
(58, '024', 0, 0, 100000, 100000, 0, 0, '2024-05-14', '05'),
(63, '024', 5000, 2000, 1000, 2000, 5000, 2000, '2024-05-27', '05'),
(64, '020', 500000, 300000, 150000, 600000, 250000, 2000000, '2024-05-27', '05'),
(73, '024', 5000, 2000, 3000, 1000, 1000, 1000, '2025-06-12', '06'),
(74, '024', 5000, 2000, 3000, 1000, 1000, 1000, '2025-06-12', '06'),
(75, '024', 5000, 2000, 3000, 1000, 1000, 1000, '2025-06-12', '06'),
(76, '024', 5000, 2000, 3000, 1000, 1000, 1000, '2025-06-12', '06'),
(77, '024', 5000, 2000, 3000, 1000, 1000, 1000, '2025-06-12', '06'),
(78, '024', 5000, 2000, 3000, 1000, 1000, 1000, '2025-06-12', '06'),
(79, '024', 5000, 2000, 3000, 1000, 1000, 1000, '2025-06-12', '06');

-- --------------------------------------------------------

--
-- Table structure for table `set_web`
--

CREATE TABLE `set_web` (
  `id_set` int(11) NOT NULL,
  `nama_koperasi` varchar(128) DEFAULT NULL,
  `deskripsi_koperasi` varchar(1024) DEFAULT NULL,
  `alamat_koperasi` varchar(128) DEFAULT NULL,
  `telp_koperasi` varchar(128) DEFAULT NULL,
  `email_koperasi` varchar(128) DEFAULT NULL,
  `logo_koperasi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `set_web`
--

INSERT INTO `set_web` (`id_set`, `nama_koperasi`, `deskripsi_koperasi`, `alamat_koperasi`, `telp_koperasi`, `email_koperasi`, `logo_koperasi`) VALUES
(1, 'KOPERASI WANITA ', 'Koperasi Kita Bina Swakerta Swasembada Koperasi Tuntutan Nyata Demi Membangun Bangsa', 'Jalan Raya Kebonagung 1, Kecamagtan Sukodono, Kabupaten Sidoarjo.', '031892122', 'Dinkopum@sidoarjokab.go.idd', 'dikom.png');

-- --------------------------------------------------------

--
-- Table structure for table `shu`
--

CREATE TABLE `shu` (
  `id_shu` int(11) NOT NULL,
  `cadangan_modal` int(3) NOT NULL DEFAULT 0,
  `cadangan_resiko` int(3) NOT NULL DEFAULT 0,
  `anggota_simpanan` int(3) NOT NULL DEFAULT 0,
  `anggota_pinjaman` int(3) NOT NULL DEFAULT 0,
  `dana_pp` int(3) NOT NULL DEFAULT 0,
  `dana_pendidikan` int(3) NOT NULL DEFAULT 0,
  `dana_karyawan` int(3) NOT NULL DEFAULT 0,
  `dana_sosial` int(3) NOT NULL DEFAULT 0,
  `tahun` int(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `shu`
--

INSERT INTO `shu` (`id_shu`, `cadangan_modal`, `cadangan_resiko`, `anggota_simpanan`, `anggota_pinjaman`, `dana_pp`, `dana_pendidikan`, `dana_karyawan`, `dana_sosial`, `tahun`) VALUES
(1, 20, 5, 20, 30, 10, 5, 5, 5, 2024),
(2, 20, 5, 20, 30, 10, 5, 5, 5, 2023),
(3, 20, 5, 20, 30, 10, 5, 5, 5, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE `simpanan` (
  `id_smp` int(11) NOT NULL,
  `nomor_anggota` varchar(128) DEFAULT NULL,
  `nama_anggota` varchar(100) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `spokok` decimal(10,0) DEFAULT NULL,
  `swajib` decimal(10,0) DEFAULT NULL,
  `ssukarela` decimal(10,0) DEFAULT NULL,
  `shariraya` decimal(10,0) DEFAULT NULL,
  `skhusus` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id_smp`, `nomor_anggota`, `nama_anggota`, `unit`, `spokok`, `swajib`, `ssukarela`, `shariraya`, `skhusus`) VALUES
(19, '024', 'Abdan Lurus;', 'I', 5370000, 34538000, 112000, 4000, 16000),
(28, '020', 'maul jomok:', 'II', 100000, 0, 0, 0, 0),
(29, '2', 'rafl,  insyaAllah', 'I', 15000, 15000, 15000, 15000, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `simpanan_record`
--

CREATE TABLE `simpanan_record` (
  `id_simpanan` int(11) NOT NULL,
  `id_anggota` varchar(5) DEFAULT NULL,
  `pokok_rec` decimal(10,0) DEFAULT NULL,
  `wajib_rec` decimal(10,0) DEFAULT NULL,
  `sukarela_rec` decimal(10,0) DEFAULT NULL,
  `hariraya_rec` decimal(10,0) DEFAULT NULL,
  `khusus_rec` decimal(10,0) DEFAULT NULL,
  `tgl_simpanan` date DEFAULT NULL,
  `bulan` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `simpanan_record`
--

INSERT INTO `simpanan_record` (`id_simpanan`, `id_anggota`, `pokok_rec`, `wajib_rec`, `sukarela_rec`, `hariraya_rec`, `khusus_rec`, `tgl_simpanan`, `bulan`) VALUES
(766, '024', 100000, 0, 0, 0, 0, '2024-04-24', '04'),
(793, '020', 100000, 0, 0, 0, 0, '2024-05-13', '05'),
(794, '024', 277777, 0, 0, 0, 0, '2024-05-13', '05'),
(797, '024', 0, 0, 100000, 0, 0, '2024-01-08', '01'),
(800, '024', 0, 184530000, 0, 0, 0, '2024-05-16', '05'),
(802, '024', -77777, 0, 0, 0, 0, '2024-05-20', '05'),
(806, '024', 5000, 2000, 3000, 1000, 4000, '2025-06-19', '01'),
(807, '024', 5000, 2000, 3000, 1000, 4000, '2025-06-19', '01'),
(808, '024', 5000, 2000, 3000, 1000, 4000, '2025-06-19', '01'),
(810, '024', -100000000, 0, 0, 0, 0, '2024-06-04', '06'),
(811, '024', 105000000, 0, 0, 0, 0, '2024-06-04', '06'),
(812, '024', 150000000, 0, 0, 0, 0, '2024-06-04', '06'),
(813, '024', -150000000, 0, 0, 0, 0, '2024-06-04', '06'),
(814, '024', 0, -150000000, 0, 0, 0, '2024-06-04', '06'),
(815, '024', 5000, 2000, 3000, 1000, 4000, '2024-06-24', '06'),
(816, '2', 15000, 15000, 15000, 15000, 15000, '2024-06-28', '06');

-- --------------------------------------------------------

--
-- Table structure for table `visi_misi`
--

CREATE TABLE `visi_misi` (
  `id_vmblkg` int(11) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `latar_belakang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visi_misi`
--

INSERT INTO `visi_misi` (`id_vmblkg`, `visi`, `misi`, `latar_belakang`) VALUES
(1, 'Visi....................', 'Misi..........................,\r\n1. jijsaidjasid,\r\n2. r3434343', 'Koperasi ini berdiri sejak tahun 2009 berlatar belakang.......\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aset_tetap`
--
ALTER TABLE `aset_tetap`
  ADD PRIMARY KEY (`id_aset_tetap`);

--
-- Indexes for table `bank_record`
--
ALTER TABLE `bank_record`
  ADD PRIMARY KEY (`id_bank_rec`);

--
-- Indexes for table `beban`
--
ALTER TABLE `beban`
  ADD PRIMARY KEY (`id_beban`);

--
-- Indexes for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD PRIMARY KEY (`id_dokumentasi`);

--
-- Indexes for table `ekuitas`
--
ALTER TABLE `ekuitas`
  ADD PRIMARY KEY (`id_ekuitas`);

--
-- Indexes for table `ekuitas_record`
--
ALTER TABLE `ekuitas_record`
  ADD PRIMARY KEY (`id_ekurecord`);

--
-- Indexes for table `kewajiban`
--
ALTER TABLE `kewajiban`
  ADD PRIMARY KEY (`id_kewajiban`);

--
-- Indexes for table `list_kelompok`
--
ALTER TABLE `list_kelompok`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indexes for table `master_admin`
--
ALTER TABLE `master_admin`
  ADD PRIMARY KEY (`id_master`);

--
-- Indexes for table `master_kelompok`
--
ALTER TABLE `master_kelompok`
  ADD PRIMARY KEY (`id_master_kel`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indexes for table `pinjaman_record`
--
ALTER TABLE `pinjaman_record`
  ADD PRIMARY KEY (`id_simpnan_rec`);

--
-- Indexes for table `set_web`
--
ALTER TABLE `set_web`
  ADD PRIMARY KEY (`id_set`);

--
-- Indexes for table `shu`
--
ALTER TABLE `shu`
  ADD PRIMARY KEY (`id_shu`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id_smp`);

--
-- Indexes for table `simpanan_record`
--
ALTER TABLE `simpanan_record`
  ADD PRIMARY KEY (`id_simpanan`),
  ADD KEY `no_anggota` (`id_anggota`);

--
-- Indexes for table `visi_misi`
--
ALTER TABLE `visi_misi`
  ADD PRIMARY KEY (`id_vmblkg`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `aset_tetap`
--
ALTER TABLE `aset_tetap`
  MODIFY `id_aset_tetap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bank_record`
--
ALTER TABLE `bank_record`
  MODIFY `id_bank_rec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `beban`
--
ALTER TABLE `beban`
  MODIFY `id_beban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  MODIFY `id_dokumentasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ekuitas`
--
ALTER TABLE `ekuitas`
  MODIFY `id_ekuitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ekuitas_record`
--
ALTER TABLE `ekuitas_record`
  MODIFY `id_ekurecord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kewajiban`
--
ALTER TABLE `kewajiban`
  MODIFY `id_kewajiban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `list_kelompok`
--
ALTER TABLE `list_kelompok`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `master_admin`
--
ALTER TABLE `master_admin`
  MODIFY `id_master` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `master_kelompok`
--
ALTER TABLE `master_kelompok`
  MODIFY `id_master_kel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pinjaman_record`
--
ALTER TABLE `pinjaman_record`
  MODIFY `id_simpnan_rec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `set_web`
--
ALTER TABLE `set_web`
  MODIFY `id_set` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shu`
--
ALTER TABLE `shu`
  MODIFY `id_shu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id_smp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `simpanan_record`
--
ALTER TABLE `simpanan_record`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=817;

--
-- AUTO_INCREMENT for table `visi_misi`
--
ALTER TABLE `visi_misi`
  MODIFY `id_vmblkg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
