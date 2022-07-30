<?php

if ($_SESSION['role'] == 'admin') {
  $disable = "";
  $readonly = "";
} else {
  $disable = "d-none";
  $readonly = "readonly";
}

?>

<div class="row">
  <div class="col-5">
    <h1 class="h3 mb-4 text-gray-800">Form Tambah User</h1>
    <div class="card mb-4 py-3 border-left-primary">
      <div class="card-body">
        <form action="" method="POST">
          <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" required <?= $readonly; ?>>
            </div>
          </div>
          <div class="form-group row">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="username" id="username" autocomplete="off" required <?= $readonly; ?>>
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" name="password" id="password" autocomplete="off" required <?= $readonly; ?>>
            </div>
          </div>
          <div class="form-group row">
            <label for="role" class="col-sm-3 col-form-label">Role</label>
            <div class="col-sm-9">
              <select name="role" id="role" class="form-control" <?= $readonly; ?>>
                <option value="admin">Admin</option>
                <option value="guru">Guru</option>
              </select>
            </div>
          </div>
      </div>
    </div>
    <button type="submit" name="add" class="btn btn-sm btn-primary float-right mr-3 <?= $disable; ?>" >Tambah</button>
    </form>
  </div>

  <?php

  if (isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $addQuery = $conn->query("INSERT INTO tb_user (username, password, nama_user, role) VALUES ('$username','$password','$nama','$role')");

    if ($addQuery) {
  ?>
      <script>
        alert("Data user berhasil ditambah");
        window.location.href = "user";
      </script>
  <?php
    }
  }

  ?>

  <div class="col-7">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th width="3%">No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th width="20%">Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sql = $conn->query("SELECT * FROM tb_user");
              while ($result = $sql->fetch_assoc()) {
              ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $result['nama_user']; ?></td>
                  <td><?= $result['username']; ?></td>
                  <td><?= $result['role']; ?></td>
                  <td>
                    <a href="?page=user&action=edit&id=<?= $result['id_user']; ?>" data-toggle="tooltip" data-placement="top" title="edit"><i class="fas fa-fw fa-edit text-success"></i></a>
                    <a href="?page=user&action=delete&id=<?= $result['id_user']; ?>" onclick="return confirm('Anda Yakin akan menghapus data ini...?')" data-toggle="tooltip" data-placement="top" title="delete"><i class="fas fa-fw fa-trash-alt text-danger"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>