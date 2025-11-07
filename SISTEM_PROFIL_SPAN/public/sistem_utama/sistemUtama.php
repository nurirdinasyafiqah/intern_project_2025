<?php
require_once '../../app/config.php';
require_once '../../app/auth.php';
require_login();

$current_page = basename($_SERVER['PHP_SELF']);

// ambil senarai sistem dari DB
$stmt = $pdo->query("SELECT id_sistemutama, nama_entiti FROM sistem_utama ORDER BY id_sistemutama DESC");
$sistem_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Sistem Utama | Sistem Profil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color:#eaf4f9; font-family:'Poppins',sans-serif; }
    .sidebar { background-color:#f8f9fa; width:260px; height:100vh; position:fixed; top:0; left:0; padding-top:30px; box-shadow:2px 0 5px rgba(0,0,0,0.1);}
    .sidebar .logo{text-align:center;margin-bottom:15px;}
    .sidebar .logo img{width:150px;}
    .sidebar .title{text-align:center;font-weight:600;font-size:13px;letter-spacing:3px;color:#1b2e46;margin-bottom:25px;}
    .sidebar .nav-link{color:#1b2e46;padding:10px 20px;border-radius:8px;margin:5px 10px;display:flex;align-items:center;gap:10px;text-decoration:none;}
    .sidebar .nav-link.active{background-color:#006EA0;color:#fff;}
    .sidebar .nav-link:hover{background-color:#d9edf7;color:#000;}
    .content{margin-left:260px;padding:20px 15px;}
    .main-header{background-color:#fff;color:#006EA0;font-weight:700;font-size:28px;padding:20px;border-radius:8px;box-shadow:0 3px 8px rgba(0,0,0,0.05);display:flex;align-items:center;justify-content:center;gap:10px;}
    .main-body{background-color:#fff;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.05);padding:25px;margin-top:20px;}
    .add-btn{border:none;background-color:#006EA0;color:#fff;font-size:18px;border-radius:50%;width:38px;height:38px;display:flex;align-items:center;justify-content:center;}
    .profile-card{background-color:#f4fbff;border:1px solid #d3e9f5;border-radius:10px;padding:18px 20px;display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;}
    .profile-card span{font-weight:600;color:#004b73;}
    .profile-card button{background-color:#006EA0;color:#fff;border:none;border-radius:8px;padding:6px 18px;}
    .modal-dialog-scrollable .modal-body {
      max-height: calc(100vh - 200px); /* allows scrolling inside modal */
      overflow-y: auto;
    }

  </style>
</head>

<script>
  // Auto-hide success popup after 3 seconds
  document.addEventListener("DOMContentLoaded", function() {
    const popup = document.getElementById("successPopup");
    if (popup) {
      setTimeout(() => {
        popup.classList.remove("show");
        popup.classList.add("fade");
      }, 3000); // 3 seconds
      setTimeout(() => popup.remove(), 3500);
    }
  });
</script>

<body>
<!-- SIDEBAR -->
<div class="sidebar">
  <div class="logo"><img src="../../assets/img/span-logo.png" alt="SPAN Logo"></div>
  <div class="title">S I S T E M &nbsp; P R O F I L</div>
  <a href="../dashboard.php" class="nav-link <?= ($current_page == 'dashboard.php') ? 'active' : '' ?>"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
  <a href="sistemUtama.php" class="nav-link <?= ($current_page == 'sistemUtama.php') ? 'active' : '' ?>"><i class="bi bi-pc-display"></i> Sistem Utama</a>
  <a href="../peralatan/peralatan.php" class="nav-link"><i class="bi bi-hdd-stack"></i> Peralatan</a>
</div>

<!-- CONTENT -->
<div class="content">
  <div class="main-header"><i class="bi bi-pc-display"></i> Sistem Utama</div>

  <div class="main-body">
    <?php if (isset($_GET['success'])): ?>
      <div id="successPopup" class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow" 
          style="z-index: 1055; min-width: 300px; text-align:center;">
        ✅ Profil sistem berjaya disimpan!
      </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="fw-semibold mb-0">Senarai Profil</h5>
      <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addSistemModal" title="Tambah Profil"><i class="bi bi-plus-lg"></i></button>
    </div>

    <?php if (empty($sistem_list)): ?>
      <p class="text-muted text-center">Tiada data sistem direkodkan.</p>
    <?php else: ?>
      <?php foreach ($sistem_list as $sistem): ?>
        <div class="profile-card">
          <span><?= htmlspecialchars($sistem['nama_entiti']) ?></span>
          <button><i class="bi bi-eye-fill me-1"></i>View</button>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<!-- MODAL FORM -->
<div class="modal fade" id="addSistemModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content shadow-lg border-0">
      <div class="modal-header text-white" style="background: linear-gradient(90deg, #006EA0, #0096C7);">
        <h5 class="modal-title fw-semibold"><i class="bi bi-plus-circle me-2"></i>Tambah Profil Sistem Utama</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="tambah_sistem.php" method="POST">
        <input type="hidden" name="id_user" value="<?= isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : '' ?>">

        <div class="modal-body p-4" style="background-color:#f7fbfd;">

          <!-- Section Header Style -->
          <style>
            .section-card {
              background: #fff;
              border-radius: 10px;
              box-shadow: 0 1px 4px rgba(0,0,0,0.08);
              padding: 20px;
              margin-bottom: 25px;
            }
            .section-title {
              background: #e1f1fa;
              color: #004b73;
              font-weight: 600;
              padding: 10px 15px;
              border-left: 5px solid #0096C7;
              border-radius: 6px;
              margin-bottom: 20px;
            }
            label {
              font-weight: 500;
              color: #00334d;
              font-size: 14px;
            }
            input.form-control, textarea.form-control, select.form-control {
              border-radius: 8px;
              border: 1px solid #ccc;
              font-size: 14px;
              transition: all 0.2s ease;
            }
            input.form-control:focus, textarea.form-control:focus, select.form-control:focus {
              border-color: #0096C7;
              box-shadow: 0 0 5px rgba(0,150,199,0.3);
            }
          </style>

          <!-- A. MAKLUMAT AM ENTITI -->
          <div class="section-card">
            <div class="section-title">A. Maklumat Am Entiti</div>
            <div class="row mb-3">
              <div class="col-md-6"><label>Nama Entiti</label><input type="text" name="nama_entiti" class="form-control" required></div>
              <div class="col-md-6"><label>Tarikh Kemaskini</label><input type="date" name="tarikh_kemaskini" class="form-control"></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6"><label>Bahagian</label><input type="text" name="bahagian" class="form-control"></div>
              <div class="col-md-6"><label>Alamat</label><input type="text" name="alamat" class="form-control"></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4"><label>Nama Ketua Bahagian IT</label><input type="text" name="nama_ketua" class="form-control"></div>
              <div class="col-md-4"><label>No. Telefon</label><input type="text" name="no_telefon" class="form-control"></div>
              <div class="col-md-4"><label>No. Faks</label><input type="text" name="no_faks" class="form-control"></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4"><label>Emel Ketua Bahagian IT</label><input type="email" name="emel_ketua" class="form-control"></div>
              <div class="col-md-4"><label>Nama CIO</label><input type="text" name="cio" class="form-control"></div>
              <div class="col-md-4"><label>Nama ICTSO</label><input type="text" name="ictso" class="form-control"></div>
            </div>
            <div><label>Carta Organisasi</label><input type="text" name="carta_organisasi" class="form-control"></div>
          </div>

          <!-- B. MAKLUMAT SISTEM APLIKASI -->
          <div class="section-card">
            <div class="section-title">B. Maklumat Sistem Aplikasi</div>
            <div class="row mb-3">
              <div class="col-md-6"><label>Nama Sistem</label><input type="text" name="nama_sistem" class="form-control"></div>
              <div class="col-md-6"><label>Objektif</label><textarea name="objektif" class="form-control" rows="1"></textarea></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6"><label>Pemilik Sistem</label><input type="text" name="pemilik" class="form-control"></div>
              <div class="col-md-2"><label>Tarikh Mula</label><input type="date" name="tarikh_mula" class="form-control"></div>
              <div class="col-md-2"><label>Tarikh Siap</label><input type="date" name="tarikh_siap" class="form-control"></div>
              <div class="col-md-2"><label>Tarikh Guna</label><input type="date" name="tarikh_guna" class="form-control"></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-3"><label>Bil. Pengguna</label><input type="number" name="bil_pengguna" class="form-control"></div>
              <div class="col-md-3"><label>Kaedah Pembangunan</label>
                <select name="kaedah_pembangunan" class="form-control">
                  <option value="">-- Pilih Kaedah --</option>
                  <option value="In-House">In-House</option>
                  <option value="Outsource">Outsource</option>
                </select>
              </div>
              <div class="col-md-3"><label>In-House</label><input type="text" name="inhouse" class="form-control"></div>
              <div class="col-md-3"><label>Outsource</label><input type="text" name="outsource" class="form-control"></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-3"><label>Bil Modul</label><input type="text" name="bil_modul" class="form-control"></div>
              <div class="col-md-3"><label>Kategori</label><input type="text" name="kategori" class="form-control"></div>
              <div class="col-md-3"><label>Bahasa Pengaturcaraan</label><input type="text" name="bahasa_pengaturcaraan" class="form-control"></div>
              <div class="col-md-3"><label>Pangkalan Data</label><input type="text" name="pangkalan_data" class="form-control"></div>
            </div>
            <div><label>Rangkaian</label><textarea name="rangkaian" class="form-control" rows="2"></textarea></div>
            <div><label>Integrasi</label><textarea name="integrasi" class="form-control" rows="2"></textarea></div>
            <div><label>Penyelenggaraan</label><input type="text" name="penyelenggaraan" class="form-control"></div>
          </div>

          <!-- C. KOS SISTEM -->
          <div class="section-card">
            <div class="section-title">C. Kos Sistem</div>
            <div class="row mb-3">
              <div class="col-md-4"><label>Kos Keseluruhan (RM)</label><input type="number" step="0.01" name="keseluruhan" class="form-control"></div>
              <div class="col-md-4"><label>Kos Perkakasan (RM)</label><input type="number" step="0.01" name="perkakasan" class="form-control"></div>
              <div class="col-md-4"><label>Kos Perisian (RM)</label><input type="number" step="0.01" name="perisian" class="form-control"></div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4"><label>Lesen Perisian (RM)</label><input type="number" step="0.01" name="lesen_perisian" class="form-control"></div>
              <div class="col-md-4"><label>Penyelenggaraan (RM)</label><input type="number" step="0.01" name="penyelenggaraan_kos" class="form-control"></div>
              <div class="col-md-4"><label>Kos Lain (RM)</label><input type="number" step="0.01" name="kos_lain" class="form-control"></div>
            </div>
          </div>

          <!-- D. AKSES SISTEM -->
          <div class="section-card">
            <div class="section-title">D. Akses Sistem</div>
            <div class="row mb-3">
              <div class="col-md-4"><label>Kategori Dalaman</label><select name="kategori_dalaman" class="form-control"><option value="1">Ya</option><option value="0">Tidak</option></select></div>
              <div class="col-md-4"><label>Kategori Umum</label><select name="kategori_umum" class="form-control"><option value="1">Ya</option><option value="0">Tidak</option></select></div>
              <div class="col-md-4"><label>Pegawai Urus Akses</label><input type="text" name="pegawai_urus_akses" class="form-control"></div>
            </div>
          </div>

          <!-- E. PEGAWAI RUJUKAN SISTEM -->
          <div class="section-card mb-2">
            <div class="section-title">E. Pegawai Rujukan Sistem</div>
            <div class="row mb-3">
              <div class="col-md-3"><label>Nama Pegawai</label><input type="text" name="nama_pegawai" class="form-control"></div>
              <div class="col-md-3"><label>Jawatan & Gred</label><input type="text" name="jawatan_gred" class="form-control"></div>
              <div class="col-md-3"><label>Bahagian</label><input type="text" name="bahagian_pegawai" class="form-control"></div>
              <div class="col-md-3"><label>Emel Pegawai</label><input type="email" name="emel_pegawai" class="form-control"></div>
            </div>
            <div><label>No. Telefon Pegawai</label><input type="text" name="no_telefon_pegawai" class="form-control"></div>
          </div>

        </div>

        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle me-1"></i>Batal</button>
          <button type="submit" class="btn btn-success px-4"><i class="bi bi-save2 me-1"></i>Simpan Profil</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
