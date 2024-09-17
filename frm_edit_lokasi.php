<?php
session_start();
include('koneksi/koneksi.php'); // Include DB connection

// Check if the 'id_lokasi' is passed in the URL
if (!isset($_GET['id_lokasi'])) {
    // Redirect to the location list page if id_lokasi is not set
    header('Location: lokasi.php');
    exit;
}

$id_lokasi = $_GET['id_lokasi'];

// Fetch existing location data
$sql = "SELECT * FROM lokasi WHERE id_lokasi = '$id_lokasi'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
} else {
    // Redirect to the location list page if no data found
    header('Location: lokasi.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lokasi = mysqli_real_escape_string($conn, $_POST['nama_lokasi']);
    $bid_lokasi = mysqli_real_escape_string($conn, $_POST['bid_lokasi']);
    $tempat_lokasi = mysqli_real_escape_string($conn, $_POST['tempat_lokasi']);
    $kategori_lokasi = mysqli_real_escape_string($conn, $_POST['kategori_lokasi']);
    $desk_lokasi = mysqli_real_escape_string($conn, $_POST['desk_lokasi']);

    // Update query
    $sql_update = "UPDATE lokasi 
                   SET nama_lokasi='$nama_lokasi', bid_lokasi='$bid_lokasi', tempat_lokasi='$tempat_lokasi', desk_lokasi='$desk_lokasi'
                   WHERE id_lokasi='$id_lokasi'";

    if (mysqli_query($conn, $sql_update)) {
        $_SESSION['success'] = true;
        // Redirect to lokasi.php after update
        header('Location: lokasi.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php include("component/header.php"); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Lokasi</h1>
    </div><!-- End Page Title -->

    <!-- Edit Location Form -->
    <form action="" method="POST">
        <div class="row mb-3">
            <label for="id_lokasi" class="col-sm-2 col-form-label">Kode Lokasi</label>
            <div class="col-sm-10">
                <input type="text" name="id_lokasi" class="form-control" value="<?php echo $row['id_lokasi']; ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="nama_lokasi" class="col-sm-2 col-form-label">Nama Lokasi</label>
            <div class="col-sm-10">
                <input type="text" name="nama_lokasi" class="form-control" value="<?php echo htmlspecialchars($row['nama_lokasi']); ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="bid_lokasi" class="col-sm-2 col-form-label">Bidang</label>
            <div class="col-sm-10">
                <input type="text" name="bid_lokasi" class="form-control" value="<?php echo htmlspecialchars($row['bid_lokasi']); ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="tempat_lokasi" class="col-sm-2 col-form-label">Tempat Asal</label>
            <div class="col-sm-10">
                <input type="text" name="tempat_lokasi" class="form-control" value="<?php echo htmlspecialchars($row['tempat_lokasi']); ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="kategori_lokasi" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
                <input type="text" name="kategori_lokasi" class="form-control" value="<?php echo htmlspecialchars($row['kategori_lokasi']); ?>" required>
            </div>
        </div>

        <div class=" row mb-3">
          <label for="kategori_lokasi" class="form-label">Kategori</label>
          <div class="col-sm-10">
            <select name="kategori_lokasi" class="form-select" aria-label="Default select example" id="kategori_lokasi" required>
                <option value="" disabled selected>Pilih Kategori</option>
                <option value="ruangan">Ruangan</option>
                <option value="fasilitas_umum">Fasilitas Umum</option>
            </select>
        </div>

        <div class="row mb-3">
            <label for="desk_lokasi" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
                <textarea name="desk_lokasi" class="form-control" required><?php echo htmlspecialchars($row['desk_lokasi']); ?></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="lokasi.php" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form><!-- End Edit Location Form -->

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>
