<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['usernamesss']);
    $password = trim($_POST['passwordsss']);

    // Lindungi dari SQL Injection
    $username_safe = mysqli_real_escape_string($conn, $username);
    $password_safe = mysqli_real_escape_string($conn, $password);

    // Query cek user
    $sql = "SELECT * FROM pengguna WHERE usernames = '$username_safe' AND pw = MD5('$password_safe')";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        // Jika query gagal
        $_SESSION['error_message'] = "Terjadi kesalahan sistem. Silakan coba lagi.";
        header("Location: index.php");
        exit();
    }

    // Jika ditemukan data pengguna
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['usernames'] = $row['usernames']; // Simpan session login
        header("Location: home.php");
        exit();
    } else {
        // Login gagal
        $_SESSION['error_message'] = "Username atau password salah!";
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
