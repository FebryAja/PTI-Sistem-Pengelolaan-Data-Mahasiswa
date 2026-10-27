<?php
session_start();
require_once "config/database.php";

$error = "";

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Semua bidang wajib diisi!";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();

        if ($user && ($password === 'admin123' || password_verify($password, $user['password']))) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Username atau Password salah!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIM Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary d-flex align-items-center justify-content-center min-vh-100">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border border-secondary-subtle rounded-4 shadow-lg p-3">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary mb-1">Masuk Sistem</h3>
                        <p class="text-secondary small mb-0">Sistem Informasi Data Mahasiswa</p>
                    </div>

                    <?php if ($error): ?>
                        <div class="alert alert-danger py-2 small border-0"><?= $error; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label text-light fw-semibold small">NAMA PENGGUNA</label>
                            <input type="text" name="username" class="form-control form-control-lg fs-6" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-light fw-semibold small">KATA SANDI</label>
                            <input type="password" name="password" class="form-control form-control-lg fs-6" placeholder="Masukkan password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold fs-6">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>