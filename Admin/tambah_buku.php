<?php
include 'db.php';

// Ambil ID kategori dari query string
$id_kategori = isset($_GET['kategori_id_buku']) && is_numeric($_GET['kategori_id_buku']) ? (int)$_GET['kategori_id_buku'] : 0;
if ($id_kategori <= 0) {
    header("Location: kelola_buku.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $penulis = trim($_POST['penulis'] ?? '');
    $penerbit = trim($_POST['penerbit'] ?? '');
    $tahun_terbit = trim($_POST['tahun_terbit'] ?? '');
    $jumlah_halaman = (int) ($_POST['jumlah_halaman'] ?? 0);
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $harga = (int) ($_POST['harga'] ?? 0);

    if ($judul && $penulis && $harga > 0 && !empty($_FILES['foto']['name'])) {
        $foto = basename($_FILES['foto']['name']);
        $tmp = $_FILES['foto']['tmp_name'];
        $upload_dir = 'uploads/';
        $path_foto = $upload_dir . $foto;

        if (move_uploaded_file($tmp, $path_foto)) {
            $stmt = $conn->prepare("INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, jumlah_halaman, deskripsi, harga, foto, id_kategori) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssisssi", $judul, $penulis, $penerbit, $tahun_terbit, $jumlah_halaman, $deskripsi, $harga, $foto, $id_kategori);
            if ($stmt->execute()) {
                header("Location: kelola_buku.php?id_kategori=$id_kategori");
                exit;
            } else {
                $error = "Gagal menyimpan data buku.";
            }
            $stmt->close();
        } else {
            $error = "Gagal mengunggah file cover.";
        }
    } else {
        $error = "Semua field wajib diisi dan cover harus dipilih.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Tambah Buku</h5>
        </div>
        <div class="card-body">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="text" name="tahun_terbit" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Halaman</label>
                    <input type="number" name="jumlah_halaman" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cover Buku</label>
                    <input type="file" name="foto" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="kelola_buku.php?id_kategori=<?= htmlspecialchars($id_kategori) ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>