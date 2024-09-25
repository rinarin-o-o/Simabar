<?php
session_start();
include('component/header.php');
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Barang</h1>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form</h5>

            <!-- Form for adding new item -->
            <form method="POST" action="proses/tambah_barang.php" enctype="multipart/form-data">

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
                    <input type="text" name="no_registrasi" class="form-control" id="no_registrasi">
                </div>

                <div class="mb-3">
                    <label for="kode_pemilik" class="form-label">Kode Pemilik</label>
                    <input type="text" name="kode_pemilik" class="form-control" id="kode_pemilik">
                </div>

                <div class="mb-3">
                    <label for="nama_pemilik" class="form-label">Nama Pemilik (Jika Kode Pemilik Baru)</label>
                    <input type="text" name="nama_pemilik" class="form-control" id="nama_pemilik">
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
                    <label for="bid_ruang" class="form-label">Bid Ruang</label>
                    <input type="text" name="bid_ruang" class="form-control" id="bid_ruang">
                </div>

                <div class="mb-3">
                    <label for="tempat_ruang" class="form-label">Tempat Ruang</label>
                    <input type="text" name="tempat_ruang" class="form-control" id="tempat_ruang">
                </div>

                <div class="mb-3">
                    <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
                    <input type="date" name="tgl_pembelian" class="form-control" id="tgl_pembelian">
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
                    <label for="type" class="form-label">Tipe</label>
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
                    <input type="text" name="masa_manfaat" class="form-control" id="masa_manfaat">
                </div>

                <div class="mb-3">
                    <label for="harga_awal" class="form-label">Harga Awal</label>
                    <input type="number" name="harga_awal" class="form-control" id="harga_awal" step="0.01">
                </div>

                <div class="mb-3">
                    <label for="harga_total" class="form-label">Harga Total</label>
                    <input type="number" name="harga_total" class="form-control" id="harga_total" step="0.01">
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
                </div>

                <div class="mb-3">
                    <label for="foto_barang" class="form-label">Foto Barang</label>
                    <input type="file" name="foto_barang" class="form-control" id="foto_barang">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="Data_barang.php" class="btn btn-secondary">Batal</a>

            </form><!-- End form -->

        </div>
    </div>
</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>