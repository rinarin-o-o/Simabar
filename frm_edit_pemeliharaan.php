<?php
ob_start();
include('koneksi/koneksi.php');
include('component/header.php');

if (!isset($_GET['id_pemeliharaan'])) {
    // Redirect to the location list page if id_pemeliharaan is not set
    header('Location: Data_pemeliharaan.php');
    exit;
}

$id_pemeliharaan = $_GET['id_pemeliharaan'];

// Fetch existing location data
$sql = "SELECT * FROM data_pemeliharaan WHERE id_pemeliharaan = '$id_pemeliharaan'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
} else {
    // Redirect to the location list page if no data found
    header('Location: Data_pemeliharaan.php');
    exit;
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Data Pemeliharaan</h1>
  </div><!-- End Page Title -->

  <div class="card">
    <div class="card-body">
  <form id="editPemeliharaanForm" method="POST" action="proses/pemeliharaan/edit_pemeliharaan.php">
  <div class="row row mb-3">
      <label for="id_pemeliharaan" class="col-sm-3 col-form-label">ID Pemeliharaan</label>
      <div class="col-sm-9">
        <input type="text" id="id_pemeliharaan" name="id_pemeliharaan" class="form-control readonly-input" value="<?php echo htmlspecialchars($row['id_pemeliharaan']); ?>" readonly style="background-color: #f0f0f0;">
        </div>
    </div>

    <div class="row row mb-3">
      <label for="kode_barang" class="col-sm-3 col-form-label">Kode Barang</label>
      <div class="col-sm-9">
        <input type="text" id="kode_barang" name="kode_barang" class="form-control readonly-input" value="<?php echo htmlspecialchars($row['kode_barang']); ?>" readonly style="background-color: #f0f0f0;">
        </div>
    </div>

    <div class="row mb-3">
      <label for="desk_pemeliharaan" class="col-sm-3 col-form-label">Deskripsi Pemeliharaan / Kerusakan</label>
      <div class="col-sm-9">
        <input type="text" id="desk_pemeliharaan" name="desk_pemeliharaan" class="form-control readonly-input" value="<?php echo htmlspecialchars($row['desk_pemeliharaan']); ?>">
    </div>
    </div>
    <div class="row mb-3">
      <label for="perbaikan" class="col-sm-3 col-form-label">Perbaikan</label>
      <div class="col-sm-9">
        <input type="text" id="perbaikan" name="perbaikan" class="form-control readonly-input" value="<?php echo htmlspecialchars($row['perbaikan']); ?>">
    </div>
    </div>
    <div class="row mb-3">
      <label for="tgl_perbaikan" class="col-sm-3 col-form-label">Tanggal Perbaikan</label>
      <div class="col-sm-9">
        <input type="date" id="tgl_perbaikan" name="tgl_perbaikan" class="form-control" value="<?php echo htmlspecialchars($row['tgl_perbaikan']); ?>">
        </div>
    </div>
    <div class="row mb-3">
      <label for="lama_perbaikan" class="col-sm-3 col-form-label">Lama Perbaikan (hari)</label>
      <div class="col-sm-9">
        <input type="text" id="lama_perbaikan" name="lama_perbaikan" class="form-control " value="<?php echo htmlspecialchars($row['lama_perbaikan']); ?>">
    </div>
    </div>
    <div class="row mb-3">
      <label for="biaya_perbaikan" class="col-sm-3 col-form-label">Biaya Perbaikan</label>
      <div class="col-sm-9">
        <input type="number" id = "biaya perbaikan" name = "biaya_perbaikan" class="form-control" value="<?php echo htmlspecialchars($row['biaya_perbaikan']); ?> ">
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="Data_pemeliharaan.php" class="btn btn-secondary">Batal</a>
  </form>
    </div>
  </div>
</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>

<!-- JavaScript untuk Konfirmasi SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('editPemeliharaanForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin merubah data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('editPemeliharaanForm').submit();
        }
    });
});

</script>

<!-- Menangani Pesan Error dari Session -->
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
    // Hapus error setelah ditampilkan
    unset($_SESSION['error']);
}
?>