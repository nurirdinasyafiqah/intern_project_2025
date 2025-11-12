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
  
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/dashboard.css">
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

  <!-- HEADER -->
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
