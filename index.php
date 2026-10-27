<?php
session_start();
require_once "config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Menangani Pencarian Data
$keyword = $_GET['keyword'] ?? '';

if (!empty($keyword)) {
    // Kueri pencarian berdasarkan NIM, Nama, Email, Jurusan, atau Angkatan
    $stmt = $pdo->prepare("SELECT * FROM mahasiswa 
                           WHERE nim LIKE :kw 
                           OR nama LIKE :kw 
                           OR email LIKE :kw 
                           OR jurusan LIKE :kw 
                           OR angkatan LIKE :kw 
                           ORDER BY id DESC");
    $stmt->execute([':kw' => "%$keyword%"]);
} else {
    // Ambil seluruh data jika tidak ada pencarian
    $stmt = $pdo->query("SELECT * FROM mahasiswa ORDER BY id DESC");
}

$mahasiswa = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIM Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">
<nav class="navbar navbar-expand-lg bg-body-secondary border-bottom border-secondary-subtle shadow-sm mb-4 py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-primary" href="index.php">SIM Mahasiswa</a>
        <div class="d-flex align-items-center">
            <span class="text-secondary me-3">Halo, <strong class="text-body-emphasis"><?= $_SESSION['username']; ?></strong></span>
            <a href="logout.php" class="btn btn-sm btn-outline-danger px-3">Keluar</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card border border-secondary-subtle rounded-4 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <h4 class="fw-bold mb-1 text-primary">Data Mahasiswa</h4>
                    <p class="text-secondary small mb-0">Kelola dan lihat informasi seluruh data mahasiswa terkini.</p>
                </div>
                <a href="tambah.php" class="btn btn-primary px-3 py-2 rounded-3 text-nowrap">+ Tambah Mahasiswa</a>
            </div>

            <!-- Fitur Pencarian Data (Search Bar) -->
            <form method="GET" action="" class="mb-4">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari berdasarkan NIM, Nama, Email, Jurusan..." value="<?= htmlspecialchars($keyword); ?>">
                    <button class="btn btn-primary px-4" type="submit">Cari</button>
                    <?php if (!empty($keyword)): ?>
                        <a href="index.php" class="btn btn-outline-secondary">Reset</a>
                    <?php endif; ?>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr class="table-active">
                            <th class="py-3">NO</th>
                            <th class="py-3">NIM</th>
                            <th class="py-3">NAMA LENGKAP</th>
                            <th class="py-3">EMAIL</th>
                            <th class="py-3">JURUSAN</th>
                            <th class="py-3">ANGKATAN</th>
                            <th class="py-3 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($mahasiswa) > 0): ?>
                            <?php $no = 1; foreach ($mahasiswa as $mhs): ?>
                            <tr>
                                <td class="fw-bold text-secondary"><?= $no++; ?></td>
                                <td><span class="badge text-bg-primary px-2 py-1 fs-6"><?= htmlspecialchars($mhs['nim']); ?></span></td>
                                <td class="fw-bold text-body-emphasis"><?= htmlspecialchars($mhs['nama']); ?></td>
                                <td class="text-secondary"><?= htmlspecialchars($mhs['email']); ?></td>
                                <td><span class="badge text-bg-secondary px-2 py-1"><?= htmlspecialchars($mhs['jurusan']); ?></span></td>
                                <td class="fw-semibold text-body-emphasis"><?= htmlspecialchars($mhs['angkatan']); ?></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $mhs['id']; ?>" class="btn btn-sm btn-outline-warning me-1 px-3">Ubah</a>
                                    <a href="hapus.php?id=<?= $mhs['id']; ?>" class="btn btn-sm btn-outline-danger px-3" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-secondary">
                                    <?= !empty($keyword) ? 'Data dengan kata kunci "'.htmlspecialchars($keyword).'" tidak ditemukan.' : 'Belum ada data mahasiswa yang terdaftar.'; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>