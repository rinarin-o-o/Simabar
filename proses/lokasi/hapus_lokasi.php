<?php
session_start();
include('../../koneksi/koneksi.php');

// Pastikan parameter id_lokasi ada di URL
if (isset($_GET['id_lokasi'])) {
    $id_lokasi = mysqli_real_escape_string($conn, $_GET['id_lokasi']);

    // Query untuk menghapus data dari tabel lokasi
    $sql = "DELETE FROM lokasi WHERE id_lokasi = '$id_lokasi'";

    if (mysqli_query($conn, $sql)) {
        // Setelah berhasil menghapus, redirect ke halaman lokasi dengan pesan sukses
        $_SESSION['message'] = "Data lokasi berhasil dihapus.";
        header('Location: ../../lokasi.php');
        exit();
    } else {
        // Jika gagal menghapus, tampilkan pesan error
        $_SESSION['error'] = "Gagal menghapus data lokasi: " . mysqli_error($conn);
        header('Location: ../../lokasi.php');
        exit();
    }
} else {
    // Jika id_lokasi tidak ditemukan, redirect dengan pesan error
    $_SESSION['error'] = "ID Lokasi tidak ditemukan.";
    header('Location: ../../lokasi.php');
    exit();
}
?>
