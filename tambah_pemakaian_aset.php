<?php

require_once 'app/koneksi.php';

session_start();

$pemakaian = $conn->query("SELECT * FROM pemakaian_aset WHERE id_aset = '$_POST[id_aset]' AND id_ruangan = '$_POST[id_ruangan]'");

if ($pemakaian->num_rows > 0) {
  $pemakaian = $pemakaian->fetch_assoc();
  $query = "UPDATE pemakaian_aset SET unit = unit + '$_POST[jumlah]' WHERE id = '$pemakaian[id]'";
} else {
  $query = "INSERT INTO pemakaian_aset (id_ruangan, id_aset, unit) VALUES ('$_POST[id_ruangan]', '$_POST[id_aset]', '$_POST[jumlah]')";
}

$hasil = $conn->query($query);

if ($hasil) {
  // udpate unit pada data aset berdasarkan jumlah barang masuk
  $query = "UPDATE aset SET unit_bebas = unit_bebas - '$_POST[jumlah]' WHERE id = '$_POST[id_aset]'";
  $hasil = $conn->query($query);

  header('Location: pemakaian_aset.php');
} else {
  die('Gagal menambah data pemakaian_aset: ' . $conn->error);
}
