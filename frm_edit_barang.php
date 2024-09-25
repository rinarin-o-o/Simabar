<?php include("component/header.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Edit Barang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item"><a href="data_barang.php">Data Barang</a></li>
        <li class="breadcrumb-item active">Edit Barang</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Edit Form -->
  <form action="update_barang.php" method="POST">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Edit Barang</h5>

        <!-- ID (Hidden field) -->
        <input type="hidden" name="id" value="001"> <!-- Example id -->

        <div class="row mb-3">
          <label for="no_reg" class="col-sm-2 col-form-label">No. Registrasi</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="no_reg" name="no_reg" value="01/01/2000">
          </div>
        </div>

        <div class="row mb-3">
          <label for="kode_pemilik" class="col-sm-2 col-form-label">Kode Pemilik</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="kode_pemilik" name="kode_pemilik" value="1.3.2.05">
          </div>
        </div>

        <div class="row mb-3">
          <label for="kode_barang" class="col-sm-2 col-form-label">Kode Aset/Kode Barang</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="003.001.008">
          </div>
        </div>

        <div class="row mb-3">
          <label for="ruang_asal" class="col-sm-2 col-form-label">Ruang Asal</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="ruang_asal" name="ruang_asal" value="Kantor Pusat">
          </div>
        </div>

        <div class="row mb-3">
          <label for="ruang_sekarang" class="col-sm-2 col-form-label">Ruang Sekarang</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="ruang_sekarang" name="ruang_sekarang" value="Ruang Kerja Pegawai">
          </div>
        </div>

        <div class="row mb-3">
          <label for="nama_bidang" class="col-sm-2 col-form-label">Nama Ruang/Bidang</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" value="Bidang Administrasi">
          </div>
        </div>

        <div class="row mb-3">
          <label for="tanggal_pembelian" class="col-sm-2 col-form-label">Tanggal Pembelian</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="2000-01-01">
          </div>
        </div>

        <div class="row mb-3">
          <label for="merk" class="col-sm-2 col-form-label">Merk</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="merk" name="merk" value="ABC Furniture">
          </div>
        </div>

        <div class="row mb-3">
          <label for="type" class="col-sm-2 col-form-label">Type</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="type" name="type" value="MKP-001">
          </div>
        </div>

        <div class="row mb-3">
          <label for="harga" class="col-sm-2 col-form-label">Harga</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="harga" name="harga" value="68750">
          </div>
        </div>

        <div class="row mb-3">
          <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="keterangan" name="keterangan">Digunakan di ruang kerja administrasi</textarea>
          </div>
        </div>

        <div class="row mb-3">
          <label for="foto" class="col-sm-2 col-form-label">Foto</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="foto" name="foto">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="Data_barang.php" class="btn btn-secondary">Batal</a>
          </div>
        </div>

      </div>
    </div><!-- End Form -->

  </form>

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>
