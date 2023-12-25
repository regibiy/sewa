-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Des 2023 pada 10.03
-- Versi server: 8.0.35-0ubuntu0.22.04.1
-- Versi PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sewa_lapangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_pegawai`
--

CREATE TABLE `akun_pegawai` (
  `id` tinyint NOT NULL,
  `username` varchar(60) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `role` varchar(30) NOT NULL,
  `status_akun` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `akun_pegawai`
--

INSERT INTO `akun_pegawai` (`id`, `username`, `nama`, `password`, `email`, `jenis_kelamin`, `no_telp`, `role`, `status_akun`) VALUES
(1, 'owner', 'Adrianus Rizki', '123', 'adririzki@gmail.com', 'Laki-Laki', '0814123454321', 'Owner', 'Aktif'),
(2, 'kiko', 'kiko enak twd', '123', 'kiko@gmail.com', 'Laki-Laki', '008912', 'Admin', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_pengguna`
--

CREATE TABLE `akun_pengguna` (
  `id` smallint NOT NULL,
  `username` varchar(60) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `jenis_kelamin` char(9) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `status_member` varchar(10) NOT NULL,
  `status_akun` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `akun_pengguna`
--

INSERT INTO `akun_pengguna` (`id`, `username`, `nama`, `password`, `email`, `jenis_kelamin`, `no_telp`, `status_member`, `status_akun`) VALUES
(2, 'asdf', 'asf', 'asdf', 'asdf@gmail.com', 'Perempuan', '123', 'Non-Member', 'Non-Aktif'),
(5, 'adrizki', 'adrianus rizki', '123', 'rizki@gmail.com', 'Laki-Laki', '08991332811', 'Non-Member', 'Aktif'),
(7, 'fery', 'Feryanto', '123', 'asdf@gmail.com', 'Laki-Laki', '1212', 'Non-Member', 'Aktif'),
(8, 'andre', 'andre lantang', '123', 'andre@gmail.com', 'Laki-Laki', '12345', 'Non-Member', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `no_transaksi` int NOT NULL,
  `tanggal_booking` date NOT NULL,
  `kode_booking` char(6) NOT NULL,
  `id_user` int NOT NULL,
  `lapangan` int NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `jadwal` varchar(5) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status_booking` varchar(15) NOT NULL,
  `status_member_when_book` varchar(10) NOT NULL,
  `no_trans_member` int DEFAULT NULL,
  `bukti_bayar` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id` tinyint NOT NULL,
  `judul` varchar(60) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `informasi`
--

INSERT INTO `informasi` (`id`, `judul`, `isi`) VALUES
(3, 'Petunjuk Booking', '1. Anda dipersilakan login terlebih dahulu. Jika belum memiliki akun, silakan mendaftar terlebih dahulu.<br />\r\n<br />\r\n2. Pilih Booking, kemudian mengisi form dan konfirmasi.<br />\r\n<br />\r\n3. Pilih Data Sewa. Jika status Anda non-member, Anda akan diminta meng-upload bukti pembayaran dan kemudian menunggu konfirmasi admin.<br />\r\n<br />\r\n4. Setelah Anda dikonfirmasi admin, Anda diminta mencetak kode booking yang terdapat pada tombol Aksi pada Data Sewa dan menunjukkan kode booking tersebut kepada bagian Administrator yang berada di lokasi.'),
(4, 'Petunjuk Beli Member', '1. Anda dipersilakan login terlebih dahulu. Jika belum memiliki akun, silakan mendaftar terlebih dahulu.<br />\r\n<br />\r\n2. Pilih Member, kemudian pilih paket member yang ingin Anda beli. Selanjutnya Anda akan diminta meng-upload bukti pembayaran atas paket member yang dipilih dan konfirmasi.<br />\r\n<br />\r\n3. Status member Anda akan otomatis aktif.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` tinyint NOT NULL,
  `sesi` varchar(5) NOT NULL,
  `hari` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga` mediumint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `sesi`, `hari`, `harga`) VALUES
(14, 'pagi', 'Monday', 30000),
(15, 'siang', 'Monday', 35000),
(16, 'malam', 'Monday', 40000),
(17, 'pagi', 'Tuesday', 30000),
(18, 'siang', 'Tuesday', 35000),
(19, 'malam', 'Tuesday', 40000),
(20, 'pagi', 'Wednesday', 30000),
(21, 'siang', 'Wednesday', 35000),
(22, 'malam', 'Wednesday', 40000),
(23, 'pagi', 'Thursday', 30000),
(24, 'siang', 'Thursday', 35000),
(25, 'malam', 'Thursday', 40000),
(26, 'pagi', 'Friday', 30000),
(27, 'siang', 'Friday', 35000),
(28, 'malam', 'Friday', 40000),
(32, 'pagi', 'Saturday', 40000),
(33, 'siang', 'Saturday', 40000),
(34, 'malam', 'Saturday', 40000),
(35, 'pagi', 'Sunday', 40000),
(36, 'siang', 'Sunday', 40000),
(37, 'malam', 'Sunday', 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapangan`
--

CREATE TABLE `lapangan` (
  `id` tinyint NOT NULL,
  `nama_lapangan` varchar(30) NOT NULL,
  `status_lapangan` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `lapangan`
--

INSERT INTO `lapangan` (`id`, `nama_lapangan`, `status_lapangan`) VALUES
(1, 'Lapangan 1', 'Aktif'),
(7, 'Lapangan 2', 'Aktif'),
(8, 'Lapangan 3', 'Aktif'),
(9, 'Lapangan 4', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id` tinyint NOT NULL,
  `nama_paket` varchar(30) NOT NULL,
  `hari` varchar(30) NOT NULL,
  `jadwal` varchar(5) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int NOT NULL,
  `status_member` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id`, `nama_paket`, `hari`, `jadwal`, `keterangan`, `harga`, `status_member`) VALUES
(1, 'Paket Member 1', 'Senin-Jumat', 'pagi', '3 Jam Setiap Booking, 4 Kali Pertemuan Selama Satu Bulan', 300000, 'Aktif'),
(3, 'Paket Member 2', 'Senin-Jumat', 'siang', '3 Jam Setiap Booking, 4 Kali Pertemuan Selama Satu Bulan', 350000, 'Aktif'),
(4, 'Paket Member 3', 'Senin-Jumat', 'malam', '3 Jam Setiap Booking, 4 Kali Pertemuan Selama Satu Bulan', 400000, 'Aktif'),
(5, 'Paket Member 4', 'Sabtu-Minggu', 'semua', '3 Jam Setiap Booking, 4 Kali Pertemuan Selama Satu Bulan', 400000, 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id` tinyint NOT NULL,
  `nama_bank` varchar(15) NOT NULL,
  `nama_pemilik` varchar(60) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `status` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id`, `nama_bank`, `nama_pemilik`, `no_rekening`, `status`) VALUES
(1, 'BCA', 'Vierra', '12345678', 'Aktif'),
(3, 'Mandiri', 'Vierra', '87654321', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_member`
--

CREATE TABLE `transaksi_member` (
  `id` int NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `no_transaksi` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_user` int NOT NULL,
  `paket_member` tinyint NOT NULL,
  `berlaku_sampai` date NOT NULL,
  `status_transaksi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bukti_bayar` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun_pegawai`
--
ALTER TABLE `akun_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akun_pengguna`
--
ALTER TABLE `akun_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_member`
--
ALTER TABLE `transaksi_member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun_pegawai`
--
ALTER TABLE `akun_pegawai`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `akun_pengguna`
--
ALTER TABLE `akun_pengguna`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `no_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28112303;

--
-- AUTO_INCREMENT untuk tabel `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi_member`
--
ALTER TABLE `transaksi_member`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
