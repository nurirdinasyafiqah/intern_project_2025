<?php
require_once '../../app/auth.php';
require_login();

// contoh data dummy (nanti boleh ambil dari DB)
$sistem_list = [
  ['nama' => 'Sistem Maklumat Aduan SPAN (sisMAS)']
];

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Sistem Utama | Sistem Profil SPAN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #eaf4f9;
      font-family: 'Poppins', sans-serif;
    }

    /* SIDEBAR */
    .sidebar {
      background-color: #f8f9fa;
      width: 260px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      padding-top: 30px;
      box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }
    .sidebar .logo {
      text-align: center;
      margin-bottom: 15px;
    }
    .sidebar .logo img {
      width: 150px;
    }
    .sidebar .title {
      text-align: center;
      font-weight: 600;
      font-size: 13px;
      letter-spacing: 3px;
      color: #1b2e46;
      margin-bottom: 25px;
    }
    .sidebar .nav-link {
      color: #1b2e46;
      padding: 10px 20px;
      border-radius: 8px;
      margin: 5px 10px;
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }
    .sidebar .nav-link.active {
      background-color: #0072bc;
      color: #fff;
    }
    .sidebar .nav-link:hover {
      background-color: #d9edf7;
      color: #000;
    }

    /* CONTENT AREA */
    .content {
      margin-left: 260px;
      padding: 25px 40px;
    }

    .main-header {
      background-color: #7ed957;
      color: #fff;
      font-weight: 600;
      font-size: 20px;
      padding: 15px;
      border-radius: 10px 10px 0 0;
      text-align: center;
    }

    .main-body {
      background-color: #fff;
      border-radius: 0 0 10px 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      padding: 25px;
    }

    .search-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .search-bar {
      border: 1px solid #ccc;
      border-radius: 20px;
      padding: 5px 10px;
      width: 200px;
    }

    .add-btn {
      border: none;
      background: none;
      font-size: 22px;
      color: #333;
      cursor: pointer;
    }

    .profile-card {
      background-color: #e8f6e8;
      border-radius: 10px;
      padding: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .profile-card button {
      background-color: #d9d9d9;
      border: none;
      border-radius: 10px;
      padding: 5px 15px;
      font-size: 0.9em;
      font-weight: 500;
    }

  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="logo">
    <img src="../../assets/img/span-logo.png" alt="SPAN Logo">
  </div>
  <div class="title">S I S T E M &nbsp; P R O F I L</div>
  <a href="../dashboard.php" class="nav-link <?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
    <i class="bi bi-grid-1x2-fill"></i> Dashboard
  </a>
  <a href="sistemUtama.php" class="nav-link <?= ($current_page == 'sistemUtama.php') ? 'active' : '' ?>">
    <i class="bi bi-pc-display"></i> Sistem Utama
  </a>
  <a href="../peralatan/list.php" class="nav-link <?= ($current_page == 'list.php') ? 'active' : '' ?>">
    <i class="bi bi-hdd-stack"></i> Peralatan
  </a>
</div>

<!-- MAIN CONTENT -->
<div class="content">
  <div class="main-header">Sistem Utama</div>
  <div class="main-body">
    <h5 class="fw-semibold mb-3">Senarai Profil</h5>
    <div class="search-section">
      <input type="text" class="search-bar" placeholder="Carian">
      <button class="add-btn" title="Tambah Profil"><i class="bi bi-plus-circle"></i></button>
    </div>

    <?php foreach ($sistem_list as $sistem): ?>
      <div class="profile-card">
        <span><?= htmlspecialchars($sistem['nama']) ?></span>
        <button>View</button>
      </div>
    <?php endforeach; ?>
  </div>
</div>

</body>
</html>
