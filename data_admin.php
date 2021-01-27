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
            <h4>Data Admin</h4>
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
              <th class="text-center">Profil</th>
              <th>Username</th>
              <th>Nama</th>
              <th>Kontak</th>
              <th>Alamat</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $no = 1;
            $admin = $conn->query("SELECT * FROM admin");
            while ($data = $admin->fetch_assoc()) :
            ?>
              <tr>
                <td class="text-center"><?= $no; ?></td>
                <td class="text-center">
                  <img src="<?= $data['foto'] ?>" alt="profil" class="img-thumbnail elevation-2" style="width: 5rem;">
                </td>
                <td><?= $data['username'] ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['kontak'] ?></td>
                <td><?= $data['alamat'] ?></td>
                <td class="text-center">
                  <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#formModal" onclick='editForm(`<?= json_encode($data) ?>`)'>
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick='deleteModal(`hapus_admin.php?id=<?= $data["id"] ?>`, `Admin: <?= $data["username"] ?>`)'>
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
    <form action="tambah_admin.php" method="POST" id="form" class="modal-content" enctype="multipart/form-data">
      <div class="modal-header" style="background-color: #00A8FF;">
        <h5 class="modal-title text-dark font-weight-bold" id="formModalLabel">Tambah Data Admin</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="resetForm('tambah_admin.php', 'Tambah Data Admin')">
          <span aria-hidden="true" class="text-light">×</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- edit untuk mengubah isi form -->
        <input type="hidden" name="id" id="id" value="">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <hr>

        <div class="form-group">
          <label for="nama">Nama Admin</label>
          <input type="text" name="nama" id="nama" class="form-control">
        </div>

        <div class="form-group">
          <label for="kontak">Kontak</label>
          <input type="number" name="kontak" id="kontak" class="form-control">
        </div>

        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea name="alamat" id="alamat" class="form-control"></textarea>
        </div>

        <div class="form-group">
          <label for="foto">Foto</label>
          <input type="file" name="foto" id="foto" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <!-- ubah tombol form -->
        <button class="btn btn-secondary" type="reset" data-dismiss="modal" onclick="resetForm('tambah_admin.php','Tambah Data Admin')">Batal</button>
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
    let editAction = 'update_admin.php';
    // console.log(window.location);
    $('#form').attr('action', editAction);

    // ubah judul form
    $('#formModalLabel').html('Edit Data Admin');

    // ubah tombol tambah menjadi edit
    $('#form input[type=submit]').val('Edit');

    // ubah dan tambahkan sesuai form kalian
    $('#id').val(data.id);
    $('#username').val(data.username);
    // $('#password').val(data.password);
    $('#nama').val(data.nama);
    $('#alamat').val(data.alamat);
    $('#kontak').val(data.kontak);

  }
</script>

<?php require_once "layouts/footer.php" ?>