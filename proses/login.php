<?php
session_start();
include '../koneksi/koneksi.php'; // Update with your actual connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to the admin table with a prepared statement to prevent SQL injection
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the username is found in the admin table
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        // Verify password using password_verify() if passwords are hashed
        if(password_verify($password, $row['password'])){
            // If password is verified, set session and redirect to the admin dashboard
            $_SESSION['admin_name'] = $row['nama_admin']; // Use 'name' from admin table for admin name
            $_SESSION['admin_id'] = $row['id_admin']; // Use 'id' from admin table for admin id
            header('location:../home.php'); // Redirect to dashboard after successful login
            exit();
        } else {
            // If password does not match, show alert and redirect to login page
            echo "<script>
                alert('Username atau Password salah, ulangi!');
                window.location = '../login_admin.php';
                </script>";
            exit();
        }
    } else {
        // If no username is found, show alert and redirect to login page
        echo "<script>
            alert('Username atau Password salah, ulangi!');
            window.location = '../login_admin.php';
            </script>";
        exit();
    }
} else {
    // If the request method is not POST, redirect to the login page
    header('location:../login_admin.php');
    exit();
}
?>
