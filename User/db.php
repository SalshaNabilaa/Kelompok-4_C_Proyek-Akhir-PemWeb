<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "projekWebtfix";

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

