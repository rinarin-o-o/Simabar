<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_simabar");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil data dari form dengan validasi apakah data ada
$kode_barang = isset($_POST['kode_barang']) ? $_POST['kode_barang'] : '';
$nama_barang = isset($_POST['nama_barang']) ? $_POST['nama_barang'] : '';
$ruang_asal = isset($_POST['ruang_asal']) ? $_POST['ruang_asal'] : '';
$ruang_sekarang = isset($_POST['ruang_sekarang']) ? $_POST['ruang_sekarang'] : '';
$jenis_mutasi = isset($_POST['jenis_mutasi']) ? $_POST['jenis_mutasi'] : '';
$tgl_mutasi = isset($_POST['tgl_mutasi']) ? $_POST['tgl_mutasi'] : '';
$PIC = isset($_POST['PIC']) ? $_POST['PIC'] : '';
$keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';

// Cek jika ada data yang kosong, jika ada munculkan pesan error
if (empty($kode_barang) || empty($nama_barang) || empty($ruang_asal) || empty($ruang_sekarang) || empty($jenis_mutasi) || empty($tgl_mutasi) || empty($PIC)) {
    echo "<script>alert('Semua field harus diisi!');
    window.history.back();</script>";
    exit;
}

// Gunakan prepared statement untuk mengamankan query
$query = "INSERT INTO mutasi_barang (kode_barang, nama_barang, ruang_asal, ruang_sekarang, jenis_mutasi, tgl_mutasi, PIC, keterangan) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "ssssssss", $kode_barang, $nama_barang, $ruang_asal, $ruang_sekarang, $jenis_mutasi, $tgl_mutasi, $PIC, $keterangan);
    
    // Eksekusi statement
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data mutasi berhasil ditambahkan!');
        window.location='http://localhost/Simabar/Data_mutasi_barang.php';</script>";  // Arahkan ke URL yang benar
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
    // Tutup statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>

