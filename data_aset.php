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
            <h4>Data Aset</h4>
          </div>
          <div class="col-md-6 text-right">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#formModal">TAMBAH</a>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tableMenuItem" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Nama Aset</th>
              <th>Kategori</th>
              <th>Unit</th>
              <th>Ruangan</th>
              <th>Keterangan</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $aset = $conn->query("SELECT aset.*, ruangan.kode as kode_ruangan FROM aset INNER JOIN ruangan ON aset.id_ruangan = ruangan.id");
            while ($data = $aset->fetch_assoc()) :
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['kategori'] ?></td>
                <td><?= $data['unit'] ?></td>
                <td><?= $data['kode_ruangan'] ?></td>
                <td><?= $data['keterangan'] ?></td>
                <td class="text-center">
                  <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick='editForm(`<?= json_encode($data) ?>`)'>
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick='deleteModal(`hapus_aset.php?id=<?= $data["id"] ?>`, `Aset: <?= $data["nama"] ?>`)'>
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
    <form action="tambah_aset.php" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Aset</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_aset.php', 'Tambah Data Aset')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" id="id" value="">
        <div class="form-group">
          <label for="nama">Nama Aset</label>
          <input type="text" name="nama" id="nama" class="form-control">
        </div>

        <div class="form-group">
          <label for="kategori">kategori</label>
          <select name="kategori" id="kategori" class="form-control">
            <option value="kt1">Kategori 1</option>
            <option value="kt2">Kategori 2</option>
            <option value="kt3">Kategori 3</option>
          </select>
        </div>

        <div class="form-group">
          <label for="unit">Unit</label>
          <input type="number" name="unit" id="unit" class="form-control">
        </div>

        <div class="form-group">
          <label for="id_ruangan">Pilih Ruangan</label>
          <select name="id_ruangan" id="id_ruangan" class="form-control">
            <?php

            $ruangan = $conn->query("SELECT * FROM ruangan");
            while ($data = $ruangan->fetch_assoc()) :

            ?>
              <option value="<?= $data['id'] ?>"><?= $data['kode'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="keterangan">keterangan</label>
          <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_admin.php','Tambah Data Aset')">Batal</button>
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
    let editAction = 'update_aset.php';
    // console.log(window.location);
    $('#form').attr('action', editAction);

    // ubah judul form
    $('#formModalLabel').html('Edit Data Aset');

    // ubah tombol tambah menjadi edit
    $('#form input[type=submit]').val('Edit');

    // ubah dan tambahkan sesuai form kalian
    $('#id').val(data.id);
    $('#nama').val(data.nama);
    $('#kategori').val(data.kategori);
    $('#unit').val(data.unit);
    $('#id_ruangan').val(data.id_ruangan);
    $('#keterangan').val(data.keterangan);

  }
</script>

<?php require_once "layouts/footer.php" ?>