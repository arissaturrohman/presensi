<?php 

$page = $_GET['page'];
$action = $_GET['action'];

if ($page == 'siswa') {
  if ($action == '') {
    include "page/siswa/siswa.php";
  } elseif ($action == 'add') {
    include "page/siswa/add.php";
  } elseif ($action == 'edit') {
    include "page/siswa/edit.php";
  } elseif ($action == 'delete') {
    include "page/siswa/delete.php";
  }
} elseif ($page == 'jurusan') {
  if ($action == '') {
    include "page/jurusan/jurusan.php";
  }  elseif ($action == 'add') {
    include "page/jurusan/add.php";
  } elseif ($action == 'edit') {
    include "page/jurusan/edit.php";
  } elseif ($action == 'delete') {
    include "page/jurusan/delete.php";
  }
}  elseif ($page == 'kelas') {
  if ($action == '') {
    include "page/kelas/kelas.php";
  }  elseif ($action == 'add') {
    include "page/kelas/add.php";
  } elseif ($action == 'edit') {
    include "page/kelas/edit.php";
  } elseif ($action == 'delete') {
    include "page/kelas/delete.php";
  }
}  elseif ($page == 'user') {
  if ($action == '') {
    include "page/user/user.php";
  }  elseif ($action == 'add') {
    include "page/user/add.php";
  } elseif ($action == 'edit') {
    include "page/user/edit.php";
  } elseif ($action == 'delete') {
    include "page/user/delete.php";
  }
} elseif ($page == 'absen') {
  if ($action == '') {
    include "page/absen/absen.php";
  }  elseif ($action == 'add') {
    include "page/absen/add.php";
  } elseif ($action == 'edit') {
    include "page/absen/edit.php";
  } elseif ($action == 'delete') {
    include "page/absen/delete.php";
  }
}
 elseif ($page == 'harian') {
  if ($action == '') {
    include "page/laporan/harian.php";
  }
}elseif ($page == 'bulanan') {
  if ($action == '') {
    include "page/laporan/bulanan.php";
  }
}
 else {
  include "inc/dashboard.php";
}
