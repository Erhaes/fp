<?php
session_start();
require 'connectDB.php';

// Jika admin sudah login, redirect ke halaman utama
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: index.php');
    exit;
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error_message = "Username dan password tidak boleh kosong.";
    } else {
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($admin = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $admin['password'])) {
                    // Password benar, mulai sesi
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_username'] = $admin['username'];
                    header('Location: ManageUsers.php');
                    exit;
                } else {
                    $error_message = "Username atau password salah.";
                }
            } else {
                $error_message = "Username atau password salah.";
            }
        } else {
            $error_message = "Terjadi kesalahan. Silakan coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9ecef;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card login-card shadow-sm">
            <div class="card-header text-center">
                <h3>Admin Login</h3>
            </div>
            <div class="card-body">
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <?php if (isset($_GET['error']) && $_GET['error'] == 'unauthorized'): ?>
                    <div class="alert alert-warning">Anda harus login untuk mengakses halaman tersebut.</div>
                <?php endif; ?>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
             <div class="card-footer text-center">
                <a href="index.php">Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
</body>
</html>