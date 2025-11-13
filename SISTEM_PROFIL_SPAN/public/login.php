<?php
require_once '../app/auth.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emel = $_POST['emel'];
    $kata_laluan = $_POST['kata_laluan'];

    if (login($emel, $kata_laluan)) {
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Emel atau kata laluan tidak sah.";
    }
}
?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <title>Log Masuk | Sistem Profil SPAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
  <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="logo">
    <img src="../assets/img/span-logo.png" alt="Logo SPAN">
</div>

<div class="subtitle">S I S T E M &nbsp; P R O F I L</div>

<div class="login-box">
    <h3>Log Masuk</h3>

    <?php if ($error): ?>
        <div class="alert alert-danger py-2 text-center"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="emel" class="form-label">Emel Pengguna</label>
            <input type="email" class="form-control" id="emel" name="emel" required>
        </div>
        <div class="mb-5">
            <label for="kata_laluan" class="form-label">Kata Laluan</label>
            <input type="password" class="form-control" id="kata_laluan" name="kata_laluan" required>
        </div>
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary">Log Masuk</button>
        </div>
        <div class="extra-links">
            <a href="lupa_katalaluan.php">Lupa Kata Laluan?</a><br>
            <a href="register.php">Belum ada akaun? Daftar sekarang</a>
        </div>
    </form>
</div>

</body>
</html>
