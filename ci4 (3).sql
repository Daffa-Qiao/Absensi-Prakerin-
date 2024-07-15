-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jul 2024 pada 10.56
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nim_nis` varchar(25) NOT NULL,
  `jenis_user` varchar(100) DEFAULT NULL,
  `instansi_pendidikan` varchar(25) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `checkin_time` varchar(25) NOT NULL,
  `checkout_time` varchar(25) DEFAULT NULL,
  `foto_profile` varchar(255) NOT NULL,
  `foto_absen` varchar(50) NOT NULL,
  `waktu_absen` date NOT NULL DEFAULT current_timestamp(),
  `member_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `instansi`
--

CREATE TABLE `instansi` (
  `id` int(255) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `foto_instansi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `instansi`
--

INSERT INTO `instansi` (`id`, `nama_instansi`, `foto_instansi`) VALUES
(1, 'SMK BINA MANDIRI', '2023.12.28 - 08.44.10.jpeg'),
(2, 'SMKN 2 JAKARTA', '2023.12.28 - 08.44.44.jpeg'),
(3, 'UNIVERSITAS TERBUKA', '2023.12.28 - 08.45.22.jpeg'),
(4, 'UNIVERSITAS BINA SARANA INFORMATIKA', '2024.01.18 - 16.29.01.jpeg'),
(5, 'PERGURUAN TINGGI NEGARA KEMENHUB', '2023.12.28 - 08.48.31.jpeg'),
(6, 'SMK TRIMULIA', '2024.01.02 - 10.22.34.jpeg'),
(7, 'SMKN 2 JKT48', '2024.01.02 - 12.48.18.jpeg'),
(8, 'UNIVERSITAS NEGERI JAKARTA', '2024.01.18 - 16.26.48.jpeg'),
(9, 'UNIVERSITAS BINA NUSANTARA', '2024.03.01 - 15.46.34.jpeg'),
(10, 'SMK MUHAMMADIYAH 4 JAKARTA', '2024.03.01 - 15.48.36.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(5) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nim_nis` varchar(25) NOT NULL,
  `jenis_user` varchar(100) DEFAULT NULL,
  `instansi_pendidikan` varchar(25) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `kegiatan` text NOT NULL,
  `foto_profile` varchar(255) NOT NULL,
  `waktu_laporan` date NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `member_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `member_id` int(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nim_nis` varchar(20) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Male','Female') NOT NULL,
  `jenis_user` varchar(100) DEFAULT NULL,
  `instansi_pendidikan` varchar(255) NOT NULL COMMENT 'Student/College Student',
  `nama_instansi` varchar(255) NOT NULL,
  `level` enum('Super Admin','Admin','User') DEFAULT 'User',
  `token` varchar(255) DEFAULT NULL,
  `is_verifikasi` enum('yes','no','pending') NOT NULL DEFAULT 'no',
  `tanggal_bergabung` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Baik','Teguran Lisan','Perjanjian Tertulis','Terminate') NOT NULL DEFAULT 'Baik',
  `nama_pembimbing` varchar(255) NOT NULL,
  `no_pembimbing` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`member_id`, `username`, `password`, `email`, `nama_lengkap`, `nim_nis`, `no_hp`, `foto`, `jenis_kelamin`, `jenis_user`, `instansi_pendidikan`, `nama_instansi`, `level`, `token`, `is_verifikasi`, `tanggal_bergabung`, `updated_at`, `status`, `nama_pembimbing`, `no_pembimbing`) VALUES
(39, 'daffa.reivan', '12345678', 'daffa.sweet100@gmail.com', 'Daffa Reivan', '141141', '085894861350', 'profile.png', 'Male', 'Student', 'School', 'SMKN 1 KOTA BEKASI', 'Super Admin', NULL, 'yes', '2024-07-15', '2024-07-15 07:06:42', 'Baik', 'Chelsea Ramadhani', '085714108993');

--
-- Trigger `member`
--
DELIMITER $$
CREATE TRIGGER `set_jenis_user_trigger` BEFORE UPDATE ON `member` FOR EACH ROW BEGIN
    IF NEW.instansi_pendidikan = 'Sekolah' THEN
        SET NEW.jenis_user = 'Siswa';
    ELSEIF NEW.instansi_pendidikan = 'Universitas' THEN
        SET NEW.jenis_user = 'Mahasiswa';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_insert` BEFORE INSERT ON `member` FOR EACH ROW BEGIN
	IF NEW.instansi_pendidikan = 'Sekolah' THEN
    	SET NEW.jenis_user = 'Siswa';
	ELSEIF NEW.instansi_pendidikan = 'Universitas' THEN
    	SET NEW.jenis_user = 'Mahasiswa';
	END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userAbsensi` (`member_id`);

--
-- Indeks untuk tabel `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `userLaporan` (`member_id`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=916;

--
-- AUTO_INCREMENT untuk tabel `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `userAbsensi` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `userLaporan` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
