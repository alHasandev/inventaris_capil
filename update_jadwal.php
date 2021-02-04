<?php

require_once 'app/koneksi.php';


$query = "UPDATE jadwal SET tanggal = '$_POST[tanggal]', id_ruangan = '$_POST[id_ruangan]', nama_staff = '$_POST[nama_staff]', status = '$_POST[status]', keterangan = '$_POST[keterangan]' WHERE id = '$_POST[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_jadwal.php');
} else {
  die("Gagal mengupdate data jadwal: " . $conn->error);
}
