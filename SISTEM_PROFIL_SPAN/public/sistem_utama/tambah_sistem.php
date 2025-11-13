<?php
require_once '../../app/config.php';
require_once '../../app/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Ensure user session exists
        $id_user = $_SESSION['user']['id'] ?? null;
        
        if (!$id_user) {
            throw new Exception("ID pengguna tidak ditemui dalam sesi login.");
        }

        // 1️⃣ SISTEM_UTAMA
        $stmt = $pdo->prepare("
            INSERT INTO sistem_utama (
                id_user, nama_entiti, tarikh_kemaskini, bahagian, alamat,
                nama_ketua, no_telefon, no_faks, emel_ketua, cio, ictso, carta_organisasi
            ) VALUES (
                :id_user, :nama_entiti, :tarikh_kemaskini, :bahagian, :alamat,
                :nama_ketua, :no_telefon, :no_faks, :emel_ketua, :cio, :ictso, :carta_organisasi
            )
        ");
        $stmt->execute([
            ':id_user' => $id_user,
            ':nama_entiti' => $_POST['nama_entiti'] ?? '',
            ':tarikh_kemaskini' => $_POST['tarikh_kemaskini'] ?? null,
            ':bahagian' => $_POST['bahagian'] ?? '',
            ':alamat' => $_POST['alamat'] ?? '',
            ':nama_ketua' => $_POST['nama_ketua'] ?? '',
            ':no_telefon' => $_POST['no_telefon'] ?? '',
            ':no_faks' => $_POST['no_faks'] ?? '',
            ':emel_ketua' => $_POST['emel_ketua'] ?? '',
            ':cio' => $_POST['cio'] ?? '',
            ':ictso' => $_POST['ictso'] ?? '',
            ':carta_organisasi' => $_POST['carta_organisasi'] ?? ''
        ]);
        $id_sistemutama = $pdo->lastInsertId();

        // 2️⃣ SISTEM_APLIKASI
        $stmt2 = $pdo->prepare("
            INSERT INTO sistem_aplikasi (
                id_sistemutama, nama_sistem, objektif, pemilik, tarikh_mula, tarikh_siap,
                tarikh_guna, bil_pengguna, kaedah_pembangunan, inhouse, outsource,
                bil_modul, kategori, bahasa_pengaturcaraan, pangkalan_data, rangkaian, integrasi, penyelenggaraan
            ) VALUES (
                :id_sistemutama, :nama_sistem, :objektif, :pemilik, :tarikh_mula, :tarikh_siap,
                :tarikh_guna, :bil_pengguna, :kaedah_pembangunan, :inhouse, :outsource,
                :bil_modul, :kategori, :bahasa_pengaturcaraan, :pangkalan_data, :rangkaian, :integrasi, :penyelenggaraan
            )
        ");
        $stmt2->execute([
            ':id_sistemutama' => $id_sistemutama,
            ':nama_sistem' => $_POST['nama_sistem'] ?? '',
            ':objektif' => $_POST['objektif'] ?? '',
            ':pemilik' => $_POST['pemilik'] ?? '',
            ':tarikh_mula' => $_POST['tarikh_mula'] ?? null,
            ':tarikh_siap' => $_POST['tarikh_siap'] ?? null,
            ':tarikh_guna' => $_POST['tarikh_guna'] ?? null,
            ':bil_pengguna' => $_POST['bil_pengguna'] ?? '',
            ':kaedah_pembangunan' => $_POST['kaedah_pembangunan'] ?? '',
            ':inhouse' => $_POST['inhouse'] ?? '',
            ':outsource' => $_POST['outsource'] ?? '',
            ':bil_modul' => $_POST['bil_modul'] ?? '',
            ':kategori' => $_POST['kategori'] ?? '',
            ':bahasa_pengaturcaraan' => $_POST['bahasa_pengaturcaraan'] ?? '',
            ':pangkalan_data' => $_POST['pangkalan_data'] ?? '',
            ':rangkaian' => $_POST['rangkaian'] ?? '',
            ':integrasi' => $_POST['integrasi'] ?? '',
            ':penyelenggaraan' => $_POST['penyelenggaraan'] ?? ''
        ]);

        // 3️⃣ KOS_SISTEM
        $stmt3 = $pdo->prepare("
            INSERT INTO kos_sistem (
                id_sistemutama, keseluruhan, perkakasan, perisian,
                lesen_perisian, penyelenggaraan, kos_lain
            ) VALUES (
                :id_sistemutama, :keseluruhan, :perkakasan, :perisian,
                :lesen_perisian, :penyelenggaraan, :kos_lain
            )
        ");
        $stmt3->execute([
            ':id_sistemutama' => $id_sistemutama,
            ':keseluruhan' => $_POST['keseluruhan'] ?? 0,
            ':perkakasan' => $_POST['perkakasan'] ?? 0,
            ':perisian' => $_POST['perisian'] ?? 0,
            ':lesen_perisian' => $_POST['lesen_perisian'] ?? 0,
            ':penyelenggaraan' => $_POST['penyelenggaraan_kos'] ?? 0,
            ':kos_lain' => $_POST['kos_lain'] ?? 0
        ]);

        // 4️⃣ AKSES_SISTEM
        $stmt4 = $pdo->prepare("
            INSERT INTO akses_sistem (
                id_sistemutama, kategori_dalaman, kategori_umum, pegawai_urus_akses
            ) VALUES (
                :id_sistemutama, :kategori_dalaman, :kategori_umum, :pegawai_urus_akses
            )
        ");
        $stmt4->execute([
            ':id_sistemutama' => $id_sistemutama,
            ':kategori_dalaman' => $_POST['kategori_dalaman'] ?? 0,
            ':kategori_umum' => $_POST['kategori_umum'] ?? 0,
            ':pegawai_urus_akses' => $_POST['pegawai_urus_akses'] ?? ''
        ]);

        // 5️⃣ PEGAWAI_RUJUKAN_SISTEM
        $stmt5 = $pdo->prepare("
            INSERT INTO pegawai_rujukan_sistem (
                id_sistemutama, nama_pegawai, jawatan_gred, bahagian, emel_pegawai, no_telefon
            ) VALUES (
                :id_sistemutama, :nama_pegawai, :jawatan_gred, :bahagian, :emel_pegawai, :no_telefon
            )
        ");
        $stmt5->execute([
            ':id_sistemutama' => $id_sistemutama,
            ':nama_pegawai' => $_POST['nama_pegawai'] ?? '',
            ':jawatan_gred' => $_POST['jawatan_gred'] ?? '',
            ':bahagian' => $_POST['bahagian_pegawai'] ?? '',
            ':emel_pegawai' => $_POST['emel_pegawai'] ?? '',
            ':no_telefon' => $_POST['no_telefon_pegawai'] ?? ''
        ]);

        header("Location: sistemUtama.php?success=1");
        exit;

    } catch (Exception $e) {
        die("❌ Ralat semasa simpan: " . $e->getMessage());
    }
} else {
    header("Location: sistemUtama.php");
    exit;
}
