<?php
session_start();
include('koneksi/koneksi.php'); // Include DB connection

// Get the 'no_regristrasi' from the URL
$no_regristrasi = isset($_GET['no_regristrasi']) ? $_GET['no_regristrasi'] : '';

// Fetch item details based on 'no_regristrasi'
$sql = "SELECT * FROM data_barang WHERE no_regristrasi = '$no_regristrasi'";
$result = mysqli_query($conn, $sql);

// Check if item is found
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Data barang tidak ditemukan.";
    exit;
}
?>

<?php include("component/header.php"); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Detail Barang</h1>
  </div><!-- End Page Title -->

  <!-- Item Details -->
  <div class="card">
    <div class="card-body">
      <form>
        <div class="row mb-3">
          <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang:</label>
          <div class="col-sm-9">
          <h5 class="card-title">
        <input type="text" id="nama_barang" class="form-control" value="<?php echo $row['nama_barang']; ?>" readonly style="font-weight: bold; background-color: #f8f9fa; border: 1px solid #ced4da;">
      </h5>
          </div>
        </div>
        <div class="row mb-3">
          <label for="no_regristrasi" class="col-sm-3 col-form-label">No. Registrasi:</label>
          <div class="col-sm-9">
            <input type="text" id="no_regristrasi" class="form-control" value="<?php echo $row['no_regristrasi']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="kode_pemilik" class="col-sm-3 col-form-label">Kode Pemilik:</label>
          <div class="col-sm-9">
            <input type="text" id="kode_pemilik" class="form-control" value="<?php echo $row['kode_pemilik']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="kode_barang" class="col-sm-3 col-form-label">Kode Aset/Kode Barang:</label>
          <div class="col-sm-9">
            <input type="text" id="kode_barang" class="form-control" value="<?php echo $row['kode_barang']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="ruang_asal" class="col-sm-3 col-form-label">Ruang Asal:</label>
          <div class="col-sm-9">
            <input type="text" id="ruang_asal" class="form-control" value="<?php echo $row['ruang_asal']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="ruang_sekarang" class="col-sm-3 col-form-label">Ruang Sekarang:</label>
          <div class="col-sm-9">
            <input type="text" id="ruang_sekarang" class="form-control" value="<?php echo $row['ruang_sekarang']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="bid_ruang" class="col-sm-3 col-form-label">Nama Ruang/Bidang:</label>
          <div class="col-sm-9">
            <input type="text" id="bid_ruang" class="form-control" value="<?php echo $row['bid_ruang']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="tgl_pembelian" class="col-sm-3 col-form-label">Tanggal Pembelian:</label>
          <div class="col-sm-9">
            <input type="text" id="tgl_pembelian" class="form-control" value="<?php echo date('d/m/Y', strtotime($row['tgl_pembelian'])); ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="tgl_pembukuan" class="col-sm-3 col-form-label">Tanggal Pembukuan:</label>
          <div class="col-sm-9">
            <input type="text" id="tgl_pembukuan" class="form-control" value="<?php echo date('d/m/Y', strtotime($row['tgl_pembukuan'])); ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="merk" class="col-sm-3 col-form-label">Merk:</label>
          <div class="col-sm-9">
            <input type="text" id="merk" class="form-control" value="<?php echo $row['merk']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="type" class="col-sm-3 col-form-label">Type:</label>
          <div class="col-sm-9">
            <input type="text" id="type" class="form-control" value="<?php echo $row['type']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="ukuran_CC" class="col-sm-3 col-form-label">Ukuran/CC:</label>
          <div class="col-sm-9">
            <input type="text" id="ukuran_CC" class="form-control" value="<?php echo $row['ukuran_CC']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="no_pabrik" class="col-sm-3 col-form-label">No. Pabrik:</label>
          <div class="col-sm-9">
            <input type="text" id="no_pabrik" class="form-control" value="<?php echo $row['no_pabrik']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="no_rangka" class="col-sm-3 col-form-label">No. Rangka:</label>
          <div class="col-sm-9">
            <input type="text" id="no_rangka" class="form-control" value="<?php echo $row['no_rangka']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="no_bpkb" class="col-sm-3 col-form-label">No. BPKB:</label>
          <div class="col-sm-9">
            <input type="text" id="no_bpkb" class="form-control" value="<?php echo $row['no_bpkb']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="bahan" class="col-sm-3 col-form-label">Bahan:</label>
          <div class="col-sm-9">
            <input type="text" id="bahan" class="form-control" value="<?php echo $row['bahan']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="no_mesin" class="col-sm-3 col-form-label">No. Mesin:</label>
          <div class="col-sm-9">
            <input type="text" id="no_mesin" class="form-control" value="<?php echo $row['no_mesin']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="no_polisi" class="col-sm-3 col-form-label">No. Polisi:</label>
          <div class="col-sm-9">
            <input type="text" id="no_polisi" class="form-control" value="<?php echo $row['no_polisi']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="kondisi_barang" class="col-sm-3 col-form-label">Kondisi:</label>
          <div class="col-sm-9">
            <input type="text" id="kondisi_barang" class="form-control" value="<?php echo $row['kondisi_barang']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="masa_manfaat" class="col-sm-3 col-form-label">Masa Manfaat:</label>
          <div class="col-sm-9">
            <input type="text" id="masa_manfaat" class="form-control" value="<?php echo $row['masa_manfaat']; ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="harga_awal" class="col-sm-3 col-form-label">Harga Awal:</label>
          <div class="col-sm-9">
            <input type="text" id="harga_awal" class="form-control" value="Rp <?php echo number_format($row['harga_awal'], 2, ',', '.'); ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="harga_total" class="col-sm-3 col-form-label">Total Harga:</label>
          <div class="col-sm-9">
            <input type="text" id="harga_total" class="form-control" value="Rp <?php echo number_format($row['harga_total'], 2, ',', '.'); ?>" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="keterangan" class="col-sm-3 col-form-label">Keterangan:</label>
          <div class="col-sm-9">
            <textarea id="keterangan" class="form-control" rows="3" readonly><?php echo $row['keterangan']; ?></textarea>
          </div>
        </div>

        <!-- Foto Toggle Section -->
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Foto:</label>
          <div class="col-sm-9">
            <a href="javascript:void(0);" id="togglePhotoLink" onclick="togglePhoto()">Lihat Foto...</a>
          </div>
        </div>
        <div id="photoSection" style="display:none;" class="row mb-3">
          <div class="col-sm-3 offset-sm-3">
            <img src="<?php echo $row['foto_barang']; ?>" alt="Foto Barang" class="img-fluid" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;">
          </div>
        </div>

        <!-- Edit and Delete Actions -->
        <div class="row mb-3">
          <div class="col-sm-12">
            <a href="edit_barang.php?no_regristrasi=<?php echo $row['no_regristrasi']; ?>" class="btn btn-warning me-2">Edit</a>
            <a href="hapus_barang.php?no_regristrasi=<?php echo $row['no_regristrasi']; ?>" class="btn btn-danger">Hapus</a>
          </div>
        </div>
      </form>
    </div>
  </div><!-- End Item Details -->

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>

<!-- Toggle Photo Section Script -->
<script>
function togglePhoto() {
    var photoSection = document.getElementById("photoSection");
    var toggleLink = document.getElementById("togglePhotoLink");
    if (photoSection.style.display === "none") {
        photoSection.style.display = "block";
        toggleLink.innerHTML = "Tutup Foto...";
    } else {
        photoSection.style.display = "none";
        toggleLink.innerHTML = "Lihat Foto...";
    }
}
</script>
