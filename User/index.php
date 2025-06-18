<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginUser.php?error=Silakan login dulu.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beranda - Rekomendasi Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
  .hover-shadow:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
    transform: translateY(-4px);
  }
  body {
    padding-top: 70px; /* atau sesuai tinggi navbar */
}
</style>
<style>
  .book-card {
    max-width: 160px;
    margin: auto;
    border-radius: 1rem;
    height: 320px; /* Tambahkan tinggi tetap untuk semua kartu */
  }

  .book-card img {
    height: 200px;
    width: 100%;
    object-fit: cover;
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
  }

  .book-card .card-body {
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .book-card h6 {
    font-size: 0.85rem;
    margin: 0;
    line-height: 1.2em;
    height: 2.4em; /* untuk 2 baris */
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .book-card p {
    font-size: 0.75rem;
    margin: 0.25rem 0;
  }

  .truncate-text {
    max-width: 150px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin: 0 auto;
  }
</style>
</head>
<body>

<?php
include 'db.php'; 
$activePage = 'beranda';
include 'navbar.php';
?>

<!-- Kategori -->
<section class="container my-5">
  <div class="row justify-content-center g-4">
    <div class="col-6 col-md-3">
      <a href="kategori_detail.php?id=2" class="text-decoration-none text-dark">
        <div class="bg-white rounded-4 p-4 text-center shadow-sm hover-shadow transition" style="transition: all 0.3s;">
          <i class="fas fa-book-open fa-2x mb-2 text-primary"></i>
          <p class="fw-medium mb-0">Fiksi</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-3">
      <a href="kategori_detail.php?id=7" class="text-decoration-none text-dark">
        <div class="bg-white rounded-4 p-4 text-center shadow-sm hover-shadow transition" style="transition: all 0.3s;">
          <i class="fas fa-grin-squint-tears fa-2x mb-2 text-primary"></i>
          <p class="fw-medium mb-0">Komik</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-3">
      <a href="kategori_detail.php?id=8" class="text-decoration-none text-dark">
        <div class="bg-white rounded-4 p-4 text-center shadow-sm hover-shadow transition" style="transition: all 0.3s;">
          <i class="fas fa-child fa-2x mb-2 text-primary"></i>
          <p class="fw-medium mb-0">Anak - Anak</p>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- Buku Populer -->
<section class="container my-5">
  <h4 class="mb-4 fw-bold">Buku Populer</h4>
  <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-3">
    <?php
    $populer = $conn->query("SELECT * FROM buku ORDER BY id_buku ASC LIMIT 6");
    while ($b = $populer->fetch_assoc()):
    ?>
    <div class="col">
      <a href="detail_buku.php?id=<?= $b['id_buku'] ?>" class="text-decoration-none text-dark">
        <div class="card shadow-sm book-card">
          <img src="../Admin/uploads/<?= htmlspecialchars($b['foto']) ?>" class="card-img-top" alt="<?= htmlspecialchars($b['judul']) ?>">
          <div class="card-body text-center">
            <p class="text-muted small mb-1 truncate-text"><?= htmlspecialchars($b['penulis']) ?></p>
            <h6 class="card-title mb-1"><?= htmlspecialchars($b['judul']) ?></h6>
            <p class="fw-bold">Rp <?= number_format($b['harga'], 0, ',', '.') ?></p>
          </div>
        </div>
      </a>
    </div>
    <?php endwhile; ?>
  </div>
</section>

<!-- Buku Baru Dirilis -->
<section class="container my-5">
  <h4 class="mb-4 fw-bold">Buku Baru Dirilis</h4>
  <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-3">
    <?php
    $baru = $conn->query("SELECT * FROM buku ORDER BY id_buku DESC LIMIT 8");
    while ($b = $baru->fetch_assoc()):
    ?>
    <div class="col">
      <a href="detail_buku.php?id=<?= $b['id_buku'] ?>" class="text-decoration-none text-dark">
        <div class="card shadow-sm book-card">
          <img src="../Admin/uploads/<?= htmlspecialchars($b['foto']) ?>" class="card-img-top" alt="<?= htmlspecialchars($b['judul']) ?>">
          <div class="card-body text-center">
            <p class="text-muted small mb-1 truncate-text"><?= htmlspecialchars($b['penulis']) ?></p>
            <h6 class="card-title mb-1"><?= htmlspecialchars($b['judul']) ?></h6>
            <p class="fw-bold">Rp <?= number_format($b['harga'], 0, ',', '.') ?></p>
          </div>
        </div>
      </a>
    </div>
    <?php endwhile; ?>
  </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>