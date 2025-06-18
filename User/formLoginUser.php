<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Bookaku</title>
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

        .login-box {
            background: rgba(0, 123, 255, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            width: 350px;
            color: #fff;
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-control {
            border-radius: 10px;
        }

        .login-title {
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
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

        .login-button {
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;        
            padding: 6px 12px;
        }

        img.logo {
            height: 40px;
        }

        @media (max-width: 768px) {
            .tagline {
                display: none;
            }

            .login-box {
                left: 50%;
                width: 90%;
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

    <!-- Form Login -->
    <div class="login-box">
        <div class="login-title text-center">Login</div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="loginUser.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-light w-50 login-button" style="color: blue;">Login</button>
            </div>
           
        </form>

        <p class="mt-3 text-center text-white">
            Belum punya akun? <a href="formSignUp.php" class="text-white fw-bold">Daftar di sini</a>
        </p>
    </div>
        <!-- Tagline -->
    <div class="tagline">
        "Rekomendasi Cerdas untuk Pembaca Cerdas"
    </div>
</body>
</html>