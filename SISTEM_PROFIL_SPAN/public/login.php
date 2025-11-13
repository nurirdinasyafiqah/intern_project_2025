<?php
require_once '../app/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emel = $_POST['emel'];
    $kata_laluan = $_POST['kata_laluan'];

    $sql = "SELECT * FROM USER WHERE emel = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $emel);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($kata_laluan, $user['kata_laluan'])) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama_penuh'] = $user['nama_penuh'];
            $_SESSION['peranan'] = $user['peranan'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Kata laluan salah.";
        }
    } else {
        $error = "Pengguna tidak ditemui.";
    }
}
?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Log Masuk - Sistem Profil SPAN</title>
  <link rel="stylesheet" href="css/sb-admin-2.min.css">
</head>
<body class="bg-gradient-primary">
<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-body">
          <h3 class="text-center mb-4">Log Masuk</h3>
          <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
          <form method="POST">
            <div class="form-group">
              <label>Emel</label>
              <input type="email" name="emel" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Kata Laluan</label>
              <input type="password" name="kata_laluan" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Log Masuk</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
