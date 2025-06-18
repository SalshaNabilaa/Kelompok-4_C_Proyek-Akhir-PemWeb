<?php
session_start();
include 'db.php';

$query = '';
$hasil = [];

if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $query = trim($_GET['q']);
    $sql = "SELECT * FROM buku WHERE judul LIKE '%$query%' OR penulis LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);
    $hasil = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function safe($text) {
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Hasil Pencarian</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      padding-top: 80px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      flex: 1;
    }

    .book-list {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: flex-start;
    }

    .book-card {
      width: 160px;
      height: 320px;
      border-radius: 1rem;
      overflow: hidden;
      background: white;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: 0.3s;
      text-decoration: none;
      color: inherit;
    }

    .book-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }

    .book-card img {
      height: 200px;
      width: 100%;
      object-fit: cover;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
    }

    .book-card .card-body {
      padding: 10px 8px;
      display: flex;
      flex-direction: column;
      text-align: center;
      justify-content: space-between;
      height: 120px;
    }

    .book-card h6 {
      font-size: 0.9rem;
      font-weight: bold;
      margin-bottom: 4px;
    }

    .book-card p {
      font-size: 0.75rem;
      color: #555;
      margin: 0;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .price {
      font-weight: bold;
      color: navy;
      font-size: 0.85rem;
      margin-top: 6px;
    }
  </style>
</head>
<body>

<?php
$activePage = ''; // atau 'beranda' jika ingin menandai navbar
include 'navbar.php';
?>

<div class="container py-4">
  <?php if ($query): ?>
    <h5 class="mb-4 text-center">Hasil pencarian untuk "<strong><?= safe($query); ?></strong>"</h5>

    <?php if (count($hasil) > 0): ?>
      <div class="book-list">
        <?php foreach ($hasil as $b): ?>
          <a href="detail_buku.php?id=<?= $b['id_buku']; ?>" class="book-card">
            <img src="../Admin/uploads/<?= safe($b['foto']) ?: 'default.jpg'; ?>" alt="Cover <?= safe($b['judul']); ?>">
            <div class="card-body">
              <h6><?= safe($b['judul']); ?></h6>
              <p><?= safe($b['penulis']); ?></p>
              <div class="price">Rp <?= number_format($b['harga'], 0, ',', '.'); ?></div>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="text-center text-muted mt-4">Tidak ditemukan buku yang sesuai.</p>
    <?php endif; ?>
  <?php else: ?>
    <p class="text-center text-muted">Masukkan kata kunci pencarian pada kotak di atas.</p>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
