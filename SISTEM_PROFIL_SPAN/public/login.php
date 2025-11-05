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
    <style>
        body {
            background: url('../assets/img/water-bg.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            font-family: "Poppins", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid #cce5f6;
            border-radius: 10px;
            padding: 40px 50px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .login-box h3 {
            text-align: center;
            color: #006fa6;
            font-weight: 700;
            margin-bottom: 40px;
            text-decoration: underline;
            text-underline-offset: 4px;
        }
        .login-box label {
            color: #555;
            font-weight: 500;
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
