<?php

require_once 'app/koneksi.php';

$query = "INSERT INTO jadwal (tanggal, id_ruangan, nama_staff, status, keterangan) VALUES ('$_POST[tanggal]', '$_POST[id_ruangan]', '$_POST[nama_staff]',  '$_POST[status]', '$_POST[keterangan]')";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_jadwal.php');
} else {
  die('Gagal menambah data jadwal: ' . $conn->error);
}
