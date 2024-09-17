<?php
ob_start(); // Start output buffering
session_start();
include('koneksi/koneksi.php'); 
include('component/header.php'); 

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input to prevent SQL injection
    $kode_barang = mysqli_real_escape_string($conn, $_POST['kode_barang']);
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $no_registrasi = mysqli_real_escape_string($conn, $_POST['no_registrasi']);
    $kode_pemilik = mysqli_real_escape_string($conn, $_POST['kode_pemilik']);
    $ruang_asal = mysqli_real_escape_string($conn, $_POST['ruang_asal']);
    $ruang_sekarang = mysqli_real_escape_string($conn, $_POST['ruang_sekarang']);
    $bid_ruang = mysqli_real_escape_string($conn, $_POST['bid_ruang']);
    $tempat_ruang = mysqli_real_escape_string($conn, $_POST['tempat_ruang']);
    $tgl_pembelian = mysqli_real_escape_string($conn, $_POST['tgl_pembelian']);
    $tgl_pembukuan = mysqli_real_escape_string($conn, $_POST['tgl_pembukuan']);
    $merk = mysqli_real_escape_string($conn, $_POST['merk']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $ukuran_CC = mysqli_real_escape_string($conn, $_POST['ukuran_CC']);
    $no_pabrik = mysqli_real_escape_string($conn, $_POST['no_pabrik']);
    $no_rangka = mysqli_real_escape_string($conn, $_POST['no_rangka']);
    $no_bpkb = mysqli_real_escape_string($conn, $_POST['no_bpkb']);
    $bahan = mysqli_real_escape_string($conn, $_POST['bahan']);
    $no_mesin = mysqli_real_escape_string($conn, $_POST['no_mesin']);
    $no_polisi = mysqli_real_escape_string($conn, $_POST['no_polisi']);
    $kondisi_barang = mysqli_real_escape_string($conn, $_POST['kondisi_barang']);
    $masa_manfaat = mysqli_real_escape_string($conn, $_POST['masa_manfaat']);
    $harga_awal = mysqli_real_escape_string($conn, $_POST['harga_awal']);
    $harga_total = mysqli_real_escape_string($conn, $_POST['harga_total']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $foto_barang = mysqli_real_escape_string($conn, $_POST['foto_barang']);

    // Insert data into barang table
    $sql = "INSERT INTO barang (kode_barang, nama_barang, no_registrasi, kode_pemilik, ruang_asal, ruang_sekarang, bid_ruang, tempat_ruang, tgl_pembelian, tgl_pembukuan, merk, type, kategori, ukuran_CC, no_pabrik, no_rangka, no_bpkb, bahan, no_mesin, no_polisi, kondisi_barang, masa_manfaat, harga_awal, harga_total, keterangan, foto_barang) 
            VALUES ('$kode_barang', '$nama_barang', '$no_registrasi', '$kode_pemilik', '$ruang_asal', '$ruang_sekarang', '$bid_ruang', '$tempat_ruang', '$tgl_pembelian', '$tgl_pembukuan', '$merk', '$type', '$kategori', '$ukuran_CC', '$no_pabrik', '$no_rangka', '$no_bpkb', '$bahan', '$no_mesin', '$no_polisi', '$kondisi_barang', '$masa_manfaat', '$harga_awal', '$harga_total', '$keterangan', '$foto_barang')";

    if (mysqli_query($conn, $sql)) {
        // Set session success flag and redirect to barang.php
        $_SESSION['success'] = true;
        header('Location: tambah_barang.php');
        exit();
    } else {
        // Check for duplicate entry error
        if (mysqli_errno($conn) == 1062) { // 1062 is the MySQL error code for duplicate entry
            $_SESSION['error'] = 'Duplikat Kode Barang. Data sudah ada.';
            header('Location: frm_tambah_barang.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Tambah Barang</h1>
  </div><!-- End Page Title -->

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Form</h5>

      <!-- Form for adding new item -->
      <form method="POST" action="">

        <div class="mb-3">
          <label for="kode_barang" class="form-label">Kode Barang</label>
          <input type="text" name="kode_barang" class="form-control" id="kode_barang" required>
        </div>

        <div class="mb-3">
          <label for="nama_barang" class="form-label">Nama Barang</label>
          <input type="text" name="nama_barang" class="form-control" id="nama_barang" required>
        </div>

        <div class="mb-3">
          <label for="no_registrasi" class="form-label">No Registrasi</label>
          <input type="number" name="no_registrasi" class="form-control" id="no_registrasi" required>
        </div>

        <div class="mb-3">
          <label for="kode_pemilik" class="form-label">Kode Pemilik</label>
          <input type="text" name="kode_pemilik" class="form-control" id="kode_pemilik" required>
        </div>

        <div class="mb-3">
          <label for="ruang_asal" class="form-label">Ruang Asal</label>
          <input type="text" name="ruang_asal" class="form-control" id="ruang_asal">
        </div>

        <div class="mb-3">
          <label for="ruang_sekarang" class="form-label">Ruang Sekarang</label>
          <input type="text" name="ruang_sekarang" class="form-control" id="ruang_sekarang">
        </div>

        <div class="mb-3">
          <label for="bid_ruang" class="form-label">Bidang Ruang</label>
          <input type="text" name="bid_ruang" class="form-control" id="bid_ruang">
        </div>

        <div class="mb-3">
          <label for="tempat_ruang" class="form-label">Tempat Ruang</label>
          <input type="text" name="tempat_ruang" class="form-control" id="tempat_ruang">
        </div>

        <div class="mb-3">
          <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
          <input type="date" name="tgl_pembelian" class="form-control" id="tgl_pembelian" required>
        </div>

        <div class="mb-3">
          <label for="tgl_pembukuan" class="form-label">Tanggal Pembukuan</label>
          <input type="date" name="tgl_pembukuan" class="form-control" id="tgl_pembukuan">
        </div>

        <div class="mb-3">
          <label for="merk" class="form-label">Merk</label>
          <input type="text" name="merk" class="form-control" id="merk">
        </div>

        <div class="mb-3">
          <label for="type" class="form-label">Type</label>
          <input type="text" name="type" class="form-control" id="type">
        </div>

        <div class="mb-3">
          <label for="kategori" class="form-label">Kategori</label>
          <input type="text" name="kategori" class="form-control" id="kategori">
        </div>

        <div class="mb-3">
          <label for="ukuran_CC" class="form-label">Ukuran CC</label>
          <input type="text" name="ukuran_CC" class="form-control" id="ukuran_CC">
        </div>

        <div class="mb-3">
          <label for="no_pabrik" class="form-label">No Pabrik</label>
          <input type="text" name="no_pabrik" class="form-control" id="no_pabrik">
        </div>

        <div class="mb-3">
          <label for="no_rangka" class="form-label">No Rangka</label>
          <input type="text" name="no_rangka" class="form-control" id="no_rangka">
        </div>

        <div class="mb-3">
          <label for="no_bpkb" class="form-label">No BPKB</label>
          <input type="text" name="no_bpkb" class="form-control" id="no_bpkb">
        </div>

        <div class="mb-3">
          <label for="bahan" class="form-label">Bahan</label>
          <input type="text" name="bahan" class="form-control" id="bahan">
        </div>

        <div class="mb-3">
          <label for="no_mesin" class="form-label">No Mesin</label>
          <input type="text" name="no_mesin" class="form-control" id="no_mesin">
        </div>

        <div class="mb-3">
          <label for="no_polisi" class="form-label">No Polisi</label>
          <input type="text" name="no_polisi" class="form-control" id="no_polisi">
        </div>

        <div class="mb-3">
          <label for="kondisi_barang" class="form-label">Kondisi Barang</label>
          <select name="kondisi_barang" class="form-select" id="kondisi_barang" required>
            <option value="" disabled selected>Pilih Kondisi</option>
            <option value="baik">Baik</option>
            <option value="rusak">Kurang Baik</option>
            <option value="rusak">Rusak</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="masa_manfaat" class="form-label">Masa Manfaat</label>
          <input type="text" name="masa_manfaat" class="form-control" id="masa_manfaat" placeholder="Masukkan masa manfaat (contoh: 2 bulan)">
        </div>

        <div class="mb-3">
          <label for="harga_awal" class="form-label">Harga Awal</label>
          <input type="number" name="harga_awal" class="form-control" id="harga_awal">
        </div>

        <div class="mb-3">
          <label for="harga_total" class="form-label">Harga Total</label>
          <input type="number" name="harga_total" class="form-control" id="harga_total">
        </div>

        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea name="keterangan" class="form-control" id="keterangan" rows="3"></textarea>
        </div>

        <div class="mb-3">
          <label for="foto_barang" class="form-label">Foto Barang</label>
          <input type="file" name="foto_barang" class="form-control" id="foto_barang">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="barang.php" class="btn btn-secondary">Batal</a>

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
