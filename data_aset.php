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
        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Nama Aset</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Unit</th>
              <th>Keterangan</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $aset = $conn->query("SELECT aset.*, kategori.kode as kode_kategori FROM aset INNER JOIN kategori ON aset.id_kategori = kategori.id");
            while ($data = $aset->fetch_assoc()) :
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td><?= $data['nama'] ?></td>
                <td class="text-center text-uppercase">[<?= $data['kode_kategori'] ?>]</td>
                <td class="text-center">
                  <?= $data['unit_bebas'] ?> / <?= $data['unit_total'] ?>
                </td>
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
          <label for="id_kategori">Pilih Kategori</label>
          <select name="id_kategori" id="id_kategori" class="form-control">
            <?php

            $kategori = $conn->query("SELECT * FROM kategori");
            while ($data = $kategori->fetch_assoc()) :

            ?>
              <option value="<?= $data['id'] ?>">[<?= $data['kode'] ?>] <?= $data['nama'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="nama">Nama Aset</label>
          <input type="text" name="nama" id="nama" class="form-control">
        </div>

        <div class="form-group">
          <label for="unit_terpakai">Unit Terpakai</label>
          <input type="number" name="unit_terpakai" id="unit_terpakai" class="form-control" value="0" readonly>
        </div>

        <div class="form-group">
          <label for="unit_total">Unit Total</label>
          <input type="number" name="unit_total" id="unit_total" class="form-control" value="0" readonly>
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
    $('#unit_terpakai').val(data.unit_terpakai);
    $('#unit_bebas').val(data.unit_bebas);
    $('#id_ruangan').val(data.id_ruangan);
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