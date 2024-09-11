<?php include("component/header.php"); ?>
<?php include("koneksi/koneksi.php"); // Include DB connection ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Pemeliharaan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Pemeliharaan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Search Bar and Add Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword" class="form-control me-2">
      <button type="submit" title="Search" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
    </form>
    <a href="tambah_pemeliharaan.php" class="btn btn-primary">
      <i class="bi bi-plus"></i> Tambah Data
    </a>
  </div><!-- End Search Bar and Add Button -->

  <!-- Data Table -->
  <table class="table table-bordered">
    <thead class="table-secondary text-center">
      <tr>
        <th scope="col">Kode Barang</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Deskripsi Pemeliharaan / Kerusakan</th>
        <th scope="col">Perbaikan</th>
        <th scope="col">Tanggal Perbaikan</th>
        <th scope="col">Lama Perbaikan</th>
        <th scope="col">Biaya Perbaikan</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Handle search query if provided
      $searchQuery = isset($_POST['query']) ? mysqli_real_escape_string($conn, $_POST['query']) : '';

      // Fetch data from database with join
      $sql = "SELECT dp.*, db.nama_barang, db.harga_awal, (db.harga_awal + dp.biaya_perbaikan) AS harga_total 
              FROM data_pemeliharaan dp
              JOIN data_barang db ON dp.kode_barang = db.kode_barang
              WHERE db.nama_barang LIKE '%$searchQuery%' OR dp.kode_barang LIKE '%$searchQuery%'";

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr class='text-center'>
                      <td>{$row['kode_barang']}</td>
                      <td>{$row['nama_barang']}</td>
                      <td>{$row['desk_pemeliharaan']}</td>
                      <td>{$row['perbaikan']}</td>
                      <td>{$row['tgl_perbaikan']}</td>
                      <td>{$row['lama_perbaikan']}</td>
                      <td>Rp " . number_format($row['biaya_perbaikan'], 2, ',', '.') . "</td>
                      <td>
                        <a href='edit_pemeliharaan.php?kode_barang={$row['kode_barang']}' class='btn btn-warning btn-sm' data-bs-toggle='tooltip' title='Edit'>
                          <i class='bi bi-pencil'></i>
                        </a>
                        <a href='delete_pemeliharaan.php?kode_barang={$row['kode_barang']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus Riwayat pemeliharaan ini?\")' data-bs-toggle='tooltip' title='Hapus'>
                          <i class='bi bi-trash'></i>
                        </a>
                      </td>
                    </tr>";
              
              // Update harga_total in data_barang table
              $updateHargaTotalSql = "UPDATE data_barang 
                                      SET harga_total = (harga_awal + {$row['biaya_perbaikan']}) 
                                      WHERE kode_barang = '{$row['kode_barang']}'";
              mysqli_query($conn, $updateHargaTotalSql);
          }
      } else {
          echo "<tr><td colspan='9' class='text-center'>No data available</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <?php
  // Count total rows for pagination logic
  $countQuery = "SELECT COUNT(*) AS total FROM data_pemeliharaan";
  $countResult = mysqli_query($conn, $countQuery);
  $countRow = mysqli_fetch_assoc($countResult);
  $totalRows = $countRow['total'];

  if ($totalRows > 10) { // Only show pagination if more than 10 rows
  ?>
    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
      <ul class="pagination">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Sebelumnya</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Selanjutnya</a>
        </li>
      </ul>
    </nav><!-- End Pagination -->
  <?php } ?>

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>
