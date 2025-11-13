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

    <link rel="stylesheet" href="css/lupa_katalaluan.css">
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
