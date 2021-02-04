<?php

require_once 'app/koneksi.php';

session_start();
$user = $_SESSION['user'];

$query = "UPDATE pemeliharaan SET bulan = '$_POST[bulan]', id_admin = '$user[id]', id_pemakaian_aset = '$_POST[id_pemakaian_aset]', baik = '$_POST[baik]', sedang = '$_POST[sedang]', rusak = '$_POST[rusak]', habis = '$_POST[habis]', keterangan = '$_POST[keterangan]' WHERE id = '$_POST[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: pemeliharaan.php');
} else {
  die('Gagal menambah data pemeliharaan: ' . $conn->error);
}
