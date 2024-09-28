<?php include("component/header.php"); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Mutasi Barang</h1>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form </h5>
            <!-- Form to add mutation -->
            <form action="proses/mutasi/tambah_mutasi.php" method="POST">
                <div class="row mb-3">
                    <label for="kode_barang" class="col-sm-4 col-form-label">Kode Barang</label>
                    <div class="col-sm-8">
                        <select id="kode_barang" name="kode_barang" class="form-select" onchange="updateRuang()">
                            <option value="">Pilih Kode Barang</option>
                            <?php
                            // Fetch kode_barang and nama_barang from data_barang
                            $conn = mysqli_connect("localhost", "root", "", "db_simabar");
                            $query = "SELECT kode_barang, nama_barang, ruang_asal, ruang_sekarang FROM data_barang";
                            $result = mysqli_query($conn, $query);
                            $barangData = [];
                            while ($row = mysqli_fetch_assoc($result)) {
                                $barangData[$row['kode_barang']] = $row;
                                echo "<option value='{$row['kode_barang']}'>{$row['kode_barang']} - {$row['nama_barang']}</option>";
                            }
                            mysqli_close($conn);
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama_barang" class="col-sm-4 col-form-label">Nama Barang</label>
                    <div class="col-sm-8">
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="ruang_asal" class="col-sm-4 col-form-label">Ruang Asal</label>
                    <div class="col-sm-8">
                        <input type="text" id="ruang_asal" name="ruang_asal" class="form-control" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="ruang_sekarang" class="col-sm-4 col-form-label">Ruang Sekarang</label>
                    <div class="col-sm-8">
                        <input type="text" id="ruang_sekarang" name="ruang_sekarang" class="form-control" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jenis_mutasi" class="col-sm-4 col-form-label">Jenis Mutasi</label>
                    <div class="col-sm-8">
                        <input type="text" id="jenis_mutasi" name="jenis_mutasi" class="form-control">
                    </div>
                </div>

                <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

                <div class="row mb-3">
                    <label for="tgl_mutasi" class="col-sm-4 col-form-label">Tanggal Mutasi</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="text" id="tgl_mutasi" name="tgl_mutasi" class="form-control" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
                </div>

                <script>
                    $(function() {
                        $("#tgl_mutasi").datepicker({
                            dateFormat: 'mm/dd/yy'
                        });
                    });
                </script>



                <div class="row mb-3">
                    <label for="PIC" class="col-sm-4 col-form-label">Penanggung Jawab</label>
                    <div class="col-sm-8">
                        <input type="text" id="PIC" name="PIC" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                        <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Tambah Mutasi</button>
                </div>
            </form><!-- End General Form Elements -->
        </div>
    </div>
</main>

<script>
    // JavaScript to update ruang_asal and ruang_sekarang
    let barangData = <?php echo json_encode($barangData); ?>;

    function updateRuang() {
        let kodeBarang = document.getElementById('kode_barang').value;
        if (barangData[kodeBarang]) {
            document.getElementById('nama_barang').value = barangData[kodeBarang].nama_barang;
            document.getElementById('ruang_asal').value = barangData[kodeBarang].ruang_asal;
            document.getElementById('ruang_sekarang').value = barangData[kodeBarang].ruang_sekarang;
        } else {
            document.getElementById('nama_barang').value = '';
            document.getElementById('ruang_asal').value = '';
            document.getElementById('ruang_sekarang').value = '';
        }
    }
</script>

<?php include("component/footer.php"); ?>