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
            <h4>Barang Masuk</h4>
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
              <th>Tanggal</th>
              <th>Nama Aset</th>
              <th>Pemasok</th>
              <th class="text-center">Jumlah</th>
              <th>Admin</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $barang_masuk = $conn->query("SELECT barang_masuk.*, aset.nama as nama_aset, pemasok.nama as nama_pemasok, admin.username as username_admin FROM barang_masuk INNER JOIN aset ON barang_masuk.id_aset = aset.id INNER JOIN pemasok ON barang_masuk.id_pemasok = pemasok.id LEFT JOIN admin ON barang_masuk.id_admin = admin.id");

            while ($data = $barang_masuk->fetch_assoc()) :
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td><?= $data['tgl_masuk'] ?></td>
                <td><?= $data['nama_aset'] ?></td>
                <td><?= $data['nama_pemasok'] ?></td>
                <td class="text-center"><?= $data['jumlah'] ?></td>
                <td><?= $data['username_admin'] ?></td>
                <td class="text-center">
                  <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick='editForm(`<?= json_encode($data) ?>`)'>
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick='deleteModal(`hapus_barang_masuk.php?id=<?= $data["id"] ?>`, `Barang Masuk: [<?= $data["tgl_masuk"] ?>] <?= $data["nama_aset"] ?>`)'>
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
    <form action="tambah_barang_masuk.php" method="POST" id="form" class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="formModalLabel">Tambah Barang Masuk</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_barang_masuk.php', 'Tambah Barang Masuk')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" id="id" value="">

        <div class="form-group">
          <label for="tgl_masuk">Tanggal</label>
          <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" value="<?= date('Y-m-d') ?>">
        </div>

        <div class="form-group">
          <label for="id_aset">Pilih Aset</label>
          <select name="id_aset" id="id_aset" class="form-control">
            <?php

            $aset = $conn->query("SELECT * FROM aset");
            while ($data = $aset->fetch_assoc()) :

            ?>
              <option value="<?= $data['id'] ?>">[<?= $data['kode'] ?>] <?= $data['nama'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="jumlah">Jumlah</label>
          <input type="number" name="jumlah" id="jumlah" class="form-control">
        </div>


        <div class="form-group">
          <label for="id_pemasok">Pilih Pemasok</label>
          <select name="id_pemasok" id="id_pemasok" class="form-control">
            <?php

            $pemasok = $conn->query("SELECT * FROM pemasok");
            while ($data = $pemasok->fetch_assoc()) :

            ?>
              <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_barang_masuk.php','Tambah Barang Masuk')">Batal</button>
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
</script>

<?php require_once "layouts/footer.php" ?>