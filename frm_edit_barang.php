<?php
session_start();
include('koneksi/koneksi.php'); // Koneksi ke database

// Dapatkan kode_barang dari URL
$kode_barang = $_GET['kode_barang'];

// Query untuk mendapatkan detail barang
$sql_barang = "SELECT * FROM data_barang WHERE kode_barang = '$kode_barang'";
$result_barang = mysqli_query($conn, $sql_barang);

// Cek apakah data ditemukan
if (mysqli_num_rows($result_barang) > 0) {
    $row_barang = mysqli_fetch_assoc($result_barang);

    // Query untuk mendapatkan nama_pemilik berdasarkan kode_pemilik
    $kode_pemilik = $row_barang['kode_pemilik'];
    $sql_pemilik = "SELECT nama_pemilik FROM pemilik WHERE kode_pemilik = '$kode_pemilik'";
    $result_pemilik = mysqli_query($conn, $sql_pemilik);
    $row_pemilik = mysqli_fetch_assoc($result_pemilik);

    // Jika tidak ada data pemilik
    $nama_pemilik = isset($row_pemilik['nama_pemilik']) ? $row_pemilik['nama_pemilik'] : 'Pemilik tidak ditemukan';

    // Mengambil data lokasi untuk opsi select
    $sql_locations = "SELECT * FROM lokasi";
    $locations_result = mysqli_query($conn, $sql_locations);

    // Menyimpan lokasi dalam array
    $locations = [];
    while ($location = mysqli_fetch_assoc($locations_result)) {
        $locations[] = $location;
    }

    // Mendapatkan detail lokasi untuk 'ruang_sekarang' yang dipilih
    $selected_location_id = $row_barang['ruang_sekarang'];
    $sql_location_detail = "SELECT * FROM lokasi WHERE id_lokasi = '$selected_location_id'";
    $location_detail_result = mysqli_query($conn, $sql_location_detail);
    $location_detail = mysqli_fetch_assoc($location_detail_result);
} else {
    echo "Data barang tidak ditemukan.";
    exit;
}
?>

<?php include("component/header.php"); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Barang</h1>
  </div><!-- End Page Title -->

  <!-- Form Edit Barang -->
  <div class="card">
    <div class="card-body">
      <form id="editBarangForm" action="proses/barang/edit_barang.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="kode_barang" value="<?php echo htmlspecialchars($row_barang['kode_barang']); ?>">

        <!-- Nama Barang -->
        <div class="row mb-3">
          <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang:</label>
          <div class="col-sm-9">
            <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="<?php echo htmlspecialchars($row_barang['nama_barang']); ?>" required>
          </div>
        </div>

        <!-- No. Registrasi -->
        <div class="row mb-3">
          <label for="no_regristrasi" class="col-sm-3 col-form-label">No. Registrasi:</label>
          <div class="col-sm-9">
            <input type="text" id="no_regristrasi" name="no_regristrasi" class="form-control readonly-input" value="<?php echo htmlspecialchars($row_barang['no_regristrasi']); ?>" readonly style="background-color: #f0f0f0;">
          </div>
        </div>

        <!-- Kode Pemilik -->
        <div class="row mb-3">
          <label for="kode_pemilik" class="col-sm-3 col-form-label">Kode Pemilik:</label>
          <div class="col-sm-3">
            <input type="text" id="kode_pemilik" name="kode_pemilik" class="form-control readonly-input" value="<?php echo htmlspecialchars($row_barang['kode_pemilik']); ?>" readonly style="background-color: #f0f0f0;">
          </div>
          <div class="col-sm-6">
            <input type="text" id="nama_pemilik" name="nama_pemilik" class="form-control readonly-input" value="<?php echo htmlspecialchars($nama_pemilik); ?>" readonly style="background-color: #f0f0f0;">
          </div>
        </div>

        <!-- Kode Barang -->
        <div class="row mb-3">
          <label for="kode_barang" class="col-sm-3 col-form-label">Kode Aset/Kode Barang:</label>
          <div class="col-sm-9">
            <input type="text" id="kode_barang" name="kode_barang" class="form-control readonly-input" value="<?php echo htmlspecialchars($row_barang['kode_barang']); ?>" readonly style="background-color: #f0f0f0;">
          </div>
        </div>

        <!-- Lokasi Asal -->
        <div class="row mb-3">
          <label for="ruang_asal" class="col-sm-3 col-form-label">Lokasi Asal:</label>
          <?php 
          // Query lokasi asal
          $ruang_asal = $row_barang['ruang_asal'];
          $sql_asal = "SELECT * FROM lokasi WHERE nama_lokasi = '$ruang_asal'";
          $result_asal = mysqli_query($conn, $sql_asal);
          $asal_location = mysqli_fetch_assoc($result_asal);

          if ($asal_location):
          ?>
          <div class="col-sm-3">
            <input type="text" class="form-control readonly-input" value="<?php echo htmlspecialchars($asal_location['nama_lokasi']); ?>" readonly style="background-color: #f0f0f0;">
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control readonly-input" value="<?php echo htmlspecialchars($asal_location['bid_lokasi']); ?>" readonly style="background-color: #f0f0f0;">
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control readonly-input" value="<?php echo htmlspecialchars($asal_location['tempat_lokasi']); ?>" readonly style="background-color: #f0f0f0;">
          </div>
          <?php else: ?>
          <div class="col-sm-9">
            <input type="text" class="form-control readonly-input" value="Lokasi asal tidak ditemukan" readonly>
          </div>
          <?php endif; ?>
        </div>

        <!-- Lokasi Sekarang -->
        <div class="row mb-3">
          <label for="ruang_sekarang" class="col-sm-3 col-form-label">Lokasi Sekarang:</label>
          <div class="col-sm-9">
          <select id="ruang_sekarang" name="ruang_sekarang" class="form-select" onchange="handleLocationChange()" required>
            <option value="">Pilih Ruang Sekarang</option>
            <?php foreach ($locations as $location): ?>
                <option value="<?php echo htmlspecialchars($location['nama_lokasi']); ?>" <?php echo ($location['nama_lokasi'] == $row_barang['ruang_sekarang']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($location['nama_lokasi'] . ' - ' . $location['bid_lokasi'] . ' - ' . $location['tempat_lokasi']); ?>
                </option>
            <?php endforeach; ?>
            <option value="other">Tambah Ruang/lokasi Baru (Masuk ke Inventaris Lokasi)...</option>
        </select>
          </div>
        </div>

        <script>
          // Fungsi untuk menangani perubahan pada dropdown lokasi
          function handleLocationChange() {
              var selectElement = document.getElementById('ruang_sekarang');
              var selectedValue = selectElement.value;

              if (selectedValue === "other") {
                  // Arahkan pengguna ke halaman tambah lokasi
                  window.location.href = "frm_tambah_lokasi.php"; // Ganti dengan path yang sesuai
              }
          }
          </script>


        <!-- Tanggal Pembelian -->
        <div class="row mb-3">
          <label for="tgl_pembelian" class="col-sm-3 col-form-label">Tanggal Pembelian:</label>
          <div class="col-sm-9">
            <input type="date" id="tgl_pembelian" name="tgl_pembelian" class="form-control" value="<?php echo htmlspecialchars($row_barang['tgl_pembelian']); ?>" readonly style="background-color: #f0f0f0;">
          </div>
        </div>

        <!-- Tanggal Pembukuan -->
        <div class="row mb-3">
          <label for="tgl_pembukuan" class="col-sm-3 col-form-label">Tanggal Pembukuan:</label>
          <div class="col-sm-9">
            <input type="date" id="tgl_pembukuan" name="tgl_pembukuan" class="form-control" value="<?php echo htmlspecialchars($row_barang['tgl_pembukuan']); ?>" readonly style="background-color: #f0f0f0;">
          </div>
        </div>

        <!-- Merk (Opsional) -->
        <div class="row mb-3">
          <label for="merk" class="col-sm-3 col-form-label">Merk:</label>
          <div class="col-sm-9">
            <input type="text" id="merk" name="merk" class="form-control" value="<?php echo htmlspecialchars($row_barang['merk']); ?>">
          </div>
        </div>

        <!-- Type (Opsional) -->
        <div class="row mb-3">
          <label for="type" class="col-sm-3 col-form-label">Type:</label>
          <div class="col-sm-9">
            <input type="text" id="type" name="type" class="form-control" value="<?php echo htmlspecialchars($row_barang['type']); ?>">
          </div>
        </div>

        <!-- Ukuran/CC (Opsional) -->
        <div class="row mb-3">
          <label for="ukuran_CC" class="col-sm-3 col-form-label">Ukuran/CC:</label>
          <div class="col-sm-9">
            <input type="text" id="ukuran_CC" name="ukuran_CC" class="form-control" value="<?php echo htmlspecialchars($row_barang['ukuran_CC']); ?>">
          </div>
        </div>

        <!-- No. Pabrik (Opsional) -->
        <div class="row mb-3">
          <label for="no_pabrik" class="col-sm-3 col-form-label">No. Pabrik:</label>
          <div class="col-sm-9">
            <input type="text" id="no_pabrik" name="no_pabrik" class="form-control" value="<?php echo htmlspecialchars($row_barang['no_pabrik']); ?>">
          </div>
        </div>

        <!-- No. Rangka (Opsional) -->
        <div class="row mb-3">
          <label for="no_rangka" class="col-sm-3 col-form-label">No. Rangka:</label>
          <div class="col-sm-9">
            <input type="text" id="no_rangka" name="no_rangka" class="form-control" value="<?php echo htmlspecialchars($row_barang['no_rangka']); ?>">
          </div>
        </div>

        <!-- No. BPKB (Opsional) -->
        <div class="row mb-3">
          <label for="no_bpkb" class="col-sm-3 col-form-label">No. BPKB:</label>
          <div class="col-sm-9">
            <input type="text" id="no_bpkb" name="no_bpkb" class="form-control" value="<?php echo htmlspecialchars($row_barang['no_bpkb']); ?>">
          </div>
        </div>

        <!-- Bahan (Opsional) -->
        <div class="row mb-3">
          <label for="bahan" class="col-sm-3 col-form-label">Bahan:</label>
          <div class="col-sm-9">
            <input type="text" id="bahan" name="bahan" class="form-control" value="<?php echo htmlspecialchars($row_barang['bahan']); ?>">
          </div>
        </div>

        <!-- Kategori (Opsional) -->
        <div class="row mb-3">
          <label for="kategori" class="col-sm-3 col-form-label">Kategori:</label>
          <div class="col-sm-9">
            <input type="text" id="kategori" name="kategori" class="form-control" value="<?php echo htmlspecialchars($row_barang['kategori']); ?>">
          </div>
        </div>

        <!-- no_polisi (Opsional) -->
        <div class="row mb-3">
          <label for="no_polisi" class="col-sm-3 col-form-label">no polisi:</label>
          <div class="col-sm-9">
            <input type="text" id="no_polisi" name="no_polisi" class="form-control" value="<?php echo htmlspecialchars($row_barang['no_polisi']); ?>">
          </div>
        </div>

        <!-- no_mesin (Opsional) -->
        <div class="row mb-3">
          <label for="no_mesin" class="col-sm-3 col-form-label">no mesin:</label>
          <div class="col-sm-9">
            <input type="text" id="no_mesin" name="no_mesin" class="form-control" value="<?php echo htmlspecialchars($row_barang['no_mesin']); ?>">
          </div>
        </div>

        <div class="row mb-3">
          <label for="keterangan" class="col-sm-3 col-form-label">keterangan:</label>
          <div class="col-sm-9">
            <input type="text" id="keterangan" name="keterangan" class="form-control" value="<?php echo htmlspecialchars($row_barang['keterangan']); ?>">
          </div>
        </div>


        <!-- Harga Awal -->
        <div class="row mb-3">
          <label for="harga_awal" class="col-sm-3 col-form-label">Harga Perolehan:</label>
          <div class="col-sm-9">
            <input type="text" id="harga_awal" name="harga_awal" class="form-control" value="<?php echo number_format($row_barang['harga_awal'], 2, ',', '.'); ?>" readonly style="background-color: #f0f0f0;">
          </div>
        </div>

        <!-- Harga Total -->
        <div class="row mb-3">
          <label for="harga_total" class="col-sm-3 col-form-label">Harga Total:</label>
          <div class="col-sm-9">
            <input type="text" id="harga_total" name="harga_total" class="form-control" value="<?php echo number_format($row_barang['harga_total'], 2, ',', '.'); ?>" readonly style="background-color: #f0f0f0;">
          </div>
        </div>

        <!-- Kondisi Barang -->
        <div class="row mb-3">
          <label for="kondisi_barang" class="col-sm-3 col-form-label">Kondisi Barang:</label>
          <div class="col-sm-9">
            <select name="kondisi_barang" class="form-select" required>
              <option value="Baik" <?php echo ($row_barang['kondisi_barang'] == 'Baik') ? 'selected' : ''; ?>>Baik</option>
              <option value="Kurang Baik" <?php echo ($row_barang['kondisi_barang'] == 'Kurang Baik') ? 'selected' : ''; ?>>Kurang Baik</option>
              <option value="Rusak Berat" <?php echo ($row_barang['kondisi_barang'] == 'Rusak Berat') ? 'selected' : ''; ?>>Rusak Berat</option>
            </select>
          </div>
        </div>

        <!-- Masa Manfaat -->
        <div class="row mb-3">
          <label for="masa_manfaat" class="col-sm-3 col-form-label">Masa Manfaat (Tahun):</label>
          <div class="col-sm-9">
            <input type="number" id="masa_manfaat" name="masa_manfaat" class="form-control" value="<?php echo htmlspecialchars($row_barang['masa_manfaat']); ?>" required>
          </div>
        </div>

        <!-- Foto Barang -->
        <div class="row mb-3">
          <label for="foto_barang" class="col-sm-3 col-form-label">Foto Barang:</label>
          <div class="col-sm-9">
            <?php if (!empty($row_barang['foto_barang'])): ?>
              <img src="images/<?php echo htmlspecialchars($row_barang['foto_barang']); ?>" alt="Foto Barang" style="max-width: 200px;">
            <?php endif; ?>
            <input type="file" id="foto_barang" name="foto_barang" class="form-control">
            <small class="text-muted">Unggah file gambar (JPEG, PNG)</small>
          </div>
        </div>

        <!-- Tombol Submit -->
        <div class="row mb-3">
          <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary" id="submitButton">Update</button>
            <a href="Data_barang.php" class="btn btn-secondary">Batal</a>
          </div>
        </div>

      </form>
    </div>
  </div><!-- End Form Edit Barang -->
</main><!-- End #main -->

<?php include("component/footer.php"); ?>

<script>
document.getElementById('ruang_sekarang').addEventListener('change', function() {
    var ruangSekarang = this.value;

    if (ruangSekarang !== '') {
        // Lakukan AJAX untuk mendapatkan detail bidang dan lokasi
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'proses/barang/get_lokasi.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.error) {
                    alert(response.error);
                } else {
                    // Update bidang dan tempat dengan hasil dari server
                    document.getElementById('bid_ruang').value = response.bidang;
                    document.getElementById('tempat_ruang').value = response.lokasi;
                }
            }
        };

        xhr.send('id_lokasi=' + encodeURIComponent(ruangSekarang));
    }
});
</script>


<!-- JavaScript untuk Konfirmasi SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('editBarangForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

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
            document.getElementById('editBarangForm').submit();
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
