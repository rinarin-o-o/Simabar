<?php
session_start();
include('../../koneksi/koneksi.php');

// Pastikan parameter kode_barang ada di URL
if (isset($_GET['kode_barang'])) {
    $kode_barang = mysqli_real_escape_string($conn, $_GET['kode_barang']);

    // Query untuk menghapus data dari tabel data_barang
    $sql = "DELETE FROM data_barang WHERE kode_barang = '$kode_barang'";

    if (mysqli_query($conn, $sql)) {
        // Setelah berhasil menghapus, redirect ke halaman data_barang dengan pesan sukses
        $_SESSION['message'] = "Data barang berhasil dihapus.";
        header('Location: ../../data_barang.php');
        exit();
    } else {
        // Jika gagal menghapus, tampilkan pesan error
        $_SESSION['error'] = "Gagal menghapus data data_barang: " . mysqli_error($conn);
        header('Location: ../../data_barang.php');
        exit();
    }
} else {
    // Jika kode_barang tidak ditemukan, redirect dengan pesan error
    $_SESSION['error'] = "ID data_barang tidak ditemukan.";
    header('Location: ../../data_barang.php');
    exit();
}
?>
