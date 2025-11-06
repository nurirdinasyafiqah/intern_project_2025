<?php
require_once '../../app/auth.php';
require_login();

// contoh data dummy
$sistem_list = [
  ['nama' => 'list system']
];

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Sistem Utama | Sistem Profil</title>
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
    .sidebar .logo { text-align: center; margin-bottom: 15px; }
    .sidebar .logo img { width: 150px; }
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
    .sidebar .nav-link.active { background-color: #006EA0; color: #fff; }
    .sidebar .nav-link:hover { background-color: #d9edf7; color: #000; }

    /* CONTENT */
    .content {
      margin-left: 260px;
      padding: 20px 15px;
    }
    .main-header {
      background-color: #ffffff;
      color: #006EA0;
      font-weight: 700;
      font-size: 28px;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.05);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }
    .main-header i { font-size: 28px; }
    .main-body {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      padding: 25px;
      margin-top: 20px;
    }
    .search-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }
    .search-bar {
      border: 1px solid #bbb;
      border-radius: 25px;
      padding: 8px 15px;
      width: 250px;
      font-size: 14px;
    }
    .add-btn {
      border: none;
      background-color: #006EA0;
      color: white;
      font-size: 18px;
      border-radius: 50%;
      width: 38px;
      height: 38px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: 0.2s ease;
    }
    .profile-card {
      background-color: #f4fbff;
      border: 1px solid #d3e9f5;
      border-radius: 10px;
      padding: 18px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
    }
    .profile-card span { font-weight: 600; color: #004b73; }
    .profile-card button {
      background-color: #006EA0;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 6px 18px;
    }

    /* MODAL */
    .modal-header {
      background: linear-gradient(90deg, #006EA0, #0096C7);
    }
    .modal-body {
      background-color: #f8fbfc;
      padding: 30px;
      border-radius: 0 0 10px 10px;
    }
    .modal-body h6 {
      color: #006EA0;
      border-left: 5px solid #7ed957;
      padding-left: 10px;
      margin-top: 20px;
      font-weight: 600;
    }
    .modal-body label {
      font-weight: 500;
      font-size: 14px;
      color: #333;
    }
    .form-control {
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .modal-dialog-scrollable .modal-body {
      max-height: calc(100vh - 200px);
      overflow-y: auto;
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
  <a href="../peralatan/peralatan.php" class="nav-link <?= ($current_page == 'list.php') ? 'active' : '' ?>">
    <i class="bi bi-hdd-stack"></i> Peralatan
  </a>
</div>

<!-- CONTENT -->
<div class="content">
  <div class="main-header"><i class="bi bi-pc-display"></i> Sistem Utama</div>

  <div class="main-body">
    <div class="search-section">
      <h5 class="fw-semibold mb-0">Senarai Profil</h5>
      <div class="d-flex align-items-center gap-3">
        <input type="text" class="search-bar" placeholder="🔍 Cari sistem...">
        <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addSistemModal" title="Tambah Profil">
          <i class="bi bi-plus-lg"></i>
        </button>
      </div>
    </div>

    <?php foreach ($sistem_list as $sistem): ?>
      <div class="profile-card">
        <span><?= htmlspecialchars($sistem['nama']) ?></span>
        <button><i class="bi bi-eye-fill me-1"></i>View</button>
      </div>
    <?php endforeach; ?>

    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success text-center">✅ Profil sistem berjaya disimpan!</div>
    <?php endif; ?>
  </div>
</div>

<!-- MODAL FORM -->
<div class="modal fade" id="addSistemModal" tabindex="-1" aria-labelledby="addSistemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header text-white">
        <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah Profil Sistem Utama</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="proses_tambah.php" method="POST">
        <div class="modal-body">

          <!-- A. MAKLUMAT AM ENTITI -->
          <h6>A. Maklumat Am Entiti</h6>
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Nama Entiti</label>
              <input type="text" name="nama_entiti" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Tarikh Kemaskini</label>
              <input type="date" name="tarikh_kemaskini" class="form-control" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Nama Bahagian</label>
              <input type="text" name="nama_bahagian" class="form-control">
            </div>
            <div class="col-md-6">
              <label>Alamat Pejabat</label>
              <input type="text" name="alamat_pejabat" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4">
              <label>Nama Ketua Bahagian IT</label>
              <input type="text" name="nama_ketua_bahagian_it" class="form-control">
            </div>
            <div class="col-md-4">
              <label>No. Telefon</label>
              <input type="text" name="no_telefon" class="form-control">
            </div>
            <div class="col-md-4">
              <label>No. Faks</label>
              <input type="text" name="no_faks" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4">
              <label>Emel Ketua Bahagian IT</label>
              <input type="email" name="emel_ketua_bahagian_it" class="form-control">
            </div>
            <div class="col-md-4">
              <label>Nama CIO</label>
              <input type="text" name="nama_cio" class="form-control">
            </div>
            <div class="col-md-4">
              <label>Nama ICTSO</label>
              <input type="text" name="nama_ictso" class="form-control">
            </div>
          </div>
          <div class="mb-3">
            <label>Carta Organisasi</label>
            <input type="text" name="carta_organisasi" class="form-control" placeholder="Contoh: Rajah Struktur Bahagian IT">
          </div>

          <hr>

          <!-- B. MAKLUMAT SISTEM APLIKASI -->
          <h6>B. Maklumat Sistem Aplikasi</h6>
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Nama Sistem</label>
              <input type="text" name="nama_sistem" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Objektif Sistem</label>
              <input type="text" name="objektif_sistem" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6"><label>Pemilik Sistem</label><input type="text" name="pemilik_sistem" class="form-control"></div>
            <div class="col-md-3"><label>Tarikh Mula</label><input type="date" name="tarikh_mula" class="form-control"></div>
            <div class="col-md-3"><label>Tarikh Siap</label><input type="date" name="tarikh_siap" class="form-control"></div>
          </div>
          <div class="row mb-3">
            <div class="col-md-3"><label>Bil. Pengguna</label><input type="text" name="bil_pengguna" class="form-control"></div>
            <div class="col-md-3"><label>Kaedah In-House</label><input type="text" name="kaedah_inhouse" class="form-control"></div>
            <div class="col-md-3"><label>Kaedah Outsource</label><input type="text" name="kaedah_outsource" class="form-control"></div>
            <div class="col-md-3"><label>Bil. Modul / Kategori</label><input type="text" name="bil_modul_kategori" class="form-control"></div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4"><label>Bahasa Pengaturcaraan</label><input type="text" name="bahasa_pengaturcaraan" class="form-control"></div>
            <div class="col-md-4"><label>Pangkalan Data</label><input type="text" name="pangkalan_data" class="form-control"></div>
            <div class="col-md-4"><label>Integrasi</label><textarea name="integrasi" class="form-control" rows="2"></textarea></div>
          </div>
          <div class="mb-3">
            <label>Penyelenggaraan Sistem</label>
            <textarea name="penyelenggaraan_sistem" class="form-control" rows="2"></textarea>
          </div>

          <hr>

          <!-- C. KOS SISTEM -->
          <h6>C. Kos Sistem</h6>
          <div class="row mb-3">
            <div class="col-md-4"><label>Kos Keseluruhan (RM)</label><input type="number" name="kos_keseluruhan" class="form-control"></div>
            <div class="col-md-4"><label>Kos Perkakasan (RM)</label><input type="number" name="kos_perkakasan" class="form-control"></div>
            <div class="col-md-4"><label>Kos Perisian (RM)</label><input type="number" name="kos_perisian" class="form-control"></div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4"><label>Lesen Perisian (RM)</label><input type="number" name="lesen_perisian" class="form-control"></div>
            <div class="col-md-4"><label>Penyelenggaraan (RM)</label><input type="number" name="penyelenggaraan" class="form-control"></div>
            <div class="col-md-4"><label>Kos Lain (RM)</label><input type="number" name="kos_lain" class="form-control"></div>
          </div>

          <hr>

          <!-- D. AKSES SISTEM -->
          <h6>D. Akses Sistem</h6>
          <div class="row mb-3">
            <div class="col-md-4"><label>Kategori Dalaman</label><input type="text" name="kategori_dalaman" class="form-control"></div>
            <div class="col-md-4"><label>Kategori Umum</label><input type="text" name="kategori_umum" class="form-control"></div>
            <div class="col-md-4"><label>Pegawai Urus Akses</label><input type="text" name="pegawai_urus_akses" class="form-control"></div>
          </div>

          <hr>

          <!-- E. PEGAWAI RUJUKAN -->
          <h6>E. Pegawai Rujukan Sistem</h6>
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
          <button type="submit" class="btn btn-success">Simpan Profil</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
