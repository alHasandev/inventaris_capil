<?php

require_once 'app/koneksi.php';

$query = "DELETE FROM jadwal WHERE id = '$_GET[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_jadwal.php');
} else {
  die('Gagal menghapus data jadwal: ' . $conn->error);
}
