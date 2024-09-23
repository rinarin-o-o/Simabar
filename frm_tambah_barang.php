<?php
ob_start(); // Start output buffering
session_start();
include('koneksi/koneksi.php'); 
include('component/header.php'); 

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $kode_barang = isset($_POST['kode_barang']) ? $_POST['kode_barang'] : '';
    $nama_barang = isset($_POST['nama_barang']) ? $_POST['nama_barang'] : '';
    $no_registrasi = isset($_POST['no_registrasi']) ? $_POST['no_registrasi'] : '';
    $kode_pemilik = isset($_POST['kode_pemilik']) ? $_POST['kode_pemilik'] : '';
    $ruang_asal = isset($_POST['ruang_asal']) ? $_POST['ruang_asal'] : '';
    $ruang_sekarang = isset($_POST['ruang_sekarang']) ? $_POST['ruang_sekarang'] : '';
    $bid_ruang = isset($_POST['bid_ruang']) ? $_POST['bid_ruang'] : '';
    $tempat_ruang = isset($_POST['tempat_ruang']) ? $_POST['tempat_ruang'] : '';
    $tgl_pembelian = isset($_POST['tgl_pembelian']) ? $_POST['tgl_pembelian'] : '';
    $tgl_pembukuan = isset($_POST['tgl_pembukuan']) ? $_POST['tgl_pembukuan'] : '';
    $merk = isset($_POST['merk']) ? $_POST['merk'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
    $ukuran_CC = isset($_POST['ukuran_CC']) ? $_POST['ukuran_CC'] : '';
    $no_pabrik = isset($_POST['no_pabrik']) ? $_POST['no_pabrik'] : '';
    $no_rangka = isset($_POST['no_rangka']) ? $_POST['no_rangka'] : '';
    $no_bpkb = isset($_POST['no_bpkb']) ? $_POST['no_bpkb'] : '';
    $bahan = isset($_POST['bahan']) ? $_POST['bahan'] : '';
    $no_mesin = isset($_POST['no_mesin']) ? $_POST['no_mesin'] : '';
    $no_polisi = isset($_POST['no_polisi']) ? $_POST['no_polisi'] : '';
    $kondisi_barang = isset($_POST['kondisi_barang']) ? $_POST['kondisi_barang'] : '';
    $masa_manfaat = isset($_POST['masa_manfaat']) ? $_POST['masa_manfaat'] : '';
    $harga_awal = !empty($_POST['harga_awal']) ? $_POST['harga_awal'] : 0;
    $harga_total = !empty($_POST['harga_total']) ? $_POST['harga_total'] : 0;
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';

    // Cek apakah kode_barang sudah ada di database
    $cekBarang = mysqli_query($conn, "SELECT * FROM data_barang WHERE kode_barang = '$kode_barang'");
    if (mysqli_num_rows($cekBarang) > 0) {
        $_SESSION['error'] = 'Duplikat Kode Barang. Data sudah ada.';
        header('Location: frm_tambah_barang.php');
        exit();
    }

    // Cek apakah kode pemilik sudah ada di database
    $cekPemilik = mysqli_query($conn, "SELECT * FROM pemilik WHERE Kode_pemilik = '$kode_pemilik'");
    if (mysqli_num_rows($cekPemilik) == 0 && isset($_POST['nama_pemilik'])) {
        // Kode pemilik tidak ada, tambahkan pemilik baru
        $nama_pemilik = $_POST['nama_pemilik'];
        $query_pemilik = "INSERT INTO pemilik (Kode_pemilik, Nama_pemilik) VALUES ('$kode_pemilik', '$nama_pemilik')";
        if (!mysqli_query($conn, $query_pemilik)) {
            echo "Error menambah pemilik baru: " . mysqli_error($conn);
            exit();
        }
    }

    // Penanganan file upload
    $foto_barang = null; // Inisialisasi variabel foto_barang
    if (isset($_FILES['foto_barang']) && $_FILES['foto_barang']['error'] == 0) {
        $foto_barang = $_FILES['foto_barang']['name'];
        $folder = "uploads/"; // Pastikan folder ini ada
        move_uploaded_file($_FILES['foto_barang']['tmp_name'], $folder . $foto_barang);
    }

    // Validasi input nama barang
    if (empty($nama_barang)) {
        echo "Data tidak valid. Pastikan nama barang diisi.";
    } else {
        // Buat query SQL
        $query = "INSERT INTO data_barang (kode_barang, nama_barang, no_registrasi, kode_pemilik, ruang_asal, ruang_sekarang, bid_ruang, tempat_ruang, tgl_pembelian, tgl_pembukuan, merk, type, kategori, ukuran_CC, no_pabrik, no_rangka, no_bpkb, bahan, no_mesin, no_polisi, kondisi_barang, masa_manfaat, harga_awal, harga_total, keterangan, foto_barang) 
        VALUES ('$kode_barang', '$nama_barang', '$no_registrasi', '$kode_pemilik', '$ruang_asal', '$ruang_sekarang', '$bid_ruang', '$tempat_ruang', '$tgl_pembelian', '$tgl_pembukuan', '$merk', '$type', '$kategori', '$ukuran_CC', '$no_pabrik', '$no_rangka', '$no_bpkb', '$bahan', '$no_mesin', '$no_polisi', '$kondisi_barang', '$masa_manfaat', $harga_awal, '$harga_total', '$keterangan', '$foto_barang')";

        // Jalankan query
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = true;
            header('Location: tambah_barang.php');
            exit();
        } else {
            // Check for duplicate entry error
            if (mysqli_errno($conn) == 1062) {
                $_SESSION['error'] = 'Duplikat Kode Barang. Data sudah ada.';
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            header('Location: frm_tambah_barang.php');
            exit();
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
            <form method="POST" action="" enctype="multipart/form-data">

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
                    <button type="button" class="btn btn-link" onclick="toggleAddPemilikForm()">Tambah Pemilik Baru</button>
                </div>

                <div id="addPemilikForm" style="display:none;" class="mb-3">
                    <label for="nama_pemilik" class="form-label">Nama Pemilik Baru</label>
                    <input type="text" name="nama_pemilik" class="form-control" id="nama_pemilik" required>
                </div>

                <script>
                function toggleAddPemilikForm() {
                    const form = document.getElementById('addPemilikForm');
                    form.style.display = form.style.display === 'none' ? 'block' : 'none';
                }
                </script>

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
                        <option value="kurang_baik">Kurang Baik</option>
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
