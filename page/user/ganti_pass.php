<?php
$id_user = $_GET['id'];
$ganti = $conn->query("SELECT * FROM tb_user WHERE id_user = '$id_user'");
$data_ganti = $ganti->fetch_assoc();
?>

<div class="row">
  <div class="col-4 offset-4">
    <div class="card">
      <div class="card-header">
        Ganti Password
      </div>
      <div class="card-body">
        <form action="" method="post">
          <input type="hidden" name="id_user" value="<?= $data_ganti['id_user']; ?>" id="iduser">
          <div class="form-group">
            <label for="pass_lama">Password Lama</label>
            <input type="password" name="pass_lama" class="form-control" id="pass_lama">
          </div>
          <div class="form-group">
            <label for="pass_baru">Password Baru</label>
            <input type="password" name="pass_baru" class="form-control" id="pass_baru">
          </div>
          <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
// session_start();

if (isset($_POST['submit'])) {
  $id_user = $_POST['id_user'];
  $pass_lama = $_POST['pass_lama'];
  $pass_baru = $_POST['pass_baru'];
  $hash = password_hash($pass_baru, PASSWORD_DEFAULT);

  $query = "SELECT *from tb_user WHERE id_user='$id_user'";
  $result = mysqli_query($conn, $query);
  while ($data = mysqli_fetch_assoc($result)) {
    $hasil = $data["password"];
    $verf = password_verify($pass_lama, $hasil);
    if ($verf == true) {
      mysqli_query($conn, "UPDATE tb_user SET password='$hash' WHERE id_user='$id_user'");
      $_SESSION = [];
      session_unset();
      session_destroy();
?>
      <script>
        alert("Password berhasil diubah");
        window.location.href = "login.php";
      </script>
      <?php
    } else {
      echo "<script>
          alert('gagal')</script>";
    }
  }
}
?>