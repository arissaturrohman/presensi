<?php

$id = $_GET['id'];
$editSiswa = $conn->query("SELECT * FROM tb_siswa WHERE id_siswa = '$id'");
$resultSiswa = $editSiswa->fetch_assoc();
$kelas = $resultSiswa['id_kelas'];
$jurusan = $resultSiswa['id_jurusan'];

?>

<h1 class="h3 mb-1 text-gray-800">Form Edit Siswa</h1>
<hr>
<form action="" method="POST">
  <input type="hidden" name="id_kelas" value="<?= $resultSiswa['id_siswa']; ?>">
  <div class="form-group row">
    <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $resultSiswa['nisn']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="nama" class="col-sm-2 col-form-label">Nama Siswa</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="nama" name="nama" value="<?= $resultSiswa['nama_siswa']; ?>">
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

          if ($kelas == $resultKelas['id_kelas']) {
            $select = "selected";
          } else {
            $select = "";
          }

        ?>
          <option value="<?= $resultKelas['id_kelas']; ?>" <?= $select; ?>><?= $resultKelas['kelas']; ?></option>
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

          if ($jurusan == $resultJurusan['id_jurusan']) {
            $select = "selected";
          } else {
            $select = "";
          }
        ?>
          <option value="<?= $resultJurusan['id_jurusan']; ?>" <?= $select; ?>><?= $resultJurusan['jurusan']; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <fieldset class="form-group row">
    <legend class="col-form-label col-sm-2 float-sm-left pt-0">Jenis Kelamin</legend>
    <div class="col-sm-4">
      <div class="form-check">
        <?php
        if ($resultSiswa['jk'] == 'L') {
          $ceck = "checked";
        } else {
          $ceck = "";
        }
        ?>
        <input class="form-check-input" type="radio" name="jk" id="gridRadios1" value="L" <?= $ceck; ?>>
        <label class="form-check-label" for="gridRadios1">
          Laki-laki
        </label>
      </div>
      <div class="form-check">
        <?php
        if ($resultSiswa['jk'] == 'P') {
          $ceck = "checked";
        } else {
          $ceck = "";
        }
        ?>
        <input class="form-check-input" type="radio" name="jk" id="gridRadios2" value="P" <?= $ceck; ?>>
        <label class="form-check-label" for="gridRadios2">
          Perempuan
        </label>
      </div>
  </fieldset>
  <div class="form-group row">
    <label for="lahir" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="tempat" value="<?= $resultSiswa['tempat_lahir']; ?>">
    </div>
    <div class="col-sm-2">
      <input type="date" class="form-control" name="lahir" value="<?= $resultSiswa['tanggal_lahir']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-4">
      <textarea name="alamat" id="" rows="5" class="form-control"><?= $resultSiswa['alamat']; ?></textarea>

    </div>
  </div>
  <div class="form-group row">
    <label for="ibu" class="col-sm-2 col-form-label">Nama Ibu</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="ibu" name="ibu" value="<?= $resultSiswa['nama_ibu']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-6">
      <button type="submit" name="edit" class="btn btn-sm btn-primary float-right">Submit</button>
      <a href="siswa" class="btn btn-sm btn-secondary float-right mr-2">Cancel</a>
    </div>
  </div>
</form>

<?php

if (isset($_POST['edit'])) {
  $nisn = $_POST['nisn'];
  $nama = $_POST['nama'];
  $kelas = $_POST['kelas'];
  $jurusan = $_POST['jurusan'];
  $jk = $_POST['jk'];
  $tempat = $_POST['tempat'];
  $lahir = $_POST['lahir'];
  $alamat = $_POST['alamat'];
  $ibu = $_POST['ibu'];

  $editSiswa = $conn->query("UPDATE tb_siswa SET nisn='$nisn', nama_siswa='$nama',jk='$jk',alamat='$alamat',tempat_lahir='$tempat',tanggal_lahir='$lahir',id_kelas='$kelas',id_jurusan='$jurusan',nama_ibu='$ibu' WHERE id_siswa='$id'");

  if ($editSiswa) {
?>
    <script>
      alert("Data Siswa berhasil diubah");
      window.location.href = "siswa";
    </script>
<?php
  }
}

?>