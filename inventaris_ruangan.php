<?php
// Include koneksi database
include('koneksi/koneksi.php');

// Mendapatkan ID ruangan dari parameter URL atau filter
$ruang_id = isset($_GET['id_lokasi']) ? $_GET['id_lokasi'] : 0;
$tanggal_mulai = isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : '';
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '';

// Query untuk mengambil data inventaris berdasarkan ruang_id dan filter tanggal jika ada
$query = "SELECT b.kode_barang, b.nama_barang, b.type, b.merk, b.no_pabrik, b.ukuran_CC, 
    b.bahan, b.tgl_pembelian, b.harga_awal, b.kondisi_barang 
    FROM data_barang b
    WHERE b.ruang_sekarang = '$ruang_id'";

// echo $query;

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

// Query SQL untuk mengambil data dari tabel
$sql = "SELECT * FROM data_barang";
$result = $conn->query($sql);

// Cek apakah ada hasil
// if ($result->num_rows > 0) {
//     // Looping data hasil query
//     while ($row = $result->fetch_assoc()) {
//         echo "ID: " . $row["id"] . " - Nama: " . $row["nama"] . "<br>";
//     }
// } else {
//     echo "Tidak ada data ditemukan";
// }

// Menutup koneksi
// $conn->close();

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
     <link rel="stylesheet" type="text/css" href="../inventaris.css">
</head>
<body>

<h1>Inventaris Ruangan - Ruang ID: <?= $ruang_id ?></h1>
<style>
    /* Atur gaya dasar halaman */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f9;
}

/* Gaya untuk judul utama */
h1 {
    color: #2c3e50;
    text-align: center;
    font-size: 32px;
    margin-bottom: 20px;
    position: relative;
}

/* Gaya untuk form filter tanggal */
form {
    margin-bottom: 20px;
    text-align: center;
}

form label {
    font-weight: bold;
    margin-right: 1px;
}

form input[type="date"] {
    padding: 5px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form button {
    padding: 5px 15px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #2980b9;
}

/* Gaya untuk tabel */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    padding: 5px;
    text-align: left;
    border: 1px solid #ddd;
}

table th {
    background-color: #2c3e50;
    color: white;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #e1e1e1;
}

/* Gaya untuk tabel Kondisi Barang */
h2 {
    color: #34495e;
    text-align: center;
    margin-bottom: 10px;
}

/* Responsif */
@media screen and (max-width: 768px) {
    table, form {
        width: 100%;
    }

    form input[type="date"] {
        width: 90%;
        margin-bottom: 10px;
    }
}

</style>

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
            <th>No Registrasi</th>
            <th>Kode Pemilik</th>
            <th>Ruang Asal</th>
            <th>Ruang Sekarang</th>
            <th>Bid Ruangan</th>
            <th>Tempat Ruangan</th>
            <th>Tanggal Pembelian</th>
            <th>Tanggal Pembukuan</th>
            <th>Merk</th>
            <th>Type</th>
            <th>Kategori</th>
            <th>Ukuran CC</th>
            <th>No Pabrik</th>
            <th>No Rangka</th>
            <th>No BPKB</th>
            <th>Bahan</th>
            <th>No Mesin</th>
            <th>No Polisi</th>
            <th>Kondisi Barang</th>
            <th>Massa Manfaat</th>
            <th>Harga Awal</th>
            <th>Harga Total</th>
            <th>Keterangan</th>
            <th>Foto Barang</th>
    
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['kode_barang'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['no_registrasi'] ?></td>
            <td><?= $row['kode_pemilik'] ?></td>
            <td><?= $row['ruang_asal'] ?></td>
            <td><?= $row['ruang_sekarang'] ?></td>
            <td><?= $row['bid_ruang'] ?></td>
            <td><?= $row['tempat_ruang'] ?></td>
            <td><?= $row['tgl_pembelian'] ?></td>
            <td><?= $row['tgl_pembukuan'] ?></td>
            <td><?= $row['merk'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['kategori'] ?></td>
            <td><?= $row['ukuran_CC'] ?></td>
            <td><?= $row['no_pabrik'] ?></td>
            <td><?= $row['no_rangka'] ?></td>
            <td><?= $row['no_bpkb'] ?></td>
            <td><?= $row['bahan'] ?></td>
            <td><?= $row['no_mesin'] ?></td>
            <td><?= $row['no_polisi'] ?></td>
            <td><?= $row['kondisi_barang'] ?></td>
            <td><?= $row['masa_manfaat'] ?></td>
            <td><?= $row['harga_awal'] ?></td>
            <td><?= $row['harga_total'] ?></td>
            <td><?= $row['keterangan'] ?></td>
            <td><?= $row['foto_barang'] ?></td>

        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Tabel Kondisi Barang -->
<!-- <h2>Kondisi Barang</h2>
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
</table> -->

<!-- Tombol Cetak -->
<a href="cetak_kir.php?ruang_id=<?= $ruang_id ?>">Cetak KIR</a>
<a href="cetak_barcode.php?ruang_id=<?= $ruang_id ?>">Cetak Barcode</a>

</body>
</html>
