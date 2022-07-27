<?php
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM tb_kelas WHERE id_kelas = '$id'");
?>

<script type="text/javascript">
  window.location.href = "kelas";
</script>