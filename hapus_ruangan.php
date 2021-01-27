<?php

require_once 'app/koneksi.php';

$query = "DELETE FROM ruangan WHERE id = '$_GET[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_ruangan.php');
} else {
  die('Gagal menghapus data ruangan: ' . $conn->error);
}
