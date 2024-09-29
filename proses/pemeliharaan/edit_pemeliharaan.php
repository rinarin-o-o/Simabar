<?php
session_start();
include('../../koneksi/koneksi.php'); // Include DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dengan validasi dasar
    $id_pemeliharaan = mysqli_real_escape_string($conn, $_POST['id_pemeliharaan']);
    $kode_barang = mysqli_real_escape_string($conn, $_POST['kode_barang']);
    $desk_pemeliharaan = mysqli_real_escape_string($conn, $_POST['desk_pemeliharaan']);
    $perbaikan = mysqli_real_escape_string($conn, $_POST['perbaikan']);
    $lama_perbaikan = mysqli_real_escape_string($conn, $_POST['lama_perbaikan']);
    $biaya_perbaikan = (int) $_POST['biaya_perbaikan']; // Pastikan ini angka dan tidak perlu tanda kutip

    $sql_update = "UPDATE data_pemeliharaan SET desk_pemeliharaan ='$desk_pemeliharaan', perbaikan = '$perbaikan', lama_perbaikan = '$lama_perbaikan', biaya_perbaikan = '$biaya_perbaikan' WHERE id_pemeliharaan ='$id_pemeliharaan'";

    if (mysqli_query($conn, $sql_update)) {
        $_SESSION['success'] = true;
        // Redirect to lokasi.php after update
        header('Location: ../../Data_pemeliharaan.php');
        exit;
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
        header('Location: ../../Data_pemeliharaan.php?kode_barang=' . $kode_barang);
        exit;
    }
} else {
    // Redirect to the location list page if accessed directly
    header('Location: ../../Data_pemeliharaan.php');
    exit;
}
?>
