<?php
require_once '../app/config.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_penuh']);
    $emel = trim($_POST['emel']);
    $kata_laluan = $_POST['kata_laluan'];
    $peranan = 'staff'; // default role

    // Hash password
    $hashed = password_hash($kata_laluan, PASSWORD_DEFAULT);

    // Semak kalau emel dah wujud
    $check = $pdo->prepare("SELECT * FROM user WHERE emel = ?");
    $check->execute([$emel]);
    if ($check->fetch()) {
        $message = '<div class="alert alert-warning text-center">⚠️ Emel sudah digunakan. Sila guna emel lain.</div>';
    } else {
        $stmt = $pdo->prepare("INSERT INTO user (nama_penuh, emel, kata_laluan, peranan) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nama, $emel, $hashed, $peranan])) {
            $message = '<div class="alert alert-success text-center">✅ Akaun berjaya didaftarkan! Anda boleh log masuk sekarang.</div>';
        } else {
            $message = '<div class="alert alert-danger text-center">❌ Ralat semasa pendaftaran.</div>';
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
            background-size: cover;
            height: 100vh;
            font-family: "Poppins", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .register-box {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid #cce5f6;
            border-radius: 10px;
            padding: 60px 50px;
            max-width: 450px;
            width: 90%;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .register-box h3 {
            text-align:center;
            color: #006fa6;
            font-weight: 700;
            margin-bottom: 40px;
            text-decoration: underline;
            text-underline-offset: 4px;
        }
        .btn-primary {
            background-color: #0072bc;
            border: none;
        }
        .btn-primary:hover {
            background-color: #005c94;
        }
        .logo {
            text-align: center;
            margin-bottom: 15px;
        }
        .logo img {
            width: 200px;
        }
        .subtitle {
            text-align: center;
            letter-spacing: 5px;
            color: #1b2e46;
            font-weight: 600;
            margin-bottom: 50px;
            margin-top: 25px;
        }
        .extra-links {
            text-align: center;
            font-size: 0.9em;
            margin-top: 15px;
        }
        .extra-links a {
            color: #0072bc;
            text-decoration: none;
        }
        .extra-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>


<div class="register-box">
    <h3>Daftar Akaun</h3>

    <?= $message ?>

    <form method="POST">
        <div class="mb-4">
            <label class="form-label">Nama Penuh</label>
            <input type="text" name="nama_penuh" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Emel</label>
            <input type="email" name="emel" class="form-control" required>
        </div>
        <div class="mb-5">
            <label class="form-label">Kata Laluan</label>
            <input type="password" name="kata_laluan" class="form-control" required>
        </div>
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary">Daftar Akaun</button>
        </div>
        <div class="extra-links">
            <a href="login.php">← Kembali ke Log Masuk</a>
        </div>
    </form>
</div>

</body>
</html>
