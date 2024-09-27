<?php
session_start();
include 'koneksi/koneksi.php'; // Koneksi ke database

// Pagination settings
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit; // Starting record

// Handle search query
$search_query = "";
$search_param = "";
if (isset($_POST['query']) && !empty($_POST['query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['query']);
    $search_query = "AND (b.nama_barang LIKE ? OR b.kode_barang LIKE ?)";
    $search_param = "%$search%";
}

// Mendapatkan id_lokasi dan nama_lokasi dari parameter URL
$id_lokasi = isset($_GET['id_lokasi']) ? $_GET['id_lokasi'] : 0;
$nama_ruang = isset($_GET['nama_lokasi']) ? $_GET['nama_lokasi'] : '';
$tanggal_mulai = isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : '';
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '';

// Validasi input tanggal agar query berjalan dengan benar
if (!empty($tanggal_mulai) && !empty($tanggal_akhir)) {
    // Query untuk mengambil data inventaris berdasarkan ruang_sekarang dan filter tanggal
    $query = "SELECT b.kode_barang, b.nama_barang, b.kategori, b.merk, b.no_pabrik, b.ukuran_CC, 
        b.bahan, b.tgl_pembelian, b.harga_total, b.kondisi_barang 
        FROM data_barang b
        WHERE b.ruang_sekarang = ? 
        AND b.tgl_pembelian BETWEEN ? AND ? $search_query
        LIMIT ?, ?";
} else {
    // Query tanpa filter tanggal
    $query = "SELECT b.kode_barang, b.nama_barang, b.kategori, b.merk, b.no_pabrik, b.ukuran_CC, 
        b.bahan, b.tgl_pembelian, b.harga_total, b.kondisi_barang 
        FROM data_barang b
        WHERE b.ruang_sekarang = ? $search_query
        LIMIT ?, ?";
}

// Prepare and execute the query
$stmt = mysqli_prepare($conn, $query);
if ($search_param) {
    mysqli_stmt_bind_param($stmt, "ssiii", $nama_ruang, $tanggal_mulai, $tanggal_akhir, $start, $limit);
} else {
    mysqli_stmt_bind_param($stmt, "sii", $nama_ruang, $start, $limit);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Get total records for pagination
$count_sql = "SELECT COUNT(*) AS total FROM data_barang b WHERE b.ruang_sekarang = ? $search_query";
$count_stmt = mysqli_prepare($conn, $count_sql);
if ($search_param) {
    mysqli_stmt_bind_param($count_stmt, "ss", $nama_ruang, $search_param);
} else {
    mysqli_stmt_bind_param($count_stmt, "s", $nama_ruang);
}
mysqli_stmt_execute($count_stmt);
$count_result = mysqli_stmt_get_result($count_stmt);
$total_records = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_records / $limit);
?>

<?php include("component/header.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Inventaris Ruangan</h1>
    <h1><?= htmlspecialchars($nama_ruang) ?></h1>
  </div><!-- End Page Title -->

  <div class="d-flex justify-content-between mb-3">
    <div>
      Tanggal: 
      <?= !empty($tanggal_mulai) ? date('d/m/Y', strtotime($tanggal_mulai)) : date('d/m/Y') ?>
    </div>
    <div>
      Kode Ruang: <?= htmlspecialchars($id_lokasi) ?>
    </div>
  </div>

  <!-- Tombol Export -->
  <a href="proses/barang/export_inventaris.php?id_lokasi=<?= $id_lokasi ?>&nama_lokasi=<?= urlencode($nama_ruang) ?>" class="btn btn-primary mb-3">Export Data</a>

  <!-- Tabel Inventaris -->
  <table class="table table-bordered">
    <thead class="table-secondary text-center">
      <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Merk</th>
        <th>Nomor Seri</th>
        <th>Ukuran</th>
        <th>Bahan</th>
        <th>Tanggal Pembelian</th>
        <th>Harga</th>
        <th>Kondisi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr class='text-center'>
          <td><?= htmlspecialchars($row['kode_barang']) ?></td>
          <td><?= htmlspecialchars($row['nama_barang']) ?></td>
          <td><?= htmlspecialchars($row['kategori']) ?></td>
          <td><?= htmlspecialchars($row['merk']) ?></td>
          <td><?= htmlspecialchars($row['no_pabrik']) ?></td>
          <td><?= htmlspecialchars($row['ukuran_CC']) ?></td>
          <td><?= htmlspecialchars($row['bahan']) ?></td>
          <td><?= date('d/m/Y', strtotime($row['tgl_pembelian'])) ?></td>
          <td>Rp <?= number_format($row['harga_total'], 2, ',', '.') ?></td>
          <td><?= htmlspecialchars($row['kondisi_barang']) ?></td>
        </tr>
      <?php endwhile; ?>
      <?php if (mysqli_num_rows($result) == 0): ?>
        <tr><td colspan="10">Tidak ada data</td></tr>
      <?php endif; ?>
    </tbody>
  </table><!-- End Tabel Inventaris -->

  <?php if ($total_pages > 1): // Hanya tampilkan pagination jika total halaman lebih dari 1 ?>
  <!-- Pagination centered -->
  <nav aria-label="Page navigation example" class="d-flex justify-content-center">
    <ul class="pagination">
      <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
        <a class="page-link" href="?page=<?= ($page > 1) ? ($page - 1) : 1 ?>" tabindex="-1">Sebelumnya</a>
      </li>
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $i; ?><?= isset($_POST['query']) ? '&query=' . urlencode($_POST['query']) : '' ?>"><?= $i; ?></a>
        </li>
      <?php endfor; ?>
      <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
        <a class="page-link" href="?page=<?= ($page < $total_pages) ? ($page + 1) : $total_pages ?><?= isset($_POST['query']) ? '&query=' . urlencode($_POST['query']) : '' ?>">Selanjutnya</a>
      </li>
    </ul>
  </nav><!-- End Pagination -->
  <?php endif; ?>

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>
