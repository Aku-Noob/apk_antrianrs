<?php
include 'lib/koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect ke halaman login jika belum login
    header("Location: login.php");
    exit();
}

// Menyiapkan query untuk mengambil data antrian dan mengurutkan berdasarkan waktu kedatangan terbaru
$sql = "SELECT * FROM antrian ORDER BY waktu_kedatangan DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Ambil semua data hasil query
$antrian = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Antrian</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- Header -->
<div class="container-fluid p-5 bg-primary text-white text-center">
    <h1 class="display-4">Daftar Antrian Pasien</h1>
    <p class="lead">Kelola dan pantau daftar antrian pasien dengan mudah</p>
</div>

<!-- Main Content -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Antrian</h2>
    <?php if (count($antrian) > 0): ?>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Nomor Antrian</th>
                    <th>Waktu Kedatangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($antrian as $row): 
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row["nama_pasien"]); ?></td>
                    <td><?= htmlspecialchars($row["nomor_antrian"]); ?></td>
                    <td><?= htmlspecialchars($row["waktu_kedatangan"]); ?></td>
                    <td><?= htmlspecialchars($row["status"]); ?></td>
                    <td>
                        <a href="ubah_status.php?id=<?= $row["id"]; ?>&action=update" class="btn btn-warning btn-sm">Ubah Status</a>
                        <a href="ubah_status.php?id=<?= $row["id"]; ?>&action=delete" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus antrian ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info text-center">Tidak ada antrian saat ini.</div>
    <?php endif; ?>
</div>

<!-- Footer -->
<div class="container-fluid bg-dark text-white text-center p-3 mt-5">
    <p>© 2024 Programer Noob. All rights reserved.</p>
</div>
</body>
</html>
