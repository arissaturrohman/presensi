<div class="row">
  <div class="col-5">
    <h1 class="h3 mb-4 text-gray-800">Form Tambah Kelas</h1>
    <div class="card mb-4 py-3 border-left-primary">
      <div class="card-body">
        <form action="" method="POST">
          <div class="form-group row">
            <label for="kelas" class="col-sm-3 col-form-label">Kelas</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="kelas" id="kelas" autocomplete="off" required>
            </div>
          </div>
      </div>
    </div>
    <button type="submit" name="add" class="btn btn-sm btn-primary float-right mr-3">Tambah</button>
    </form>
  </div>

  <?php

  if (isset($_POST['add'])) {
    $kelas = $_POST['kelas'];

    $addQuery = $conn->query("INSERT INTO tb_kelas (kelas) VALUES ('$kelas')");

    if ($addQuery) {
  ?>
      <script>
        alert("Data kelas berhasil ditambah");
        window.location.href = "kelas";
      </script>
  <?php
    }
  }

  ?>

  <div class="col-7">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th width="3%">No</th>
                <th>Kelas</th>
                <th width="20%">Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sql = $conn->query("SELECT * FROM tb_kelas");
              while ($result = $sql->fetch_assoc()) {
              ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $result['kelas']; ?></td>
                  <td>
                    <a href="?page=kelas&action=edit&id=<?= $result['id_kelas']; ?>" data-toggle="tooltip" data-placement="top" title="edit"><i class="fas fa-fw fa-edit text-success"></i></a>
                    <a href="?page=kelas&action=delete&id=<?= $result['id_kelas']; ?>" onclick="return confirm('Anda Yakin akan menghapus data ini...?')" data-toggle="tooltip" data-placement="top" title="delete"><i class="fas fa-fw fa-trash-alt text-danger"></i></a>
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