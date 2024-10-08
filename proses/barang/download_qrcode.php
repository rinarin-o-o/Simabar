<?php
require('../qrcode/qrlib.php'); // Pastikan path ke library QR code benar
require('../../koneksi/koneksi.php'); // Pastikan sudah ada file koneksi database

function generateQRCodeWithText($barang, $filename) {
    // Ukuran QR code
    $tempQR = 'temp_qr.png';
    $barangInfo = "SI MABAR\n" . 
                  "Nama Barang: " . $barang['nama_barang'] . "\n" . 
                  "No Registrasi: " . $barang['no_regristrasi'] . "\n" . 
                  "Kode Barang: " . $barang['kode_barang'] . "\n" . 
                  "Ruang Asal: " . $barang['ruang_asal'] . "\n" . 
                  "Tempat Ruang: " . $barang['tempat_ruang'] . "\n";
    
    // Generate QR code sesuai informasi yang diinginkan
    QRcode::png($barangInfo, $tempQR, 'M', 6, 2); 
    
    // Buat gambar akhir dengan ukuran 1230x300 pixel
    $finalImage = imagecreatetruecolor(1230, 300);
    $white = imagecolorallocate($finalImage, 255, 255, 255);
    $black = imagecolorallocate($finalImage, 0, 0, 0);
    $blue = imagecolorallocate($finalImage, 0, 0, 255);
    
    // Isi background dengan warna putih
    imagefilledrectangle($finalImage, 0, 0, 1230, 300, $white);
    
    // Ambil QR code dari file temp
    $qrImage = imagecreatefrompng($tempQR);
    imagecopyresized($finalImage, $qrImage, 50, 50, 0, 0, 200, 200, imagesx($qrImage), imagesy($qrImage)); // QR di bagian kiri
    
    // Tulis teks di sebelah QR code
    $fontPath = 'fonts/arial.ttf'; // Pastikan path ke font benar
    if (!file_exists($fontPath)) {
        die('Font tidak ditemukan. Pastikan path font benar.');
    }

    imagettftext($finalImage, 20, 0, 300, 80, $blue, $fontPath, 'SI MABAR');
    imagettftext($finalImage, 15, 0, 300, 120, $black, $fontPath, 'NAMA_BARANG: ' . $barang['nama_barang']);
    imagettftext($finalImage, 15, 0, 300, 160, $black, $fontPath, 'NO_REGRISTRASI: ' . $barang['no_regristrasi']);
    imagettftext($finalImage, 15, 0, 300, 200, $black, $fontPath, 'KODE_BARANG: ' . $barang['kode_barang']);
    imagettftext($finalImage, 15, 0, 300, 240, $black, $fontPath, 'RUANG_ASAL: ' . $barang['ruang_asal']);
    imagettftext($finalImage, 15, 0, 300, 280, $black, $fontPath, 'TEMPAT_RUANG: ' . $barang['tempat_ruang']);
    
    // Simpan gambar besar sebagai file png
    if (!imagepng($finalImage, $filename)) {
        die('Gagal menyimpan gambar. Pastikan direktori untuk menyimpan file ada.');
    }
    
    // Bersihkan
    imagedestroy($qrImage);
    imagedestroy($finalImage);
    unlink($tempQR); // Hapus file sementara QR code
}

// Fungsi untuk mengambil data barang dari database
function getBarangData($kode_barang) {
    global $conn; // Koneksi database
    $sql = "SELECT * FROM data_barang WHERE kode_barang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $kode_barang); // Bind parameter dengan kode_barang
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc(); // Ambil data barang sebagai array asosiatif
}

// Contoh penggunaan
if (isset($_GET['kode_barang'])) {
    $kode_barang = $_GET['kode_barang'];
    $barang = getBarangData($kode_barang); // Ambil data barang dari database
    
    if ($barang) {
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/Simabar-main2/images/qrcode/qrcode_custom_' . $barang['kode_barang'] . '.png';
 // Pastikan path penyimpanan sesuai
        
        generateQRCodeWithText($barang, $filename);
        
        // Berikan file sebagai download
        if (file_exists($filename)) {
            header('Content-Type: image/png');
            header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
            header('Content-Length: ' . filesize($filename));
            readfile($filename);
            unlink($filename); // Hapus file setelah didownload
        } else {
            echo "File tidak ditemukan.";
        }
    } else {
        echo "Barang tidak ditemukan.";
    }
} else {
    echo "Kode barang tidak diberikan.";
}
?>