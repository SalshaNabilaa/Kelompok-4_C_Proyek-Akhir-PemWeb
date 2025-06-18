<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
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

        .login-button {
            border-radius: 20px;
            font-weight: bold;
            width: 150px;
            background-color: #fff;
            color: #dc3545;
            border: none;
            margin: 0 auto;
            display: block;
        }

        .login-button:hover {
            background-color: #e6e6e6;
        }

        .tagline-admin {
            font-weight: bold;
            font-size: 25px;
            position: absolute;
            top: 15%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #000;
            text-align: center;
        }

        @media (max-width: 768px) {
            .login-box {
                width: 90%;
            }

            .tagline-admin {
                top: 10%;
                font-size: 20px;
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

    <!-- Tagline Admin -->
    <div class="tagline-admin">
        Hello, Admin!
    </div>

    <!-- Form Login Admin -->
    <div class="login-box">
        <div class="login-title">Login Admin</div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="loginAdmin.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>

            <button type="submit" class="btn login-button">Login</button>
        </form>
    </div>
</body>
</html>