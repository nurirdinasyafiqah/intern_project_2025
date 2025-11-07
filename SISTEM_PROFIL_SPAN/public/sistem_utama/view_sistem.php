<?php
require_once '../../app/config.php';
require_once '../../app/auth.php';
require_login();

// Check if ID given
$id = $_GET['id'] ?? null;
if (!$id) {
  die("<div style='text-align:center;margin-top:50px;color:red;'>❌ ID sistem tidak sah.</div>");
}

// Fetch data by id_sistemutama
$stmt = $pdo->prepare("
  SELECT su.*, sa.*, ks.*, ak.*, pr.*
  FROM sistem_utama su
  LEFT JOIN sistem_aplikasi sa ON su.id_sistemutama = sa.id_sistemutama
  LEFT JOIN kos_sistem ks ON su.id_sistemutama = ks.id_sistemutama
  LEFT JOIN akses_sistem ak ON su.id_sistemutama = ak.id_sistemutama
  LEFT JOIN pegawai_rujukan_sistem pr ON su.id_sistemutama = pr.id_sistemutama
  WHERE su.id_sistemutama = ?
");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
  die("<div style='text-align:center;margin-top:50px;color:red;'>❌ Rekod tidak dijumpai.</div>");
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Lihat Profil Sistem | Sistem Profil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color:#f5faff;
      font-family:"Poppins",sans-serif;
      padding:30px;
    }
    .container-box {
      background-color:#fff;
      border:2px solid #b9e0f5;
      border-radius:10px;
      padding:40px 50px;
      box-shadow:0 3px 8px rgba(0,0,0,0.05);
    }
    h2 {
      color:#006EA0;
      font-weight:700;
      text-align:center;
      margin-bottom:40px;
      text-decoration:underline;
      text-underline-offset:6px;
    }
    h5 {
      color:#004b73;
      font-weight:600;
      margin-top:40px;
      margin-bottom:15px;
      text-transform:uppercase;
      border-bottom:2px solid #b9e0f5;
      display:inline-block;
      padding-bottom:4px;
    }
    .info-box {
      background-color:#f0f9ff;
      border:1px solid #cce9f9;
      border-radius:6px;
      padding:15px 20px;
      margin-bottom:10px;
    }
    .info-label {
      font-weight:600;
      color:#003c5c;
      width:40%;
    }
    .info-value {
      color:#004b73;
      flex:1;
    }
    .info-row {
      display:flex;
      justify-content:space-between;
      padding:3px 0;
      border-bottom:1px dotted #d0ebff;
    }
    .back-btn {
      text-decoration:none;
      color:#006EA0;
      font-weight:600;
      display:inline-flex;
      align-items:center;
      gap:5px;
      margin-bottom:20px;
    }
    .back-btn:hover { text-decoration:underline; }
    .edit-btn {
      position: absolute;
      right: 40px;
      top: 40px;
      background-color: #006EA0;
      border: none;
      color: white;
      border-radius: 8px;
      padding: 8px 16px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .edit-btn:hover {
      background-color: #005b86;
    }
  </style>
</head>

<?php if (isset($_GET['updated'])): ?>
  <script>
    alert('✅ Profil sistem berjaya dikemaskini!');
  </script>
<?php endif; ?>

<body>
  <div class="container-box">
    <a href="sistemUtama.php" class="back-btn">&larr; Kembali ke Senarai</a>

    <button class="edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square"></i> Edit Profil</button>

    <h2><?= htmlspecialchars($data['nama_sistem'] ?? 'Maklumat Sistem') ?></h2>

    <!-- A. Maklumat Am Entiti -->
    <h5>Maklumat Am Entiti</h5>
    <div class="info-box">
      <div class="info-row"><div class="info-label">Nama Entiti</div><div class="info-value"><?= $data['nama_entiti'] ?></div></div>
      <div class="info-row"><div class="info-label">Tarikh Kemaskini</div><div class="info-value"><?= $data['tarikh_kemaskini'] ?></div></div>
      <div class="info-row"><div class="info-label">Bahagian</div><div class="info-value"><?= $data['bahagian'] ?></div></div>
      <div class="info-row"><div class="info-label">Alamat</div><div class="info-value"><?= $data['alamat'] ?></div></div>
      <div class="info-row"><div class="info-label">Nama Ketua</div><div class="info-value"><?= $data['nama_ketua'] ?></div></div>
      <div class="info-row"><div class="info-label">No Telefon</div><div class="info-value"><?= $data['no_telefon'] ?></div></div>
      <div class="info-row"><div class="info-label">Emel Ketua</div><div class="info-value"><?= $data['emel_ketua'] ?></div></div>
      <div class="info-row"><div class="info-label">CIO</div><div class="info-value"><?= $data['cio'] ?></div></div>
      <div class="info-row"><div class="info-label">ICTSO</div><div class="info-value"><?= $data['ictso'] ?></div></div>
    </div>

    <!-- B. Maklumat Sistem Aplikasi -->
    <h5>Maklumat Sistem Aplikasi</h5>
    <div class="info-box">
      <div class="info-row"><div class="info-label">Nama Sistem</div><div class="info-value"><?= $data['nama_sistem'] ?></div></div>
      <div class="info-row"><div class="info-label">Objektif</div><div class="info-value"><?= $data['objektif'] ?></div></div>
      <div class="info-row"><div class="info-label">Pemilik</div><div class="info-value"><?= $data['pemilik'] ?></div></div>
      <div class="info-row"><div class="info-label">Tarikh Mula</div><div class="info-value"><?= $data['tarikh_mula'] ?></div></div>
      <div class="info-row"><div class="info-label">Tarikh Guna</div><div class="info-value"><?= $data['tarikh_guna'] ?></div></div>
      <div class="info-row"><div class="info-label">Bil Pengguna</div><div class="info-value"><?= $data['bil_pengguna'] ?></div></div>
      <div class="info-row"><div class="info-label">Kaedah Pembangunan</div><div class="info-value"><?= $data['kaedah_pembangunan'] ?></div></div>
      <div class="info-row"><div class="info-label">Bahasa Pengaturcaraan</div><div class="info-value"><?= $data['bahasa_pengaturcaraan'] ?></div></div>
      <div class="info-row"><div class="info-label">Pangkalan Data</div><div class="info-value"><?= $data['pangkalan_data'] ?></div></div>
      <div class="info-row"><div class="info-label">Integrasi</div><div class="info-value"><?= $data['integrasi'] ?></div></div>
    </div>

    <!-- C. Kos Sistem -->
    <h5>Kos Sistem</h5>
    <div class="info-box">
      <div class="info-row"><div class="info-label">Kos Keseluruhan</div><div class="info-value">RM <?= number_format($data['keseluruhan'],2) ?></div></div>
      <div class="info-row"><div class="info-label">Kos Perkakasan</div><div class="info-value">RM <?= number_format($data['perkakasan'],2) ?></div></div>
      <div class="info-row"><div class="info-label">Kos Perisian</div><div class="info-value">RM <?= number_format($data['perisian'],2) ?></div></div>
      <div class="info-row"><div class="info-label">Kos Lesen Perisian</div><div class="info-value">RM <?= number_format($data['lesen_perisian'],2) ?></div></div>
      <div class="info-row"><div class="info-label">Kos Penyelenggaraan</div><div class="info-value">RM <?= number_format($data['penyelenggaraan'],2) ?></div></div>
      <div class="info-row"><div class="info-label">Kos Lain</div><div class="info-value">RM <?= number_format($data['kos_lain'],2) ?></div></div>
    </div>

    <!-- D. Akses Sistem -->
    <h5>Akses Sistem</h5>
    <div class="info-box">
      <div class="info-row"><div class="info-label">Kategori Dalaman</div><div class="info-value"><?= $data['kategori_dalaman'] ? 'Ya' : 'Tidak' ?></div></div>
      <div class="info-row"><div class="info-label">Kategori Umum</div><div class="info-value"><?= $data['kategori_umum'] ? 'Ya' : 'Tidak' ?></div></div>
      <div class="info-row"><div class="info-label">Pegawai Urus Akses</div><div class="info-value"><?= $data['pegawai_urus_akses'] ?></div></div>
    </div>

    <!-- E. Pegawai Rujukan -->
    <h5>Pegawai Rujukan Sistem</h5>
    <div class="info-box">
      <div class="info-row"><div class="info-label">Nama Pegawai</div><div class="info-value"><?= $data['nama_pegawai'] ?></div></div>
      <div class="info-row"><div class="info-label">Jawatan & Gred</div><div class="info-value"><?= $data['jawatan_gred'] ?></div></div>
      <div class="info-row"><div class="info-label">Bahagian</div><div class="info-value"><?= $data['bahagian'] ?></div></div>
      <div class="info-row"><div class="info-label">Emel Pegawai</div><div class="info-value"><?= $data['emel_pegawai'] ?></div></div>
      <div class="info-row"><div class="info-label">No. Telefon</div><div class="info-value"><?= $data['no_telefon'] ?></div></div>
    </div>
  </div>

    <!-- MODAL: Edit Sistem -->
    <div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">
        <!-- HEADER -->
        <div class="modal-header text-white" style="background: linear-gradient(90deg, #006EA0, #0096C7);">
            <h5 class="modal-title fw-semibold">
            <i class="bi bi-pencil-square me-2"></i> Kemaskini Profil Sistem
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <!-- BODY -->
        <form action="kemaskini_sistem.php" method="POST" style="max-height: calc(100vh - 180px); overflow-y: auto;">
            <input type="hidden" name="id_sistemutama" value="<?= $data['id_sistemutama'] ?>">

            <div class="modal-body" style="background-color:#f7fbfd; padding:25px;">

            <style>
                .section-card {
                background:#fff;
                border-radius:10px;
                box-shadow:0 2px 6px rgba(0,0,0,0.05);
                padding:20px;
                margin-bottom:25px;
                }
                .section-title {
                background:#e1f1fa;
                color:#004b73;
                font-weight:600;
                padding:10px 15px;
                border-left:5px solid #0096C7;
                border-radius:6px;
                margin-bottom:20px;
                }
                label {
                font-weight:500;
                color:#00334d;
                font-size:14px;
                }
                input.form-control, textarea.form-control, select.form-control {
                border-radius:8px;
                border:1px solid #ccc;
                font-size:14px;
                transition:all 0.2s ease;
                }
                input.form-control:focus, textarea.form-control:focus, select.form-control:focus {
                border-color:#0096C7;
                box-shadow:0 0 5px rgba(0,150,199,0.3);
                }
            </style>

            <!-- A. Maklumat Am Entiti -->
            <div class="section-card">
                <div class="section-title">A. Maklumat Am Entiti</div>
                <div class="row mb-3">
                <div class="col-md-6"><label>Nama Entiti</label>
                    <input type="text" name="nama_entiti" value="<?= htmlspecialchars($data['nama_entiti']) ?>" class="form-control"></div>
                <div class="col-md-6"><label>Tarikh Kemaskini</label>
                    <input type="date" name="tarikh_kemaskini" value="<?= $data['tarikh_kemaskini'] ?>" class="form-control"></div>
                </div>
                <div class="row mb-3">
                <div class="col-md-6"><label>Bahagian</label>
                    <input type="text" name="bahagian" value="<?= $data['bahagian'] ?>" class="form-control"></div>
                <div class="col-md-6"><label>Alamat</label>
                    <input type="text" name="alamat" value="<?= $data['alamat'] ?>" class="form-control"></div>
                </div>
                <div class="row mb-3">
                <div class="col-md-4"><label>Nama Ketua Bahagian IT</label>
                    <input type="text" name="nama_ketua" value="<?= $data['nama_ketua'] ?>" class="form-control"></div>
                <div class="col-md-4"><label>No. Telefon</label>
                    <input type="text" name="no_telefon" value="<?= $data['no_telefon'] ?>" class="form-control"></div>
                <div class="col-md-4"><label>Emel Ketua</label>
                    <input type="email" name="emel_ketua" value="<?= $data['emel_ketua'] ?>" class="form-control"></div>
                </div>
                <div class="row">
                <div class="col-md-6"><label>Nama CIO</label>
                    <input type="text" name="cio" value="<?= $data['cio'] ?>" class="form-control"></div>
                <div class="col-md-6"><label>Nama ICTSO</label>
                    <input type="text" name="ictso" value="<?= $data['ictso'] ?>" class="form-control"></div>
                </div>
            </div>

            <!-- B. Maklumat Sistem Aplikasi -->
            <div class="section-card">
                <div class="section-title">B. Maklumat Sistem Aplikasi</div>
                <div class="row mb-3">
                <div class="col-md-6"><label>Nama Sistem</label>
                    <input type="text" name="nama_sistem" value="<?= $data['nama_sistem'] ?>" class="form-control"></div>
                <div class="col-md-6"><label>Objektif</label>
                    <textarea name="objektif" class="form-control" rows="2"><?= $data['objektif'] ?></textarea></div>
                </div>
                <div class="row mb-3">
                <div class="col-md-4"><label>Pemilik</label><input type="text" name="pemilik" value="<?= $data['pemilik'] ?>" class="form-control"></div>
                <div class="col-md-4"><label>Bil. Pengguna</label><input type="number" name="bil_pengguna" value="<?= $data['bil_pengguna'] ?>" class="form-control"></div>
                <div class="col-md-4"><label>Kaedah Pembangunan</label>
                    <select name="kaedah_pembangunan" class="form-control">
                    <option value="">-- Pilih Kaedah --</option>
                    <option value="In-House" <?= ($data['kaedah_pembangunan']=='In-House')?'selected':'' ?>>In-House</option>
                    <option value="Outsource" <?= ($data['kaedah_pembangunan']=='Outsource')?'selected':'' ?>>Outsource</option>
                    </select>
                </div>
                </div>
                <div class="row mb-3">
                <div class="col-md-6"><label>Bahasa Pengaturcaraan</label><input type="text" name="bahasa_pengaturcaraan" value="<?= $data['bahasa_pengaturcaraan'] ?>" class="form-control"></div>
                <div class="col-md-6"><label>Pangkalan Data</label><input type="text" name="pangkalan_data" value="<?= $data['pangkalan_data'] ?>" class="form-control"></div>
                </div>
                <div><label>Integrasi</label><textarea name="integrasi" class="form-control" rows="2"><?= $data['integrasi'] ?></textarea></div>
            </div>

            <!-- C. Kos Sistem -->
            <div class="section-card">
                <div class="section-title">C. Kos Sistem</div>
                <div class="row mb-3">
                <div class="col-md-4"><label>Kos Keseluruhan (RM)</label><input type="number" step="0.01" name="keseluruhan" value="<?= $data['keseluruhan'] ?>" class="form-control"></div>
                <div class="col-md-4"><label>Kos Perkakasan (RM)</label><input type="number" step="0.01" name="perkakasan" value="<?= $data['perkakasan'] ?>" class="form-control"></div>
                <div class="col-md-4"><label>Kos Perisian (RM)</label><input type="number" step="0.01" name="perisian" value="<?= $data['perisian'] ?>" class="form-control"></div>
                </div>
                <div class="row mb-3">
                <div class="col-md-4"><label>Lesen Perisian (RM)</label><input type="number" step="0.01" name="lesen_perisian" value="<?= $data['lesen_perisian'] ?>" class="form-control"></div>
                <div class="col-md-4"><label>Penyelenggaraan (RM)</label><input type="number" step="0.01" name="penyelenggaraan" value="<?= $data['penyelenggaraan'] ?>" class="form-control"></div>
                <div class="col-md-4"><label>Kos Lain (RM)</label><input type="number" step="0.01" name="kos_lain" value="<?= $data['kos_lain'] ?>" class="form-control"></div>
                </div>
            </div>

            <!-- D. Akses Sistem -->
            <div class="section-card">
                <div class="section-title">D. Akses Sistem</div>
                <div class="row mb-3">
                <div class="col-md-4"><label>Kategori Dalaman</label>
                    <select name="kategori_dalaman" class="form-control">
                    <option value="1" <?= ($data['kategori_dalaman'])?'selected':'' ?>>Ya</option>
                    <option value="0" <?= (!$data['kategori_dalaman'])?'selected':'' ?>>Tidak</option>
                    </select></div>
                <div class="col-md-4"><label>Kategori Umum</label>
                    <select name="kategori_umum" class="form-control">
                    <option value="1" <?= ($data['kategori_umum'])?'selected':'' ?>>Ya</option>
                    <option value="0" <?= (!$data['kategori_umum'])?'selected':'' ?>>Tidak</option>
                    </select></div>
                <div class="col-md-4"><label>Pegawai Urus Akses</label><input type="text" name="pegawai_urus_akses" value="<?= $data['pegawai_urus_akses'] ?>" class="form-control"></div>
                </div>
            </div>

            <!-- E. Pegawai Rujukan Sistem -->
            <div class="section-card mb-0">
                <div class="section-title">E. Pegawai Rujukan Sistem</div>
                <div class="row mb-3">
                <div class="col-md-4"><label>Nama Pegawai</label><input type="text" name="nama_pegawai" value="<?= $data['nama_pegawai'] ?>" class="form-control"></div>
                <div class="col-md-4"><label>Jawatan & Gred</label><input type="text" name="jawatan_gred" value="<?= $data['jawatan_gred'] ?>" class="form-control"></div>
                <div class="col-md-4"><label>Bahagian</label><input type="text" name="bahagian_pegawai" value="<?= $data['bahagian'] ?>" class="form-control"></div>
                </div>
                <div class="row">
                <div class="col-md-6"><label>Emel Pegawai</label><input type="email" name="emel_pegawai" value="<?= $data['emel_pegawai'] ?>" class="form-control"></div>
                <div class="col-md-6"><label>No. Telefon</label><input type="text" name="no_telefon_pegawai" value="<?= $data['no_telefon'] ?>" class="form-control"></div>
                </div>
            </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer bg-light sticky-bottom">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                <i class="bi bi-x-circle me-1"></i> Batal
            </button>
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-save2 me-1"></i> Simpan Perubahan
            </button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
