<?php
session_start();
include('koneksi/koneksi.php'); // Include DB connection

// Handle search query if provided
$query = isset($_POST['query']) ? mysqli_real_escape_string($conn, $_POST['query']) : '';

// Pagination settings
$rows_per_page = 10; // Number of rows per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $rows_per_page;

// Count the total number of rows
$sql_count = "SELECT COUNT(*) as total FROM lokasi WHERE nama_lokasi LIKE '%$query%' OR id_lokasi LIKE '%$query%'";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_rows = $row_count['total'];
$total_pages = ceil($total_rows / $rows_per_page);

// Fetch location data from the database with pagination
$sql = "SELECT * FROM lokasi WHERE nama_lokasi LIKE '%$query%' OR id_lokasi LIKE '%$query%' LIMIT $offset, $rows_per_page";
$result = mysqli_query($conn, $sql);
?>

<?php include("component/header.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Daftar Lokasi</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Lokasi</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Search Bar and Add Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <form class="search-form d-flex align-items-center" method="POST" action="">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword" class="form-control me-2" value="<?php echo htmlspecialchars($query); ?>">
      <button type="submit" title="Search" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
    </form>
    <a href="frm_tambah_lokasi.php" class="btn btn-primary">
      <i class="bi bi-plus"></i> Tambah Data
    </a>
  </div><!-- End Search Bar and Add Button -->

  <!-- Data Table -->
  <table class="table table-bordered">
    <thead class="table-secondary text-center">
      <tr>
        <th scope="col" style="width: 5%;">No</th>
        <th scope="col" style="width: 10%;">Kode Lokasi</th>
        <th scope="col" style="width: 20%;">Nama Lokasi</th>
        <th scope="col" style="width: 15%;">Bidang</th>
        <th scope="col" style="width: 20%;">Tempat Asal</th>
        <th scope="col" style="width: 20%;">Deskripsi</th>
        <th scope="col" style="width: 10%;">Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php
$no = $offset + 1;
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr class='text-center'>";
  echo "<th scope='row'>{$no}</th>";
  echo "<td>{$row['id_lokasi']}</td>";
  echo "<td>{$row['nama_lokasi']}</td>";
  echo "<td>{$row['bid_lokasi']}</td>";
  echo "<td>{$row['tempat_lokasi']}</td>";
  echo "<td>{$row['desk_lokasi']}</td>";
  echo "<td>
          <a href='frm_edit_lokasi.php?id_lokasi={$row['id_lokasi']}' class='btn btn-warning btn-sm' title='Edit'>
            <i class='bi bi-pencil'></i>
          </a>
          <button class='btn btn-danger btn-sm btn-hapus' data-id_lokasi='{$row['id_lokasi']}' title='Hapus'>
            <i class='bi bi-trash'></i>
          </button>
        </td>";
  echo "</tr>";
  $no++;
}
?>


    </tbody>
  </table>

  <!-- Pagination centered -->
  <?php if ($total_rows > $rows_per_page): ?>
  <nav aria-label="Page navigation example" class="d-flex justify-content-center">
    <ul class="pagination">
      <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
        <a class="page-link" href="?page=<?php echo max($page - 1, 1); ?>" tabindex="-1" aria-disabled="true">Previous</a>
      </li>
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
      <?php endfor; ?>
      <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
        <a class="page-link" href="?page=<?php echo min($page + 1, $total_pages); ?>">Next</a>
      </li>
    </ul>
  </nav><!-- End Pagination -->
  <?php endif; ?>

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Event handler untuk tombol hapus
    $('.btn-hapus').on('click', function() {
        // Ambil id_lokasi dari atribut data
        var id_lokasi = $(this).data('id_lokasi');

        // Tampilkan popup SweetAlert2
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke halaman hapus
                window.location.href = 'proses/lokasi/hapus_lokasi.php?id_lokasi=' + id_lokasi;
            }
        });
    });
});
</script>
