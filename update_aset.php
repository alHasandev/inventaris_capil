<?php

require_once 'app/koneksi.php';

$query = "UPDATE aset SET kode = '$_POST[kode]', nama = '$_POST[nama]', kategori = '$_POST[kategori]', unit_bebas = '$_POST[unit_bebas]', unit_total = '$_POST[unit_total]', id_ruangan = '$_POST[id_ruangan]', keterangan = '$_POST[keterangan]' WHERE id = '$_POST[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_aset.php');
} else {
  die("Gagal mengupdate data aset: " . $conn->error);
}
