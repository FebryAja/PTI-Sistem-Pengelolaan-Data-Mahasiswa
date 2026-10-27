<?php
session_start();
require_once "config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id = :id");
$stmt->execute([':id' => $id]);
$mhs = $stmt->fetch();

if (!$mhs) {
    header("Location: index.php");
    exit;
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim      = htmlspecialchars(trim($_POST['nim']));
    $nama     = htmlspecialchars(trim($_POST['nama']));
    $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $jurusan  = htmlspecialchars(trim($_POST['jurusan']));
    $angkatan = htmlspecialchars(trim($_POST['angkatan']));

    if (empty($nim) || empty($nama) || empty($email) || empty($jurusan) || empty($angkatan)) {
        $errors[] = "Semua bidang wajib diisi!";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email, jurusan = :jurusan, angkatan = :angkatan WHERE id = :id");
        $stmt->execute([
            ':nim' => $nim,
            ':nama' => $nama,
            ':email' => $email,
            ':jurusan' => $jurusan,
            ':angkatan' => $angkatan,
            ':id' => $id
        ]);
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Ubah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border border-secondary-subtle rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-body-secondary py-3">
                    <h5 class="m-0 fw-bold text-primary">Ubah Data Mahasiswa</h5>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger py-2">
                            <?php foreach ($errors as $e) echo $e; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label text-light fw-semibold small">NIM</label>
                            <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($mhs['nim']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-light fw-semibold small">NAMA LENGKAP</label>
                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($mhs['nama']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-light fw-semibold small">EMAIL</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($mhs['email']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-light fw-semibold small">JURUSAN</label>
                            <input type="text" name="jurusan" class="form-control" value="<?= htmlspecialchars($mhs['jurusan']); ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-light fw-semibold small">ANGKATAN</label>
                            <input type="number" name="angkatan" class="form-control" value="<?= htmlspecialchars($mhs['angkatan']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        <a href="index.php" class="btn btn-outline-secondary px-3 ms-2">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>