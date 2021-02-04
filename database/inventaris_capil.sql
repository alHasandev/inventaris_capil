-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Feb 2021 pada 04.46
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris_capil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(6) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kontak` char(13) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `alamat`, `kontak`, `foto`) VALUES
(4, 'admin', 'admin', 'Admin', 'Where am I ?', '082149259827', 'assets/img/profiles/default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aset`
--

CREATE TABLE `aset` (
  `id` int(6) NOT NULL,
  `kode` char(8) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `id_kategori` int(6) DEFAULT NULL,
  `unit_bebas` int(3) DEFAULT NULL,
  `unit_total` int(3) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aset`
--

INSERT INTO `aset` (`id`, `kode`, `nama`, `id_kategori`, `unit_bebas`, `unit_total`, `keterangan`) VALUES
(3, '', 'Komputer', 1, 10, 10, 'Seperangkat Alat Komputer'),
(4, '', 'Kertas HVS 50g', 2, 10, 20, '1 Rim, Semua Merk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(6) NOT NULL,
  `id_aset` int(6) DEFAULT NULL,
  `id_pemasok` int(6) DEFAULT NULL,
  `id_admin` int(6) DEFAULT NULL,
  `jumlah` int(3) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `id_aset`, `id_pemasok`, `id_admin`, `jumlah`, `tgl_masuk`) VALUES
(3, 3, 1, 4, 10, '2021-02-04'),
(4, 4, 1, 4, 20, '2021-02-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(6) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_ruangan` int(6) DEFAULT NULL,
  `nama_staff` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `tanggal`, `id_ruangan`, `nama_staff`, `status`, `keterangan`) VALUES
(2, '2021-02-04', 2, 'Agus Mulyadi', 'selesai', 'Aman tekendali');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(6) NOT NULL,
  `kode` char(8) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `unit` int(3) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kode`, `nama`, `unit`, `keterangan`) VALUES
(1, 'AEK', 'Alat Elektronik Kantor', 0, 'termasuk hp, printer, monitor, komputer, notebook atau laptop'),
(2, 'ATK', 'Alat Tulis Kantor', 1, 'Buku, kertas, pulpen, pensil, penggaris, dsbg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemakaian_aset`
--

CREATE TABLE `pemakaian_aset` (
  `id` int(6) NOT NULL,
  `id_ruangan` int(6) DEFAULT NULL,
  `id_aset` int(6) DEFAULT NULL,
  `unit` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemakaian_aset`
--

INSERT INTO `pemakaian_aset` (`id`, `id_ruangan`, `id_aset`, `unit`) VALUES
(1, 2, 3, 0),
(2, 2, 4, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasok`
--

CREATE TABLE `pemasok` (
  `id` int(6) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kontak` char(13) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemasok`
--

INSERT INTO `pemasok` (`id`, `nama`, `kontak`, `alamat`) VALUES
(1, 'CV. Anugerah Barokat', '082149259829', 'Jl. Padat Karya, no. 25, Rt. 61');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeliharaan`
--

CREATE TABLE `pemeliharaan` (
  `id` int(6) NOT NULL,
  `id_admin` int(6) DEFAULT NULL,
  `id_pemakaian_aset` int(6) DEFAULT NULL,
  `bulan` char(7) DEFAULT NULL,
  `baik` int(3) DEFAULT NULL,
  `sedang` int(3) DEFAULT NULL,
  `rusak` int(3) DEFAULT NULL,
  `habis` int(3) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemeliharaan`
--

INSERT INTO `pemeliharaan` (`id`, `id_admin`, `id_pemakaian_aset`, `bulan`, `baik`, `sedang`, `rusak`, `habis`, `keterangan`) VALUES
(1, 4, 2, '2021-02', 0, 0, 0, 10, 'Habis dipakai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(6) NOT NULL,
  `kode` char(8) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `penanggung_jawab` varchar(100) DEFAULT NULL,
  `kontak` char(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id`, `kode`, `nama`, `penanggung_jawab`, `kontak`) VALUES
(2, 'GD', 'Gudang', 'Dhani Marhaban', '082149259820');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemakaian_aset`
--
ALTER TABLE `pemakaian_aset`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `aset`
--
ALTER TABLE `aset`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pemakaian_aset`
--
ALTER TABLE `pemakaian_aset`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
