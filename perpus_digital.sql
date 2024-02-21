-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Feb 2024 pada 02.48
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_digital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_rak` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun` int(5) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `id_kategori`, `id_rak`, `judul`, `penulis`, `penerbit`, `tahun`, `foto`) VALUES
(24, 7, 18, 'Aku Mati Memeluk  Boneka', 'LUBIS GRAFURA', 'GRAMEDIA', 2022, '11-02-2024-2.jpg'),
(25, 13, 18, 'Menjadi Kekasih Allah Sejak Kecil', 'UMMU HIKMAH', 'GRAMEDIA', 2019, '11-02-2024-1.jpg'),
(26, 7, 18, 'Nayla', 'Siti Rosidah', 'Gramedia', 2022, '11-02-2024-3.jpg'),
(28, 7, 18, 'Ini Bukan Tentang Motivasi', 'Fikri Muhammad', 'Transmedia', 2022, '11-02-2024-4.jpg'),
(29, 15, 18, 'Matematika Kelas X', 'Bornok Sinaga dkk', 'Kemendikbud', 2017, '11-02-2024-5.png'),
(30, 23, 18, 'Bahasa Indonesia Kela X', 'Maman Suryaman dkk', 'Kemendikbud', 2017, '11-02-2024-6.png'),
(31, 18, 18, 'Optimasi PC Meningkatkan Kinerja Komputer', '    Ali Zaky Smitdev Community', 'Gramedia', 2013, '11-02-2024-7.jpg'),
(32, 24, 18, 'Buku Model-Model Pembelajaran', 'Shilphy Afiattresna Octavia', 'Deepublish', 2020, '11-02-2024-8.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(7, 'Novel'),
(8, 'Cerpen'),
(9, 'Roman'),
(10, 'Ensiklopedia'),
(11, 'Biograpi'),
(12, 'Memora'),
(13, 'Buku Sejarah'),
(14, 'Buku Fisika'),
(15, 'Buku Matematika'),
(16, 'Buku Biologi'),
(17, 'Buku Sejarah'),
(18, 'Buku Jaringan Komputer'),
(19, 'Buku Desain Grafis'),
(20, 'Novel'),
(21, 'Buku Musik'),
(22, 'Buku Film'),
(23, 'Buku Pelajaran'),
(24, 'Buku Pedagogi'),
(25, 'Puisi'),
(26, 'Buku Kesehatan'),
(27, 'Buku Memasak'),
(28, 'Buku Panduan Perjalanan'),
(29, 'Buku Petualangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `koleksi_pribadi`
--

CREATE TABLE `koleksi_pribadi` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `koleksi_pribadi`
--

INSERT INTO `koleksi_pribadi` (`id`, `id_pengguna`, `id_buku`) VALUES
(7, 18, 18),
(8, 18, 18),
(19, 16, 24),
(20, 16, 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `status_peminjaman` enum('0','pinjam','kembali') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_pengguna`, `id_petugas`, `id_buku`, `tanggal_pinjam`, `status_peminjaman`) VALUES
(25, 18, 6, 24, '2024-02-12', 'kembali'),
(26, 18, 6, 24, '2024-02-12', 'kembali'),
(27, 18, 6, 24, '2024-02-12', 'kembali'),
(51, 16, 6, 28, '2024-02-12', 'kembali'),
(52, 16, 6, 28, '2024-02-13', 'pinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `lama_pinjam` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `lama_pinjam`, `denda`) VALUES
(13, 10, 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `id_peminjaman`, `id_petugas`, `tanggal_kembali`, `denda`) VALUES
(8, 26, 6, '2024-02-12', 0),
(9, 27, 6, '2024-02-12', 0),
(10, 51, 6, '2024-02-12', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama_pengguna`, `alamat`, `email`, `username`, `password`) VALUES
(16, 'Anwar Maulana', 'Sumedang', 'away@gmail.com', 'anwar', '1234'),
(18, 'rofy pratimi', 'bandung', 'rofy@gmail.com', 'rofy', '1234'),
(23, 'ff', 'ff', 'ff@dd', 'ff', 'ff'),
(25, 'asa', 'asa', 'anwarmaulana193@gmail.com', 'agus', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `level` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `alamat`, `username`, `password`, `level`) VALUES
(6, 'Anwar Maulana', 'Sumedang\r\n', 'away', '1234', 'admin'),
(8, 'Budi Dirgantara', 'Sumedang', 'budi', '1234', 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak`
--

CREATE TABLE `rak` (
  `id` int(11) NOT NULL,
  `nama_rak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rak`
--

INSERT INTO `rak` (`id`, `nama_rak`) VALUES
(18, 'RAK 1'),
(21, 'RAK 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan_buku`
--

CREATE TABLE `ulasan_buku` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `ulasan` text NOT NULL,
  `rating` int(11) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasan_buku`
--

INSERT INTO `ulasan_buku` (`id`, `id_pengguna`, `id_buku`, `ulasan`, `rating`, `waktu`) VALUES
(8, 18, 24, 'tes', 1, '2024-02-12 18:02:15'),
(9, 18, 24, 'tes 2', 3, '2024-02-12 18:06:36'),
(10, 18, 24, 'tes3', 1, '2024-02-13 00:08:02'),
(11, 16, 28, 'tes aja', 1, '2024-02-13 00:10:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `koleksi_pribadi`
--
ALTER TABLE `koleksi_pribadi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `rak`
--
ALTER TABLE `rak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
