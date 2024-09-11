<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SiMabar</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="images/favicon.png" rel="icon">
  <link href="images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="vendor/simple-datatables/style.css" rel="stylesheet">
  
  <!-- Template Main CSS File -->
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
      <a href="index.html" class="logo d-flex align-items-center" style="margin-left: 20px;">
        <img src="images/logo.png" alt="">
        <span class="d-none d-lg-block">SiMabar</span>
      </a>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">       

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="images/profil.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Bambang</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Mas Bambang</h6>
              <span>Admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>        
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>

  </header>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="home.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">   
        <a class="nav-link collapsed" data-bs-target="#data-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-archive"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="data-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="inventaris.php">
              <i class="bi bi-circle"></i><span>Inventaris</span>
            </a>
          </li>
          <li>
            <a href="data_barang.php">
              <i class="bi bi-circle"></i><span>Data Barang</span>
            </a>
          </li>
          <li>
            <a href="lokasi.php">
              <i class="bi bi-circle"></i><span>Lokasi</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-event"></i><span>Report</span><i class="bi bi-chevron-down ms-auto"></i>
        </a> 
        <ul id="report-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="olah_barcode_barang.php">
              <i class="bi bi-circle"></i><span>Data Barcode Barang</span>
            </a>
          </li>
          <li>
            <a href="Data_mutasi_barang.php">
              <i class="bi bi-circle"></i><span>Data Mutasi Barang</span>
            </a>
          </li>
          <li>
            <a href="Data_barang_rusak.php">
              <i class="bi bi-circle"></i><span>Data Barang Rusak</span>
            </a>
          </li>
          <li>
            <a href="Data_pemeliharaan.php">
              <i class="bi bi-circle"></i><span>Data Pemeliharaan</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#jadwal-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-event"></i><span>Jadwal Penggunaan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a> 
        <ul id="jadwal-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="jadwal_ruang.php">
              <i class="bi bi-circle"></i><span>Ruang</span>
            </a>
          </li>
          <li>
            <a href="jadwal_kendaraan.php">
              <i class="bi bi-circle"></i><span>Kendaraan</span>
            </a>
          </li>
          <li>
            <a href="jadwal_fasum.php">
              <i class="bi bi-circle"></i><span>Fasilitas Umum</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="panduan_umum.php">
          <i class="bi bi-question-circle"></i>
          <span>Panduan Umum</span>
        </a>
      </li>

    </ul> 

  </aside>

  <!-- Vendor JS Files -->
  <script src="vendor/apexcharts/apexcharts.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/chart.js/chart.umd.js"></script>
  <script src="vendor/echarts/echarts.min.js"></script>

  <!-- Custom JS -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Handle sidebar toggle
      document.querySelector('.toggle-sidebar-btn').addEventListener('click', function() {
        document.querySelector('#sidebar').classList.toggle('collapsed');
      });

      // Handle collapse of sidebar nav items
      document.querySelectorAll('.sidebar-nav .nav-link[data-bs-toggle="collapse"]').forEach(function(link) {
        link.addEventListener('click', function() {
          var target = document.querySelector(this.getAttribute('data-bs-target'));
          
          // Close other open collapsibles
          document.querySelectorAll('.sidebar-nav .collapse.show').forEach(function(collapse) {
            if (collapse !== target) {
              var bsCollapse = new bootstrap.Collapse(collapse, {toggle: false});
              bsCollapse.hide();
            }
          });
          
          // Toggle the clicked collapse
          var bsCollapse = new bootstrap.Collapse(target);
          bsCollapse.toggle();
        });
      });
    });
  </script>

</body>

</html>
