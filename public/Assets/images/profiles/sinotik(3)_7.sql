-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 07:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinotik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasi`
--

CREATE TABLE `dokumentasi` (
  `dokumentasi_id` int(11) NOT NULL,
  `notulensi_id` int(11) NOT NULL,
  `foto_dokumentasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumentasi`
--

INSERT INTO `dokumentasi` (`dokumentasi_id`, `notulensi_id`, `foto_dokumentasi`) VALUES
(1, 1, '1739629745_e332cad561244306aa6f.jpg'),
(2, 2, '1739633953_d11bc3abae5c0e46ff48.jpg'),
(3, 3, '1739634107_e930827f595724cda07a.png'),
(4, 4, '1739708086_be5f31e5d41876d08009.jpg'),
(5, 5, '1739717318_28884d4df6ad244af98c.txt'),
(6, 6, '1739726068_da76c9c181070e87fafd.jpg'),
(7, 7, '1739928974_e3b1aec89381450bd2ab.png');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `notulensi_id` int(11) NOT NULL,
  `isi` text NOT NULL,
  `tanggal_feedback` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `notulensi_id`, `isi`, `tanggal_feedback`, `user_id`, `created_at`) VALUES
(1, 1, 'waw bagus', '2025-02-15', 32, '2025-02-15 22:06:24'),
(2, 1, 'nn', '2025-02-15', 32, '2025-02-15 22:12:34'),
(3, 1, '😃', '2025-02-15', 32, '2025-02-15 22:24:25'),
(4, 1, '🤨', '2025-02-15', 32, '2025-02-15 23:39:57'),
(5, 1, '😙', '2025-02-16', 32, '2025-02-16 09:54:02'),
(6, 1, '😛', '2025-02-16', 32, '2025-02-16 14:37:46'),
(7, 1, 'tes yaa', '2025-02-16', 13, '2025-02-16 14:57:01'),
(8, 7, 'nn', '2025-02-19', 32, '2025-02-19 08:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `history_email`
--

CREATE TABLE `history_email` (
  `id` int(11) NOT NULL,
  `notulensi_id` int(11) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `status_kirim` enum('berhasil','gagal') DEFAULT NULL,
  `timestamp_kirim` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_email`
--

INSERT INTO `history_email` (`id`, `notulensi_id`, `email`, `status_kirim`, `timestamp_kirim`) VALUES
(1, 1, '[\"jurandariyurianidu@gmail.com\"]', 'berhasil', '2025-02-15 14:29:10'),
(2, 2, '[\"jurandariyurianidu@gmail.com\"]', 'berhasil', '2025-02-15 15:39:18'),
(3, 3, '[\"wulandariyulianis360@gmail.com\",\"jurandariyurianidu@gmail.com\"]', 'berhasil', '2025-02-15 15:41:52'),
(4, 4, '[\"wulandariyulianis360@gmail.com\",\"jurandariyurianidu@gmail.com\",\"wulandariyulianis20@gmail.com\"]', 'berhasil', '2025-02-16 12:14:54'),
(5, 5, '[]', 'gagal', '2025-02-16 14:48:38'),
(6, 6, '[\"wulandariyulianis20@gmail.com\"]', 'berhasil', '2025-02-16 17:14:33'),
(7, 7, '[\"wulandariyulianis360@gmail.com\"]', 'berhasil', '2025-02-19 01:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_rapat`
--

CREATE TABLE `jadwal_rapat` (
  `id` int(11) NOT NULL,
  `Topik` varchar(50) NOT NULL,
  `agenda` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `status` enum('Belum Disetujui','Disetujui','Ditolak') DEFAULT 'Belum Disetujui',
  `user_id` int(11) NOT NULL,
  `alasan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_rapat`
--

INSERT INTO `jadwal_rapat` (`id`, `Topik`, `agenda`, `tanggal`, `waktu`, `lokasi`, `status`, `user_id`, `alasan`) VALUES
(9, '', 'kkk', '2025-02-11', '10:02:00', 'sksk', 'Disetujui', 13, NULL),
(10, '', 'sks', '2025-02-19', '20:00:00', 'kekk', 'Ditolak', 13, 'rapat rapat nya ada ada aja'),
(11, '', 'kkk', '2025-02-05', '18:22:00', 'mmm', 'Disetujui', 13, NULL),
(13, '', 'rapat ulala', '2025-02-10', '12:00:00', 'ssl', 'Disetujui', 13, NULL),
(16, '', 'lala', '2025-02-10', '12:33:00', 'alal', 'Ditolak', 13, 'bentrok'),
(17, '', 'makan', '2025-02-10', '12:59:00', 'alla', 'Disetujui', 13, NULL),
(18, '', 'test', '2025-02-10', '12:34:00', 'sll', 'Ditolak', 13, 'heni gilaa'),
(19, '', 'tes lagi', '2025-02-11', '19:59:00', 'sll', 'Ditolak', 13, 'llllllllllll'),
(20, '', ',,,', '2025-02-11', '20:00:00', 'sll', 'Disetujui', 13, NULL),
(21, '', 'coa', '2025-02-11', '12:23:00', 'ss', 'Disetujui', 13, NULL),
(22, '', 'test', '2025-01-28', '23:04:00', 'sll', 'Disetujui', 32, NULL),
(23, '', 'aksk', '2025-02-18', '12:02:00', 'ss', 'Disetujui', 32, NULL),
(24, '', 'aa', '2025-02-10', '23:04:00', 'sss', 'Ditolak', 32, 'sjjjs'),
(25, '', 'mencoba', '2025-02-11', '13:44:00', 'skkks', 'Ditolak', 32, 'nnnn'),
(26, '', 'tes saja', '2025-02-10', '18:20:00', 'akk', 'Disetujui', 32, 'nn'),
(27, '', 'tes saja', '2025-02-14', '15:52:00', 'akk', 'Ditolak', 9, 'hjjjj'),
(28, '', 'tes saja', '2025-02-14', '17:52:00', 'akk', 'Ditolak', 9, 'jjj'),
(32, '', '1.ak\r\n2.al', '2025-02-16', '21:39:00', 'mm', 'Disetujui', 13, NULL),
(33, 'mm', '1.kkk\r\n2.jjj', '2025-02-16', '20:54:00', 'mm', 'Disetujui', 9, NULL),
(34, '', '1.mm', '2025-02-16', '21:03:00', 'zoom', 'Ditolak', 13, 'ssss'),
(35, '', 'mm', '2025-02-16', '22:03:00', 'zoom', 'Ditolak', 13, 'jjj'),
(36, '', 'mm', '2025-02-11', '21:06:00', 'zoom', 'Ditolak', 13, 'jjjj'),
(37, '', 'mm', '2025-02-16', '22:06:00', 'm', 'Ditolak', 13, 'gg'),
(38, '', 'mm', '2025-02-16', '22:20:00', 'mm', 'Ditolak', 13, 'sss'),
(39, '', 'mm', '2025-02-16', '21:26:00', 'k', 'Ditolak', 13, 'jjj'),
(40, '', ',,', '2025-02-16', '23:27:00', 'k', 'Ditolak', 13, 'ssss'),
(41, '', 'mm', '2025-02-16', '22:33:00', 'mm', 'Ditolak', 13, 'nn'),
(42, 'nn', 'mm', '2025-02-11', '23:36:00', 'mm', 'Disetujui', 13, NULL),
(43, 'Tes', '1.mm', '2025-02-16', '22:40:00', 'aa', 'Ditolak', 13, 'hhhh'),
(44, 'mm', '1.akk\r\n2.ak', '2025-02-16', '23:43:00', 'aa', 'Ditolak', 13, 'hahaj'),
(45, 'hhhhd', 'sss', '2025-02-19', '08:37:00', 'ruangan aptika', 'Disetujui', 32, NULL),
(46, 'yyyyyy', 'gcytdudy', '2025-02-12', '12:51:00', 'gftcggf', 'Ditolak', 13, 'fggggg'),
(47, 'fffffffffff', 'yuftydtrd', '2025-02-01', '12:53:00', 'ihyugt', 'Ditolak', 13, 'JASJAJ'),
(48, 'bdfdczfsz', 'huvtrese', '2025-02-19', '13:51:00', 'kk', 'Ditolak', 13, 'HSBVDHSVFHVSH'),
(49, 'fgddgtbr', 'hjfytdtbnyhnfny', '2025-02-19', '15:51:00', 'hyubfvd', 'Ditolak', 13, 'JJ'),
(50, 'kkhjvfcdv', 'jj', '2025-02-19', '15:52:00', 'mmmm', 'Ditolak', 13, 'SSS'),
(51, 'SSS', 'SSS', '2025-02-19', '15:01:00', 'SS', 'Ditolak', 9, 'JJJJJ'),
(52, 'JHVJVHUV', 'HUVGHVBG', '2025-02-19', '13:05:00', 'JB', 'Ditolak', 9, 'BISMILLAH'),
(53, 'NJ HJGFB', 'GCGB', '2025-02-20', '14:02:00', 'akk', 'Ditolak', 9, 'nmmm'),
(54, 'DDD', 'AAA', '2025-02-19', '13:03:00', 'VGGG', 'Ditolak', 9, 'mmmm'),
(55, 'mencoba', 'aaa', '2025-02-19', '14:06:00', 'aaa', 'Ditolak', 13, 'jnn'),
(56, 'aaa', 'aaa', '2025-02-21', '15:06:00', 'zz', 'Belum Disetujui', 13, NULL),
(57, 'aaa', 'aaa', '2025-02-19', '14:06:00', 'dd', 'Belum Disetujui', 13, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notulensi`
--

CREATE TABLE `notulensi` (
  `notulensi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `partisipan` text NOT NULL,
  `agenda` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `Bidang` varchar(50) NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `partisipan_non_pegawai` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notulensi`
--

INSERT INTO `notulensi` (`notulensi_id`, `user_id`, `judul`, `partisipan`, `agenda`, `isi`, `Bidang`, `tanggal_dibuat`, `email`, `partisipan_non_pegawai`) VALUES
(1, 32, 'rapat wajib ', '1.wulan\r\n2.cindy\r\n3.intan', '1. Pembukaan\r\n2. Evaluasi Kegiatan Sebelumnya\r\n3. bb', '<p data-start=\"0\" data-end=\"630\">Agenda rapat wajib dimulai dengan <strong data-start=\"34\" data-end=\"47\">pembukaan</strong>, di mana moderator atau pimpinan rapat memberikan sambutan serta menyampaikan tujuan dan aturan rapat agar berjalan dengan tertib. Selanjutnya, dilakukan <strong data-start=\"202\" data-end=\"234\">evaluasi kegiatan sebelumnya</strong>, yang mencakup laporan progres dari setiap divisi atau tim, identifikasi kendala yang dihadapi, serta solusi atau langkah perbaikan yang telah atau perlu dilakukan. Setelah itu, masuk ke <strong data-start=\"422\" data-end=\"449\">pembahasan agenda utama</strong>, yang meliputi diskusi terkait proyek atau program yang sedang berjalan, perencanaan kegiatan mendatang, serta keputusan strategis yang harus diambil untuk kelancaran organisasi.</p>\r\n<p data-start=\"632\" data-end=\"1274\" data-is-last-node=\"\">Setelah agenda utama dibahas, rapat dilanjutkan dengan <strong data-start=\"687\" data-end=\"721\">rencana dan target selanjutnya</strong>, yang berisi penyusunan timeline kegiatan, pembagian tugas, penetapan deadline, serta identifikasi sumber daya yang dibutuhkan untuk mencapai target yang telah ditentukan. Kemudian, dibuka sesi <strong data-start=\"916\" data-end=\"945\">lain-lain dan tanya jawab</strong>, di mana peserta dapat menyampaikan saran, masukan, atau isu tambahan yang perlu didiskusikan. Rapat ditutup dengan <strong data-start=\"1062\" data-end=\"1075\">penutupan</strong>, yang berisi rangkuman hasil diskusi, pembagian tugas tindak lanjut, serta informasi terkait pertemuan selanjutnya agar semua peserta memiliki pemahaman yang jelas mengenai langkah-langkah ke depan.</p>', 'aptika', '2025-02-15', NULL, '1.heni\r\n2.mahira'),
(2, 7, 'rapat wajib ', '1.skk\r\n2m', '1.nsk\r\n2.sm', 'Dalam era digital saat ini, teknologi berkembang pesat dan mempengaruhi hampir semua aspek kehidupan manusia. Salah satu perkembangan yang paling mencolok adalah dalam dunia komunikasi dan informasi. Dengan adanya internet dan perangkat digital seperti smartphone, informasi kini dapat diakses dengan mudah dan cepat. Hal ini memungkinkan individu untuk terhubung dengan orang lain di berbagai belahan dunia tanpa batasan waktu dan tempat, yang pada gilirannya mengubah cara orang bekerja, belajar, dan berinteraksi. Pengaruh teknologi ini tidak hanya terbatas pada komunikasi, tetapi juga merambah ke sektor lain seperti pendidikan, bisnis, dan hiburan, yang semakin digital dan terhubung.\r\n\r\nNamun, meskipun teknologi membawa banyak manfaat, ada juga tantangan yang harus dihadapi, terutama dalam hal keamanan data dan privasi. Dengan semakin banyaknya informasi pribadi yang dibagikan melalui platform digital, ancaman terhadap privasi menjadi semakin nyata. Serangan siber, penyalahgunaan data pribadi, dan pencurian identitas adalah beberapa masalah yang semakin sering ditemui. Oleh karena itu, penting bagi setiap individu dan organisasi untuk lebih berhati-hati dalam melindungi data dan informasi yang mereka miliki. Penggunaan teknologi yang bijak dan penerapan langkah-langkah keamanan yang tepat dapat membantu mengurangi risiko yang muncul seiring dengan pesatnya perkembangan dunia digital.', 'Statistik dan Persandian', '2025-02-15', NULL, 'ss\r\ns'),
(3, 6, 'teknologi ', '1.rara\r\n2.lala', '1.perkembangan \r\n2.evolusi', 'Teknologi telah membawa perubahan besar dalam berbagai industri, termasuk dalam dunia pendidikan. Dengan adanya platform pembelajaran daring, siswa dan mahasiswa kini dapat mengakses materi pelajaran kapan saja dan di mana saja. Teknologi memungkinkan metode pengajaran yang lebih fleksibel dan interaktif, seperti penggunaan video, simulasi, dan aplikasi yang mendukung pemahaman materi secara lebih mendalam. Selain itu, dengan adanya forum diskusi online, kolaborasi antara siswa dan pengajar juga dapat berlangsung dengan lebih efisien. Perkembangan ini tentunya membuka peluang bagi pendidikan yang lebih inklusif dan merata, tanpa terhalang oleh lokasi atau keterbatasan fisik.\r\n\r\nNamun, tantangan yang muncul seiring dengan digitalisasi pendidikan adalah kesenjangan akses teknologi antara daerah atau individu dengan sumber daya terbatas. Meskipun teknologi dapat mempercepat penyebaran pengetahuan, tidak semua orang memiliki akses yang sama terhadap perangkat atau koneksi internet yang memadai. Hal ini dapat memperburuk ketidaksetaraan dalam pendidikan, di mana beberapa siswa mungkin tertinggal karena keterbatasan akses tersebut. Oleh karena itu, penting untuk memperhatikan upaya pemerataan akses teknologi dan memberikan solusi agar pendidikan berbasis teknologi bisa dinikmati oleh semua kalangan secara adil.', 'IKP', '2025-02-15', NULL, ''),
(4, 32, 'rapat wajib ', '1.wulan\r\n2.intan\r\n3.heni', '1.evaluasi\r\n2.keuangan \r\n3.laporan kerja', '<p data-start=\"895\" data-end=\"1273\">Rapat wajib ini bertujuan untuk mengevaluasi kegiatan yang telah berjalan serta merumuskan strategi untuk pelaksanaan agenda selanjutnya. Dalam sesi pertama, dilakukan analisis terhadap keberhasilan maupun kendala yang dihadapi pada kegiatan sebelumnya. Evaluasi ini penting untuk mengidentifikasi aspek yang perlu diperbaiki agar kegiatan mendatang dapat berjalan lebih baik.</p>\r\n<p data-start=\"1275\" data-end=\"1635\">Selanjutnya, rapat akan membahas rencana kegiatan ke depan, termasuk penentuan jadwal, pembagian tugas, serta anggaran yang diperlukan. Dalam sesi ini, setiap anggota diharapkan dapat menyampaikan ide dan masukan agar perencanaan menjadi lebih matang. Keuangan juga menjadi salah satu fokus utama untuk memastikan penggunaan dana yang transparan dan efektif.</p>\r\n<p data-start=\"1637\" data-end=\"2020\" data-is-last-node=\"\">Terakhir, pembagian tugas dan tanggung jawab akan didiskusikan untuk memastikan seluruh anggota memahami peran masing-masing. Dengan koordinasi yang baik, diharapkan seluruh agenda dapat berjalan lancar. Rapat akan ditutup dengan sesi tanya jawab atau diskusi mengenai hal-hal lain yang belum terbahas, guna memastikan semua aspek penting telah dipertimbangkan sebelum rapat selesai.</p>', 'aptika', '2025-02-16', NULL, '1.heni\r\n2.mahira'),
(5, 32, 'aa', 'aa', 'mm', '<p>aa</p>', 'aptika', '2025-02-16', NULL, 'aa'),
(6, 32, 'rapat bulanan', '1.laporan\r\n2.kerjasama', '1.raisya\r\n2.rama', 'Rapat bulanan merupakan kegiatan rutin yang penting untuk menjaga komunikasi dan koordinasi antar anggota tim atau divisi dalam sebuah organisasi. Tujuan utama dari rapat ini adalah untuk mengevaluasi pencapaian yang telah dilakukan dalam sebulan terakhir, mengidentifikasi masalah yang muncul, dan merencanakan langkah-langkah yang perlu diambil untuk mencapai tujuan di bulan berikutnya. Dalam rapat bulanan, setiap anggota tim biasanya akan melaporkan progres dari tugas yang telah diberikan, serta menyampaikan hambatan atau tantangan yang mereka hadapi. Hal ini memungkinkan pimpinan dan tim untuk segera memberikan solusi atau dukungan yang diperlukan agar pencapaian target dapat lebih optimal.\r\n\r\nSelain evaluasi dan perencanaan, rapat bulanan juga menjadi momen untuk mempererat hubungan antar anggota tim. Diskusi yang terbuka dan konstruktif akan membantu membangun pemahaman bersama mengenai visi dan misi organisasi, serta mendorong kolaborasi yang lebih erat. Dalam rapat ini, penting juga untuk memberikan kesempatan kepada setiap anggota tim untuk menyampaikan ide atau inovasi yang dapat meningkatkan kinerja atau efisiensi kerja. Dengan demikian, rapat bulanan tidak hanya berfungsi sebagai sarana evaluasi, tetapi juga sebagai platform untuk pembelajaran dan pengembangan bersama.', 'aptika', '2025-02-16', NULL, '1.kk'),
(7, 32, 'rapat wajib ', '1,hssh', '1.rapat saja\r\n2.rapayt ', '<p>shhhsjhhhjhhh</p>', 'aptika', '2025-02-19', NULL, '1.shhj');

-- --------------------------------------------------------

--
-- Table structure for table `riwayatnotulensi`
--

CREATE TABLE `riwayatnotulensi` (
  `riwayat_id` int(11) NOT NULL,
  `notulensi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayatnotulensi`
--

INSERT INTO `riwayatnotulensi` (`riwayat_id`, `notulensi_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(6, 5),
(7, 6),
(8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `Bidang` varchar(50) NOT NULL,
  `profil_foto` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tanggal_lahir` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `nama`, `nip`, `email`, `password`, `role`, `Bidang`, `profil_foto`, `alamat`, `jabatan`, `tanggal_lahir`, `created_at`, `updated_at`) VALUES
(3, 'wulan dari ', 'John ', '123456789', 'admin@example.com', '$2y$10$bt4.BEmdIhnRDA3GANoKeeIiyFy6FgKuhWEF3oGI1mNGglFfdCg3u', 'pegawai', 'Statistik dan Persandian', '1739929142_84f93bcee3ee1350670f.png', 'Jl. Merdeka No. 123, Jakarta', 'korea', '', '2025-01-09 15:02:06', '2025-02-18 18:39:02'),
(6, 'wulan saja', 'wulandari yulianis', '18679202938390', 'lala@gmail.com', '$2y$10$Sbofb2lg7PyOSv1D1/vCauYJmgWsYc62iaww/yz9aMuZHwdpRyscG', 'notulensi', 'IKP', '1738317012_28f82e9f4a84a03b1352.png', NULL, 'sek', '', '2025-01-09 08:02:18', '2025-02-19 03:13:43'),
(7, 'lala', 'lala', '123456789123456789', 'lala1@gmail.com', '$2y$10$tBSYxTpvfWjIlSkqSZ.7TeAQp2RvMqDg2J91d0vUGxaieUvPIv61a', 'notulensi', 'Aptika', NULL, NULL, '', '', '2025-01-09 08:16:16', '2025-01-30 08:15:20'),
(9, 'lili', 'wulandari yulianis', '123456780123456789', 'bismillah@gmail.com', '$2y$10$GNfd6zIA4kK/7vX47gN7eepuS.AXjm5tSpBgx7YvxRDjgGubdAS0K', 'admin', '', '7 (1).jpg', 'jalan  saja', 'Sekretaris', '2003-07-09', '2025-01-09 19:06:34', '2025-02-16 11:12:59'),
(13, 'jaja', 'jungwon', '123456788987654324', 'jaja@gmail.com', '$2y$10$nVk3.ULQ.f2qJcwl.zo9p.3ZmVs8RESB.SYe8GvwHZ4Y.pEHR.TlO', 'pegawai', 'IKP', 'pegawai.png', NULL, 'korea', '', '2025-01-13 00:53:10', '2025-01-30 22:12:25'),
(18, 'notulensi_user18', 'Nama Notulensi 18', '12345678918', 'notulensi_user18@example.com', 'password_enkripsi18', 'notulensi', 'Administrasi', '', 'Alamat Notulensi 18', 'Notulensi', '1998-08-18', '2025-01-16 02:28:25', '2025-01-16 17:16:49'),
(26, 'notulensi', 'alhamdulilla', '345678909876789376', 'notulensi@gmail.com', '$2y$10$ZhNj131GHHBnlqCvbB3.bOR13E/V13x3i1tumnFZPNg.YhqScDCnq', 'notulensi', '', 'image.png\r\n', NULL, '', '', '2025-01-15 19:36:45', '2025-01-16 08:11:16'),
(32, 'dadang', 'cindy arwinda ', '098765432234567892', 'dadang@gmail.com', '$2y$10$FKo1RqxUsHWcoWzbk5ZZae9C4Al32xjQuyf99kyXR4CMMYtDOyMVC', 'notulensi', 'aptika', '2.jpg', NULL, 'Sekretaris', '', '2025-01-17 02:26:42', '2025-02-11 07:05:41'),
(40, 'cindy', 'cindy arwinda putry', '123456788987654259', 'cindy@gmail.com', '$2y$10$fFtsHB1wzUtGMaBUM0/c3uv.EFy0QXZgTj6.q2gKaPtCdUVYHNMqG', 'notulensi', 'IKP', '2.jpg', NULL, 'Sekretaris', '', '2025-01-20 22:07:14', '2025-01-26 17:04:23'),
(56, 'fafa', '', '123456789023749256', 'fafa0@gmail.com', '$2y$10$XJUEmFJrojPtC9R4cycKnuDoJCBxq3y6dseNmJboMocJb8tipDMyq', 'pegawai', 'APTIKA', NULL, NULL, '', '', '2025-01-30 22:24:03', '2025-01-30 22:24:03'),
(59, 'lili', 'intan salma denaidy', '123456788987654328', 'intan@gmail.com', '$2y$10$KdrB3PXMBnKrCd0IAlsjCOx6/gTCziLDwaQI62G1iUdtOcCjdJqZS', 'notulensi', 'IKP', '1739929188_5c101946dc4cbe7a3245.jpg', NULL, 'korea', '', '2025-02-18 18:39:48', '2025-02-18 18:39:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD PRIMARY KEY (`dokumentasi_id`),
  ADD KEY `notulensi_id` (`notulensi_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `notulensi_id` (`notulensi_id`),
  ADD KEY `fk_feedback_user` (`user_id`);

--
-- Indexes for table `history_email`
--
ALTER TABLE `history_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notulensi_id` (`notulensi_id`);

--
-- Indexes for table `jadwal_rapat`
--
ALTER TABLE `jadwal_rapat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jadwal_rapat_user` (`user_id`);

--
-- Indexes for table `notulensi`
--
ALTER TABLE `notulensi`
  ADD PRIMARY KEY (`notulensi_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `riwayatnotulensi`
--
ALTER TABLE `riwayatnotulensi`
  ADD PRIMARY KEY (`riwayat_id`),
  ADD KEY `notulensi_id` (`notulensi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  MODIFY `dokumentasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `history_email`
--
ALTER TABLE `history_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jadwal_rapat`
--
ALTER TABLE `jadwal_rapat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `notulensi`
--
ALTER TABLE `notulensi`
  MODIFY `notulensi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `riwayatnotulensi`
--
ALTER TABLE `riwayatnotulensi`
  MODIFY `riwayat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD CONSTRAINT `dokumentasi_ibfk_1` FOREIGN KEY (`notulensi_id`) REFERENCES `notulensi` (`notulensi_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`notulensi_id`) REFERENCES `notulensi` (`notulensi_id`),
  ADD CONSTRAINT `fk_feedback_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `history_email`
--
ALTER TABLE `history_email`
  ADD CONSTRAINT `history_email_ibfk_1` FOREIGN KEY (`notulensi_id`) REFERENCES `notulensi` (`notulensi_id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_rapat`
--
ALTER TABLE `jadwal_rapat`
  ADD CONSTRAINT `fk_jadwal_rapat_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `notulensi`
--
ALTER TABLE `notulensi`
  ADD CONSTRAINT `notulensi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `riwayatnotulensi`
--
ALTER TABLE `riwayatnotulensi`
  ADD CONSTRAINT `riwayatnotulensi_ibfk_1` FOREIGN KEY (`notulensi_id`) REFERENCES `notulensi` (`notulensi_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
