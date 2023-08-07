<?php
    date_default_timezone_set('Asia/Jakarta');
    mysqli_connect('localhost', 'root', '');
    mysqli_select_db('db_penggajian');
    $act = isset($_POST['act']) ? $_POST['act'] : '';
    $page = isset($_POST['page']) ? $_POST['page'] : '';

    define('WEB', 'Program Penggajian');
    define('URL', 'http://localhost/program-penggajian');

    function AturKode($table, $id, $init)
    {
        $data = mysqli_fetch_array(mysqli_query("SELECT MAX($id) AS kode FROM {$table}"));
        $kode = $data['kode'];
        if($kode)
        {
            $kode = substr($kode, 0, 5);
            $kode++;
        }
        else
        {
            kode = $init . "001";
        }
        return $kode;
    }

    function Rupiah($id)
    {
        return number_format($id, 0, ", ", ".");
    }
?>