<?php
include "koneksi.php";

// Cek aksi yang diminta
if ($act == 'User Login') {
    // Cek login user
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $errors = array(); // Menyimpan pesan kesalahan

    if (empty($username) || empty($password)) {
        $errors[] = 'Harap mengisi username dan password.';
    }

    if (empty($errors)) {
        // Mencari data user berdasarkan username dan password (password di-hash dengan MD5)
        $hashedPassword = md5($password);
        $query = "SELECT * FROM tb_user WHERE username ='{$username}' AND password ='{$hashedPassword}'";
        $result = mysqli_query($koneksi, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_array($result);
            $_SESSION['user_id'] = $data['user_id']; // Mengatur sesi user_id
        } else {
            $errors[] = 'Maaf, password Anda salah. Ulangi lagi.';
        }
    }

    // Mengatur tindakan berdasarkan hasil cek login
    if (!empty($errors)) {
        $_SESSION['login']['gagal'] = implode('<br>', $errors);
        header("Location: index.php");
        exit;
    } elseif ($page == 'logout') {
        // Logout user
        session_destroy();
        header("Location: index.php");
        exit;
    } elseif ($act == 'Simpan Karyawan') {
        // Tambah karyawan
        $kode_kar = AturKode("tb_karyawan", "kode_kar", "KA"); // Kode urut karyawan
        $nama_kar = isset($_POST['nama_kar']) ? $_POST['nama_kar'] : '';
        $alamat_kar = isset($_POST['alamat_kar']) ? $_POST['alamat_kar'] : '';
        $gol_kar = isset($_POST['gol_kar']) ? $_POST['gol_kar'] : '';
        $gaji_utama = isset($_POST['gaji_utama']) ? $_POST['gaji_utama'] : '';
        $no_rek = isset($_POST['no_rek']) ? $_POST['no_rek'] : '';
        $errors = array();

        // Validasi data karyawan
        if (empty($nama_kar) || empty($alamat_kar) || empty($gaji_utama) || empty($gol_kar)) {
            $errors[] = 'Harap mengisi seluruh data karyawan yang diperlukan.';
        }

        if (empty($errors)) {
            // Cek apakah kode karyawan sudah ada sebelumnya
            if (mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE kode_kar='{$kode_kar}'")) == 0) {
                mysqli_query($koneksi, "INSERT INTO tb_karyawan VALUES('', '{$kode_kar}', '{$nama_kar}', '{$alamat_kar}', '{$no_rek}', '{$gaji_utama}', '{$gol_kar}')");
            } else {
                $errors[] = 'Kode karyawan ini sudah ada sebelumnya.';
            }
        }

        // Mengatur tindakan berdasarkan hasil validasi
        if (count($errors)) {
            $_SESSION['tambah-kar']['gagal'] = implode('<br>', $errors);
        }
        header("Location: index.php?page=tambah-karyawan");
        exit;
    } elseif ($act == 'Edit Karyawan') {
        $kary_id = isset($_GET['kary_id']) ? $_GET['kary_id'] : '';
        $kary = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE kary_id = '{$kary_id}'"));
        $nama_kar = isset($_POST['nama_kar']) ? $_POST['nama_kar'] : '';
        $alamat_kar = isset($_POST['alamat_kar']) ? $_POST['alamat_kar'] : '';
        $gol_kar = isset($_POST['gol_kar']) ? $_POST['gol_kar'] : '';
        $gaji_utama = isset($_POST['gaji_utama']) ? $_POST['gaji_utama'] : '';
        $no_rek = isset($_POST['no_rek']) ? $_POST['no_rek'] : '';
        $errors = array();

        // Validasi data karyawan
        if (empty($nama_kar) || empty($alamat_kar) || empty($gaji_utama) || empty($gol_kar)) {
            $errors[] = 'Harap mengisi seluruh data karyawan yang diperlukan.';
        }

        if (empty($errors)) {
            mysqli_query($koneksi, "UPDATE tb_karyawan SET nama_kar = '{$nama_kar}', no_rek = '{$no_rek}', alamat_kar = '{$alamat_kar}', gaji_utama = '{$gaji_utama}', gol_kar = '{$gol_kar}' WHERE kary_id = '{$kary_id}'");
        }

        // Mengatur tindakan berdasarkan hasil validasi
        if (count($errors)) {
            $_SESSION['edit-kar']['gagal'] = implode('<br>', $errors);
            header("Location: index.php?page=edit-karyawan&kary_id=$kary_id");
        } else {
            header("Location: index.php?page=daftar-karyawan");
        }
        exit;
    } elseif ($act == 'Transfer Gaji') {
        // Proses penggajian
        $kary_id = isset($_GET['kary_id']) ? $_GET['kary_id'] : '';
        $jam_lembur = isset($_GET['jam_lembur']) ? $_GET['jam_lembur'] : '';
        $uang_lembur = isset($_GET['uang_lembur']) ? $_GET['uang_lembur'] : '';
        $kode_gaji = AturKode("tb_gaji", "kode_gaji", "GJ"); // Kode urut gaji
        $bulan_transfer = date("F Y"); // Bulan transfer
        $tgl_transfer = date("d/m/Y"); // Tanggal transfer
        $jam_transfer = date("H:i:s"); // Jam transfer
        $errors = array();

        // Ambil data karyawan
        $karyawan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE kary_id = '{$kary_id}'"));
        $total_gaji = $uang_lembur + $karyawan['gaji_utama']; // Total gaji

        // Validasi jam lembur
        if (empty($jam_lembur)) {
            $errors[] = 'Harap mengisi total jam lembur karyawan.';
        }

        if (empty($errors)) {
            mysqli_query($koneksi, "INSERT INTO tb_gaji VALUES('', '{$kary_id}', '{$kode_gaji}', '{$jam_lembur}', '{$uang_lembur}', '{$total_gaji}', '{$bulan_transfer}', '{$tgl_transfer}', '{$jam_transfer}')");
        }

        // Mengatur tindakan berdasarkan hasil validasi
        if (count($errors)) {
            $_SESSION['gaji']['gagal'] = implode('<br>', $errors);
            header("Location: index.php?page=transfer-gaji&kary_id=$kary_id");
        } else {
            header("Location: index.php?page=data-transfer-gaji&kary_id=$kary_id");
        }
        exit;
    } elseif ($page == 'delete-karyawan') {
        $kary_id = isset($_GET['kary_id']) ? $_GET['kary_id'] : '';
        mysqli_query($koneksi, "DELETE FROM tb_karyawan WHERE kary_id = '{$kary_id}'");
        header("Location: index.php?page=daftar-karyawan");
        exit;
    }
}
?>