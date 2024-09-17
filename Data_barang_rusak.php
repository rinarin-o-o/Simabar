<?php include("component/header.php"); ?>
<?php include("koneksi/koneksi.php"); // Include the database connection ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Barang Rusak</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Barang Rusak</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Search Bar and Add Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword" class="form-control me-2">
      <button type="submit" title="Search" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
    </form>
    <button type="button" class="btn btn-primary">
      <i class="bi bi-plus"></i> Tambah Data
    </button>
  </div><!-- End Search Bar and Add Button -->

  <!-- Data Table -->
  <table class="table table-bordered">
    <thead class="table-secondary text-center">
      <tr>
        <th scope="col">Kode Barang</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Lokasi</th>
        <th scope="col">Deskripsi Kerusakan</th>
        <th scope="col">Tanggal Kerusakan</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Handle search query if provided
      $searchQuery = isset($_POST['query']) ? mysqli_real_escape_string($conn, $_POST['query']) : '';

      // Pagination setup
      $itemsPerPage = 10;
      $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $offset = ($currentPage - 1) * $itemsPerPage;

      // Get total number of rows
      $countQuery = "SELECT COUNT(*) AS total FROM data_barang db
                     JOIN barang_rusak br ON db.kode_barang = br.kode_barang
                     WHERE db.kondisi_barang = 'Rusak' AND (db.nama_barang LIKE '%$searchQuery%' OR db.kode_barang LIKE '%$searchQuery%')";
      $countResult = mysqli_query($conn, $countQuery);
      $totalRows = mysqli_fetch_assoc($countResult)['total'];
      $totalPages = ceil($totalRows / $itemsPerPage);

      // Fetch data from database with pagination
      $query = "SELECT db.kode_barang, db.nama_barang, db.ruang_sekarang AS lokasi, br.desk_kerusakan, br.tgl_kerusakan
                FROM data_barang db
                JOIN barang_rusak br ON db.kode_barang = br.kode_barang
                WHERE db.kondisi_barang = 'Rusak' AND (db.nama_barang LIKE '%$searchQuery%' OR db.kode_barang LIKE '%$searchQuery%')
                LIMIT $offset, $itemsPerPage";

      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr class='text-center'>
                      <td>{$row['kode_barang']}</td>
                      <td>{$row['nama_barang']}</td>
                      <td>{$row['lokasi']}</td>
                      <td>{$row['desk_kerusakan']}</td>
                      <td>{$row['tgl_kerusakan']}</td>
                      <td>
                        <!-- Edit Button -->
                        <a href='edit_rusak.php?id={$row['kode_barang']}' class='btn btn-warning btn-sm'>
                          <i class='bi bi-pencil'></i> Edit
                        </a>
                        <!-- Delete Button -->
                        <a href='delete_rusak.php?id={$row['kode_barang']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">
                          <i class='bi bi-trash'></i> Hapus
                        </a>
                      </td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='6' class='text-center'>No data available</td></tr>";
      }

      mysqli_close($conn);
      ?>
    </tbody>
  </table>

  <!-- Pagination centered -->
  <?php if ($totalPages > 1): ?>
    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
      <ul class="pagination">
        <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= max(1, $currentPage - 1) ?>" tabindex="-1" aria-disabled="true">Sebelumnya</a>
        </li>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= min($totalPages, $currentPage + 1) ?>">Selanjutnya</a>
        </li>
      </ul>
    </nav><!-- End Pagination -->
  <?php endif; ?>

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>
