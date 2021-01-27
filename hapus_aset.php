<?php

require_once 'app/koneksi.php';

$query = "DELETE FROM aset WHERE id = '$_GET[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_aset.php');
} else {
  die('Gagal menghapus data aset: ' . $conn->error);
}
