<?php

require_once 'app/koneksi.php';

session_start();

$user = $_SESSION['user'];

$query = "INSERT INTO barang_masuk (tgl_masuk, id_aset, id_pemasok, id_admin, jumlah) VALUES ('$_POST[tgl_masuk]', '$_POST[id_aset]', '$_POST[id_pemasok]',  '$user[id]', '$_POST[jumlah]')";

$hasil = $conn->query($query);

if ($hasil) {
  // udpate unit pada data aset berdasarkan jumlah barang masuk
  $query = "UPDATE aset SET unit_bebas = unit_bebas + '$_POST[jumlah]', unit_total = unit_total + '$_POST[jumlah]' WHERE id = '$_POST[id_aset]'";
  $hasil = $conn->query($query);

  header('Location: barang_masuk.php');
} else {
  die('Gagal menambah data barang_masuk: ' . $conn->error);
}
