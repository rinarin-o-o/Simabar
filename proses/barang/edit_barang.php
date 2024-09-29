<?php
session_start();
include('../../koneksi/koneksi.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input to prevent SQL injection
    $kode_barang = mysqli_real_escape_string($conn, $_POST['kode_barang']);
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $no_regristrasi = mysqli_real_escape_string($conn, $_POST['no_regristrasi']);
    $kode_pemilik = mysqli_real_escape_string($conn, $_POST['kode_pemilik']);
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
    // For harga_awal and harga_total, remove any commas
    $harga_awal_raw = $_POST['harga_awal'];
    $harga_total_raw = $_POST['harga_total'];

    // Remove commas from harga_awal and harga_total
    $harga_awal = str_replace(',', '', $harga_awal_raw);
    $harga_total = str_replace(',', '', $harga_total_raw);

    // Sanitize harga_awal and harga_total
    $harga_awal = mysqli_real_escape_string($conn, $harga_awal);
    $harga_total = mysqli_real_escape_string($conn, $harga_total);

    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    // Check if kode_pemilik exists in pemilik table
    $check_pemilik = "SELECT COUNT(*) AS count FROM pemilik WHERE Kode_pemilik = '$kode_pemilik'";
    $result = mysqli_query($conn, $check_pemilik);
    $row = mysqli_fetch_assoc($result);

    if ($row['count'] == 0) {
        $_SESSION['error'] = "Invalid kode pemilik.";
        header('Location: ../../frm_edit_barang.php?kode_barang=' . $kode_barang);
        exit;
    }

    // Handle file upload
    $foto_barang = ""; // Initialize $foto_barang

    if (isset($_FILES['foto_barang']) && $_FILES['foto_barang']['error'] === UPLOAD_ERR_OK) {
        $foto_barang = $_FILES['foto_barang']['name'];
        $target_dir = "../../images/"; // Ganti path sesuai dengan struktur direktori
        $target_file = $target_dir . basename($foto_barang);

        // Cek tipe file
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($imageFileType, $allowed_types)) {
            $_SESSION['error'] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            header('Location: ../../frm_edit_barang.php?kode_barang=' . $kode_barang);
            exit;
        }

        // Cek ukuran file
        if ($_FILES['foto_barang']['size'] > 5000000) { // Limit file size to 5MB
            $_SESSION['error'] = "File size should not exceed 5MB.";
            header('Location: ../../frm_edit_barang.php?kode_barang=' . $kode_barang);
            exit;
        }

        // Upload file
        if (!move_uploaded_file($_FILES['foto_barang']['tmp_name'], $target_file)) {
            $_SESSION['error'] = "Failed to upload image.";
            header('Location: ../../frm_edit_barang.php?kode_barang=' . $kode_barang);
            exit;
        }
    }

    // Update query for data_barang table
    if ($foto_barang !== "") {
        $sql_update = "UPDATE data_barang 
                       SET nama_barang='$nama_barang', no_regristrasi='$no_regristrasi', kode_pemilik='$kode_pemilik', 
                           ruang_asal='$ruang_asal', ruang_sekarang='$ruang_sekarang', bid_ruang='$bid_ruang', 
                           tempat_ruang='$tempat_ruang', tgl_pembelian='$tgl_pembelian', tgl_pembukuan='$tgl_pembukuan', 
                           merk='$merk', type='$type', kategori='$kategori', ukuran_CC='$ukuran_CC', 
                           no_pabrik='$no_pabrik', no_rangka='$no_rangka', no_bpkb='$no_bpkb', bahan='$bahan', 
                           no_mesin='$no_mesin', no_polisi='$no_polisi', kondisi_barang='$kondisi_barang', 
                           masa_manfaat='$masa_manfaat', harga_awal='$harga_awal', harga_total='$harga_total', 
                           keterangan='$keterangan', foto_barang='$foto_barang'
                       WHERE kode_barang='$kode_barang'";
    } else {
        $sql_update = "UPDATE data_barang 
                       SET nama_barang='$nama_barang', no_regristrasi='$no_regristrasi', kode_pemilik='$kode_pemilik', 
                           ruang_asal='$ruang_asal', ruang_sekarang='$ruang_sekarang', bid_ruang='$bid_ruang', 
                           tempat_ruang='$tempat_ruang', tgl_pembelian='$tgl_pembelian', tgl_pembukuan='$tgl_pembukuan', 
                           merk='$merk', type='$type', kategori='$kategori', ukuran_CC='$ukuran_CC', 
                           no_pabrik='$no_pabrik', no_rangka='$no_rangka', no_bpkb='$no_bpkb', bahan='$bahan', 
                           no_mesin='$no_mesin', no_polisi='$no_polisi', kondisi_barang='$kondisi_barang', 
                           masa_manfaat='$masa_manfaat', harga_awal='$harga_awal', harga_total='$harga_total', 
                           keterangan='$keterangan'
                       WHERE kode_barang='$kode_barang'";
    }

    // Execute the query
    if (mysqli_query($conn, $sql_update)) {
        $_SESSION['success'] = true;
        header('Location: ../../Data_barang.php');
        exit;
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
        header('Location: ../../frm_edit_barang.php?kode_barang=' . $kode_barang);
        exit;
    }
} else {
    header('Location: ../../Data_barang.php');
    exit;
}
