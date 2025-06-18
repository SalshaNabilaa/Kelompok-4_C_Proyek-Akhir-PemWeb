<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Bookaku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: url('image/book.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }

        .overlay {
            background: rgba(255, 255, 255, 0.4);
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            backdrop-filter: blur(4px);
        }

        .signup-box {
            background: rgba(0, 123, 255, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            width: 350px;
            color: #fff;
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-control {
            border-radius: 10px;
        }

        .signup-title {
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .brand {
            position: absolute;
            top: 30px;
            left: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #000;
        }

        img.logo {
            height: 40px;
        }

        .signup-button {
            border-radius: 20px;
            font-weight: bold;
            width: 150px;
            background-color: #ffffff;
            color: #007bff;
            border: none;
            margin: 0 auto;
            display: block;
        }

        .signup-button:hover {
            background-color: #e6e6e6;
        }

        a {
            color: #fff;
            font-weight: bold;
        }

        .tagline {
            font-weight: bold;
            font-size: 25px;
            position: absolute;
            top: 85%;
            left: 50%;
            transform: translate(-90%, -30%);
            color: #000;
            text-align: center;
            max-width: 300px;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .signup-box {
                width: 90%;
            }

            .tagline {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <!-- Logo -->
    <div class="brand">
        <img src="image/Logo.png" alt="Logo" class="logo">
    </div>

    <!-- Signup Form -->
    <div class="signup-box">
        <div class="signup-title">Sign Up</div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="signUp.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn signup-button">Sign Up</button>
        </form>

        <p class="mt-3 text-center text-white">
            Sudah punya akun? <a href="formLoginUser.php">Login di sini</a>
        </p>
    </div>

    <!-- Tagline -->
    <div class="tagline">
        "Rekomendasi Cerdas untuk Pembaca Cerdas"
    </div>
</body>
</html>