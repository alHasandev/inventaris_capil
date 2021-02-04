<?php

require_once 'app/koneksi.php';

$query = "INSERT INTO kategori (kode, nama, unit, keterangan) VALUES ('$_POST[kode]',  '$_POST[nama]', '0', '$_POST[keterangan]')";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_kategori.php');
} else {
  die('Gagal menambah data kategori: ' . $conn->error);
}
