<div class="row">
  <div class="col-5">
    <div class="card mb-4 py-3 border-left-primary">
      <div class="card-body">
        <?php
        $id = $_GET['id'];
        $editQuery = $conn->query("SELECT * FROM tb_jurusan WHERE id_jurusan = '$id'");
        $resultJurusan = $editQuery->fetch_assoc();
        ?>

        <form action="" method="POST">
          <input type="hidden" name="id_jurusan" value="<?= $resultJurusan['id_jurusan']; ?>">
          <div class="form-group row">
            <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" value="<?= $resultJurusan['jurusan']; ?>" name="jurusan" id="jurusan" autocomplete="off" required>
            </div>
          </div>
      </div>
    </div>
    <button type="submit" name="edit" class="btn btn-sm btn-primary float-right mr-3">Submit</button>
    <a href="jurusan" class="btn btn-sm btn-secondary float-right mr-3">Cancel</a>
    </form>
  </div>

  <?php

  if (isset($_POST['edit'])) {
    $jurusan = $_POST['jurusan'];

    $edit = $conn->query("UPDATE tb_jurusan SET jurusan = '$jurusan' WHERE id_jurusan = '$id'");

    if ($edit) {
  ?>
      <script>
        alert("Data Jurusan berhasil diubah");
        window.location.href = "jurusan";
      </script>
  <?php
    }
  }

  ?>

  <div class="col-7">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Jurusan</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th width="3%">No</th>
                <th>Jurusan</th>
                <th width="20%">Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sql = $conn->query("SELECT * FROM tb_jurusan");
              while ($result = $sql->fetch_assoc()) {
              ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $result['jurusan']; ?></td>
                  <td>
                    <a href="?page=jurusan&action=edit&id=<?= $result['id_jurusan']; ?>" data-toggle="tooltip" data-placement="top" title="edit"><i class="fas fa-fw fa-edit text-success"></i></a>
                    <a href="?page=jurusan&action=delete&id=<?= $result['id_jurusan']; ?>" onclick="return confirm('Anda Yakin akan menghapus data ini...?')" data-toggle="tooltip" data-placement="top" title="delete"><i class="fas fa-fw fa-trash-alt text-danger"></i></a>
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