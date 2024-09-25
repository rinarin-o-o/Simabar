<?php
// Include the database connection
include("koneksi/koneksi.php");

if (isset($_GET['id'])) {
    // Get the kode_barang from the URL
    $kode_barang = mysqli_real_escape_string($conn, $_GET['id']);

    // SQL to delete the record from both barang_rusak and data_barang tables
    $deleteRusakQuery = "DELETE FROM barang_rusak WHERE kode_barang = '$kode_barang'";
    $deleteBarangQuery = "DELETE FROM data_barang WHERE kode_barang = '$kode_barang'";

    // Perform the deletion
    if (mysqli_query($conn, $deleteRusakQuery) && mysqli_query($conn, $deleteBarangQuery)) {
        // If successful, redirect to the data list page with success message
        header("Location: Data_barang_rusak.php?message=success");
    } else {
        // If failed, redirect with an error message
        header("Location: Data_barang_rusak.php?message=error");
    }

    // Close the connection
    mysqli_close($conn);
} else {
    // Redirect back if no id was provided
    header("Location: Data_barang_rusak.php");
}
?>