<?php
session_start();
$_SESSION = []; // kosongkan session
session_destroy();

// Hapus cookie session jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

header("Location: formLoginUser.php"); // arahkan langsung ke form login
exit;
