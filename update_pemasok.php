<?php

require_once 'app/koneksi.php';

$query = "UPDATE pemasok SET nama = '$_POST[nama]', kontak = '$_POST[kontak]', alamat = '$_POST[alamat]' WHERE id = '$_POST[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_pemasok.php');
} else {
  die("Gagal mengupdate data pemasok: " . $conn->error);
}
