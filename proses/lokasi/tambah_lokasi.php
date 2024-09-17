<?php
session_start();
include('../../koneksi/koneksi.php'); // Include DB connection

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input to prevent SQL injection
    $id_lokasi = mysqli_real_escape_string($conn, $_POST['id_lokasi']);
    $nama_lokasi = mysqli_real_escape_string($conn, $_POST['nama_lokasi']);
    $bid_lokasi = mysqli_real_escape_string($conn, $_POST['bid_lokasi']);
    $tempat_lokasi = mysqli_real_escape_string($conn, $_POST['tempat_lokasi']);
    $kategori_lokasi = mysqli_real_escape_string($conn, $_POST['kategori_lokasi']);
    $desk_lokasi = mysqli_real_escape_string($conn, $_POST['desk_lokasi']);

    // SQL query to insert data into the lokasi table
    $sql = "INSERT INTO lokasi (id_lokasi, nama_lokasi, bid_lokasi, tempat_lokasi, kategori_lokasi, desk_lokasi) 
            VALUES ('$id_lokasi', '$nama_lokasi', '$bid_lokasi', '$tempat_lokasi', '$kategori_lokasi', '$desk_lokasi')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Redirect to lokasi.php after successful insert
        header('Location: ../../lokasi.php');
        exit();
    } else {
        // Handle error if insert fails
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    // If not accessed via POST, redirect to the form page
    header('Location: ../../tambah_lokasi.php');
    exit();
}
?>
