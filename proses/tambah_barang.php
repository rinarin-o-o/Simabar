<?php
session_start();
include('../../koneksi/koneksi.php'); // Include DB connection

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Ambil dan sanitasi input dari form
//     $kode_barang = mysqli_real_escape_string($conn, $_POST['kode_barang']);
//     $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
//     $no_registrasi = mysqli_real_escape_string($conn, $_POST['no_registrasi']);
//     $kode_pemilik = mysqli_real_escape_string($conn, $_POST['kode_pemilik']);
//     $ruang_asal = mysqli_real_escape_string($conn, $_POST['ruang_asal']);
//     $ruang_sekarang = mysqli_real_escape_string($conn, $_POST['ruang_sekarang']);
//     $bid_ruang = mysqli_real_escape_string($conn, $_POST['bid_ruang']);
//     $tempat_ruang = mysqli_real_escape_string($conn, $_POST['tempat_ruang']);
//     $tgl_pembelian = mysqli_real_escape_string($conn, $_POST['tgl_pembelian']);
//     $tgl_pembukuan = mysqli_real_escape_string($conn, $_POST['tgl_pembukuan']);
//     $merk = mysqli_real_escape_string($conn, $_POST['merk']);
//     $type = mysqli_real_escape_string($conn, $_POST['type']);
//     $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
//     $ukuran_CC = mysqli_real_escape_string($conn, $_POST['ukuran_CC']);
//     $no_pabrik = mysqli_real_escape_string($conn, $_POST['no_pabrik']);
//     $no_rangka = mysqli_real_escape_string($conn, $_POST['no_rangka']);
//     $no_bpkb = mysqli_real_escape_string($conn, $_POST['no_bpkb']);
//     $bahan = mysqli_real_escape_string($conn, $_POST['bahan']);
//     $no_mesin = mysqli_real_escape_string($conn, $_POST['no_mesin']);
//     $no_polisi = mysqli_real_escape_string($conn, $_POST['no_polisi']);
//     $kondisi_barang = mysqli_real_escape_string($conn, $_POST['kondisi_barang']);
//     $masa_manfaat = mysqli_real_escape_string($conn, $_POST['masa_manfaat']);
//     $harga_awal = mysqli_real_escape_string($conn, $_POST['harga_awal']);
//     $harga_total = mysqli_real_escape_string($conn, $_POST['harga_total']);
//     $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
//     $foto_barang = mysqli_real_escape_string($conn, $_POST['foto_barang']);

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO data_barang (kode_barang, nama_barang, no_registrasi, kode_pemilik, ruang_asal, ruang_sekarang, bid_ruang, tempat_ruang, tgl_pembelian, tgl_pembukuan, merk, type, kategori, ukuran_CC, no_pabrik, no_rangka, no_bpkb, bahan, no_mesin, no_polisi, kondisi_barang, masa_manfaat, harga_awal, harga_total, keterangan, foto_barang)
              VALUES ('$kode_barang', '$nama_barang', '$no_registrasi', '$kode_pemilik', '$ruang_asal', '$ruang_sekarang', '$bid_ruang', '$tempat_ruang', '$tgl_pembelian', '$tgl_pembukuan', '$merk', '$type', '$kategori', '$ukuran_CC', '$no_pabrik', '$no_rangka', '$no_bpkb', '$bahan', '$no_mesin', '$no_polisi', '$kondisi_barang', '$masa_manfaat', '$harga_awal', '$harga_total', '$keterangan', '$foto_barang')";
    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        // Redirect ke halaman Data_barang.php setelah berhasil menambahkan data
        header('Location: ../../Data_barang.php');
        exit();
    } else {
        // Tampilkan pesan error jika terjadi kesalahan saat menambahkan data
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//     }
// } else {
    // Jika halaman diakses tanpa menggunakan POST, alihkan ke halaman tambah_barang.php
    header('Location: ../../tambah_barang.php');
    exit();
}
?>
