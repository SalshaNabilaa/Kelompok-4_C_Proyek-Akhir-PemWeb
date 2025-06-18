<?php
session_start();
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: kategori.php');
    exit;
}

$id_buku = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku = $id_buku");
$buku = mysqli_fetch_assoc($query);

if (!$buku) {
    echo "<h3>Buku tidak ditemukan.</h3>";
    exit;
}

function safe($text) {
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Detail Buku</title>
<style>
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #fff;
    color: #333;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .custom-container {
    max-width: 1000px;
    margin: auto;
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    flex: 1;
  }

  .book-image {
    width: 300px;
    height: 450px;
    object-fit: contain;
    display: block;
    margin: 0 auto;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f4f4f4;
    padding: 6px;
  }

  .book-details {
    flex: 1;
    min-width: 280px;
  }

  .title {
    font-weight: 700;
    font-size: 1.7rem;
    margin-bottom: 10px;
  }

  .author {
    font-size: 1rem;
    color: #555;
    margin-bottom: 16px;
    line-height: 1.4;
  }

  .price {
    font-weight: 700;
    font-size: 1.3rem;
    color: navy;
    margin-bottom: 12px;
  }

  .shipping-note {
    background-color: #e0f7fa;
    border: 1px solid #4dd0e1;
    border-radius: 8px;
    color: #007c91;
    padding: 12px 18px;
    font-size: 1rem;
    line-height: 1.5;
  }

  .shipping-note p {
    margin: 0;
  }

  @media (max-width: 768px) {
    .custom-container {
      flex-direction: column;
      align-items: center;
    }

    .book-details {
      text-align: center;
    }
  }
</style>
</head>
<body>

<?php
$activePage = 'kategori';
include 'navbar.php';
?>

<div class="custom-container">
  <img
    src="../Admin/uploads/<?php echo safe($buku['foto']) ?: 'default.jpg'; ?>"
    alt="Cover <?php echo safe($buku['judul']); ?>"
    class="book-image"
  />

  <div class="book-details">
    <div class="title"><?php echo safe($buku['judul']); ?></div>
    <div class="author">
      <?php echo safe($buku['penulis']); ?><br>
      Tahun Terbit: <?php echo safe($buku['tahun_terbit']); ?><br>
      Penerbit: <?php echo safe($buku['penerbit']); ?><br>
      Jumlah Halaman: <?php echo safe($buku['jumlah_halaman']); ?> halaman
    </div>

    <div class="price">Rp<?php echo number_format($buku['harga'], 0, ',', '.'); ?></div>

    <div class="shipping-note">
      <p><?php echo nl2br(safe($buku['deskripsi'])); ?></p>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
