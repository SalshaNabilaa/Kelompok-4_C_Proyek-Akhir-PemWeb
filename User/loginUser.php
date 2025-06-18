<?php
session_start();

// Jika sudah login, langsung alihkan ke beranda
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// Jika bukan request POST, alihkan ke form login
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: formLoginUser.php");
    exit();
}

include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Cek user dengan prepared statement
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    $_SESSION['error'] = "Akun tidak tersedia, silakan daftar terlebih dahulu.";
    header("Location: formLoginUser.php");
    exit();
}

if (password_verify($password, $user['password'])) {
    // Set session dasar
    $_SESSION['user'] = $user['username'];
    $_SESSION['user_id'] = $user['id'];

    // Cek apakah profil sudah pernah diatur
    $profile_file = $user['profile'];
    if ($profile_file && file_exists("files/" . $profile_file)) {
        $_SESSION['foto'] = "files/" . $profile_file;
    } else {
        $_SESSION['foto'] = ''; // kosong → akan pakai default di navbar
    }

    header("Location: index.php");
    exit();
} else {
    $_SESSION['error'] = "Password salah.";
    header("Location: formLoginUser.php");
    exit();
}
