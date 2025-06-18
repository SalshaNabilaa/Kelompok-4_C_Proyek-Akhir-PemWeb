<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: formLoginAdmin.php");
    exit();
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Cari data admin berdasarkan username
$query = "SELECT * FROM admins WHERE username='$username'";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

if (!$admin) {
    $_SESSION['error'] = "Akun admin tidak ditemukan, silakan coba lagi.";
    header("Location: formLoginAdmin.php");
    exit();
}

if (password_verify($password, $admin['password'])) {
    $_SESSION['admin'] = $admin['username'];
    header("Location: index.php");
    exit();
} else {
    $_SESSION['error'] = "Password salah.";
    header("Location: formLoginAdmin.php");
    exit();
}
?>