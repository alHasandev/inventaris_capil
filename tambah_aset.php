<?php

require_once 'app/koneksi.php';

$query = "INSERT INTO aset (kode, nama, id_kategori, unit_bebas, unit_total, keterangan) VALUES ('$_POST[kode]', '$_POST[nama]', '$_POST[id_kategori]',  '$_POST[unit_bebas]', '$_POST[unit_total]', '$_POST[keterangan]')";

$hasil = $conn->query($query);

if ($hasil) {
  // tambah unit pada kategori berdasarkan pertambahan unit aset
  $query = "UPDATE kategori SET unit = unit + 1 WHERE id = '$_POST[id_kategori]'";
  $hasil = $conn->query($query);

  header('Location: data_aset.php');
} else {
  die('Gagal menambah data aset: ' . $conn->error);
}
