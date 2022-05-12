-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Bulan Mei 2022 pada 18.03
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `world_lib`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`) VALUES
(1, 'karisaz', 'karisaz@gmail.com', '2573678c74e2db5725295d0149c1be1c');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(3) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tahun` int(4) NOT NULL,
  `jml_unduhan` int(15) NOT NULL,
  `bahasa` varchar(20) NOT NULL,
  `book_file` varchar(500) NOT NULL,
  `kd_penerbit` int(3) NOT NULL,
  `kd_penulis` int(3) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0',
  `status_buku` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `tahun`, `jml_unduhan`, `bahasa`, `book_file`, `kd_penerbit`, `kd_penulis`, `is_delete`, `status_buku`) VALUES
(2001, 'The Man', 2002, 1, 'Indonesia', '1171-2309-1-SP.docx', 301, 201, b'0', 0),
(20002, 'The Girl', 2003, 2, 'English', 'ACC_Kel11_Modul6 (1).docx', 301, 201, b'0', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama`, `alamat`, `is_delete`) VALUES
(301, 'Elexmedia Komputindo', 'Jakarta, Indonesia', b'0'),
(302, 'Andi Publisher', 'Yogyakarta, Indonesia', b'0'),
(303, 'Gagas Media', 'Jakarta, Indonesia', b'0'),
(304, 'Grasindo', 'Jakarta, Indonesia', b'0'),
(305, 'Warner Business Books', 'Manhattan, NYC', b'0'),
(306, 'HarperOne', 'San Francisco, California', b'0'),
(312, 'CERC', 'Semarang, Indonesia', b'1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `umur` int(3) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama`, `umur`, `is_delete`) VALUES
(201, 'Mark Manson', 37, b'0'),
(202, 'Diana Rikasari', 36, b'0'),
(203, 'Robert T. Kiyosaki', 70, b'0'),
(204, 'Jerome Polin', 23, b'0'),
(205, 'John C. Maxwell', 74, b'0'),
(206, 'Tere Liye', 42, b'0'),
(207, 'Andrea Hirata', 54, b'0'),
(208, 'Michelle Obama', 57, b'1'),
(220, 'Scarlet', 9, b'1'),
(221, 'Carissa', 9, b'0'),
(222, 'Dhia Sezi', 100, b'0'),
(223, 'qwerty', 12, b'1'),
(224, 'wdwe', 2222, b'1'),
(225, 'qe22', 33, b'0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(2, 'karisa', 'kz@gmail.com', '9aa6e5f2256c17d2d430b100032b997c'),
(3, 'karisa01', 'karisa01@gmail.com', 'c96023394e438e4fb52221316ea873d6'),
(4, 'karisa', 'karisa@gmail.com', '9de550a449385ec47e9da763fdb9c952'),
(6, 'karisa1', 'karisa1@gmail.com', 'da40022a70e75f58bd20196aa4f9edab'),
(7, 'karisa03', 'karisa03@gmail.com', '2b107204eb686c6f6b311ed80429d43c'),
(8, 'karisa05', 'karisa05@gmail.com', 'd4e091f77c367482b4d0d6bc4503ca0a'),
(9, 'karisa002', 'karisa002@gmail.com', '491d14afc8d023908cee11231f9b406a'),
(10, 'tes1', 'tes@aaaa.com', 'fcea920f7412b5da7be0cf42b8c93759'),
(11, 'tes', 'tes@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(12, 'refan', 'refan@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indeks untuk tabel `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT untuk tabel `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
