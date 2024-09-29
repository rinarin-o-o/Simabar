<?php
include('koneksi/koneksi.php');
include('component/header.php');

// Tampilkan pesan error atau success jika ada
if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
    unset($_SESSION['error']);
} elseif (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>Data berhasil disimpan!</div>";
    unset($_SESSION['success']);
}

// Ambil data kode_barang dari tabel data_barang
$query_barang = "SELECT kode_barang, nama_barang FROM data_barang";
$result_barang = mysqli_query($conn, $query_barang);

// Buat ID Pemeliharaan baru secara otomatis
$query_max_id = "SELECT MAX(id_pemeliharaan) AS max_id FROM data_pemeliharaan";
$result_max_id = mysqli_query($conn, $query_max_id);
$row_max_id = mysqli_fetch_assoc($result_max_id);

// Jika ada ID pemeliharaan, ambil angkanya lalu increment
if ($row_max_id['max_id']) {
    $last_id = $row_max_id['max_id'];
    $number = (int)substr($last_id, 3) + 1; // Ambil angka setelah 'MNT' dan tambah 1
} else {
    $number = 1; // Jika belum ada data, mulai dari 1
}

// Format ID menjadi 'MNT' diikuti angka 8 digit
$new_id_pemeliharaan = 'MNT' . str_pad($number, 8, '0', STR_PAD_LEFT);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Tambah Data Pemeliharaan</h1>
  </div><!-- End Page Title -->

  <form method="POST" action="proses/pemeliharaan/tambah_pemeliharaan.php">
    <!-- ID Pemeliharaan Otomatis -->
    <div class="mb-3">
      <label for="id_pemeliharaan" class="form-label">ID Pemeliharaan</label>
      <input type="text" class="form-control" id="id_pemeliharaan" name="id_pemeliharaan" value="<?php echo $new_id_pemeliharaan; ?>" readonly>
    </div>

    <div class="mb-3">
      <label for="kode_barang" class="form-label">Kode Barang</label>
      <select class="form-control" name="kode_barang" required>
        <option value="">-- Pilih Kode Barang --</option>
        <?php 
        // Loop untuk menampilkan opsi dari tabel data_barang
        if (mysqli_num_rows($result_barang) > 0) {
            while($row = mysqli_fetch_assoc($result_barang)) {
                echo "<option value='".$row['kode_barang']."'>".$row['kode_barang']." - ".$row['nama_barang']."</option>";
            }
        } else {
            echo "<option value=''>Tidak ada data barang tersedia</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="desk_pemeliharaan" class="form-label">Deskripsi Pemeliharaan / Kerusakan</label>
      <textarea class="form-control" name="desk_pemeliharaan" ></textarea>
    </div>
    <div class="mb-3">
      <label for="perbaikan" class="form-label">Perbaikan</label>
      <input type="text" class="form-control" name="perbaikan" >
    </div>
    <div class="mb-3">
      <label for="tgl_perbaikan" class="form-label">Tanggal Perbaikan</label>
      <input type="date" class="form-control" name="tgl_perbaikan" >
    </div>
    <div class="mb-3">
      <label for="lama_perbaikan" class="form-label">Lama Perbaikan (hari)</label>
      <input type="number" class="form-control" name="lama_perbaikan" >
    </div>
    <div class="mb-3">
      <label for="biaya_perbaikan" class="form-label">Biaya Perbaikan</label>
      <input type="number" class="form-control" name="biaya_perbaikan" >
    </div>
    
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="Data_pemeliharaan.php" class="btn btn-secondary">Batal</a>
  </form>
</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>
