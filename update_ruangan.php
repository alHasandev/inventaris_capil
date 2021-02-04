<?php

require_once 'app/koneksi.php';

$query = "UPDATE ruangan SET kode = '$_POST[kode]', nama = '$_POST[nama]', penanggung_jawab = '$_POST[penanggung_jawab]', kontak = '$_POST[kontak]' WHERE id = '$_POST[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_ruangan.php');
} else {
  die("Gagal mengupdate data ruangan: " . $conn->error);
}
