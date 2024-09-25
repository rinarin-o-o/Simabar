<?php
ob_start();
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
?>

<?php include("component/header.php"); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Lokasi</h1>
    </div><!-- End Page Title -->

    <!-- Edit Location Form -->
    <form id="editLocationForm" action="proses/lokasi/edit_lokasi.php" method="POST">
        <div class="row mb-3">
            <label for="id_lokasi" class="col-sm-2 col-form-label">Kode Lokasi</label>
            <div class="col-sm-10">
                <input type="text" name="id_lokasi" class="form-control" value="<?php echo htmlspecialchars($row['id_lokasi']); ?>" readonly>
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
                <select name="kategori_lokasi" class="form-select" aria-label="Default select example" required>
                    <option value="Ruangan" <?php echo ($row['kategori_lokasi'] == 'Ruangan') ? 'selected' : ''; ?>>Ruangan</option>
                    <option value="Fasilitas Umum" <?php echo ($row['kategori_lokasi'] == 'Fasilitas Umum') ? 'selected' : ''; ?>>Fasilitas Umum</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="desk_lokasi" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
                <textarea name="desk_lokasi" class="form-control" required><?php echo htmlspecialchars($row['desk_lokasi']); ?></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary" id="submitButton">Update</button>
                <a href="lokasi.php" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form><!-- End Edit Location Form -->

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('editLocationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin merubah data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, update!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, submit the form
            document.getElementById('editLocationForm').submit();
        }
    });
});
</script>

<?php
if (isset($_SESSION['error'])) {
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
