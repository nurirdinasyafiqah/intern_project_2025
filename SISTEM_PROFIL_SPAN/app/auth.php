<?php
// app/auth.php
session_start();

function require_login() {
    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit();
    }
}
?>
