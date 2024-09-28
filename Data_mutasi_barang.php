<?php include("component/header.php"); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Mutasi Barang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Mutasi Barang</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Search Bar and Add Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword" class="form-control me-2">
      <button type="submit" title="Search" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
    </form>
    <a href="frm_tambah_mutasi.php" class="btn btn-primary">
      <i class="bi bi-plus"></i> Tambah Data
    </a>
  </div><!-- End Search Bar and Add Button -->

  <!-- Sorting Options -->
  <div class="mb-3">
    <form method="GET" action="#">
      <label for="sort-by" class="form-label">Urutkan Berdasarkan:</label>
      <select name="sort_by" id="sort-by" class="form-select" onchange="this.form.submit()">
        <option value="id" <?php echo (isset($_GET['sort_by']) && $_GET['sort_by'] == 'id') ? 'selected' : ''; ?>>ID</option>
        <option value="kode_barang" <?php echo (isset($_GET['sort_by']) && $_GET['sort_by'] == 'kode_barang') ? 'selected' : ''; ?>>Kode Barang</option>
        <option value="tgl_mutasi" <?php echo (isset($_GET['sort_by']) && $_GET['sort_by'] == 'tgl_mutasi') ? 'selected' : ''; ?>>Tanggal Mutasi</option>
        <option value="jenis_mutasi" <?php echo (isset($_GET['sort_by']) && $_GET['sort_by'] == 'jenis_mutasi') ? 'selected' : ''; ?>>Jenis Mutasi</option>
      </select>
    </form>
  </div><!-- End Sorting Options -->

  <!-- Data Table -->
  <table class="table table-bordered">
    <thead class="table-secondary text-center">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Kode Barang</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Lokasi Asal</th>
        <th scope="col">Lokasi Sekarang</th>
        <th scope="col">Jenis Mutasi</th>
        <th scope="col">Tanggal Mutasi</th>
        <th scope="col">Penanggung Jawab</th>
        <th scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Database connection
      $conn = mysqli_connect("localhost", "root", "", "db_simabar");

      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }

      // Default sorting
      $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
      
      // Validating sort_by parameter
      $valid_sort_columns = ['id', 'kode_barang', 'tgl_mutasi', 'jenis_mutasi'];
      if (!in_array($sort_by, $valid_sort_columns)) {
          $sort_by = 'id';
      }

      // Fetch data from database with sorting
      $query = "SELECT * FROM mutasi_barang ORDER BY ''";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr class='text-center'>
                      <td>{$row['id']}</td>
                      <td>{$row['kode_barang']}</td>
                      <td>{$row['nama_barang']}</td>
                      <td>{$row['ruang_asal']}</td>
                      <td>{$row['ruang_sekarang']}</td>
                      <td>{$row['jenis_mutasi']}</td>
                      <td>{$row['tgl_mutasi']}</td>
                      <td>{$row['PIC']}</td>
                      <td>{$row['keterangan']}</td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='9' class='text-center'>No data available</td></tr>";
      }

      mysqli_close($conn);
      ?>
    </tbody>
  </table>

  <!-- Pagination centered -->
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

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>
