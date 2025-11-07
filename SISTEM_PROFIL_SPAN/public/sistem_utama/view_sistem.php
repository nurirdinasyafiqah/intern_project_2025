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
  </style>
</head>
<body>

  <div class="container-box">
    <a href="sistemUtama.php" class="back-btn">&larr; Kembali ke Senarai</a>
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

</body>
</html>
