<?php
session_start();
include('../../koneksi/koneksi.php');

// Pastikan parameter id_pemeliharaan ada di URL
if (isset($_GET['id_pemeliharaan'])) {
    $id_pemeliharaan = mysqli_real_escape_string($conn, $_GET['id_pemeliharaan']);

    // Query untuk menghapus data dari tabel data_pemeliharaan
    $sql = "DELETE FROM data_pemeliharaan WHERE id_pemeliharaan = '$id_pemeliharaan'";

    if (mysqli_query($conn, $sql)) {
        // Setelah berhasil menghapus, redirect ke halaman Data_pemeliharaan.php dengan pesan sukses
        $_SESSION['message'] = "Data pemeliharaan berhasil dihapus.";
        header('Location: ../../Data_pemeliharaan.php');
        exit();
    } else {
        // Jika gagal menghapus, tampilkan pesan error
        $_SESSION['error'] = "Gagal menghapus data pemeliharaan: " . mysqli_error($conn);
        header('Location: ../../Data_pemeliharaan.php');
        exit();
    }
} else {
    // Jika id_pemeliharaan tidak ditemukan, redirect dengan pesan error
    $_SESSION['error'] = "ID Pemeliharaan tidak ditemukan.";
    header('Location: ../../Data_pemeliharaan.php');
    exit();
}
?>
