<?php

require_once 'app/koneksi.php';

session_start();
$user = $_SESSION['user'];

$query = "INSERT INTO pemeliharaan (bulan, id_admin, id_pemakaian_aset, baik, sedang, rusak, habis, keterangan) VALUE ('$_POST[bulan]', '$user[id]', '$_POST[id_pemakaian_aset]', '$_POST[baik]', '$_POST[sedang]', '$_POST[rusak]', '$_POST[habis]', '$_POST[keterangan]')";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: pemeliharaan.php');
} else {
  die('Gagal menambah data pemeliharaan: ' . $conn->error);
}
