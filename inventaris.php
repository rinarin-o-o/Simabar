<?php 
include ('koneksi/koneksi.php'); // Include DB connection
include ("component/header.php");

// Fetch room data
$query = "SELECT id_lokasi, nama_lokasi FROM lokasi WHERE kategori_lokasi = 'Ruangan'";
$result = mysqli_query($conn, $query);
?>

<main id="main" class="main">

<div class="pagetitle">
    <h1>Inventaris</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Inventaris</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

<div class="col-lg-12">
    <div class="row">
        <?php 
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { 
                $id_lokasi = $row['id_lokasi'];
                $nama_ruang = $row['nama_lokasi'];
        ?>
        <div class="col-xxl-5 col-md-3 mb-4">
        <a href="inventaris_ruangan.php?nama_lokasi=<?php echo urlencode($nama_ruang); ?>" class="text-decoration-none text-dark">
                <div class="card info-card sales-card h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-house-door"></i>
                        </div>
                        
                        <div>
                            <h6 class="card-title mb-0 small-font"><?php echo htmlspecialchars($nama_ruang); ?></h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php 
            } 
        } else {
            echo "<p>No rooms found in the database.</p>";
        }
        ?>
    </div>
</div>
    </main>
<?php include ("component/footer.php"); ?>