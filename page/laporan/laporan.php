<form action="" method="post">
  <div class="row">
    <div class="col-2">
      <div class="form-group">
        <select id="inputState" class="form-control">
          <option>Pilih Kelas</option>
          <?php
          $kelasQuery = $conn->query("SELECT * FROM tb_kelas");
          while ($resultKelas = $kelasQuery->fetch_assoc()) {

          ?>
            <option value="<?= $resultKelas['id_kelas']; ?>"><?= $resultKelas['kelas']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-2">
      <div class="form-group">
        <select id="inputState" class="form-control">
          <option>Pilih Jurusan</option>
          <?php
          $jurusanQuery = $conn->query("SELECT * FROM tb_jurusan");
          while ($resultJurusan = $jurusanQuery->fetch_assoc()) {

          ?>
            <option value="<?= $resultJurusan['id_jurusan']; ?>"><?= $resultJurusan['jurusan']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-3">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Tanggal</label>
        <div class="col-sm-9">
          <input type="date" class="form-control">
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Tanggal</label>
        <div class="col-sm-9">
          <input type="date" class="form-control">
        </div>
      </div>
    </div>
    <div class="col-1">
      <div class="form-group">
        <button type="submit" class="btn btn-sm btn-success">Pilih</button>
      </div>
    </div>
  </div>
</form>