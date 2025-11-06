<?php
require_once '../app/auth.php';
require_login();

// contoh data dummy (nanti boleh ambil dari DB)
$total_sistem = 29;
$total_peralatan = 13;
$sistem_utama = ['list system'];
$peralatan = ['list appliances'];
?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Dashboard | Sistem Profil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #eaf4f9;
      font-family: 'Poppins', sans-serif;
    }
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
    }
    .sidebar .nav-link.active {
      background-color: #006EA0;
      color: #fff;
    }
    .sidebar .nav-link:hover {
      background-color: #d9edf7;
      color: #000;
    }

    .content {
      margin-left: 260px;
      padding: 10px;
    }
    .header {
      background-color: #fff;
      border-radius: 10px;
      padding: 25px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .header h3 {
      margin: 0;
      font-weight: 600;
    }
    .header .profile-icon {
      background-color: #e9f1f8;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 30px;
      color: #1b2e46;
    }

    .card-section {
      background-color: #fff;
      border-radius: 10px;
      margin-top: 20px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .section-title {
      font-weight: 600;
      margin-bottom: 10px;
    }

    .stat-box {
      background-color: #dff0d8;
      border-radius: 8px;
      padding: 25px;
      text-align: center;
      font-weight: bold;
    }
    .stat-box h1 {
      font-size: 40px;
      color: #000000ff;
      margin: 0;
    }
    .stat-box p {
      margin: 0;
      color: #000000ff;
      font-size: 15px;
    }

    .stat-box-blue {
      background-color: #d9edf7;
      color: #31708f;
    }

    .profile-list {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 5px 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
    }
    .profile-list button {
      background-color: #d9d9d9;
      border: none;
      border-radius: 10px;
      padding: 3px 15px;
      font-size: 0.9em;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <div class="logo">
    <img src="../assets/img/span-logo.png" alt="SPAN Logo">
  </div>
  <div class="title">S I S T E M &nbsp; P R O F I L</div>
  <a href="dashboard.php" class="nav-link active">
    <i class="bi bi-grid-1x2-fill"></i> Dashboard
  </a>
  <a href="sistem_utama/sistemUtama.php" class="nav-link">
    <i class="bi bi-pc-display"></i> Sistem Utama
  </a>
  <a href="peralatan/peralatan.php" class="nav-link">
    <i class="bi bi-hdd-stack"></i> Peralatan
  </a>
</div>

<!-- HEADER / Main Content -->
<div class="content">
  <div class="header">
    <h3><?= htmlspecialchars($_SESSION['user']['nama']) ?></h3>
    <div class="profile-icon">
      <i class="bi bi-person-fill"></i>
    </div>
  </div>

  <!-- Sistem Utama -->
  <div class="card-section mt-4" style="background-color: #f1f9f1;">
    <div class="row">
      <div class="col-md-4">
        <div class="stat-box">
          <div style="font-weight:600; color:#2e7d32; font-size:larger; margin-bottom: 5%;">Sistem Utama</div>
          <h1><?= $total_sistem ?></h1>
          <p>Jumlah</p>
        </div>
      </div>
      <div class="col-md-8">
        <div class="section-title" style="color:#2e7d32;">Senarai Profil</div>
        <?php foreach($sistem_utama as $s): ?>
          <div class="profile-list mb-2">
            <span><?= htmlspecialchars($s) ?></span>
            <button>View</button>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Peralatan -->
  <div class="card-section mt-3" style="background-color: #f1f9fc;">
    <div class="row">
      <div class="col-md-4">
        <div class="stat-box stat-box-blue">
          <div style="font-weight:600; color:#31708f; font-size:larger; margin-bottom: 5%;">Peralatan</div>
          <h1><?= $total_peralatan ?></h1>
          <p>Jumlah</p>
        </div>
      </div>
      <div class="col-md-8">
        <div class="section-title" style="color:#31708f;">Senarai Profil</div>
        <?php foreach($peralatan as $p): ?>
          <div class="profile-list mb-2">
            <span><?= htmlspecialchars($p) ?></span>
            <button>View</button>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

</div>
</body>
</html>
