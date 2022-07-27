<?php
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM tb_siswa WHERE id_siswa = '$id'");
?>

<script type="text/javascript">
  window.location.href = "siswa";
</script>