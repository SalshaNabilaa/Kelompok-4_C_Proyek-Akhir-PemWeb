<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: LoginAdmin.php");
    exit();
}
include 'db.php';

// Inisialisasi variabel pencarian
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Query data kategori dengan filter jika ada pencarian
$sql = "SELECT * FROM kategori";
if (!empty($search)) {
    $search_sql = mysqli_real_escape_string($conn, $search);
    $sql .= " WHERE nama_kategori LIKE '%$search_sql%'";
}
$sql .= " ORDER BY id_kategori ASC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Kategori</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body { 
      background-color: #f8f9fa; 
      font-family: 'Poppins', sans-serif;
    }
    .table th { 
      background-color: #0d6efd; 
      color: white; 
    }
    /* Baru: Center text horizontal & vertical di th dan td */
    .table th, .table td {
      text-align: center;
      vertical-align: middle;
    }
    .btn:hover { 
      opacity: 0.9; 
      transform: translateY(-2px); 
      transition: all 0.3s ease; 
    }
    .btn-primary { background-color: #0d6efd; border: none; }
    .btn-info { background-color: #0dcaf0; border: none; }
    .btn-warning { background-color: #ffc107; border: none; }
    .btn-danger { background-color: #dc3545; border: none; }
    .container { 
      margin-top: 40px;
      background-color: rgba(0, 123, 255, 0.3);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }
    h2 { 
      color: #212529; 
      font-weight: 600; 
      margin-bottom: 25px; 
    }
    .table { 
      border-radius: 10px; 
      overflow: hidden; 
      background-color: white; 
    }
    .filter-bar {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #0d6efd;
    }
  </style>
</head>
<body>
<div class="container">
  <!-- Bar atas: Judul kiri dan tombol logout kanan -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-0">📚 Manajemen Kategori Buku</h2>
        <a href="logout.php" class="btn btn-outline-danger btn-sm" 
          onclick="return confirm('Apakah Anda yakin ingin logout?')">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>


  <!-- Filter & Pencarian -->
  <form method="GET" class="filter-bar">
    <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit" class="btn btn-info">Filter</button>
    <a href="index.php" class="btn btn-secondary">Reset</a>
  </form>

  <a href="tambah_kategori.php" class="btn btn-primary mb-3">
    <i class="fas fa-plus"></i> Tambah Kategori
  </a>

  <table class="table table-bordered table-striped shadow-sm">
    <thead>
      <tr>
        <th>Nama Kategori</th>
        <th>Aksi</th>
        <th>Kelola Buku</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) { 
      ?>
        <tr>
          <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
          <td>
            <a href="edit_kategori.php?id=<?= $row['id_kategori'] ?>" class="btn btn-warning btn-sm">
              <i class="fas fa-edit"></i> Edit
            </a>
            <a href="hapus_kategori.php?id=<?= $row['id_kategori'] ?>" class="btn btn-danger btn-sm"
               onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
              <i class="fas fa-trash"></i> Hapus
            </a>
          </td>
          <td>
            <a href="kelola_buku.php?id_kategori=<?= $row['id_kategori'] ?>" class="btn btn-info btn-sm">
              <i class="fas fa-book"></i> Kelola
            </a>
          </td>
        </tr>
      <?php 
        }
      } else {
      ?>
        <tr>
          <td colspan="3" class="text-center">Tidak ada data kategori ditemukan.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer_admin.php'; ?>
</body>
</html>