<?php
session_start();
include '../koneksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row['password']) { // Adjust according to your password storage method
            $_SESSION['admin_id'] = $row['id_admin'];
            $_SESSION['admin_name'] = $row['nama_admin'];
            header('Location: ../home.php');
            exit();
        } else {
            echo "<script>
                alert('Username atau Password salah, ulangi!');
                window.location = '../login_admin.php';
                </script>";
            exit();
        }
    } else {
        echo "<script>
            alert('Username atau Password salah, ulangi!');
            window.location = '../login_admin.php';
            </script>";
        exit();
    }
} else {
    header('Location: ../login_admin.php');
    exit();
}
?>
