<?php
include "db.php";
session_start();

$id = $_SESSION['user_id'] ?? null;

if (!$id) {
    echo "Akses ditolak. Silakan login kembali.";
    exit;
}

$data_query = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");

if (!$data_query || mysqli_num_rows($data_query) === 0) {
    echo "Data tidak ditemukan.";
    exit;
}

$data = mysqli_fetch_assoc($data_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Edit Profil</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($data['username'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control" value="<?= htmlspecialchars($data['telepon'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Foto Profil</label>
            <input type="file" name="file" class="form-control">
            <small>Foto saat ini: <?= htmlspecialchars($data['profile'] ?? 'profile.jpeg') ?></small>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="profil.php" class="btn btn-secondary">Kembali</a>
    </form>

<?php
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $password = $_POST['password'];

    $new_password = $password ? password_hash($password, PASSWORD_DEFAULT) : $data['password'];
    $upload_folder = "files/";
    $file_name = $data['profile']; // pakai yang lama kalau tidak upload baru

    // Jika ada file diupload
    if (isset($_FILES['file']) && $_FILES['file']['name']) {
        $upload = $_FILES['file'];
        $file_ext = strtolower(pathinfo($upload['name'], PATHINFO_EXTENSION));
        $file_name_new = uniqid('foto_', true) . '.' . $file_ext;
        $target_file = $upload_folder . $file_name_new;

        if (!is_dir($upload_folder)) {
            mkdir($upload_folder, 0777, true);
        }

        if (move_uploaded_file($upload['tmp_name'], $target_file)) {
            // Hapus foto lama jika bukan default
            if ($data['profile'] && file_exists($upload_folder . $data['profile']) && $data['profile'] !== 'profile.jpeg') {
                unlink($upload_folder . $data['profile']);
            }
            $file_name = $file_name_new;
        } else {
            echo "<div class='alert alert-danger mt-3'>Upload file gagal.</div>";
            exit;
        }
    }

    // Simpan perubahan ke database
    $stmt = $conn->prepare("UPDATE users SET username=?, email=?, telepon=?, password=?, profile=? WHERE id=?");
    $stmt->bind_param("sssssi", $username, $email, $telepon, $new_password, $file_name, $id);
    $stmt->execute();
    $stmt->close();

    // Perbarui session untuk foto di navbar
    $_SESSION['foto'] = $upload_folder . $file_name;

    echo "<script>alert('Data berhasil diupdate'); window.location.href='profil.php';</script>";
}
?>
</body>
</html>
