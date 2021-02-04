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
            <h4>Data Kategori</h4>
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
              <th>Kode</th>
              <th>Nama Kategori</th>
              <th class="text-center">Unit</th>
              <th>Keterangan</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $kategori = $conn->query("SELECT * FROM kategori");
            while ($data = $kategori->fetch_assoc()) :
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td class="text-uppercase"><?= $data['kode'] ?></td>
                <td><?= $data['nama'] ?></td>
                <td class="text-center"><?= $data['unit'] ?></td>
                <td><?= $data['keterangan'] ?></td>
                <td class="text-center">
                  <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick='editForm(`<?= json_encode($data) ?>`)'>
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick='deleteModal(`hapus_kategori.php?id=<?= $data["id"] ?>`, `Kategori: [<?= $data["kode"] ?>] <?= $data["nama"] ?>`)'>
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
    <form action="tambah_kategori.php" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Kategori</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_kategori.php', 'Tambah Data Kategori')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" id="id" value="">
        <div class="form-group">
          <label for="kode">Kode Kategori</label>
          <input type="text" name="kode" id="kode" class="form-control">
        </div>

        <div class="form-group">
          <label for="nama">Nama Kategori</label>
          <input type="text" name="nama" id="nama" class="form-control">
        </div>

        <div class="form-group">
          <label for="keterangan">keterangan</label>
          <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_kategori.php','Tambah Data Kategori')">Batal</button>
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
    let editAction = 'update_kategori.php';
    // console.log(window.location);
    $('#form').attr('action', editAction);

    // ubah judul form
    $('#formModalLabel').html('Edit Data Kategori');

    // ubah tombol tambah menjadi edit
    $('#form input[type=submit]').val('Edit');

    // ubah dan tambahkan sesuai form kalian
    $('#id').val(data.id);
    $('#kode').val(data.kode);
    $('#nama').val(data.nama);
    $('#unit').val(data.unit);
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