<?php
include("component/header.php");
include("koneksi/koneksi.php"); // Include the database connection

// Check if the kode_barang is set
if (isset($_GET['id'])) {
    $kode_barang = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch the data for the selected item
    $query = "SELECT db.kode_barang, db.nama_barang, db.ruang_sekarang AS lokasi, br.desk_kerusakan, br.tgl_kerusakan
              FROM data_barang db
              JOIN barang_rusak br ON db.kode_barang = br.kode_barang
              WHERE db.kode_barang = '$kode_barang'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "Permintaan tidak valid.";
    exit;
}

// Handle form submission for updating the data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $desk_kerusakan = mysqli_real_escape_string($conn, $_POST['desk_kerusakan']);
    $tgl_kerusakan = mysqli_real_escape_string($conn, $_POST['tgl_kerusakan']);

    // Update the data in the database
    $updateQuery1 = "UPDATE data_barang 
                     SET nama_barang = '$nama_barang', 
                         ruang_sekarang = '$lokasi' 
                     WHERE kode_barang = '$kode_barang'";

    $updateQuery2 = "UPDATE barang_rusak 
                     SET desk_kerusakan = '$desk_kerusakan', 
                         tgl_kerusakan = '$tgl_kerusakan' 
                     WHERE kode_barang = '$kode_barang'";

    // Debugging - print the query for review
    // Uncomment this for debugging purposes
    // echo $updateQuery1; 
    // echo $updateQuery2; 

    // Execute the queries and handle errors
    $error = false;
    mysqli_begin_transaction($conn); // Begin transaction
    try {
        if (!mysqli_query($conn, $updateQuery1)) {
            $error = true;
            throw new Exception("Error updating data_barang: " . mysqli_error($conn));
        }
        if (!mysqli_query($conn, $updateQuery2)) {
            $error = true;
            throw new Exception("Error updating barang_rusak: " . mysqli_error($conn));
        }
        mysqli_commit($conn); // Commit transaction
        echo "<script>alert('Data berhasil diperbarui'); window.location.href='Data_barang_rusak.php';</script>";
    } catch (Exception $e) {
        mysqli_rollback($conn); // Rollback transaction if any error occurs
        echo $e->getMessage();
    }

    mysqli_close($conn);
}
?>

<!-- HTML Form to Edit Data -->
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Data Barang Rusak</h1>
  </div><!-- End Page Title -->

  <form method="POST" action="">
    <div class="mb-3">
      <label for="kode_barang" class="form-label">Kode Barang</label>
      <input type="text" class="form-control" id="kode_barang" value="<?= $row['kode_barang']; ?>" disabled>
    </div>
    <div class="mb-3">
      <label for="nama_barang" class="form-label">Nama Barang</label>
      <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $row['nama_barang']; ?>" required>
    </div>
    <div class="mb-3">
      <label for="lokasi" class="form-label">Lokasi</label>
      <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $row['lokasi']; ?>" required>
    </div>
    <div class="mb-3">
      <label for="desk_kerusakan" class="form-label">Deskripsi Kerusakan</label>
      <input type="text" class="form-control" id="desk_kerusakan" name="desk_kerusakan" value="<?= $row['desk_kerusakan']; ?>" required>
    </div>
    <div class="mb-3">
      <label for="tgl_kerusakan" class="form-label">Tanggal Kerusakan</label>
      <input type="date" class="form-control" id="tgl_kerusakan" name="tgl_kerusakan" value="<?= $row['tgl_kerusakan']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="Data_barang_rusak.php" class="btn btn-secondary">Cancel</a>
  </form>
</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>