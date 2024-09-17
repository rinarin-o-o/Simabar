<?php include("component/header.php"); ?>
<?php include("koneksi/koneksi.php"); // Include the database connection ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Olah Barcode Barang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Barcode Barang</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Search Bar, Sort By Dropdown, and Add Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword" class="form-control me-2">
      <button type="submit" title="Search" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
    </form>
    
    <div class="d-flex align-items-center">
      <!-- Sort By Dropdown -->
      <form class="me-3" method="GET" action="">
        <select name="sort" title="Tampilkan Berdasarkan" class="form-select" onchange="this.form.submit()">
          <option value="kode_barang" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'kode_barang' ? 'selected' : ''; ?>>Kode Barang</option>
          <option value="nama_barang" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'nama_barang' ? 'selected' : ''; ?>>Nama Barang</option>
          <option value="ruang_sekarang" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'ruang_sekarang' ? 'selected' : ''; ?>>Ruang</option>
        </select>
      </form>
    </div>
  </div><!-- End Search Bar;, Sort By Dropdown -->

  <!-- Data Table -->
  <table class="table table-bordered">
    <thead class="table-secondary text-center">
      <tr>
        <th scope="col">Kode Barang</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Ruang</th>
        <th scope="col">Barcode</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require 'vendor/autoload.php';
      use Picqer\Barcode\BarcodeGeneratorPNG;

      // Retrieve sort option
      $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

      // Sample data (Replace this with data from your database)
      $query = "SELECT kode_barang, nama_barang, ruang_sekarang FROM data_barang WHERE kondisi_barang = 'Rusak'"; // Adjust query as needed
      $result = mysqli_query($conn, $query);

      if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              $kode_barang = $row['kode_barang'];
              $nama_barang = $row['nama_barang'];
              $ruang = $row['ruang_sekarang'];

              // Generate barcode
              $generator = new BarcodeGeneratorPNG();
              $barcode = $generator->getBarcode($kode_barang, $generator::TYPE_CODE_128);
              $barcodeFilePath = "Barcodes/{$kode_barang}.png";
              
              // Ensure Barcodes directory exists
              if (!is_dir('Barcodes')) {
                  mkdir('Barcodes', 0777, true);
              }

              file_put_contents($barcodeFilePath, $barcode);

              echo "<tr class='text-center'>
                      <td>{$kode_barang}</td>
                      <td>{$nama_barang}</td>
                      <td>{$ruang}</td>
                      <td><img src='{$barcodeFilePath}' alt='Barcode' /></td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
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
