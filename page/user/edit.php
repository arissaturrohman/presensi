<?php

$id = $_GET['id'];
$sql = $conn->query("SELECT * FROM tb_user WHERE id_user = '$id'");
$data = $sql->fetch_assoc();

?>
<div class="row">
  <div class="col-5">
    <h1 class="h3 mb-4 text-gray-800">Form Edit User</h1>
    <div class="card mb-4 py-3 border-left-primary">
      <div class="card-body">
        <form action="" method="POST">
          <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama" id="nama" value="<?= $data['nama_user']; ?>" autocomplete="off" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="username" id="username" value="<?= $data['username']; ?>" autocomplete="off" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="role" class="col-sm-3 col-form-label">Role</label>
            <div class="col-sm-9">
              <select name="role" id="role" class="form-control">
                <?php
                if ($data['role'] == 'admin') {
                  echo "<option selected value='admin'>Admin</option>";
                  echo "<option value='guru'>Guru</option>";
                } else {
                  echo "<option value='admin'>Admin</option>";
                  echo "<option selected value='guru'>Guru</option>";
                }
                ?>
              </select>
            </div>
          </div>
      </div>
    </div>
    <button type="submit" name="edit" class="btn btn-sm btn-primary float-right mr-3">Submit</button>
    <a href="user" class="btn btn-sm btn-secondary float-right mr-3">Cancel</a>
    </form>
  </div>

  <?php

  if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $addQuery = $conn->query("UPDATE tb_user SET username='$username', nama_user='$nama', role='$role' WHERE id_user = '$id'");

    if ($addQuery) {
  ?>
      <script>
        alert("Data user berhasil diedit");
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