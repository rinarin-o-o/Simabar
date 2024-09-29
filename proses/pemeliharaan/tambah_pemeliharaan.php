<?php
include('../../koneksi/koneksi.php');
ob_start();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dengan validasi dasar
    $kode_barang = mysqli_real_escape_string($conn, $_POST['kode_barang']);
    $desk_pemeliharaan = mysqli_real_escape_string($conn, $_POST['desk_pemeliharaan']);
    $perbaikan = mysqli_real_escape_string($conn, $_POST['perbaikan']);
    $lama_perbaikan = (int) $_POST['lama_perbaikan']; // Pastikan ini angka
    $biaya_perbaikan = (int) $_POST['biaya_perbaikan']; // Pastikan ini angka

    // Periksa apakah tanggal perbaikan diisi, jika tidak maka masukkan NULL
    if (!empty($_POST['tgl_perbaikan'])) {
        $tgl_perbaikan = "'".mysqli_real_escape_string($conn, $_POST['tgl_perbaikan'])."'";
    } else {
        $tgl_perbaikan = "NULL";
    }

    // Cek apakah ada ID yang duplikat
    $loop_count = 0; // Tambahkan penghitung loop
    $max_loop = 10;  // Set batas maksimal loop

    do {
        // Buat ID Pemeliharaan baru secara otomatis
        $query_max_id = "SELECT MAX(id_pemeliharaan) AS max_id FROM data_pemeliharaan";
        $result_max_id = mysqli_query($conn, $query_max_id);
        $row_max_id = mysqli_fetch_assoc($result_max_id);
        
        // Jika ada ID pemeliharaan, ambil angkanya lalu increment
        if ($row_max_id['max_id']) {
            $last_id = $row_max_id['max_id'];
            $number = (int)substr($last_id, 3) + 1; // Ambil angka setelah 'MNT' dan tambah 1
        } else {
            $number = 1; // Jika belum ada data, mulai dari 1
        }

        // Format ID menjadi 'MNT' diikuti angka 8 digit
        $new_id_pemeliharaan = 'MNT' . str_pad($number, 7, '0', STR_PAD_LEFT);
        
        // Cek apakah ID yang dihasilkan sudah ada
        $check_query = "SELECT COUNT(*) as count FROM data_pemeliharaan WHERE id_pemeliharaan = '$new_id_pemeliharaan'";
        $check_result = mysqli_query($conn, $check_query);
        $check_row = mysqli_fetch_assoc($check_result);
        
        $loop_count++; // Tambahkan hitungan loop
        
        // Jika sudah lebih dari batas loop, tampilkan error
        if ($loop_count > $max_loop) {
            $_SESSION['error'] = 'Gagal mendapatkan ID unik setelah beberapa percobaan.';
            header('Location: ../../frm_tambah_pemeliharaan.php');
            exit();
        }
        
    } while ($check_row['count'] > 0); // Ulangi sampai mendapatkan ID yang unik

    // Query untuk memasukkan data pemeliharaan
    $query = "INSERT INTO data_pemeliharaan (id_pemeliharaan, kode_barang, desk_pemeliharaan, perbaikan, tgl_perbaikan, lama_perbaikan, biaya_perbaikan)
              VALUES ('$new_id_pemeliharaan', '$kode_barang', '$desk_pemeliharaan', '$perbaikan', $tgl_perbaikan, '$lama_perbaikan', $biaya_perbaikan)";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Set session success flag dan redirect ke Data_pemeliharaan.php
        $_SESSION['success'] = true;
        header('Location: ../../Data_pemeliharaan.php');
        exit();
    } else {
        // Tampilkan pesan error yang lebih informatif
        $_SESSION['error'] = 'Terjadi kesalahan saat menyimpan data: ' . mysqli_error($conn);
        header('Location: ../../frm_tambah_pemeliharaan.php');
        exit();
    }
}

// Tutup koneksi
mysqli_close($conn);
?>
