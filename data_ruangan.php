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
            <h4>Data Ruangan</h4>
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
              <th>Nama Ruangan</th>
              <th>Penanggung Jawab</th>
              <th>Kontak</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $ruangan = $conn->query("SELECT * FROM ruangan");
            while ($data = $ruangan->fetch_assoc()) :
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td><?= $data['kode'] ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['penanggung_jawab'] ?></td>
                <td><?= $data['kontak'] ?></td>
                <td class="text-center">
                  <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick='editForm(`<?= json_encode($data) ?>`)'>
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick='deleteModal(`hapus_ruangan.php?id=<?= $data["id"] ?>`, `Ruangan: [<?= $data["kode"] ?>] <?= $data["nama"] ?>`)'>
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
    <form action="tambah_ruangan.php" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Ruangan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_ruangan.php', 'Tambah Data Ruangan')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" id="id" value="">
        <div class="form-group">
          <label for="kode">Kode Ruangan</label>
          <input type="text" name="kode" id="kode" class="form-control">
        </div>

        <div class="form-group">
          <label for="nama">Nama Ruangan</label>
          <input type="text" name="nama" id="nama" class="form-control">
        </div>

        <div class="form-group">
          <label for="penanggung_jawab">Nama Penanggung Jawab</label>
          <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control">
        </div>

        <div class="form-group">
          <label for="kontak">Kontak Penanggung Jawab</label>
          <input type="number" name="kontak" id="kontak" class="form-control">
        </div>

      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_ruangan.php','Tambah Data Ruangan')">Batal</button>
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
    let editAction = 'update_ruangan.php';
    // console.log(window.location);
    $('#form').attr('action', editAction);

    // ubah judul form
    $('#formModalLabel').html('Edit Data Ruangan');

    // ubah tombol tambah menjadi edit
    $('#form input[type=submit]').val('Edit');

    // ubah dan tambahkan sesuai form kalian
    $('#id').val(data.id);
    $('#kode').val(data.kode);
    $('#nama').val(data.nama);
    $('#penanggung_jawab').val(data.penanggung_jawab);
    $('#kontak').val(data.kontak);

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