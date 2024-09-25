<?php
ob_start(); // Start output buffering
session_start();
include('../koneksi/koneksi.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $kode_barang = mysqli_real_escape_string($conn, $_POST['kode_barang']);
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $no_registrasi = mysqli_real_escape_string($conn, $_POST['no_registrasi']);
    $kode_pemilik = mysqli_real_escape_string($conn, trim($_POST['kode_pemilik']));
    $nama_pemilik = mysqli_real_escape_string($conn, trim($_POST['nama_pemilik']));
    $ruang_asal = mysqli_real_escape_string($conn, $_POST['ruang_asal']);
    $ruang_sekarang = mysqli_real_escape_string($conn, $_POST['ruang_sekarang']);
    $bid_ruang = mysqli_real_escape_string($conn, $_POST['bid_ruang']);
    $tempat_ruang = mysqli_real_escape_string($conn, $_POST['tempat_ruang']);
    $tgl_pembelian = mysqli_real_escape_string($conn, $_POST['tgl_pembelian']);
    $tgl_pembukuan = mysqli_real_escape_string($conn, $_POST['tgl_pembukuan']);
    $merk = mysqli_real_escape_string($conn, $_POST['merk']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $ukuran_CC = mysqli_real_escape_string($conn, $_POST['ukuran_CC']);
    $no_pabrik = mysqli_real_escape_string($conn, $_POST['no_pabrik']);
    $no_rangka = mysqli_real_escape_string($conn, $_POST['no_rangka']);
    $no_bpkb = mysqli_real_escape_string($conn, $_POST['no_bpkb']);
    $bahan = mysqli_real_escape_string($conn, $_POST['bahan']);
    $no_mesin = mysqli_real_escape_string($conn, $_POST['no_mesin']);
    $no_polisi = mysqli_real_escape_string($conn, $_POST['no_polisi']);
    $kondisi_barang = mysqli_real_escape_string($conn, $_POST['kondisi_barang']);
    $masa_manfaat = mysqli_real_escape_string($conn, $_POST['masa_manfaat']);
    $harga_awal = mysqli_real_escape_string($conn, $_POST['harga_awal']);
    $harga_total = mysqli_real_escape_string($conn, $_POST['harga_total']) ?: 0;

    // Handle file upload
    $file_name = null;
    if (isset($_FILES['foto_barang']) && $_FILES['foto_barang']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['foto_barang']['tmp_name'];
        $file_name = basename($_FILES['foto_barang']['name']);
        $upload_dir = '../images/'; // pastikan direktori ini sudah ada
        if (!move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            $_SESSION['error'] = 'Gagal mengunggah foto barang.';
            header('Location: ../frm_tambah_barang.php');
            exit();
        }
    }

    // Cek apakah kode_pemilik ada di tabel pemilik
    $check_kode_pemilik_sql = "SELECT COUNT(*) as count FROM pemilik WHERE kode_pemilik='$kode_pemilik'";
    $result_kode_pemilik = mysqli_query($conn, $check_kode_pemilik_sql);
    if (!$result_kode_pemilik) {
        $_SESSION['error'] = 'Gagal memeriksa pemilik: ' . mysqli_error($conn);
        header('Location: ../frm_tambah_barang.php');
        exit();
    }

    $row_kode_pemilik = mysqli_fetch_assoc($result_kode_pemilik);

    // Jika kode_pemilik tidak ditemukan, tambahkan ke tabel pemilik
    if ($row_kode_pemilik['count'] == 0) {
        if (empty($nama_pemilik)) {
            $_SESSION['error'] = 'Kode Pemilik baru, harap masukkan Nama Pemilik.';
            header('Location: ../frm_tambah_barang.php');
            exit();
        }

        // Insert pemilik baru
        $insert_pemilik_sql = "INSERT INTO pemilik (kode_pemilik, nama_pemilik) VALUES ('$kode_pemilik', '$nama_pemilik')";
        if (!mysqli_query($conn, $insert_pemilik_sql)) {
            echo "Error: Gagal menambahkan pemilik baru: " . mysqli_error($conn);
            exit();
        }
    }

    // Insert data_barang (dengan kode_pemilik sebagai foreign key)
    $insert_barang_sql = "INSERT INTO data_barang (kode_barang, nama_barang, no_registrasi, kode_pemilik, ruang_asal, ruang_sekarang, 
            bid_ruang, tempat_ruang, tgl_pembelian, tgl_pembukuan, merk, type, kategori, ukuran_CC, no_pabrik, 
            no_rangka, no_bpkb, bahan, no_mesin, no_polisi, kondisi_barang, masa_manfaat, harga_awal, harga_total, foto_barang) 
            VALUES ('$kode_barang', '$nama_barang', '$no_registrasi', '$kode_pemilik', '$ruang_asal', '$ruang_sekarang', 
            '$bid_ruang', '$tempat_ruang', '$tgl_pembelian', '$tgl_pembukuan', '$merk', '$type', '$kategori', '$ukuran_CC', 
            '$no_pabrik', '$no_rangka', '$no_bpkb', '$bahan', '$no_mesin', '$no_polisi', '$kondisi_barang', 
            '$masa_manfaat', '$harga_awal', '$harga_total', '$file_name')";

    // Jalankan kedua query INSERT
    if (mysqli_query($conn, $insert_barang_sql)) {
        $_SESSION['success'] = 'Data barang dan pemilik berhasil disimpan.';
        header('Location: ../Data_barang.php');
        exit();
    } else {
        echo "Error: " . $insert_barang_sql . "<br>" . mysqli_error($conn);
    }
}
?>