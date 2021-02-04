<?php

require_once 'app/koneksi.php';

$query = "UPDATE kategori SET kode = '$_POST[kode]', nama = '$_POST[nama]', unit = '$_POST[unit]', keterangan = '$_POST[keterangan]' WHERE id = '$_POST[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_kategori.php');
} else {
  die("Gagal mengupdate data kategori: " . $conn->error);
}
