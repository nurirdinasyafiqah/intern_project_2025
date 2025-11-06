<?php
require_once '../app/config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emel = trim($_POST['emel']);

    // Semak jika emel wujud dalam DB
    $stmt = $pdo->prepare("SELECT * FROM user WHERE emel = ?");
    $stmt->execute([$emel]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Untuk demo: papar mesej berjaya (belum implement reset sebenar)
        $message = '<div class="alert alert-success text-center">Pautan reset kata laluan telah dihantar ke emel anda (simulasi).</div>';
    } else {
        $message = '<div class="alert alert-danger text-center">Emel tidak dijumpai dalam sistem.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <title>Lupa Kata Laluan</title>
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
        .reset-box {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid #cce5f6;
            border-radius: 10px;
            padding: 80px 50px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .reset-box h3 {
            text-align:center;
            color: #006fa6;
            font-weight: 700;
            margin-bottom: 50px;
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
    

<div class="reset-box">
    <h3>Lupa Kata Laluan</h3>

    <?= $message ?>

    <form method="POST">
        <div class="mb-5">
            <label for="emel" class="form-label">Masukkan Emel Anda</label>
            <input type="email" class="form-control" id="emel" name="emel" required>
        </div>
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary">Hantar Pautan Reset</button>
        </div>
        <div class="extra-links">
            <a href="login.php">← Kembali ke Log Masuk</a>
        </div>
    </form>
</div>

</body>
</html>
