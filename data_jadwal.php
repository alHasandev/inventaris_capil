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
            <h4>Rencana Jadwal</h4>
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
              <th class="text-center">Tanggal</th>
              <th>Ruangan</th>
              <th>Staff</th>
              <th class="text-center">Status</th>
              <th>Keterangan</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $jadwal = $conn->query("SELECT jadwal.*, ruangan.kode as kode_ruangan, ruangan.nama as nama_ruangan FROM jadwal INNER JOIN ruangan ON jadwal.id_ruangan = ruangan.id");
            while ($data = $jadwal->fetch_assoc()) :
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td class="text-center"><?= $data['tanggal'] ?></td>
                <td>[<?= $data['kode_ruangan'] ?>] <?= $data['nama_ruangan'] ?></td>
                <td><?= $data['nama_staff'] ?></td>
                <td class="text-center">
                  <?php if ($data['status'] === 'jadwal') : ?>
                    <a href="#" class="btn btn-primary btn-xs text-uppercase" data-toggle="modal" data-target="#formModal2" onclick='formSelesai(`<?= json_encode($data) ?>`)'>
                      <?= $data['status'] ?>
                    </a>
                  <?php else : ?>
                    <span class="btn btn-success btn-xs text-uppercase">
                      <?= $data['status'] ?>
                    </span>
                  <?php endif; ?>
                </td>
                <td><?= $data['keterangan'] ?></td>
                <td class="text-center">
                  <?php if ($data['status'] === 'jadwal') : ?>
                    <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick='editForm(`<?= json_encode($data) ?>`)'>
                      <i class="fas fa-edit"></i>
                    </a>
                  <?php endif; ?>
                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick='deleteModal(`hapus_jadwal.php?id=<?= $data["id"] ?>`, `Jadwal: [<?= $data["nama_ruangan"] ?>][<?= $data["tanggal"] ?>] <?= $data["nama_staff"] ?>`)'>
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php $no++; ?>
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
    <form action="tambah_jadwal.php" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Tambah Jadwal Pemeliharaan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_jadwal.php', 'Tambah Jadwal Pemeliharaan')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" id="id" value="">
        <input type="hidden" name="status" id="status" value="jadwal">

        <div class="form-group">
          <label for="tanggal">Tanggal Pemeliharaan</label>
          <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d') ?>">
        </div>

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
          <label for="nama_staff">Nama Staff Tugas</label>
          <input type="text" name="nama_staff" id="nama_staff" class="form-control">
        </div>

      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_jadwal.php','Tambah Jadwal Pemeliharaan')">Batal</button>
        <input type="submit" class="btn btn-primary" value="Tambah">
      </div>
    </form>
  </div>
</div>
<!-- /.form modal -->

<!-- Form Modal untuk tambah dan Edit Data -->
<div class="modal fade" id="formModal2" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!-- atur form disini -->
    <form action="update_jadwal.php" method="POST" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Pemeliharaan Selesai ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" value="">
        <input type="hidden" name="status" value="selesai">
        <input type="hidden" name="id_ruangan">

        <div class="form-group">
          <label for="tanggal">Tanggal Pemeliharaan</label>
          <input type="date" name="tanggal" class="form-control" value="" readonly>
        </div>

        <div class="form-group">
          <label for="ruangan">Ruangan</label>
          <input type="text" name="ruangan" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label for="nama_staff">Nama Staff Tugas</label>
          <input type="text" name="nama_staff" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label for="keterangan">Keterangan</label>
          <textarea name="keterangan" class="form-control"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal">Batal</button>
        <input type="submit" class="btn btn-primary" value="Selesai ?">
      </div>
    </form>
  </div>
</div>
<!-- /.form modal -->

<!-- coding untuk form edit -->
<script>
  // fungsi untuk edit siswa
  function editForm(data) {
    // parse json data menjadi objek
    data = JSON.parse(data);
    // ikuti pola sesuaikan dengan id pada form modal data

    // ubah action dari form menjadi edit
    // let editAction = window.location.href + '&aksi=edit';
    let editAction = 'update_jadwal.php';
    // console.log(window.location);
    $('#form').attr('action', editAction);

    // ubah judul form
    $('#formModalLabel').html('Edit Jadwal Pemeliharaan');

    // ubah tombol tambah menjadi edit
    $('#form input[type=submit]').val('Edit');

    // ubah dan tambahkan sesuai form kalian
    $('#id').val(data.id);
    $('#tanggal').val(data.tanggal);
    $('#id_ruangan').val(data.id_ruangan);
    $('#nama_staff').val(data.nama_staff);
    $('#keterangan').val(data.keterangan);
  }

  function formSelesai(data) {
    data = JSON.parse(data);

    // ubah dan tambahkan sesuai form kalian
    $("#formModal2 [name='id']").val(data.id);
    $("#formModal2 [name='id_ruangan']").val(data.id_ruangan);
    $("#formModal2 [name='tanggal']").val(data.tanggal);
    $("#formModal2 [name='ruangan']").val(`[${data.kode_ruangan}] ${data.nama_ruangan}`);
    $("#formModal2 [name='nama_staff']").val(data.nama_staff);
    $("#formModal2 [name='keterangan']").val(data.keterangan);
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