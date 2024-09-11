<?php
session_start();
include('koneksi/koneksi.php'); // Include DB connection

// Get the location ID from the URL parameter
$location_id = isset($_GET['id_lokasi']) ? intval($_GET['id_lokasi']) : 0;

if ($location_id > 0) {
    // Prepare a statement to fetch inventory data based on the room (location)
    $stmt = $conn->prepare("SELECT db.jenis_barang, db.merk, db.no_seri_pabrik, db.ukuran, db.bahan, 
                                   db.tahun_pembelian, db.no_kode_barang, db.jumlah_barang, db.harga_beli, 
                                   db.barang_baik, db.barang_kurang_baik, db.barang_rusak_berat 
                            FROM data_barang db 
                            WHERE db.id_lokasi = ?");
    $stmt->bind_param("i", $location_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "Invalid room.";
    exit;
}
?>

<?php include("component/header.php"); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Inventaris Ruangan</h1>
  </div><!-- End Page Title -->

  <!-- Display Room Name Dynamically -->
  <?php 
  // Prepare a statement to fetch room name
  $roomStmt = $conn->prepare("SELECT nama_lokasi FROM lokasi WHERE id_lokasi = ?");
  $roomStmt->bind_param("i", $location_id);
  $roomStmt->execute();
  $roomResult = $roomStmt->get_result();
  $roomName = $roomResult->fetch_assoc()['nama_lokasi'];
  ?>
  <h2><center><?php echo htmlspecialchars($roomName); ?></center></h2>

  <!-- Data Table -->
  <table class="table table-striped table-bordered table-hover">
    <thead class="table-secondary text-center align-middle">
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Jenis Barang / Nama Barang</th>
        <th rowspan="2">Merk / Model</th>
        <th rowspan="2">No. Seri Pabrik</th>
        <th rowspan="2">Ukuran</th>
        <th rowspan="2">Bahan</th>
        <th rowspan="2">Tahun Pembuatan/ Pembelian</th>
        <th rowspan="2">No. Kode Barang</th>
        <th rowspan="2">Jumlah Barang</th>
        <th rowspan="2">Harga Beli / Perolehan</th>
        <th colspan="3">Keadaan Barang</th>
      </tr>
      <tr>
        <th>Barang Baik</th>
        <th>Barang Kurang Baik</th>
        <th>Barang Rusak Berat</th>
      </tr>
    </thead>
    <tbody class="text-center align-middle">
      <?php
      if ($result->num_rows > 0) {
          $no = 1;
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <th scope='row'>{$no}</th>
                      <td>{$row['jenis_barang']}</td>
                      <td>{$row['merk']}</td>
                      <td>{$row['no_seri_pabrik']}</td>
                      <td>{$row['ukuran']}</td>
                      <td>{$row['bahan']}</td>
                      <td>{$row['tahun_pembelian']}</td>
                      <td>{$row['no_kode_barang']}</td>
                      <td>{$row['jumlah_barang']}</td>
                      <td>Rp " . number_format($row['harga_beli'], 2, ',', '.') . "</td>
                      <td>{$row['barang_baik']}</td>
                      <td>{$row['barang_kurang_baik']}</td>
                      <td>{$row['barang_rusak_berat']}</td>
                    </tr>";
              $no++;
          }
      } else {
          echo "<tr><td colspan='13'>No data found for this room.</td></tr>";
      }
      ?>
    </tbody>
  </table><!-- End Data Table -->

  <!-- Buttons for Print -->
  <div class="d-flex justify-content-start mb-4">
    <button type="button" class="btn btn-info me-2">
      <i class="bi bi-printer"></i> Cetak KIR
    </button>
    <button type="button" class="btn btn-info">
      <i class="bi bi-barcode"></i> Cetak Barcode KIR
    </button>
  </div><!-- End Buttons for Print -->

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>
