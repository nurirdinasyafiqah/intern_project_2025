<?php
require_once '../../app/config.php';
require_once '../../app/auth.php';
require_login();

// Semak jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        // Simpan ke dalam jadual sistem_utama
        $stmt = $pdo->prepare("
            INSERT INTO sistem_utama (
                nama_entiti, tarikh_kemaskini, nama_bahagian, alamat_pejabat,
                nama_ketua_bahagian_it, no_telefon, no_faks, emel_ketua_bahagian_it,
                nama_cio, nama_ictso, carta_organisasi, nama_sistem, objektif_sistem,
                pemilik_sistem, tarikh_mula, tarikh_siap, bil_pengguna, kaedah_inhouse,
                kaedah_outsource, bil_modul_kategori, bahasa_pengaturcaraan, pangkalan_data,
                integrasi, penyelenggaraan_sistem, kos_keseluruhan, kos_perkakasan, kos_perisian,
                lesen_perisian, penyelenggaraan, kos_lain
            ) VALUES (
                :nama_entiti, :tarikh_kemaskini, :nama_bahagian, :alamat_pejabat,
                :nama_ketua_bahagian_it, :no_telefon, :no_faks, :emel_ketua_bahagian_it,
                :nama_cio, :nama_ictso, :carta_organisasi, :nama_sistem, :objektif_sistem,
                :pemilik_sistem, :tarikh_mula, :tarikh_siap, :bil_pengguna, :kaedah_inhouse,
                :kaedah_outsource, :bil_modul_kategori, :bahasa_pengaturcaraan, :pangkalan_data,
                :integrasi, :penyelenggaraan_sistem, :kos_keseluruhan, :kos_perkakasan, :kos_perisian,
                :lesen_perisian, :penyelenggaraan, :kos_lain
            )
        ");

        $stmt->execute([
            ':nama_entiti' => $_POST['nama_entiti'],
            ':tarikh_kemaskini' => $_POST['tarikh_kemaskini'],
            ':nama_bahagian' => $_POST['nama_bahagian'],
            ':alamat_pejabat' => $_POST['alamat_pejabat'],
            ':nama_ketua_bahagian_it' => $_POST['nama_ketua_bahagian_it'],
            ':no_telefon' => $_POST['no_telefon'],
            ':no_faks' => $_POST['no_faks'],
            ':emel_ketua_bahagian_it' => $_POST['emel_ketua_bahagian_it'],
            ':nama_cio' => $_POST['nama_cio'],
            ':nama_ictso' => $_POST['nama_ictso'],
            ':carta_organisasi' => $_POST['carta_organisasi'],
            ':nama_sistem' => $_POST['nama_sistem'],
            ':objektif_sistem' => $_POST['objektif_sistem'],
            ':pemilik_sistem' => $_POST['pemilik_sistem'],
            ':tarikh_mula' => $_POST['tarikh_mula'],
            ':tarikh_siap' => $_POST['tarikh_siap'],
            ':bil_pengguna' => $_POST['bil_pengguna'],
            ':kaedah_inhouse' => $_POST['kaedah_inhouse'],
            ':kaedah_outsource' => $_POST['kaedah_outsource'],
            ':bil_modul_kategori' => $_POST['bil_modul_kategori'],
            ':bahasa_pengaturcaraan' => $_POST['bahasa_pengaturcaraan'],
            ':pangkalan_data' => $_POST['pangkalan_data'],
            ':integrasi' => $_POST['integrasi'],
            ':penyelenggaraan_sistem' => $_POST['penyelenggaraan_sistem'],
            ':kos_keseluruhan' => $_POST['kos_keseluruhan'],
            ':kos_perkakasan' => $_POST['kos_perkakasan'],
            ':kos_perisian' => $_POST['kos_perisian'],
            ':lesen_perisian' => $_POST['lesen_perisian'],
            ':penyelenggaraan' => $_POST['penyelenggaraan'],
            ':kos_lain' => $_POST['kos_lain']
        ]);

        $id_sistemutama = $pdo->lastInsertId();

        // Simpan ke jadual akses_sistem
        $stmt2 = $pdo->prepare("
            INSERT INTO akses_sistem (id_sistemutama, kategori_dalaman, kategori_umum, pegawai_urus_akses)
            VALUES (:id_sistemutama, :kategori_dalaman, :kategori_umum, :pegawai_urus_akses)
        ");
        $stmt2->execute([
            ':id_sistemutama' => $id_sistemutama,
            ':kategori_dalaman' => !empty($_POST['kategori_dalaman']) ? 1 : 0,
            ':kategori_umum' => !empty($_POST['kategori_umum']) ? 1 : 0,
            ':pegawai_urus_akses' => $_POST['pegawai_urus_akses']
        ]);

        // Simpan ke jadual pegawai_rujukan
        $stmt3 = $pdo->prepare("
            INSERT INTO pegawai_rujukan (id_sistemutama, nama_pegawai, jawatan_gred, bahagian, emel_pegawai, no_telefon)
            VALUES (:id_sistemutama, :nama_pegawai, :jawatan_gred, :bahagian, :emel_pegawai, :no_telefon)
        ");
        $stmt3->execute([
            ':id_sistemutama' => $id_sistemutama,
            ':nama_pegawai' => $_POST['nama_pegawai'],
            ':jawatan_gred' => $_POST['jawatan_gred'],
            ':bahagian' => $_POST['bahagian'],
            ':emel_pegawai' => $_POST['emel_pegawai'],
            ':no_telefon' => $_POST['no_telefon']
        ]);

        // Redirect balik
        header("Location: sistemUtama.php?success=1");
        exit;
    } catch (PDOException $e) {
        die("Ralat semasa simpan: " . $e->getMessage());
    }
} else {
    header("Location: sistemUtama.php");
    exit;
}
