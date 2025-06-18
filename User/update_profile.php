<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: loginUser.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$telepon = $_POST['telepon'];
$password = $_POST['password'];
$foto_baru = $_FILES['foto']['name'];

$foto_path = '';
if (!empty($foto_baru)) {
    $target_dir = "upload/";
    $foto_path = $target_dir . basename($foto_baru);
    move_uploaded_file($_FILES["foto"]["tmp_name"], $foto_path);
}

// Update query
$query = "UPDATE users SET username=?, email=?, telepon=?";
$params = [$nama, $email, $telepon];
$types = "sss";

if (!empty($foto_baru)) {
    $query .= ", foto=?";
    $params[] = $foto_path;
    $types .= "s";
}

if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $query .= ", password=?";
    $params[] = $hashed;
    $types .= "s";
}

$query .= " WHERE id=?";
$params[] = $user_id;
$types .= "i";

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();

// Redirect kembali ke profil
header("Location: profil.php");
exit;
?>