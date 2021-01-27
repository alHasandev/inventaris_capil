<?php

require_once 'app/koneksi.php';

$query = "INSERT INTO ruangan (kode, penanggung_jawab, kontak) VALUES ('$_POST[kode]', '$_POST[penanggung_jawab]', '$_POST[kontak]')";

$hasil = $conn->query($query);


if ($hasil) {
  header('Location: data_ruangan.php');
} else {
  die('Gagal menambah data ruangan: ' . $conn->error);
}
