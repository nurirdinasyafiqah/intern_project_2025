<?php
session_start();

if (isset($_SESSION['id_user'])) {
    header("Location: public/dashboard.php");
} else {
    header("Location: public/login.php");
}
exit();
?>
