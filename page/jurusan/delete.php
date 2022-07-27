<?php
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM tb_jurusan WHERE id_jurusan = '$id'");
?>

<script type="text/javascript">
  window.location.href = "jurusan";
</script>