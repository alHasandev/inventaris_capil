<?php

require_once "layouts/header.php";
require_once "app/koneksi.php";

?>

<div class="row">
  <div class="col-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>KD</th>
          <th>Kondisi</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>[B]</th>
          <td>Baik</td>
          <td>Baru</td>
        </tr>
        <tr>
          <th>[S]</th>
          <td>Sedang</td>
          <td>Masih Bisa Dipakai</td>
        </tr>
        <tr>
          <th>[R]</th>
          <td>Rusak</td>
          <td>Harus Diperbaiki</td>
        </tr>
        <tr>
          <th>[H]</th>
          <td>Habis</td>
          <td>Habis Dikonsumsi | Tidak Bisa Dipakai Lagi</td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <!-- tombah tambah data -->
        <div class="row">
          <div class="col-md-6">
            <!-- Judul Halaman -->
            <h4>Pemeliharaan Aset Bulanan</h4>
          </div>
          <div class="col-md-6 text-right">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#formModal">TAMBAH</a>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Bulan</th>
              <th>Ruangan</th>
              <th>Aset</th>
              <th class="text-center">Unit</th>
              <th class="text-center">B</th>
              <th class="text-center">S</th>
              <th class="text-center">R</th>
              <th class="text-center">H</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $pemakaian = $conn->query("SELECT pemeliharaan.*, pemakaian_aset.unit, aset.nama as nama_aset, ruangan.nama as nama_ruangan FROM pemeliharaan INNER JOIN pemakaian_aset ON pemeliharaan.id_pemakaian_aset = pemakaian_aset.id INNER JOIN aset ON pemakaian_aset.id_aset = aset.id INNER JOIN ruangan ON pemakaian_aset.id_ruangan = ruangan.id");

            while ($data = $pemakaian->fetch_assoc()) :
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td><?= $data['bulan'] ?></td>
                <td><?= $data['nama_ruangan'] ?></td>
                <td><?= $data['nama_aset'] ?></td>
                <td class="text-center"><?= $data['unit'] ?></td>
                <td class="text-center"><?= $data['baik'] ?></td>
                <td class="text-center"><?= $data['sedang'] ?></td>
                <td class="text-center"><?= $data['rusak'] ?></td>
                <td class="text-center"><?= $data['habis'] ?></td>
                <td class="text-center">
                  <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick='editForm(`<?= json_encode($data) ?>`)'>
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick='deleteModal(`hapus_pemeliharaan.php?id=<?= $data["id"] ?>`)'>
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<!-- Modal -->

<!-- Form Modal untuk tambah dan Edit Data -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!-- atur form disini -->
    <form action="tambah_pemeliharaan.php" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Tambah Pemakaian Aset</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_pemeliharaan.php', 'Tambah Barang Masuk')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" id="id" value="">

        <div class="form-group">
          <label for="bulan">Bulan</label>
          <input type="month" name="bulan" id="bulan" class="form-control" value="<?= date('Y-m') ?>">
        </div>

        <div class="form-group">
          <label for="id_pemakaian_aset">Pilih Inventory</label>
          <select name="id_pemakaian_aset" id="id_pemakaian_aset" class="form-control">
            <?php

            $aset = $conn->query("SELECT pemakaian_aset.*, aset.nama as nama_aset, ruangan.nama as nama_ruangan FROM pemakaian_aset INNER JOIN aset ON pemakaian_aset.id_aset = aset.id INNER JOIN ruangan ON pemakaian_aset.id_ruangan = ruangan.id");
            while ($data = $aset->fetch_assoc()) :

            ?>
              <option value="<?= $data['id'] ?>">[<?= $data['nama_ruangan'] ?>] <?= $data['nama_aset'] ?> - <?= $data['unit'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="baik">[B] Baik | Baru</label>
          <input type="number" name="baik" id="baik" class="form-control">
        </div>

        <div class="form-group">
          <label for="sedang">[S] Sedang | Bisa Dipakai</label>
          <input type="number" name="sedang" id="sedang" class="form-control">
        </div>

        <div class="form-group">
          <label for="rusak">[R] Rusak | Harus Diperbaiki</label>
          <input type="number" name="rusak" id="rusak" class="form-control">
        </div>

        <div class="form-group">
          <label for="habis">[H] Habis | Habis Dipakai | Tidak Bisa Dipakai Lagi</label>
          <input type="number" name="habis" id="habis" class="form-control">
        </div>

        <div class="form-group">
          <label for="keterangan">Keterangan</label>
          <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_pemeliharaan.php','Tambah Barang Masuk')">Batal</button>
        <input type="submit" class="btn btn-primary" value="Tambah">
      </div>
    </form>
  </div>
</div>

<!-- coding untuk form edit -->
<script>
  // fungsi untuk edit siswa
  function editForm(data) {
    // parse json data menjadi objek
    data = JSON.parse(data);
    // ikuti pola sesuaikan dengan id pada form modal data

    // ubah action dari form menjadi edit
    // let editAction = window.location.href + '&aksi=edit';
    let editAction = 'update_pemeliharaan.php';
    // console.log(window.location);
    $('#form').attr('action', editAction);

    // ubah judul form
    $('#formModalLabel').html('Edit Pemakaian Aset');

    // ubah tombol tambah menjadi edit
    $('#form input[type=submit]').val('Edit');

    // ubah dan tambahkan sesuai form kalian
    $('#id').val(data.id);
    $('#id_pemakaian_aset').val(data.id_pemakaian_aset);
    $('#baik').val(data.baik);
    $('#sedang').val(data.sedang);
    $('#rusak').val(data.rusak);
    $('#habis').val(data.habis);
    $('#keterangan').val(data.keterangan);
  }

  // datatable
  $(function() {
    $("#datatable").DataTable({
      "responsive": true,
      "lengthChange": false,
      "pageLength": 5,
      // "scrollY": 500,
      // "scrollX": true,
      "scrollCollapse": true,
      "autoWidth": false,
      "ordering": false,
      "info": false
    });
  });
</script>

<?php require_once "layouts/footer.php" ?>