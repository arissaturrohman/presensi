<form action="" method="post">
  <div class="row">
    <div class="col-2">
      <div class="form-group">
        <select id="inputState" class="form-control" name="cariKelas">
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
        <select id="inputState" class="form-control" name="cariJurusan">
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
    <div class="col-1">
      <button type="submit" name="cari" class="btn btn-success">Pilih</button>
    </div>
  </div>
</form>

<?php
if (isset($_POST['cari'])) {
  $cariKelas = $_POST['cariKelas'];
  $cariJurusan = $_POST['cariJurusan'];

  $sqlKelas = $conn->query("SELECT * FROM tb_kelas WHERE id_kelas = '$cariKelas'");
  $dataKelas = $sqlKelas->fetch_assoc();

  $sqlJurusan = $conn->query("SELECT * FROM tb_jurusan WHERE id_jurusan = '$cariJurusan'");
  $dataJurusan = $sqlJurusan->fetch_assoc();
}
?>

<form action="" method="post">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Absensi Siswa Kelas <?= $dataKelas['kelas']; ?> Jurusan <?= $dataJurusan['jurusan']; ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th rowspan="2" width="3%" class="align-middle text-center">No</th>
              <th rowspan="2" class="align-middle text-center">NISN</th>
              <th rowspan="2" class="align-middle text-center">Nama</th>
              <th rowspan="2" class="align-middle text-center">Kelas</th>
              <th rowspan="2" class="align-middle text-center">Jurusan</th>
              <th colspan="4" class="align-middle text-center">Absensi</th>
              <th rowspan="2" class="align-middle text-center">Ket</th>
              <!-- <th rowspan="2" width="5%" class="align-middle text-center">Opsi</th> -->
            </tr>
            <tr>
              <th>Hadir</th>
              <th>Ijin</th>
              <th>Sakit</th>
              <th>Alpa</th>
            </tr>

          </thead>
          <tbody>
            <?php
            $no = 1;
            $sql = $conn->query("SELECT * FROM tb_siswa WHERE id_kelas = '$cariKelas' AND id_jurusan = '$cariJurusan'");
            while ($result = $sql->fetch_assoc()) {
              $id_siswa = $result['id_siswa'];
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td>
                  <input type="text" name="nisn[]" value="<?= $result['nisn']; ?>">
                  <?= $result['nisn']; ?>
                </td>
                <td><?= $result['nama_siswa']; ?></td>

                <?php
                $id_kelas = $result['id_kelas'];
                $kelas = $conn->query("SELECT * FROM tb_kelas WHERE id_kelas = '$id_kelas'");
                while ($resultKelas = $kelas->fetch_assoc()) {
                ?>
                  <td>
                    <!-- <input type="hidden" name="id_kelas[]" value="<?= $resultKelas['id_kelas']; ?>"> -->
                    <?= $resultKelas['kelas']; ?>
                  </td>
                <?php } ?>

                <?php
                $id_jurusan = $result['id_jurusan'];
                $jurusan = $conn->query("SELECT * FROM tb_jurusan WHERE id_jurusan = '$id_jurusan'");
                while ($resultjurusan = $jurusan->fetch_assoc()) {
                ?>
                  <td>
                    <!-- <input type="hidden" name="id_jurusan[]" value="<?= $resultjurusan['id_jurusan']; ?>"> -->
                    <?= $resultjurusan['jurusan']; ?>
                  </td>
                <?php } ?>

                <td>
                  <input type="radio" name="absen[<?= $result['id_siswa']; ?>]" value="hadir" checked>
                </td>
                <td>
                  <input type="radio" name="absen[<?= $result['id_siswa']; ?>]" value="ijin">
                </td>
                <td>
                  <input type="radio" name="absen[<?= $result['id_siswa']; ?>]" value="sakit">
                </td>
                <td>
                  <input type="radio" name="absen[<?= $result['id_siswa']; ?>]" value="alpa">
                </td>
                <td>
                  <input type="text" name="ket[]" class="form-control">
                </td>
                <input type="text" name="tgl[]" value="<?= date('Y-m-d'); ?>" class="form-control">
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php
        $sql1 = $conn->query("SELECT COUNT(nisn) FROM tb_siswa WHERE id_kelas = '$cariKelas' AND id_jurusan = '$cariJurusan'");
        while ($data = $sql1->fetch_assoc()) {
          $jumlah = $data['COUNT(nisn)'];
        }
        ?>
      </div>
    </div>
  </div>
  <input type="hidden" name="count" value="<?= $jumlah; ?>">
  <button type="submit" name="add" class="btn btn-sm btn-success">Submit</button>
</form>

<?php

if (isset($_POST['add'])) {

  $id_siswa = $_POST['id_siswa'];
  $id_kelas = $_POST['id_kelas'];
  $id_jurusan = $_POST['id_jurusan'];
  $hadir = $_POST['absen'];
  $ket = $_POST['ket'];
  $tgl = $_POST['tgl'];
  $jum = $_POST['count'];
  $nisn = $_POST['nisn'];

 
  $i = 0;
  foreach ($hadir as $key) {
    $addPresensi = $conn->query("INSERT INTO tb_presensi (nisn,presensi,tgl_presensi, ket) VALUES ('$nisn[$i]','$key','$tgl[$i]', '$ket[$i]')");
    $i++;
  }



  if ($addPresensi) {
?>
    <script>
      alert("Data Absensi berhasil ditambah");
      window.location.href = "absen";
    </script>
<?php
  }
}

?>