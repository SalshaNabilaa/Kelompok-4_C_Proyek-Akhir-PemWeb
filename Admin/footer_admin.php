<!-- index.php atau layout utama -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Judul Halaman</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1; /* konten akan dorong footer ke bawah */
    }

    .footer {
      background-color: #f1f1f1;
      font-size: 14px;
      text-align: center;
      padding: 10px 0;
      width: 100%;
    }

    .footer p {
      margin: 0;
      color: #333;
    }
  </style>
</head>
<body>
  <main>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; <?= date("Y") ?> Semua Hak Dilindungi.</p>
  </footer>
</body>
</html>
