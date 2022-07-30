<h1 class="h3 mb-4 text-gray-800">Laporan Harian</h1>

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
    <div class="col-2">
      <div class="form-group">
        <input type="date" name="cariTanggal" class="form-control" id="">
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
  $cariTanggal = $_POST['cariTanggal'];

  $sqlKelas = $conn->query("SELECT * FROM tb_kelas WHERE id_kelas = '$cariKelas'");
  $dataKelas = $sqlKelas->fetch_assoc();

  $sqlJurusan = $conn->query("SELECT * FROM tb_jurusan WHERE id_jurusan = '$cariJurusan'");
  $dataJurusan = $sqlJurusan->fetch_assoc();
}
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Absensi Siswa Kelas <?= $dataKelas['kelas']; ?> Jurusan <?= $dataJurusan['jurusan']; ?></h6>
    <h6 class="m-0 font-weight-bold text-primary float-right">Tanggal : <?= date("d-m-Y"); ?></h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="3%" class="align-middle text-center">No</th>
            <th class="align-middle text-center">NISN</th>
            <th class="align-middle text-center">Nama</th>
            <th class="align-middle text-center">Presensi</th>
            <th class="align-middle text-center">Keterangan</th>
          </tr>

        </thead>
        <tbody>
          <?php
          $no = 1;
          $hari_ini = date('Y-m-d');
          $sql = $conn->query("SELECT * FROM tb_siswa WHERE id_kelas = '$cariKelas' AND id_jurusan = '$cariJurusan'");
          while ($result = $sql->fetch_assoc()) {
            $nisn = $result['nisn'];


            $absen = $conn->query("SELECT * FROM tb_presensi WHERE nisn = '$nisn' AND tgl_presensi = '$cariTanggal'");
            while ($resultAbsen = $absen->fetch_assoc()) {
              $nisn = $result['nisn'];
              $presensi = $resultAbsen['presensi'];
              $nama = $result['nama_siswa'];
              $ket = $resultAbsen['ket'];

          ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $nisn; ?></td>
                <td><?= $nama; ?></td>
                <td><?= $presensi; ?></td>
                <td><?= $ket; ?></td>
              </tr>
          <?php }
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>