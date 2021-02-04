<?php

require_once 'app/koneksi.php';

$query = "DELETE FROM barang_masuk WHERE id = '$_GET[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  // udpate unit pada data aset berdasarkan jumlah barang masuk
  $data = $conn->query("SELECT * FROM barang_masuk WHERE id = '$_GET[id]'")->fetch_assoc();

  $query = "UPDATE aset SET unit_bebas = unit_bebas - '$data[jumlah]' WHERE id = '$data[id_aset]'";
  $hasil = $conn->query($query);

  header('Location: barang_masuk.php');
} else {
  die('Gagal menghapus data barang_masuk: ' . $conn->error);
}
