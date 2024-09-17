
<?php 
// Pastikan file ini hanya dapat diakses melalui server

//if (!defined('ACCESS')) {
   // die('Akses ditolak');
//} 

// Nama file PDF yang akan diunduh
$pdf_file = 'panduan_aplikasi.pdf';

if (isset($_GET['download']) && $_GET['download'] === 'true') {
    // Periksa apakah file PDF ada di server
    if (file_exists($pdf_file)) {
        // Set header untuk memaksa browser mengunduh file
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($pdf_file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($pdf_file));
        readfile($pdf_file);
        exit;
    } else {
        echo 'File tidak ditemukan.';
    }
}
?>

<!DOCTYPE html>
<?php include ("component/header.php");?>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Umum</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ganti dengan path ke file CSS Anda -->
</head>
<body>
<main id="main" class="main">
    <h1>Panduan Umum Aplikasi</h1>
    <p>Untuk mengunduh panduan aplikasi dalam format PDF, klik tombol di bawah ini:</p>
    <form method="get" action="panduan_umum.php">
        <button type="submit" name="download" value="true">Unduh Panduan Aplikasi</button>
    </form>
</main>
</body>
<?php include ("component/footer.php");?>
</html>

