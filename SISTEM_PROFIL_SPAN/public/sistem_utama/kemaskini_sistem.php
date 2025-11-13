<?php
require_once '../../app/config.php';
require_once '../../app/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id_sistemutama'];

  // Update sistem_utama
  $stmt = $pdo->prepare("UPDATE sistem_utama SET nama_entiti=?, bahagian=?, alamat=? WHERE id_sistemutama=?");
  $stmt->execute([$_POST['nama_entiti'], $_POST['bahagian'], $_POST['alamat'], $id]);

  // Update sistem_aplikasi
  $stmt2 = $pdo->prepare("UPDATE sistem_aplikasi SET nama_sistem=?, objektif=?, pemilik=?, kaedah_pembangunan=? WHERE id_sistemutama=?");
  $stmt2->execute([$_POST['nama_sistem'], $_POST['objektif'], $_POST['pemilik'], $_POST['kaedah_pembangunan'], $id]);

  header("Location: view_sistem.php?id=$id&updated=1");
  exit();
}
?>
