<?php
session_start();

if (isset($_SESSION["login"])) {
  header("Location: index.php");
}
include('inc/config.php');

if (isset($_POST["login"])) {
  $user = $_POST['username'];
  $pass = $_POST['password'];
  $sql = $conn->query("SELECT * FROM tb_user where username='$user'");

  //cek username
  if (mysqli_num_rows($sql) === 1) {

    //cek password
    $row = mysqli_fetch_assoc($sql);
    if (password_verify($pass, $row["password"])) {

      //cek session
      $_SESSION["login"] = true;
      if ($row['role']  == "admin") {
        $_SESSION['username'] = $username;
        $_SESSION['nama_user'] = $row['nama_user'];
        $_SESSION['id_user']  = $row['id_user'];
        $_SESSION['role']    = "admin";

        header('location:./');
        exit;
      } elseif ($row['role'] == "guru") {
        $_SESSION['username'] = $username;
        $_SESSION['nama_user'] = $row['nama_user'];
        $_SESSION['id_user']  = $row['id_user'];
        $_SESSION['role']    = "guru";

        header('location:./');
        exit;
      }
    }
  }

  $error = true;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="shortcut icon" href="img/logo smk.jpg" type="image/x-icon">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-md-6 mt-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-md">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Silahkan Login!</h1>
                  </div>
                  <?php if (isset($error)) : ?>
                    <p style="color:red; font-style:italic; text-align:center;">Username / Password salah</p>
                  <?php endif; ?>
                  <form class="user" action="" method="POST">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" placeholder="Masukkan Username..." autofocus>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                    </div>
                    <!-- <div class="form-group">
                      <select name="role" id="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                      </select>
                    </div> -->
                    <button type="submit" class="btn btn-primary btn-user btn-block" name="login">Login</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>