<?php
session_start();
include 'db.php'; // File koneksi database

$user_id = $_SESSION['user_id'] ?? null;

$username = '';
$email = '';
$telepon = '';
$profile = '';

if ($user_id) {
    $query = "SELECT username, email, telepon, profile FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($username, $email, $telepon, $profile);
    $stmt->fetch();
    $stmt->close();

    // Tambahkan path folder
    if ($profile && file_exists("files/$profile")) {
        $profile = "files/$profile";
    } else {
        $profile = "files/default.png"; // default jika belum upload atau file hilang
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Profil Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #ffffff;
    }

    body {
      padding-top: 70px;
    }

    .wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .content {
      flex: 1;
      padding-top: 70px;
    }

    .profile-section {
      max-width: 700px;
      margin: auto;
      padding: 20px;
    }

    .profile-photo {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #dee2e6;
    }

    .profile-label {
      font-size: 0.9rem;
      color: #6c757d;
      margin-bottom: 2px;
    }

    .profile-value {
      font-size: 1.1rem;
      color: #212529;
      font-weight: 500;
    }

    .action-link a {
      font-size: 0.95rem;
      color: #0d6efd;
      text-decoration: none;
    }

    .action-link a:hover {
      text-decoration: underline;
    }

    .btn-group-custom {
      margin-top: 60px;
      display: flex;
      justify-content: center;
      gap: 1.5rem;
    }

    .btn-group-custom .btn {
      padding: 12px 28px;
      font-size: 1.1rem;
      font-weight: 600;
    }
  </style>
</head>
<body>
<div class="wrapper">
  <div class="content">
    <?php include 'navbar.php'; ?>

    <div class="profile-section">

      <div class="text-center mb-4">
        <img src="<?php echo $profile; ?>" class="profile-photo" alt="Foto Profil" />
      </div>

      <div class="row g-4 justify-content-center">
        <div class="col-md-5 p-3 border rounded bg-white text-center">
          <div class="profile-label">Username</div>
          <div class="profile-value"><?php echo htmlspecialchars($username); ?></div>
        </div>
        <div class="col-md-5 p-3 border rounded bg-white text-center">
          <div class="profile-label">Email</div>
          <div class="profile-value"><?php echo htmlspecialchars($email); ?></div>
        </div>
        <div class="col-md-5 p-3 border rounded bg-white text-center">
          <div class="profile-label">Kata Sandi</div>
          <div class="profile-value action-link"><a href="edit_profil.php">Atur Kata Sandi</a></div>
        </div>
        <div class="col-md-5 p-3 border rounded bg-white text-center">
          <div class="profile-label">No. Telepon</div>
          <div class="profile-value"><?php echo htmlspecialchars($telepon ?? ''); ?></div>
        </div>
      </div>

      <div class="btn-group-custom">
        <a href="edit_profil.php" class="btn btn-primary">Edit Profil</a>
        <a href="logout.php" class="btn btn-danger" onclick="return confirm('Yakin mau logout?')">Logout</a>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</div>
</body>
</html>