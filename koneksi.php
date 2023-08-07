<?php
// Mengatur zona waktu ke Asia/Jakarta
date_default_timezone_set('Asia/Jakarta');

// Membuat objek koneksi ke database
$koneksi = mysqli_connect('localhost', 'root', '', 'db_penggajian');

// Memilih database yang akan digunakan (memerlukan objek koneksi dan nama database)
mysqli_select_db($koneksi, 'db_penggajian');

// Mengambil nilai dari variabel POST 'act' atau menggunakan string kosong jika tidak ada
$act = isset($_POST['act']) ? $_POST['act'] : '';

// Mengambil nilai dari variabel POST 'page' atau menggunakan string kosong jika tidak ada
$page = isset($_POST['page']) ? $_POST['page'] : '';

// Mendefinisikan konstanta 'WEB' dengan nilai 'Program Penggajian'
define('WEB', 'Program Penggajian');

// Mendefinisikan konstanta 'URL' dengan nilai 'http://localhost/program-penggajian'
define('URL', 'http://localhost/program-penggajian');

// Fungsi untuk mengatur kode dengan mengecek nilai maksimal dalam tabel dan menambahkan angka
function AturKode($table, $id, $init)
{
    global $koneksi;

    // Mengambil data dari database berdasarkan query dan objek koneksi
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX($id) AS kode FROM {$table}"));

    // Mengambil nilai kode dari data yang diambil
    $kode = $data['kode'];

    if ($kode) {
        // Memotong kode menjadi 5 karakter pertama
        $kode = substr($kode, 0, 5);
        // Menambahkan angka satu ke kode
        $kode++;
    } else {
        // Jika tidak ada data, inisialisasi dengan kode awal + "001"
        $kode = $init . "001";
    }
    return $kode;
}

// Fungsi untuk mengformat angka sebagai format Rupiah (ribuan dan desimal dipisahkan dengan koma)
function Rupiah($id)
{
    return number_format($id, 0, ", ", ".");
}
?>