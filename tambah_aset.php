<?php

require_once 'app/koneksi.php';

$query = "INSERT INTO aset (nama, kategori, unit, id_ruangan, keterangan) VALUES ('$_POST[nama]', '$_POST[kategori]',  '$_POST[unit]', '$_POST[id_ruangan]', '$_POST[keterangan]')";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_aset.php');
} else {
  die('Gagal menambah data aset: ' . $conn->error);
}
