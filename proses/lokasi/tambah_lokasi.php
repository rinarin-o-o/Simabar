<?php
session_start();
include('../../koneksi/koneksi.php');

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $id_lokasi = $_POST['id_lokasi'];
    $nama_lokasi = $_POST['nama_lokasi'];
    $bid_lokasi = $_POST['bid_lokasi'];
    $tempat_lokasi = $_POST['tempat_lokasi'];
    $kategori_lokasi = $_POST['kategori_lokasi'];
    $desk_lokasi = $_POST['desk_lokasi'];

    // Debug: Print received data
    error_log("ID Lokasi: $id_lokasi");
    error_log("Nama Lokasi: $nama_lokasi");
    error_log("Bidang Lokasi: $bid_lokasi");
    error_log("Tempat Asal: $tempat_lokasi");
    error_log("Kategori: $kategori_lokasi");
    error_log("Deskripsi: $desk_lokasi");

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO lokasi (id_lokasi, nama_lokasi, bid_lokasi, tempat_lokasi, kategori_lokasi, desk_lokasi) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $id_lokasi, $nama_lokasi, $bid_lokasi, $tempat_lokasi, $kategori_lokasi, $desk_lokasi);

    // Execute the query
    if ($stmt->execute()) {
        echo "Data berhasil ditambahkan!";
        exit();
    } else {
        if ($conn->errno == 1062) {
            echo "Duplikat Kode Lokasi. Data sudah ada.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
} else {
    header('Location: ../../lokasi.php');
    exit();
}
?>
