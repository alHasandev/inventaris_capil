<?php

require_once "layouts/header.php";
require_once "app/koneksi.php";

?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <!-- tombah tambah data -->
        <div class="row">
          <div class="col-md-6">
            <!-- Judul Halaman -->
            <h4>Pemakaian Aset</h4>
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
              <th>Ruangan</th>
              <th>Kategori</th>
              <th>Aset</th>
              <th class="text-center">Unit</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $pemakaian = $conn->query("SELECT pemakaian_aset.*, aset.nama as nama_aset, kategori.kode as kode_kategori, ruangan.nama as nama_ruangan FROM pemakaian_aset INNER JOIN aset ON pemakaian_aset.id_aset = aset.id INNER JOIN ruangan ON pemakaian_aset.id_ruangan = ruangan.id LEFT JOIN kategori ON aset.id_kategori = kategori.id");

            while ($data = $pemakaian->fetch_assoc()) :
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td><?= $data['nama_ruangan'] ?></td>
                <td>[<?= $data['kode_kategori'] ?>]</td>
                <td><?= $data['nama_aset'] ?></td>
                <td class="text-center"><?= $data['unit'] ?></td>
                <td class="text-center">
                  <!-- <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick='editForm(`<?= json_encode($data) ?>`)'>
                    <i class="fas fa-edit"></i>
                  </a> -->
                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick='deleteModal(`hapus_pemakaian_aset.php?id=<?= $data["id"] ?>`)'>
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
    <form action="tambah_pemakaian_aset.php" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Tambah Pemakaian Aset</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_pemakaian_aset.php', 'Tambah Barang Masuk')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" id="id" value="">

        <div class="form-group">
          <label for="id_ruangan">Pilih Ruangan</label>
          <select name="id_ruangan" id="id_ruangan" class="form-control">
            <?php

            $aset = $conn->query("SELECT * FROM ruangan");
            while ($data = $aset->fetch_assoc()) :

            ?>
              <option value="<?= $data['id'] ?>">[<?= $data['kode'] ?>] <?= $data['nama'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="id_aset">Pilih Aset</label>
          <select name="id_aset" id="id_aset" class="form-control">
            <?php

            $aset = $conn->query("SELECT * FROM aset");
            while ($data = $aset->fetch_assoc()) :

            ?>
              <option value="<?= $data['id'] ?>">[<?= $data['kode'] ?>] <?= $data['nama'] ?> - <?= $data['unit_bebas'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="jumlah">Jumlah</label>
          <input type="number" name="jumlah" id="jumlah" class="form-control">
        </div>

      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_pemakaian_aset.php','Tambah Barang Masuk')">Batal</button>
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
    let editAction = 'update_pemakaian_aset.php';
    // console.log(window.location);
    $('#form').attr('action', editAction);

    // ubah judul form
    $('#formModalLabel').html('Edit Pemakaian Aset');

    // ubah tombol tambah menjadi edit
    $('#form input[type=submit]').val('Edit');

    // ubah dan tambahkan sesuai form kalian
    $('#id').val(data.id);
    $('#id_ruangan').val(data.id_ruangan);
    $('#id_aset').val(data.id_aset);
    $('#jumlah').val(data.unit);
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