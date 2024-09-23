<?php
session_start();
include('koneksi/koneksi.php'); // Include DB connection

// Pagination settings
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit; // Starting record

// Handle search query
$search_query = "";
if (isset($_POST['query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['query']);
    $search_query = "WHERE nama_barang LIKE '%$search%'";
}

// Fetch data from the `data_barang` table with limit and offset
$sql = "SELECT no_registrasi, tgl_pembelian, kode_barang, harga_total, nama_barang 
        FROM data_barang 
        $search_query 
        LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

// Get the total number of records
$count_sql = "SELECT COUNT(*) AS total FROM data_barang $search_query";
$count_result = mysqli_query($conn, $count_sql);
$total_records = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_records / $limit);
?>

<?php include("component/header.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Daftar Barang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Data Barang</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Search Bar and Add Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword" class="form-control me-2">
      <button type="submit" title="Search" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
    </form>
    <a href="frm_tambah_barang.php" class="btn btn-primary">
      <i class="bi bi-plus"></i> Tambah Data
    </a>
  </div><!-- End Search Bar and Add Button -->

  <!-- Data Table -->
<table class="table table-bordered">
  <thead class="table-secondary text-center">
    <tr>
      <th scope="col">No. Reg</th>
      <th scope="col">Tanggal Perolehan</th>
      <th scope="col">Kode Barang</th>
      <th scope="col">Harga</th>
      <th scope="col">Uraian Aset</th> <!-- Uraian Aset is the Nama Barang -->
      <th scope="col">Detail</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='text-center'>
                    <td>{$row['no_registrasi']}</td>
                    <td>" . date('d/m/Y', strtotime($row['tgl_pembelian'])) . "</td>
                    <td>{$row['kode_barang']}</td>
                    <td>Rp " . number_format($row['harga_total'], 2, ',', '.') . "</td>
                    <td>{$row['nama_barang']}</td>
                    <td><a href='detail_barang.php?no_registrasi={$row['no_registrasi']}' class='text-primary'>Detail</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No data found.</td></tr>";
    }
    ?>
  </tbody>
</table><!-- End Data Table -->

  <!-- Pagination centered -->
  <nav aria-label="Page navigation example" class="d-flex justify-content-center">
    <ul class="pagination">
      <!-- Previous page link -->
      <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($page > 1){ echo "?page=".($page - 1); } ?>" tabindex="-1" aria-disabled="true">Sebelumnya</a>
      </li>

      <!-- Page numbers -->
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
          <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
        </li>
      <?php endfor; ?>

      <!-- Next page link -->
      <li class="page-item <?php if($page >= $total_pages){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($page < $total_pages){ echo "?page=".($page + 1); } ?>">Selanjutnya</a>
      </li>
    </ul>
  </nav><!-- End Pagination -->

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>
