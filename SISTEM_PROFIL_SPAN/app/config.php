<?php
// app/config.php

$host = 'localhost';
$user = 'root';        // default XAMPP username
$pass = '';            // default XAMPP password is empty
$dbname = 'sistem_profil_span';

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
