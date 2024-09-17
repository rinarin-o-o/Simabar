<?php
session_start();
include('../../koneksi/koneksi.php'); // Include DB connection

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input to prevent SQL injection
    $id_lokasi = mysqli_real_escape_string($conn, $_POST['id_lokasi']);
    $nama_lokasi = mysqli_real_escape_string($conn, $_POST['nama_lokasi']);
    $bid_lokasi = mysqli_real_escape_string($conn, $_POST['bid_lokasi']);
    $tempat_lokasi = mysqli_real_escape_string($conn, $_POST['tempat_lokasi']);
    $kategori_lokasi = mysqli_real_escape_string($conn, $_POST['kategori_lokasi']);
    $desk_lokasi = mysqli_real_escape_string($conn, $_POST['desk_lokasi']);

    // Update query
    $sql_update = "UPDATE lokasi 
                   SET nama_lokasi='$nama_lokasi', bid_lokasi='$bid_lokasi', tempat_lokasi='$tempat_lokasi', kategori_lokasi='$kategori_lokasi', desk_lokasi='$desk_lokasi'
                   WHERE id_lokasi='$id_lokasi'";

    if (mysqli_query($conn, $sql_update)) {
        $_SESSION['success'] = true;
        // Redirect to lokasi.php after update
        header('Location: ../../lokasi.php');
        exit;
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
        header('Location: ../../frm_edit_lokasi.php?id_lokasi=' . $id_lokasi);
        exit;
    }
} else {
    // Redirect to the location list page if accessed directly
    header('Location: ../../lokasi.php');
    exit;
}
?>
