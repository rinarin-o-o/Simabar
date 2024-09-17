<?php
include 'koneksi.php'; // Koneksi ke database

// Mendapatkan ID ruangan dari parameter URL atau filter
$ruang_id = isset($_GET['ruang_id']) ? $_GET['ruang_id'] : 0;
$tanggal_mulai = isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : '';
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '';

// Query untuk mengambil data inventaris berdasarkan ruang_id dan filter tanggal jika ada
$query = "SELECT b.kode_barang, b.nama_barang, b.tipe_barang, b.merk_barang, b.nomor_seri, b.ukuran_barang, 
    b.bahan_barang, b.tahun_pembelian, b.jumlah_barang, b.harga_barang, b.kondisi_barang 
    FROM data_barang b
    WHERE b.ruang_sekarang = '$ruang_id'";

if ($tanggal_mulai && $tanggal_akhir) {
    $query .= " AND b.tanggal_pembelian BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'";
}

$result = mysqli_query($conn, $query);

// Menghitung jumlah barang berdasarkan kondisi
$query_kondisi = "SELECT 
    SUM(CASE WHEN kondisi_barang = 'Baik' THEN 1 ELSE 0 END) AS baik,
    SUM(CASE WHEN kondisi_barang = 'Rusak Sedang' THEN 1 ELSE 0 END) AS rusak_sedang,
    SUM(CASE WHEN kondisi_barang = 'Rusak Berat' THEN 1 ELSE 0 END) AS rusak_berat
    FROM data_barang
    WHERE ruang_sekarang = '$ruang_id'";

if ($tanggal_mulai && $tanggal_akhir) {
    $query_kondisi .= " AND tanggal_pembelian BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'";
}

$result_kondisi = mysqli_query($conn, $query_kondisi);
$kondisi = mysqli_fetch_assoc($result_kondisi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Ruangan</title>
    <!-- Tambahkan CSS sesuai dengan keinginan Anda -->
</head>
<body>

<h1>Inventaris Ruangan - Ruang ID: <?= $ruang_id ?></h1>

<!-- Form Filter Tanggal -->
<form method="GET" action="inventaris_ruangan.php">
    <input type="hidden" name="ruang_id" value="<?= $ruang_id ?>">
    <label for="tanggal_mulai">Tanggal Mulai:</label>
    <input type="date" name="tanggal_mulai" value="<?= $tanggal_mulai ?>">
    <label for="tanggal_akhir">Tanggal Akhir:</label>
    <input type="date" name="tanggal_akhir" value="<?= $tanggal_akhir ?>">
    <button type="submit">Filter</button>
</form>

<!-- Tabel Inventaris -->
<table border="1">
    <thead>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Tipe Barang</th>
            <th>Merk</th>
            <th>Nomor Seri</th>
            <th>Ukuran</th>
            <th>Bahan</th>
            <th>Tahun Pembelian</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Kondisi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['kode_barang'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['tipe_barang'] ?></td>
            <td><?= $row['merk_barang'] ?></td>
            <td><?= $row['nomor_seri'] ?></td>
            <td><?= $row['ukuran_barang'] ?></td>
            <td><?= $row['bahan_barang'] ?></td>
            <td><?= $row['tahun_pembelian'] ?></td>
            <td><?= $row['jumlah_barang'] ?></td>
            <td><?= $row['harga_barang'] ?></td>
            <td><?= $row['kondisi_barang'] ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Tabel Kondisi Barang -->
<h2>Kondisi Barang</h2>
<table border="1">
    <tr>
        <th>Baik</th>
        <th>Rusak Sedang</th>
        <th>Rusak Berat</th>
    </tr>
    <tr>
        <td><?= $kondisi['baik'] ?></td>
        <td><?= $kondisi['rusak_sedang'] ?></td>
        <td><?= $kondisi['rusak_berat'] ?></td>
    </tr>
</table>

<!-- Tombol Cetak -->
<a href="cetak_kir.php?ruang_id=<?= $ruang_id ?>">Cetak KIR</a>
<a href="cetak_barcode.php?ruang_id=<?= $ruang_id ?>">Cetak Barcode</a>

</body>
</html>
