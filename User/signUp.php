<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$email    = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Cek apakah username atau email sudah ada
$check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");
if (mysqli_num_rows($check) > 0) {
    $_SESSION['error'] = "Akun dengan username atau email tersebut sudah ada.";
    header("Location: formSignUp.php");
    exit();
}

// Set foto profil default
$default_profile = 'files/default.jpeg';

// Simpan akun baru dengan profil default
$query = "INSERT INTO users (username, email, password, profile) VALUES ('$username', '$email', '$password', '$default_profile')";
if (mysqli_query($conn, $query)) {
    $_SESSION['success'] = "Akun berhasil dibuat. Silakan login.";
    header("Location: formSignUp.php");
    exit();
} else {
    $_SESSION['error'] = "Terjadi kesalahan saat menyimpan data.";
    header("Location: formSignUp.php");
    exit();
}
