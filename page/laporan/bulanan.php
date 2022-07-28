<h1 class="h3 mb-4 text-gray-800">Laporan Bulanan</h1>

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
        <select id="bulan" class="form-control" name="cariBulan">
          <option>Pilih Bulan</option>
          <option value="01">Januari</option>
          <option value="02">Februari</option>
          <option value="03">Maret</option>
          <option value="04">April</option>
          <option value="05">Mei</option>
          <option value="06">Juni</option>
          <option value="07">Juli</option>
          <option value="08">Agustus</option>
          <option value="09">September</option>
          <option value="10">Oktober</option>
          <option value="11">November</option>
          <option value="12">Desember</option>
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
  $cariBulan = $_POST['cariBulan'];

  $sqlKelas = $conn->query("SELECT * FROM tb_kelas WHERE id_kelas = '$cariKelas'");
  $dataKelas = $sqlKelas->fetch_assoc();

  $sqlJurusan = $conn->query("SELECT * FROM tb_jurusan WHERE id_jurusan = '$cariJurusan'");
  $dataJurusan = $sqlJurusan->fetch_assoc();
}

$bulan = [
  '01' => 'Januari',
  '02' => 'Februari',
  '03' => 'Maret',
  '04' => 'April',
  '05' => 'Mei',
  '06' => 'Juni',
  '07' => 'Juli',
  '08' => 'Agustus',
  '09' => 'September',
  '10' => 'Oktober',
  '11' => 'November',
  '12' => 'Desember'
];
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Absensi Siswa Kelas <?= $dataKelas['kelas']; ?> Jurusan <?= $dataJurusan['jurusan']; ?></h6>
    <h6 class="m-0 font-weight-bold text-primary float-right">Bulan : <?= $bulan[$cariBulan]; ?></h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th rowspan="2" width="3%" class="align-middle text-center">No</th>
            <th rowspan="2" class="align-middle text-center">NISN</th>
            <th rowspan="2" class="align-middle text-center">Nama</th>
            <?php

            $tahun = date('Y'); //Mengambil tahun saat ini
            $bulan = date($cariBulan); //Mengambil bulan saat ini
            $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

            for ($i = 1; $i < $tanggal + 1; $i++) {
              // echo $i . " ";
              // echo "<th rowspan='$i' class='align-middle text-center'>Presensi</th>";

            }
            ?>

              <th colspan="<?= $i; ?>" class="align-middle text-center">Rekap</th>
            
            <th colspan="5" class="align-middle text-center">Rekap</th>
          </tr>
          <tr>
            <?php

            $tahun = date('Y'); //Mengambil tahun saat ini
            $bulan = date($cariBulan); //Mengambil bulan saat ini
            $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

            for ($i = 1; $i < $tanggal + 1; $i++) {
              // echo $i . " ";
              echo "<th class='align-middle text-center'>$i</th>";
            }
            ?>
            <th class="align-middle text-center">H</th>
            <th class="align-middle text-center">I</th>
            <th class="align-middle text-center">S</th>
            <th class="align-middle text-center">A</th>
          </tr>

        </thead>
        <tbody>
          <?php

          $no = 1;
          $bulan_ini = $cariBulan;

          $sql = $conn->query("SELECT * FROM tb_siswa WHERE id_kelas = '$cariKelas' AND id_jurusan = '$cariJurusan'");
          while ($result = $sql->fetch_assoc()) {
            $nisn = $result['nisn'];

            $absen = $conn->query("SELECT * FROM tb_presensi WHERE nisn = '$nisn' AND MONTH(tgl_presensi) = '$bulan_ini'");
            while ($resultAbsen = $absen->fetch_assoc()) {
              $nisn = $result['nisn'];
              $presensi = $resultAbsen['presensi'];
              $nama = $result['nama_siswa'];
              // $jumlah = $resultAbsen['jumlah']
              // $lap = date('m', strtotime($resultAbsen['tgl_presensi']));

          ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $nisn; ?></td>
                <td><?= $nama; ?></td>
                <?php
                // hitung jumlah hadir
                $hadir = $conn->query("SELECT COUNT(*) AS hadir FROM tb_presensi WHERE presensi = 'hadir' AND nisn = '$nisn' ORDER BY nisn");
                $dataHadir = $hadir->fetch_assoc();

                // hitung jumlah ijin
                $ijin = $conn->query("SELECT COUNT(*) AS ijin FROM tb_presensi WHERE presensi = 'ijin' AND nisn = '$nisn' ORDER BY nisn");
                $dataijin = $ijin->fetch_assoc();

                // hitung jumlah sakit
                $sakit = $conn->query("SELECT COUNT(*) AS sakit FROM tb_presensi WHERE presensi = 'sakit' AND nisn = '$nisn' ORDER BY nisn");
                $datasakit = $sakit->fetch_assoc();

                // hitung jumlah alpa
                $alpa = $conn->query("SELECT COUNT(*) AS alpa FROM tb_presensi WHERE presensi = 'alpa' AND nisn = '$nisn' ORDER BY nisn");
                $dataalpa = $alpa->fetch_assoc();

                ?>
                <td><?= $dataHadir['hadir'];  ?></td>
                <td><?= $dataijin['ijin'];  ?></td>
                <td><?= $datasakit['sakit'];  ?></td>
                <td><?= $dataalpa['alpa'];  ?></td>
              </tr>
          <?php }
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>