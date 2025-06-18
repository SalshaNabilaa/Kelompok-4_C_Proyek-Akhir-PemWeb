<?php
include 'db.php';

// Validasi dan sanitasi input id_kategori
$id_kategori = isset($_GET['id_kategori']) ? (int)$_GET['id_kategori'] : 0;
if ($id_kategori <= 0) {
    die("ID kategori tidak valid.");
}

// Ambil nama kategori
$stmt = $conn->prepare("SELECT nama_kategori FROM kategori WHERE id_kategori = ?");
$stmt->bind_param("i", $id_kategori);
$stmt->execute();
$result = $stmt->get_result();
$kategori = $result->fetch_assoc();
if (!$kategori) {
    die("Kategori tidak ditemukan.");
}
$stmt->close();

// Filter pencarian
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Query buku dengan filter pencarian
if ($search !== '') {
    $search_param = "%$search%";
    $stmt = $conn->prepare("SELECT * FROM buku WHERE id_kategori = ? AND judul LIKE ? ORDER BY id_buku DESC");
    $stmt->bind_param("is", $id_kategori, $search_param);
} else {
    $stmt = $conn->prepare("SELECT * FROM buku WHERE id_kategori = ? ORDER BY id_buku DESC");
    $stmt->bind_param("i", $id_kategori);
}

$stmt->execute();
$buku = $stmt->get_result();


?>

<!DOCTYPE html>
<html>
<head>
  <title>Kelola Buku - <?= htmlspecialchars($kategori['nama_kategori']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    h3 span {
      color: #007bff;
    }
    .theme-box {
      background-color: rgba(0, 123, 255, 0.3);
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 25px;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
    }
    .btn-warning {
      background-color: #ffc107;
      border: none;
      color: #000;
    }
    .btn-danger {
      background-color: #dc3545;
      border: none;
    }
    .btn-info {
      background-color: #17a2b8;
      border: none;
      color: white;
    }
    .table th {
      background-color: #007bff;
      color: white;
    }
    img.thumb {
      width: 60px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .card {
      border: none;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      border-radius: 10px;
    }
    .form-control {
      border-radius: 8px;
    }
    .deskripsi-ellipsis {
  display: -webkit-box;
  -webkit-line-clamp: 3; /* maksimal 3 baris */
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-align: left;
  word-break: break-word;
  max-width: 300px;
  margin: 0 auto;
}

  </style>
</head>
<body>
<div class="container mt-5">
  <div class="theme-box">
    <h3 class="mb-3">📚 Buku Kategori: <span><?= htmlspecialchars($kategori['nama_kategori']) ?></span></h3>
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
      <div class="mb-2">
        <a href="tambah_buku.php?kategori_id_buku=<?= $id_kategori ?>" class="btn btn-primary me-2">+ Tambah Buku</a>
        <a href="index.php" class="btn btn-secondary">← Kembali</a>
      </div>
      <form method="get" class="d-flex align-items-center" action="">
        <input type="hidden" name="id_kategori" value="<?= $id_kategori ?>">
        <input 
          type="text" 
          name="search" 
          class="form-control me-2" 
          placeholder="Cari judul..." 
          value="<?= htmlspecialchars($search) ?>" 
          style="max-width: 250px;"
        >
        <button type="submit" class="btn btn-info me-2">Filter</button>
        <a href="kelola_buku.php?id_kategori=<?= $id_kategori ?>" class="btn btn-secondary">Reset</a>
      </form>
    </div>

    <div class="card">
      <div class="card-body">
        <?php if ($buku->num_rows > 0): ?>
        <table class="table table-bordered table-striped align-middle text-center">
          <thead>
            <tr>
              <th>Cover</th>
              <th>Judul</th>
              <th>Tentang Buku</th>
              <th>Deskripsi</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $buku->fetch_assoc()): ?>
            <tr>
              <td>
                <?php if ($row['foto'] && file_exists("uploads/" . $row['foto'])): ?>
                  <img src="uploads/<?= htmlspecialchars($row['foto']) ?>" class="thumb" alt="Cover Buku">
                <?php else: ?>
                  <span class="text-muted">Tidak ada gambar</span>
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($row['judul']) ?></td>
              <td class="text-start">
                <strong>Penulis:</strong> <?= htmlspecialchars($row['penulis'] ?? '') ?><br>
                <strong>Penerbit:</strong> <?= htmlspecialchars($row['penerbit'] ?? '') ?><br>
                <strong>Tahun Terbit:</strong> <?= htmlspecialchars($row['tahun_terbit'] ?? '') ?><br>
                <strong>Jumlah Halaman:</strong> <?= htmlspecialchars($row['jumlah_halaman'] ?? '') ?>
              </td>

              <td class="align-middle">
                <div class="deskripsi-ellipsis" title="<?= htmlspecialchars($row['deskripsi'] ?? '') ?>">
                  <?= htmlspecialchars($row['deskripsi'] ?? '') ?>
                </div>
              </td>


              <td>Rp<?= number_format($row['harga'], 2, ',', '.') ?></td>
              <td>
                <div class="d-flex justify-content-center gap-2">
                  <a href="edit_buku.php?id_buku=<?= $row['id_buku'] ?>&kategori_id=<?= $id_kategori ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="hapus_buku.php?id_buku=<?= $row['id_buku'] ?>&kategori_id=<?= $id_kategori ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                </div>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <?php else: ?>
          <p class="text-center text-muted">Data buku tidak ditemukan.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'footer_admin.php'; ?>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>