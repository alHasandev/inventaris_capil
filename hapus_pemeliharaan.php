<?php

require_once 'app/koneksi.php';

$query = "DELETE FROM pemeliharaan WHERE id = '$_GET[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: pemeliharaan.php');
} else {
  die('Gagal menghapus data pemeliharaan: ' . $conn->error);
}
