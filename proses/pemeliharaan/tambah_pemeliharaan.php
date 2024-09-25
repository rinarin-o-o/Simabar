<?php
session_start();
ob_start(); 
include('../../koneksi/koneksi.php'); // Include DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_barang = $_POST['kode_barang'];
    // Validasi dan proses penyimpanan pemeliharaan di sini...
    
    $desk_pemeliharaan = $_POST['desk_pemeliharaan'];
    $perbaikan = $_POST['perbaikan'];
    $tgl_perbaikan = $_POST['tgl_perbaikan'];
    $lama_perbaikan = $_POST['lama_perbaikan'];
    $biaya_perbaikan = $_POST['biaya_perbaikan'];

    // Query untuk memasukkan data pemeliharaan
    $query = "INSERT INTO data_pemeliharaan (kode_barang, desk_pemeliharaan, perbaikan, tgl_perbaikan, lama_perbaikan, biaya_perbaikan)
              VALUES ('$kode_barang', '$desk_pemeliharaan', '$perbaikan', '$tgl_perbaikan', '$lama_perbaikan', $biaya_perbaikan)";

    if (mysqli_query($conn, $query)) {
        // Redirect atau tampilkan pesan sukses
        header('Location: frm_tambah_pemeliharaan.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>