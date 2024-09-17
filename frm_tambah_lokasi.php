<?php
ob_start(); // Start output buffering
session_start();
include('koneksi/koneksi.php');
include('component/header.php'); 

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input to prevent SQL injection
    $id_lokasi = mysqli_real_escape_string($conn, $_POST['id_lokasi']);
    $nama_lokasi = mysqli_real_escape_string($conn, $_POST['nama_lokasi']);
    $bid_lokasi = mysqli_real_escape_string($conn, $_POST['bid_lokasi']);
    $tempat_lokasi = mysqli_real_escape_string($conn, $_POST['tempat_lokasi']);
    $kategori_lokasi = mysqli_real_escape_string($conn, $_POST['kategori_lokasi']);
    $desk_lokasi = mysqli_real_escape_string($conn, $_POST['desk_lokasi']);

    // Insert data into lokasi table
    $sql = "INSERT INTO lokasi (id_lokasi, nama_lokasi, bid_lokasi, tempat_lokasi, kategori_lokasi, desk_lokasi) 
            VALUES ('$id_lokasi', '$nama_lokasi', '$bid_lokasi', '$tempat_lokasi', '$kategori_lokasi', '$desk_lokasi')";

    if (mysqli_query($conn, $sql)) {
        // Set session success flag and redirect to lokasi.php
        $_SESSION['success'] = true;
        header('Location: lokasi.php');
        exit();
    } else {
        // Check for duplicate entry error
        if (mysqli_errno($conn) == 1062) { // 1062 is the MySQL error code for duplicate entry
            $_SESSION['error'] = 'Duplikat Kode Lokasi. Data sudah ada.';
            header('Location: frm_tambah_lokasi.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Tambah Lokasi</h1>
  </div><!-- End Page Title -->

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Form</h5>

      <!-- Form for adding new location -->
      <form method="POST" action="">

        <div class="mb-3">
          <label for="id_lokasi" class="form-label">Kode Lokasi</label>
          <input type="text" name="id_lokasi" class="form-control" id="id_lokasi" required>
        </div>

        <div class="mb-3">
          <label for="nama_lokasi" class="form-label">Nama Lokasi</label>
          <input type="text" name="nama_lokasi" class="form-control" id="nama_lokasi" required>
        </div>

        <div class="mb-3">
          <label for="bid_lokasi" class="form-label">Bidang Lokasi</label>
          <input type="text" name="bid_lokasi" class="form-control" id="bid_lokasi" required>
        </div>

        <div class="mb-3">
          <label for="tempat_lokasi" class="form-label">Tempat Asal</label>
          <input type="text" name="tempat_lokasi" class="form-control" id="tempat_lokasi" required>
        </div>

        <div class="mb-3">
          <label for="kategori_lokasi" class="form-label">Kategori</label>
          <select name="kategori_lokasi" class="form-select" aria-label="Default select example" id="kategori_lokasi" required>
            <option value="" disabled selected>Pilih Kategori</option>
            <option value="ruangan">Ruangan</option>
            <option value="fasilitas_umum">Fasilitas Umum</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="desk_lokasi" class="form-label">Deskripsi Lokasi</label>
          <textarea name="desk_lokasi" class="form-control" id="desk_lokasi" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="lokasi.php" class="btn btn-secondary">Batal</a>

      </form><!-- End form -->

    </div>
  </div>

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>

<?php
// Display error popup if session error is set
if (isset($_SESSION['error'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>"; // SweetAlert2 library
    echo "<script>
        Swal.fire({
            title: 'Error!',
            text: '" . $_SESSION['error'] . "',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>";
    // Reset session error after showing popup
    unset($_SESSION['error']);
}
?>
