<?php
session_start();
include('koneksi/koneksi.php'); // Include the database connection

// Query to get the number of Kendaraan categories in data_barang
$queryKendaraan = "SELECT COUNT(DISTINCT kategori) AS total_kendaraan FROM data_barang WHERE kategori = 'kendaraan'";
$resultKendaraan = mysqli_query($conn, $queryKendaraan);
$rowKendaraan = mysqli_fetch_assoc($resultKendaraan);
$totalKendaraan = $rowKendaraan['total_kendaraan'];

// Query to get the number of Ruangan categories in lokasi
$queryRuang = "SELECT COUNT(DISTINCT kategori_lokasi) AS total_ruang FROM lokasi WHERE kategori_lokasi = 'ruangan'";
$resultRuang = mysqli_query($conn, $queryRuang);
$rowRuang = mysqli_fetch_assoc($resultRuang);
$totalRuang = $rowRuang['total_ruang'];

// Query to get the number of Fasilitas Umum (Fasum) categories in lokasi
$queryFasum = "SELECT COUNT(DISTINCT kategori_lokasi) AS total_fasum FROM lokasi WHERE kategori_lokasi = 'fasilitas_umum'";
$resultFasum = mysqli_query($conn, $queryFasum);
$rowFasum = mysqli_fetch_assoc($resultFasum);
$totalFasum = $rowFasum['total_fasum'];

?>

<body>
<?php include('component/header.php'); ?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Ruangan Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Ruangan <span></span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-house-door"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $totalRuang; ?></h6> <!-- Dynamic value for total Ruangan -->
                      <span class="text-muted small pt-2 ps-1">Ruang</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Ruangan Card -->

            <!-- Kendaraan Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Kendaraan <span></span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-bus-front"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $totalKendaraan; ?></h6> <!-- Dynamic value for total Kendaraan -->
                      <span class="text-muted small pt-2 ps-1">Kendaraan</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Kendaraan Card -->

            <!-- Fasilitas Umum Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Fasilitas Umum</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $totalFasum; ?></h6> <!-- Dynamic value for total Fasum -->
                      <span class="text-muted small pt-2 ps-1">Fasum</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Fasilitas Umum Card -->

          </div><!-- End Left side columns -->

          <br><br><br><br><br><br><br><br><br><br><br>

</main>

<?php include('component/footer.php'); ?>
