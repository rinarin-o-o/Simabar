<?php
ob_start();
session_start();
include('koneksi/koneksi.php');
include('component/header.php');
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Tambah Lokasi</h1>
  </div><!-- End Page Title -->

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Form</h5>

      <!-- Form for adding new location -->
      <form id="addLocationForm" method="POST" action="">

        <div class="mb-3">
          <label for="id_lokasi" class="form-label">Kode Lokasi</label>
          <input type="text" name="id_lokasi" class="form-control" id="id_lokasi" required>
        </div>

        <div class="mb-3">
          <label for="nama_lokasi" class="form-label">Nama Lokasi</label>
          <input type="text" name="nama_lokasi" class="form-control" id="nama_lokasi" required>
        </div>

        <div class="mb-3">
          <label for="bid_lokasi" class="form-label">Bidang Lokasi</label>
          <input type="text" name="bid_lokasi" class="form-control" id="bid_lokasi" required>
        </div>

        <div class="mb-3">
          <label for="tempat_lokasi" class="form-label">Tempat Asal</label>
          <input type="text" name="tempat_lokasi" class="form-control" id="tempat_lokasi" required>
        </div>

        <div class="mb-3">
          <label for="kategori_lokasi" class="form-label">Kategori</label>
          <select name="kategori_lokasi" class="form-select" aria-label="Default select example" id="kategori_lokasi" required>
            <option value="" disabled selected>Pilih Kategori</option>
            <option value="ruangan">Ruangan</option>
            <option value="fasilitas_umum">Fasilitas Umum</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="desk_lokasi" class="form-label">Deskripsi Lokasi</label>
          <textarea name="desk_lokasi" class="form-control" id="desk_lokasi" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="lokasi.php" class="btn btn-secondary">Batal</a>

      </form><!-- End form -->

    </div>
  </div>

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('addLocationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menambah lokasi ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, tambah!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData(document.getElementById('addLocationForm'));

            fetch('proses/lokasi/tambah_lokasi.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('Error')) {
                    Swal.fire({
                        title: 'Error!',
                        text: data,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    window.location.href = 'lokasi.php';
                }
            });
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
