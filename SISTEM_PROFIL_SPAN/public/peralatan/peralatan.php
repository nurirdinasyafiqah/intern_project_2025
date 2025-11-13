<?php
require_once '../../app/auth.php';
require_login();

// contoh data dummy
$peralatan_list = [
  ['nama' => 'list peralatan'],
];

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Peralatan | Sistem Profil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/peralatan.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="logo">
    <img src="../../assets/img/span-logo.png" alt="SPAN Logo">
  </div>
  <div class="title">S I S T E M &nbsp; P R O F I L</div>
  <a href="../dashboard.php" class="nav-link">
    <i class="bi bi-grid-1x2-fill"></i> Dashboard
  </a>
  <a href="../sistem_utama/sistemUtama.php" class="nav-link">
    <i class="bi bi-pc-display"></i> Sistem Utama
  </a>
  <a href="peralatan.php" class="nav-link active">
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

<!-- CONTENT -->
<div class="content">
  <div class="main-header"><i class="bi bi-hdd-stack"></i> Peralatan</div>

  <div class="main-body">
    <div class="search-section">
      <h5 class="fw-semibold mb-0">Senarai Profil</h5>
      <div class="d-flex align-items-center gap-3">
        <input type="text" class="search-bar" placeholder="🔍 Cari peralatan...">
        <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addPeralatanModal" title="Tambah Peralatan">
          <i class="bi bi-plus-lg"></i>
        </button>
      </div>
    </div>

    <?php foreach ($peralatan_list as $item): ?>
      <div class="profile-card">
        <span><?= htmlspecialchars($item['nama']) ?></span>
        <button><i class="bi bi-eye-fill me-1"></i>View</button>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="addPeralatanModal" tabindex="-1" aria-labelledby="addPeralatanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header text-white">
        <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah Profil Peralatan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="proses_tambah.php" method="POST">
        <div class="modal-body">

          <!-- A. MAKLUMAT PERALATAN -->
          <h6>A. Maklumat Peralatan</h6>
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Nama Peralatan</label>
              <input type="text" name="nama_peralatan" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Jenis Peralatan</label>
              <input type="text" name="jenis_peralatan" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4"><label>Jenama</label><input type="text" name="jenama" class="form-control"></div>
            <div class="col-md-4"><label>Model</label><input type="text" name="model" class="form-control"></div>
            <div class="col-md-4"><label>No. Siri</label><input type="text" name="no_siri" class="form-control"></div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4"><label>Tarikh Diperolehi</label><input type="date" name="tarikh_diperolehi" class="form-control"></div>
            <div class="col-md-4"><label>Harga Perolehan (RM)</label><input type="number" name="harga_perolehan" class="form-control"></div>
            <div class="col-md-4"><label>Status</label><input type="text" name="status" class="form-control" placeholder="Contoh: Aktif / Tidak Aktif"></div>
          </div>

          <hr>

          <!-- B. PENYELENGGARAAN -->
          <h6>B. Penyelenggaraan</h6>
          <div class="row mb-3">
            <div class="col-md-4"><label>Nama Vendor</label><input type="text" name="nama_vendor" class="form-control"></div>
            <div class="col-md-4"><label>No. Kontrak</label><input type="text" name="no_kontrak" class="form-control"></div>
            <div class="col-md-4"><label>Tarikh Mula Kontrak</label><input type="date" name="tarikh_mula" class="form-control"></div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4"><label>Tarikh Tamat Kontrak</label><input type="date" name="tarikh_tamat" class="form-control"></div>
            <div class="col-md-4"><label>Kos Penyelenggaraan (RM)</label><input type="number" name="kos_penyelenggaraan" class="form-control"></div>
            <div class="col-md-4"><label>Catatan</label><textarea name="catatan" class="form-control" rows="1"></textarea></div>
          </div>

          <hr>

          <!-- C. PEGAWAI RUJUKAN -->
          <h6>C. Pegawai Rujukan Peralatan</h6>
          <div class="row mb-3">
            <div class="col-md-3"><label>Nama Pegawai</label><input type="text" name="nama_pegawai" class="form-control"></div>
            <div class="col-md-3"><label>Jawatan & Gred</label><input type="text" name="jawatan_gred" class="form-control"></div>
            <div class="col-md-3"><label>Bahagian</label><input type="text" name="bahagian" class="form-control"></div>
            <div class="col-md-3"><label>Emel Pegawai</label><input type="email" name="emel_pegawai" class="form-control"></div>
          </div>
          <div class="mb-3">
            <label>No. Telefon Pegawai</label>
            <input type="text" name="no_telefon" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan Rekod</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
