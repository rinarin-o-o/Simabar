<?php 
include("component/header.php"); 
include("koneksi/koneksi.php"); // Include the database connection 

// Handle form submission for adding new damage data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_barang = mysqli_real_escape_string($conn, $_POST['kode_barang']);
    $desk_kerusakan = mysqli_real_escape_string($conn, $_POST['desk_kerusakan']);
    $tgl_kerusakan = date('Y-m-d'); // Get today's date

    // Insert into barang_rusak
    $insertQuery = "INSERT INTO barang_rusak (kode_barang, desk_kerusakan, tgl_kerusakan) 
                    VALUES ('$kode_barang', '$desk_kerusakan', '$tgl_kerusakan')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location.href='Data_barang_rusak.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Tambah Data Barang Rusak</h1>
  </div><!-- End Page Title -->

  <form method="POST" action="">
    <div class="mb-3">
      <label for="kode_barang" class="form-label">Pilih Barang</label>
      <select class="form-select" id="kode_barang" name="kode_barang" required>
        <option value="">-- Pilih Barang --</option>
        <?php
        // Fetch existing items from data_barang
        $barangQuery = "SELECT kode_barang, nama_barang FROM data_barang WHERE kondisi_barang != 'Rusak'";
        $barangResult = mysqli_query($conn, $barangQuery);

        while ($row = mysqli_fetch_assoc($barangResult)) {
            echo "<option value='{$row['kode_barang']}'>{$row['nama_barang']}</option>";
        }
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="desk_kerusakan" class="form-label">Deskripsi Kerusakan</label>
      <input type="text" class="form-control" id="desk_kerusakan" name="desk_kerusakan" required>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Data</button>
    <a href="Data_barang_rusak.php" class="btn btn-secondary">Batal</a>
  </form>
</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>
