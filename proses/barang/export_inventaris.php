<?php
session_start();
include '../../koneksi/koneksi.php'; // Sesuaikan path koneksi

// Mendapatkan id_lokasi dari parameter URL
$id_lokasi = isset($_GET['id_lokasi']) ? $_GET['id_lokasi'] : '';

// Query untuk mengambil data inventaris berdasarkan id_lokasi
$query = "SELECT kode_barang, nama_barang, kategori, merk, no_pabrik, ukuran_CC, bahan, tgl_pembelian, harga_total, kondisi_barang 
          FROM data_barang 
          WHERE ruang_sekarang = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $id_lokasi);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Set header untuk file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="inventaris_ruangan.csv"');

// Membuka output untuk menulis
$output = fopen('php://output', 'w');

// Menulis header kolom
fputcsv($output, ['Kode Barang', 'Nama Barang', 'Kategori', 'Merk', 'No Pabrik', 'Ukuran', 'Bahan', 'Tanggal Pembelian', 'Harga', 'Kondisi']);

// Menulis data dari database ke file CSV
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

// Menutup output
fclose($output);
exit;
?>
