<?php
// Mulai session dan koneksi ke database
session_start();
include('../../koneksi/koneksi.php');

// Atur header untuk mendownload file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_barang.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Query untuk mengambil semua kolom dari tabel data_barang
$sql = "SELECT kode_barang, nama_barang, no_regristrasi, kode_pemilik, ruang_asal, ruang_sekarang, bid_ruang, tempat_ruang, 
        tgl_pembelian, tgl_pembukuan, merk, type, kategori, ukuran_CC, no_pabrik, no_rangka, no_bpkb, bahan, no_mesin, 
        no_polisi, kondisi_barang, masa_manfaat, harga_awal, harga_total, keterangan, foto_barang 
        FROM data_barang";
$result = mysqli_query($conn, $sql);

// Tampilkan judul kolom di file Excel
echo "Kode Barang\tNama Barang\tNo. Registrasi\tKode Pemilik\tRuang Asal\tRuang Sekarang\tBidang Ruang\tTempat Ruang\t";
echo "Tanggal Pembelian\tTanggal Pembukuan\tMerk\tType\tKategori\tUkuran CC\tNo. Pabrik\tNo. Rangka\tNo. BPKB\t";
echo "Bahan\tNo. Mesin\tNo. Polisi\tKondisi Barang\tMasa Manfaat\tHarga Awal\tHarga Total\tKeterangan\tFoto Barang\n";

// Loop melalui hasil query dan tampilkan data dalam format Excel
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['kode_barang'] . "\t" .
         $row['nama_barang'] . "\t" .
         $row['no_regristrasi'] . "\t" .
         $row['kode_pemilik'] . "\t" .
         $row['ruang_asal'] . "\t" .
         $row['ruang_sekarang'] . "\t" .
         $row['bid_ruang'] . "\t" .
         $row['tempat_ruang'] . "\t" .
         date('d/m/Y', strtotime($row['tgl_pembelian'])) . "\t" .
         date('d/m/Y', strtotime($row['tgl_pembukuan'])) . "\t" .
         $row['merk'] . "\t" .
         $row['type'] . "\t" .
         $row['kategori'] . "\t" .
         $row['ukuran_CC'] . "\t" .
         $row['no_pabrik'] . "\t" .
         $row['no_rangka'] . "\t" .
         $row['no_bpkb'] . "\t" .
         $row['bahan'] . "\t" .
         $row['no_mesin'] . "\t" .
         $row['no_polisi'] . "\t" .
         $row['kondisi_barang'] . "\t" .
         $row['masa_manfaat'] . "\t" .
         "Rp " . number_format($row['harga_awal'], 2, ',', '.') . "\t" .
         "Rp " . number_format($row['harga_total'], 2, ',', '.') . "\t" .
         $row['keterangan'] . "\t" .
         $row['foto_barang'] . "\n";
}
?>
