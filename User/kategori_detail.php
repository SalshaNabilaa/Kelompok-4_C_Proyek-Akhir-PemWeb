<?php
session_start();
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: kategori.php');
    exit;
}

$id_kategori = intval($_GET['id']);
$query_kategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori = $id_kategori");
$data_kategori = mysqli_fetch_assoc($query_kategori);
$query_buku = mysqli_query($conn, "SELECT * FROM buku WHERE id_kategori = $id_kategori");

function safe($text) {
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku - <?php echo safe($data_kategori['nama_kategori']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        body {
            padding-top: 70px;
        }

        .book-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 20px;
        }

        .book-card {
            flex: 0 0 auto;
            width: 160px;
            height: 320px;
            border-radius: 1rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: 0.3s ease;
            background-color: white;
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
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }

        .book-card p,
        .book-card h6 {
            margin: 0;
            font-size: 0.75rem;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .book-card h6 {
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 4px;
            margin-bottom: 6px;
        }

        .book-card .fw-bold {
            font-size: 0.85rem;
            color: #000;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<?php
$activePage = 'kategori';
include 'navbar.php';
?>

<main class="flex-grow-1 container my-5">
    <h2 class="mb-4 text-center fw-semibold">Kategori: <?php echo safe($data_kategori['nama_kategori']); ?></h2>

    <?php if (mysqli_num_rows($query_buku) > 0): ?>
        <div class="book-list">
            <?php while ($b = mysqli_fetch_assoc($query_buku)): ?>
                <a href="detail_buku.php?id=<?php echo $b['id_buku']; ?>" class="text-decoration-none text-dark">
                    <div class="book-card">
                        <img src="../Admin/uploads/<?php echo safe($b['foto']) ?: 'default.jpg'; ?>" alt="Cover <?php echo safe($b['judul']); ?>">
                        <div class="card-body">
                            <p class="text-muted"><?php echo safe($b['penulis']); ?></p>
                            <h6><?php echo safe($b['judul']); ?></h6>
                            <p class="fw-bold">Rp <?php echo number_format($b['harga'], 0, ',', '.'); ?></p>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Belum ada buku untuk kategori ini.</p>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="kategori.php" class="btn btn-secondary btn-sm rounded-pill px-4 py-2">Kembali ke Kategori</a>
    </div>
</main>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
