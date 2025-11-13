<?php
// app/config.php
$host = '127.0.0.1';
$db   = 'sistem_profil_span';
$user = 'root';
$pass = ''; // default XAMPP password kosong

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Gagal sambung ke pangkalan data: " . $e->getMessage());
}
?>
