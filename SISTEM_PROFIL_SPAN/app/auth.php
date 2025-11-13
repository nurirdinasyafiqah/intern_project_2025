<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config.php';

function login($emel, $kata_laluan) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM user WHERE emel = ?");
    $stmt->execute([$emel]);
    $user = $stmt->fetch();

    if ($user && password_verify($kata_laluan, $user['kata_laluan'])) {
        $_SESSION['user'] = [
            'id' => $user['id_user'],
            'nama' => $user['nama_penuh'],
            'emel' => $user['emel']
            //'peranan' => $user['peranan']
        ];
        return true;
    }
    return false;
}

function require_login() {
    if (!isset($_SESSION['user'])) {
        header("Location: /intern_project_2025/SISTEM_PROFIL_SPAN/public/login.php");
        exit();
    }
}

function logout() {
    session_destroy();
    header("Location: /intern_project_2025/SISTEM_PROFIL_SPAN/public/login.php");
    exit();
}
?>
