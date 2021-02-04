<?php

require_once 'app/koneksi.php';

$query = "DELETE FROM aset WHERE id = '$_GET[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  // kurangi unit pada kategori 
  $query = "UPDATE kategori SET unit = unit - 1 WHERE id = '$_POST[id_kategori]'";
  $hasil = $conn->query($query);
  header('Location: data_aset.php');
} else {
  die('Gagal menghapus data aset: ' . $conn->error);
}
