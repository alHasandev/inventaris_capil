<?php

require_once 'app/koneksi.php';

$query = "INSERT INTO pemasok (nama, kontak, alamat) VALUES ('$_POST[nama]', '$_POST[kontak]', '$_POST[alamat]')";

$hasil = $conn->query($query);


if ($hasil) {
  header('Location: data_pemasok.php');
} else {
  die('Gagal menambah data pemasok: ' . $conn->error);
}
