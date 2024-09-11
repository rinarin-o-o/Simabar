<?php include("component/header.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Jadwal Penggunaan Ruang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Jadwal Penggunaan</li>
        <li class="breadcrumb-item active">Ruang</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Select Bulan dan Tahun dan Edit Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <form class="d-flex align-items-center" method="POST" action="#" id="filterForm">
      <!-- Dropdown untuk bulan -->
      <div class="dropdown-icon-wrapper position-relative">
      <select class="form-select" aria-label="Default select example">
          <option value="" disabled selected>Bulan</option>
          <option value="01">Januari</option>
          <option value="02">Februari</option>
          <option value="03">Maret</option>
          <option value="04">April</option>
          <option value="05">Mei</option>
          <option value="06">Juni</option>
          <option value="07">Juli</option>
          <option value="08">Agustus</option>
          <option value="09">September</option>
          <option value="10">Oktober</option>
          <option value="11">November</option>
          <option value="12">Desember</option>
        </select>
      </div>

      <!-- Dropdown untuk tahun -->
      <div class="dropdown-icon-wrapper position-relative">
      <select class="form-select" aria-label="Default select example">
        <option value="" disabled selected>Tahun</option>
            <?php
            $currentYear = date("Y");
            for($i = $currentYear; $i >= 2000; $i--) {
                echo "<option value='$i'>$i</option>";
            }
          ?>            
        </select>
      </div>
    </form>

    <button type="button" class="btn btn-primary">
      Edit Jadwal
    </button>
  </div><!-- End Select Bulan dan Tahun dan Edit Button -->

  <!-- Data Table -->
  <table class="table table-bordered">
    <thead class="table-secondary text-center">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Ruang A</th>
        <th scope="col">Ruang B</th>
        <th scope="col">Ruang C</th>
        <th scope="col">Ruang D </th>
        <th scope="col">Ruang E </th>
      </tr>
    </thead>
    <tbody>
      <tr class="text-center">
        <th scope="row">1</th>
        <td>...</td>
        <td>hari, tanggal, waktu</td>
        <td>...</td>
        <td>...</td>
        <td>...</td>
      </tr>
    </tbody>
  </table><!-- End Data Table -->

</main><!-- End Main Content -->

<?php include("component/footer.php"); ?>

<script>
// Mengubah ikon saat dropdown dibuka dan ditutup
document.getElementById('bulanDropdown').addEventListener('click', function () {
  toggleCaretIcon('bulanDropdown', 'bulanIcon');
});

document.getElementById('tahunDropdown').addEventListener('click', function () {
  toggleCaretIcon('tahunDropdown', 'tahunIcon');
});

function toggleCaretIcon(dropdownId, iconId) {
  var dropdown = document.getElementById(dropdownId);
  var icon = document.getElementById(iconId);
  
  // Toggle ikon antara caret up dan caret down
  dropdown.addEventListener('blur', function () {
    icon.classList.replace('bi-caret-up-fill', 'bi-caret-down-fill');
  });
  if (icon.classList.contains('bi-caret-down-fill')) {
    icon.classList.replace('bi-caret-down-fill', 'bi-caret-up-fill');
  } else {
    icon.classList.replace('bi-caret-up-fill', 'bi-caret-down-fill');
  }
}
</script>

<style>
/* CSS untuk menempatkan ikon caret di sebelah kanan */
.dropdown-icon-wrapper {
  position: relative;
}

.dropdown-icon {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none; /* Supaya tidak mengganggu interaksi dropdown */
}
</style>
