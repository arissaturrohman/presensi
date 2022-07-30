<div class="row">

<?php 

$siswa = $conn->query("SELECT COUNT(*) AS siswa FROM tb_siswa");
$dataSiswa = $siswa->fetch_assoc();

?>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Siswa</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dataSiswa['siswa']; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php 

$perempuan = $conn->query("SELECT COUNT(*) AS perempuan FROM tb_siswa WHERE jk = 'P'");
$dataPerempuan = $perempuan->fetch_assoc();

?>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Siswa Perempuan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dataPerempuan['perempuan']; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php 

$laki = $conn->query("SELECT COUNT(*) AS laki FROM tb_siswa WHERE jk = 'L'");
$dataLaki = $laki->fetch_assoc();

?>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Siswa Laki-laki</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dataLaki['laki']; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php 

$guru = $conn->query("SELECT COUNT(*) AS guru FROM tb_user WHERE role = 'guru'");
$dataguru = $guru->fetch_assoc();

?>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Guru</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dataguru['guru']; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>