<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        body {
            padding-top: 70px;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            padding-top: 60px; /* Lebih kecil dari sebelumnya */
            padding-bottom: 30px;
        }

        .kategori-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
            border-radius: 16px;
        }

        .kategori-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-weight: 600;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php
    $activePage = 'kategori';
    include 'navbar.php';
    ?>

    <!-- Konten Utama -->
    <main class="main-content container">
        <h2 class="text-center">Kategori Buku</h2>
        <div class="row justify-content-center">
            <?php
            $query = "SELECT * FROM kategori";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="col-6 col-sm-4 col-md-3 mb-4">
                    <div class="card kategori-card shadow-sm text-center p-3 border-0">
                        <div class="card-body">
                            <i class="fas fa-book fa-2x mb-2 text-primary"></i>
                            <h6 class="card-title fw-semibold">' . htmlspecialchars($row['nama_kategori']) . '</h6>
                            <a href="kategori_detail.php?id=' . $row['id_kategori'] . '" class="btn btn-outline-primary btn-sm mt-2">Lihat Buku</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
