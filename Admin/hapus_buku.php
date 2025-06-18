<?php
include 'db.php';

// Validasi dan sanitasi input
$id_buku = isset($_GET['id_buku']) ? (int)$_GET['id_buku'] : 0;
$id_kategori = isset($_GET['kategori_id']) ? (int)$_GET['kategori_id'] : 0;

if ($id_buku <= 0 || $id_kategori <= 0) {
    die("ID buku atau ID kategori tidak valid.");
}

// Ambil nama file foto jika ada
$stmt = $conn->prepare("SELECT foto FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id_buku);
$stmt->execute();
$result = $stmt->get_result();
$buku = $result->fetch_assoc();
$stmt->close();

if (!$buku) {
    die("Data buku tidak ditemukan.");
}

// Hapus file foto jika ada dan file-nya ada di direktori
if (!empty($buku['foto'])) {
    $file_path = "uploads/" . $buku['foto'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }
}

// Hapus data buku dari database
$stmt = $conn->prepare("DELETE FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id_buku);
$stmt->execute();
$stmt->close();

$conn->close();

// Redirect kembali ke halaman kelola buku
header("Location: kelola_buku.php?id_kategori=" . $id_kategori);
exit;
?>
