<?php

include("inc/config.php");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap Absensi.xls");



$cariKelas = $_GET['kelas'];
$cariJurusan = $_GET['jurusan'];
$cariBulan = $_GET['bulan'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Export Excel</title>
</head>
<body>
    <h2 style="font-weight: bold;">Rekap Absensi</h2>
      <table border="1">
        <thead>
          <tr>
            <th rowspan="2" width="10px">No</th>
            <th rowspan="2">NISN</th>
            <th rowspan="2">Nama</th>               
            <th colspan="4">Rekap</th>
            <th rowspan="2">Jumlah</th>
          </tr>
          <tr>
            <th>H</th>
            <th>I</th>
            <th>S</th>
            <th>A</th>
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

                // hitung jumlah
                $alpa = $conn->query("SELECT COUNT(*) AS jumlah FROM tb_presensi WHERE presensi = '$presensi' AND nisn = '$nisn' ORDER BY nisn");
                $datajumlah = $alpa->fetch_assoc();

                  ?>
                <td><?= $dataHadir['hadir'];  ?></td>
                <td><?= $dataijin['ijin'];  ?></td>
                <td><?= $datasakit['sakit'];  ?></td>
                <td><?= $dataalpa['alpa'];  ?></td>
                <td><?= $datajumlah['jumlah'];  ?></td>
              </tr>
          <?php }
          } ?>
        </tbody>
      </table>
      <br>
      Keterangan :<br>
      H : Hadir<br>
      I : Ijin<br>
      S : Sakit<br>
      A : Alpa


</body>
</html>