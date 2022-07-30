<?php
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM tb_user WHERE id_user = '$id'");
?>

<script type="text/javascript">
  window.location.href = "user";
</script>