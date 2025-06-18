<?php
include 'db.php';

// Ambil id buku
$id_buku = isset($_GET['id_buku']) && is_numeric($_GET['id_buku']) ? (int)$_GET['id_buku'] : 0;
if ($id_buku <= 0) {
    header("Location: kelola_buku.php");
    exit;
}

// Ambil data buku
$stmt = $conn->prepare("SELECT * FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id_buku);
$stmt->execute();
$result = $stmt->get_result();
$buku = $result->fetch_assoc();
$stmt->close();

if (!$buku) {
    echo "Buku tidak ditemukan.";
    exit;
}

$kategori_id = $buku['id_kategori'] ?? 0;
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $penulis = trim($_POST['penulis'] ?? '');
    $penerbit = trim($_POST['penerbit'] ?? '');
    $tahun_terbit = trim($_POST['tahun_terbit'] ?? '');
    $jumlah_halaman = (int) ($_POST['jumlah_halaman'] ?? 0);
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $harga = (int) ($_POST['harga'] ?? 0);

    if ($judul && $penulis && $harga > 0) {
        if (!empty($_FILES['foto']['name'])) {
            $foto = basename($_FILES['foto']['name']);
            $tmp = $_FILES['foto']['tmp_name'];
            $upload_dir = 'uploads/';
            $path_foto = $upload_dir . $foto;

            if (move_uploaded_file($tmp, $path_foto)) {
                $update = $conn->prepare("UPDATE buku SET judul=?, penulis=?, penerbit=?, tahun_terbit=?, jumlah_halaman=?, deskripsi=?, harga=?, foto=? WHERE id_buku=?");
                $update->bind_param("ssssisssi", $judul, $penulis, $penerbit, $tahun_terbit, $jumlah_halaman, $deskripsi, $harga, $foto, $id_buku);
            } else {
                $error = "Gagal mengunggah file.";
            }
        } else {
            $update = $conn->prepare("UPDATE buku SET judul=?, penulis=?, penerbit=?, tahun_terbit=?, jumlah_halaman=?, deskripsi=?, harga=? WHERE id_buku=?");
            $update->bind_param("ssssissi", $judul, $penulis, $penerbit, $tahun_terbit, $jumlah_halaman, $deskripsi, $harga, $id_buku);
        }

        if (isset($update)) {
            if ($update->execute()) {
                header("Location: kelola_buku.php?id_kategori=$kategori_id");
                exit;
            } else {
                $error = "Gagal memperbarui buku.";
            }
            $update->close();
        }
    } else {
        $error = "Judul, penulis, dan harga wajib diisi dengan benar.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h5>Edit Buku</h5>
        </div>
        <div class="card-body">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($buku['judul'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="<?= htmlspecialchars($buku['penulis'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="<?= htmlspecialchars($buku['penerbit'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="text" name="tahun_terbit" class="form-control" value="<?= htmlspecialchars($buku['tahun_terbit'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Halaman</label>
                    <input type="number" name="jumlah_halaman" class="form-control" value="<?= htmlspecialchars($buku['jumlah_halaman'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"><?= htmlspecialchars($buku['deskripsi'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?= htmlspecialchars($buku['harga'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cover Baru (opsional)</label>
                    <input type="file" name="foto" class="form-control">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah cover.</small>
                </div>
                <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                <a href="kelola_buku.php?id_kategori=<?= htmlspecialchars($kategori_id) ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
