<?php
    session_start();
    $user_id = isset($_SESSION['user_id'])? $_SESSION['user_id']:'';//cek jika user sudah login
    $kary_id = isset($_GET['kary_id'])? $_GET['kary_id']:'';
    include "fungsi.php";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROGRAM PENGGAJIAN</title>
    <link rel="stylesheet" href="assset/style.css">
</head>

<body>
    <?php
        //jika user sudah login
        if($user_id)
        {
            //ambil data user dari database
            $userdata = mysqli_fetch_array(mysqli_query("SELECT * FROM tb_user WHERE user_id = '{$user_id}'"));

            echo "<div class=\"wrap\">\n";
            echo "  <div class=\"header\">\n";
            echo "      <div class=\"h-right\">\n";
            echo "          <div class=\"u-info\">\n";
            echo "              <div class=\"u-text\">\n";
            echo "                  <div class=\"u-name\">Welcome, <b>{$userdata['fullname']}</b></div>\n";
            echo "                  <div class=\"u-link\"><a href=\"".URL."/index.php?page=logout\">Logout Now</a></div>\n";
            echo "              </div>\n";
            echo "              <div class=\"clear\"></div>\n";
            echo "          </div>\n";
            echo "      </div>\n";
            echo "      <div class=\"clear\"></div>\n";
            echo "  </div>\n";
            
            echo "  <div class=\"page\">\n";
            echo "      <div class=\"p-left\">\n";
            echo "          <div class=\"box\">\n";
            echo "              <h1>Menu Utama</h1>\n";
            echo "              <ul class=\"nav\">\n";
            echo "                  <li><a href=\"index.php\">Home</a></li>\n";
            echo "                  <li><a href=\"index.php?page=daftar-karyawan\">Daftar Karyawan</a></li>\n";
            echo "                  <li><a href=\"index.php?page=tambah-karyawan\">Tambah Karyawan</a></li>\n";
            echo "                  <li><a href=\"index.php?page=cari-karyawan\">Cari Karyawan</a></li>\n";
            echo "                  <li><a href=\"index.php?page=data-gajian\">Data Gajian</a></li>\n";
            echo "                  <li><a href=\"index.php?page=logout\">Logout</a></li>\n";
            echo "              </ul>\n";
            echo "           </div>\n";
            echo "      </div>\n";
            echo "      <div class=\"p-right\">\n";

            if($page == 'daftar-karyawan')
            {
                echo "  <div class=\"box\">\n";
                echo "      <h1>Daftar Karyawan</h1>\n";
                echo "      <p>Berikut daftar karyawan yang terdapat didatabase</p>\n";
                echo "      <table border=\"0\">\n";
                echo "      <tr class=\"head\>\n";
                echo "          <td width=\"30\>" align=\"center\">No</td>\n";
                echo "          <td width=\"150\">Nama</td>\n";
                echo "          <td width=\"180\">Alamat</td>\n";
                echo "          <td width=\"90\">Gaji Utama</td>\n";
                echo "          <td width=\"30\" align=\"center\">Gol.</td>\n";
                echo "          <td width=\"80\" align=\"center\">Aksi</td>\n";
                echo "      </tr>\n";

                
            }
        }
    ?>






    <script>
    function hitung_gaji() {
        var jam_lembur = document.transfer.jam_lembur.value;
        var uang_lembur = document.transfer.uang_lembur.value;
        var gaji_utama = document.transfer.gaji_utama.value;
        uang_lembur = (gaji_utama / 173) * jam_lembur;
        document.transfer.uang_lembur.value = Math.floor(uang_lembur);
    }

    function tanya(id) {
        var aa = confirm('Yakin akan menghapus data dengan ID - ' + id + '?');
        if (aa == true)
            return true;
        else
            return false;
    }
    </script>
</body>

</html>