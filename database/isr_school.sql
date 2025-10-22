-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2025 at 05:32 PM
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
-- Database: `isr_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('superadmin','admin','editor') DEFAULT 'admin',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `full_name`, `email`, `role`, `last_login`, `created_at`) VALUES
(1, '4dm1n', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator Utama', 'admin@isr.sch.id', 'superadmin', '2025-10-21 18:10:22', '2025-10-20 02:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(500) NOT NULL,
  `category` enum('tk','sd','smp','sma') NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `description`, `image_path`, `category`, `status`, `created_by`, `created_at`) VALUES
(2, 'Siluman Buaya .spd', 'Saintis', 'uploads/gallery/hacker-68f6805197f4f.png', 'smp', 'active', 1, '2025-10-20 18:32:49'),
(3, 'Guru Backend Engineer', 'Programmer', 'uploads/gallery/guru4-68f68da09ea60.jpg', 'sma', 'active', 1, '2025-10-20 19:29:36'),
(4, 'Frontend Engineer', 'Programmer', 'uploads/gallery/guru6-68f68ded9e5a3.jpg', 'smp', 'active', 1, '2025-10-20 19:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'umum',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `author_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `title`, `slug`, `excerpt`, `content`, `image_path`, `category`, `status`, `author_id`, `created_at`, `updated_at`) VALUES
(2, 'Cara Menjadi Youtuber', 'bagaimana-cara-menjadi-youtuber', 'Youtuber adalah sesuatu yang harus dibanggakan jika anda pengangguran', 'Disini adalah konten mnejadi youtuber sehingga anda menjadi toyebisadoio sjadk sjhbas jkashd dkfjskdf as,djbaks\r\nasdjabskd js bkjs kajsdk aksjda asd asads gdfg dfg asd asd afd fs', 'uploads/kegiatan/announcementketakwaan-68f6cd0f16d94.jpg', 'umum', 'active', 1, '2025-10-21 00:00:15', NULL),
(3, 'Cara Menjadi Dosen', 'bagaimana-cara-menjadi-dosem', 'Youtuber adalah sesuatu yang harus dibanggakan jika anda pengangguran', 'Wadas kampoengan', 'uploads/kegiatan/announcementpenguasaan-68f6cd715e019.png', 'berita', 'active', 1, '2025-10-21 00:01:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_foto`
--

CREATE TABLE `kegiatan_foto` (
  `id` int(11) NOT NULL,
  `kegiatan_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan_foto`
--

INSERT INTO `kegiatan_foto` (`id`, `kegiatan_id`, `image_path`, `created_at`) VALUES
(1, 2, 'uploads/kegiatan/pensi-68f6cd0f1accb.jpg', '2025-10-21 00:00:15'),
(2, 3, 'uploads/kegiatan/guru4-68f6cd7164427.jpg', '2025-10-21 00:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `render_art`
--

CREATE TABLE `render_art` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(500) DEFAULT NULL,
  `category` enum('eksterior','interior','3d_modeling') NOT NULL DEFAULT 'eksterior',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `render_art`
--

INSERT INTO `render_art` (`id`, `title`, `description`, `image_path`, `category`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Patung Pahat', 'patung ini bisa di perjual belikan sekitar 50jt-100jt karena langka', 'uploads/render/screenshot-2025-09-25-052406-68f71bc5e5998.png', '3d_modeling', 'active', 1, '2025-10-21 05:36:05', NULL),
(2, 'Makrifat Tuhan', 'Tuhan adalah konsep tentang entitas tertinggi, pencipta, dan pengatur alam semesta yang diyakini mayoritas agama. Konsep ini bervariasi antaragama, ada yang memandang-Nya Maha Esa dan sempurna seperti dalam Islam, atau sebagai Trinitas seperti dalam agama Kristen, atau sebagai dewa-dewa yang mengendalikan alam semesta seperti dalam politeisme. Berbagai filsafat mencoba membuktikan keberadaan-Nya melalui akal, alam, tujuan, dan moralitas. \r\n\r\nKonsep Tuhan berdasarkan agama:\r\n\r\nIslam: Allah adalah Tuhan yang Maha Esa, tidak memiliki sekutu, tidak beranak dan tidak diperanakkan, serta tidak ada yang setara dengan-Nya. Penekanan utamanya adalah pada Tauhid (keesaan Allah), dan konsepnya menekankan sifat transendensi (jauh dari makhluk) dan kemurnian (kesucian). \r\n\r\nKristen: Konsepnya adalah Trinitas, yaitu satu Tuhan dalam tiga pribadi: Bapa, Anak (Yesus), dan Roh Kudus. \r\n\r\nAgama Hindu: Terdapat dua konsep utama, yaitu monisme (satu Tuhan yang tidak memiliki bagian atau atribut) dan politeisme (pemujaan banyak dewa seperti Wisnu, Siwa, dll.). Ada juga pandangan yang menggabungkan keduanya. \r\n\r\nPoliteisme: Percaya pada banyak dewa yang masing-masing mengendalikan aspek tertentu dari alam semesta. \r\nBukti keberadaan Tuhan\r\n\r\nFilsafat: Menggunakan berbagai argumen logis untuk membuktikan keberadaan Tuhan. \r\n\r\nArgumen ontologis: Berbasis pada akal manusia. \r\n\r\nArgumen kosmologis: Berbasis pada fenomena alam. \r\n\r\nArgumen teleologis: Berbasis pada tujuan atau desain alam. \r\n\r\nArgumen moral: Berbasis pada moralitas. \r\n\r\nAgama: Banyak argumen ditemukan dalam kitab suci dan tradisi agama. Misalnya, dalam Islam, hujan dan alam adalah bukti keberadaan Allah SWT, yang memiliki sifat Al-Waali (Maha Mengatur dan Melindungi). \r\nSifat Tuhan\r\n\r\nTransendensi: Konsep bahwa Tuhan jauh dari jangkauan manusia, tidak terbayangkan oleh akal\r\n. \r\nImanen: Konsep bahwa Tuhan hadir dan terlibat dalam kehidupan manusia, baik di dunia maupun di akhirat. \r\n\r\nKesempurnaan: Tuhan adalah wujud yang sempurna, abadi, dan tanpa cela. \r\nBelas Kasih: Tuhan memiliki sifat kasih, adil, bijaksana, dan penyayang. \r\nPerbedaan dan tantangan\r\nPerbedaan konsep: Perbedaan konsep Tuhan di berbagai agama dan bahkan dalam satu agama menjadi sumber perdebatan teologis. \r\nKeterbatasan akal: Meskipun ada upaya untuk membuktikan Tuhan secara rasional, sebagian besar agama mengakui keterbatasan akal manusia untuk memahami zat-Nya yang tak terbatas. \r\nAnakronisme: Memaksakan konsep Tuhan dari masa lalu ke masa kini dapat menimbulkan kesalahpahaman dan tidak relevan bagi generasi modern.', 'uploads/render/capturenux-2012-08-29-11-24-32-68f7cc559e3da.jpg', 'interior', 'active', 1, '2025-10-21 18:09:25', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `kegiatan_foto`
--
ALTER TABLE `kegiatan_foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`);

--
-- Indexes for table `render_art`
--
ALTER TABLE `render_art`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kegiatan_foto`
--
ALTER TABLE `kegiatan_foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `render_art`
--
ALTER TABLE `render_art`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `kegiatan_foto`
--
ALTER TABLE `kegiatan_foto`
  ADD CONSTRAINT `fk_kegiatan_foto` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `render_art`
--
ALTER TABLE `render_art`
  ADD CONSTRAINT `render_art_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
