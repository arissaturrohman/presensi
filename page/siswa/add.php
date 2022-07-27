<h1 class="h3 mb-1 text-gray-800">Form Tambah Siswa</h1>
<hr>
<form action="" method="POST">
  <div class="form-group row">
    <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="nisn" name="nisn">
    </div>
  </div>
  <div class="form-group row">
    <label for="nama" class="col-sm-2 col-form-label">Nama Siswa</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="nama" name="nama">
    </div>
  </div>
  <div class="form-group row">
    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
    <div class="col-sm-4">
      <select id="kelas" class="form-control" name="kelas">
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
  <div class="form-group row">
    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
    <div class="col-sm-4">
      <select id="jurusan" class="form-control" name="jurusan">
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
  <fieldset class="form-group row">
    <legend class="col-form-label col-sm-2 float-sm-left pt-0">Jenis Kelamin</legend>
    <div class="col-sm-4">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="jk" id="gridRadios1" value="L">
        <label class="form-check-label" for="gridRadios1">
          Laki-laki
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="jk" id="gridRadios2" value="P">
        <label class="form-check-label" for="gridRadios2">
          Perempuan
        </label>
      </div>
  </fieldset>
  <div class="form-group row">
    <label for="lahir" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="tempat">
    </div>
    <div class="col-sm-2">
      <input type="date" class="form-control" name="lahir">
    </div>
  </div>
  <div class="form-group row">
    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-4">
      <textarea name="alamat" id="" rows="5" class="form-control"></textarea>

    </div>
  </div>
  <div class="form-group row">
    <label for="ibu" class="col-sm-2 col-form-label">Nama Ibu</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="ibu" name="ibu">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-6">
      <button type="submit" name="add" class="btn btn-sm btn-primary float-right">Tambah</button>
      <a href="siswa" class="btn btn-sm btn-secondary float-right mr-2">Cancel</a>
    </div>
  </div>
</form>

<?php

if (isset($_POST['add'])) {
  $nisn = $_POST['nisn'];
  $nama = $_POST['nama'];
  $kelas = $_POST['kelas'];
  $jurusan = $_POST['jurusan'];
  $jk = $_POST['jk'];
  $tempat = $_POST['tempat'];
  $lahir = $_POST['lahir'];
  $alamat = $_POST['alamat'];
  $ibu = $_POST['ibu'];

  $addSiswa = $conn->query("INSERT INTO tb_siswa (nisn, nama_siswa,jk,alamat,tempat_lahir,tanggal_lahir,id_kelas,id_jurusan,nama_ibu) VALUES ('$nisn','$nama','$jk','$alamat','$tempat','$lahir','$kelas','$jurusan','$ibu')");

  if ($addSiswa) {
?>
    <script>
      alert("Data Siswa berhasil ditambah");
      window.location.href = "siswa";
    </script>
<?php
  }
}

?>