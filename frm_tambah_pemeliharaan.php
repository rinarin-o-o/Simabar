<?php include("koneksi/koneksi.php"); 
// Koneksi ke database (gantilah dengan kredensial database Anda)
$conn = mysqli_connect("localhost", "root", "", "db_simabar");

// Pastikan koneksi berhasil
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dengan validasi dasar
    $kode_barang = mysqli_real_escape_string($conn, $_POST['kode_barang']);
    $desk_pemeliharaan = mysqli_real_escape_string($conn, $_POST['desk_pemeliharaan']);
    $perbaikan = mysqli_real_escape_string($conn, $_POST['perbaikan']);
    $tgl_perbaikan = mysqli_real_escape_string($conn, $_POST['tgl_perbaikan']);
    $lama_perbaikan = mysqli_real_escape_string($conn, $_POST['lama_perbaikan']);
    $biaya_perbaikan = (int) $_POST['biaya_perbaikan']; // Pastikan ini angka dan tidak perlu tanda kutip

    // Query untuk memasukkan data pemeliharaan
    $query = "INSERT INTO data_pemeliharaan (kode_barang, desk_pemeliharaan, perbaikan, tgl_perbaikan, lama_perbaikan, biaya_perbaikan)
              VALUES ('$kode_barang', '$desk_pemeliharaan', '$perbaikan', '$tgl_perbaikan', '$lama_perbaikan', $biaya_perbaikan)";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Set session success flag dan redirect ke Data_pemeliharaan.php
        $_SESSION['success'] = true;
        header('Location: Data_pemeliharaan.php');
        exit();
    } else {
        // Cek apakah error karena duplikasi entri (kode error 1062)
        if (mysqli_errno($conn) == 1062) {
            $_SESSION['error'] = 'Duplikat Kode Barang. Data sudah ada.';
            header('Location: frm_tambah_pemeliharaan.php');
            exit();
        } else {
            // Tampilkan error lain
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}

// Tutup koneksi
mysqli_close($conn);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Tambah Data Pemeliharaan</h1>
  </div><!-- End Page Title -->

  <form method="POST" action="frm_tambah_pemeliharaan.php">
    <div class="mb-3">
      <label for="kode_barang" class="form-label">Kode Barang</label>
      <input type="text" class="form-control" name="kode_barang" required>
    </div>
    <div class="mb-3">
      <label for="desk_pemeliharaan" class="form-label">Deskripsi Pemeliharaan / Kerusakan</label>
      <textarea class="form-control" name="desk_pemeliharaan" required></textarea>
    </div>
    <div class="mb-3">
      <label for="perbaikan" class="form-label">Perbaikan</label>
      <input type="text" class="form-control" name="perbaikan" required>
    </div>
    <div class="mb-3">
      <label for="tgl_perbaikan" class="form-label">Tanggal Perbaikan</label>
      <input type="date" class="form-control" name="tgl_perbaikan" required>
    </div>
    <div class="mb-3">
      <label for="lama_perbaikan" class="form-label">Lama Perbaikan (hari)</label>
      <input type="number" class="form-control" name="lama_perbaikan" required>
    </div>
    <div class="mb-3">
      <label for="biaya_perbaikan" class="form-label">Biaya Perbaikan</label>
      <input type="number" class="form-control" name="biaya_perbaikan" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>
