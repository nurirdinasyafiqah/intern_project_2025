<?php
require_once '../app/config.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_penuh'];
    $emel = $_POST['emel'];
    $kata_laluan = $_POST['kata_laluan'];
    $peranan = 'staff'; // default role

    // Hash password
    $hashed = password_hash($kata_laluan, PASSWORD_DEFAULT);

    // Semak kalau emel dah wujud
    $check = $pdo->prepare("SELECT * FROM user WHERE emel = ?");
    $check->execute([$emel]);
    if ($check->fetch()) {
        $message = "⚠️ Emel sudah digunakan. Sila guna emel lain.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO user (nama_penuh, emel, kata_laluan, peranan) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nama, $emel, $hashed, $peranan])) {
            $message = "✅ Akaun berjaya didaftarkan! Anda boleh log masuk sekarang.";
        } else {
            $message = "❌ Ralat semasa pendaftaran.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akaun | Sistem Profil SPAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="card p-4">
    <h3 class="text-center mb-3">Daftar Akaun</h3>
    <?php if ($message): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Penuh</label>
            <input type="text" name="nama_penuh" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Emel</label>
            <input type="email" name="emel" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kata Laluan</label>
            <input type="password" name="kata_laluan" class="form-control" required>
        </div>
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-success">Daftar</button>
        </div>
        <div class="text-center">
            <a href="login.php">Sudah ada akaun? Log masuk</a>
        </div>
    </form>
</div>
</body>
</html>
