<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php'; // <--- Tambahkan ini agar bisa query ke database

$foto_profil = 'files/default.png'; // default

if (isset($_SESSION['foto']) && $_SESSION['foto'] !== '') {
    if (file_exists($_SESSION['foto'])) {
        $foto_profil = $_SESSION['foto'];
    }
} elseif (isset($_SESSION['user_id'])) {
    // Ambil data user dari database
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT profile FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $foto = $row['profile'];
        if (!empty($foto) && file_exists($foto)) {
            $foto_profil = $foto;
            $_SESSION['foto'] = $foto; // Simpan ke session biar efisien
        }
    }
}

$activePage = isset($activePage) ? $activePage : '';
?>


<!-- Navbar -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Navbar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    body {
      padding-top: 70px;
    }

    .navbar {
      height: 60px;
    }

    .navbar-brand img {
      height: 40px;
    }

    .search-wrapper {
      width: 400px;
      position: relative;
    }

    .search-input {
      width: 100%;
      border-radius: 30px;
      padding-left: 40px;
    }

    .search-wrapper i {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      color: #aaa;
      pointer-events: none;
    }

    .profil-img {
      width: 36px;
      height: 36px;
      object-fit: cover;
      border-radius: 50%;
      border: 1px solid #ccc;
    }

    @media (max-width: 576px) {
      .search-wrapper {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top w-100">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="image/Logo.png" alt="Logo">
    </a>

    <!-- Toggle button (mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <!-- Search -->
      <form class="d-flex mx-auto" role="search" action="pencarian.php" method="GET" autocomplete="off">
        <div class="search-wrapper">
          <i class="fas fa-search"></i>
          <input class="form-control search-input" type="search" name="q" placeholder="Cari buku..." aria-label="Search">
        </div>
      </form>

      <!-- Right Menu -->
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'beranda') ? 'active' : '' ?>" href="index.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($activePage == 'kategori') ? 'active' : '' ?>" href="kategori.php">Kategori</a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="profil.php" title="Profil Saya">
            <img src="<?= htmlspecialchars($foto_profil); ?>" alt="Profil" class="profil-img ms-2">
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
