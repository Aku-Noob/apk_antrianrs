<?php
include 'lib/koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect ke halaman login jika belum login
    header("Location: login.php");
    exit();
}

$message = '';
$alertClass = '';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'update') {
        // Update status menjadi 'Selesai'
        $sql = "UPDATE antrian SET status = 'Selesai' WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $message = "Status pasien berhasil diubah menjadi 'Selesai'!";
            $alertClass = 'alert-success';
        } else {
            $message = "Error: Gagal mengubah status.";
            $alertClass = 'alert-danger';
        }
    } elseif ($action == 'delete') {
        // Hapus data pasien dari tabel
        $sql = "DELETE FROM antrian WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $message = "Pasien berhasil dihapus dari daftar antrian.";
            $alertClass = 'alert-warning';
            header("location: daftar_antrian.php");
            exit();
        } else {
            $message = "Error: Gagal menghapus pasien.";
            $alertClass = 'alert-danger';
        }
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah Status Antrian</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- Header -->
<div class="container-fluid p-5 bg-success text-white text-center">
    <h1 class="display-4">Ubah Status Antrian</h1>
    <p class="lead">Kelola antrian pasien dengan mudah</p>
</div>

<!-- Notification -->
<?php if ($message): ?>
<div class="container mt-4">
    <div class="alert <?php echo $alertClass; ?> alert-dismissible fade show" role="alert">
        <?php echo $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<?php endif; ?>

<!-- Main Content -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h3 class="text-center mb-4">Pilih Aksi</h3>
            <form action="ubah_status.php" method="get">
                <div class="mb-3">
                    <label for="id" class="form-label">ID Pasien</label>
                    <input type="number" name="id" id="id" class="form-control" placeholder="Masukkan ID Pasien" required>
                </div>
                <div class="mb-3">
                    <label for="action" class="form-label">Aksi</label>
                    <select name="action" id="action" class="form-select" required>
                        <option value="" disabled selected>Pilih Aksi</option>
                        <option value="update">Ubah Status ke 'Selesai'</option>
                        <option value="delete">Hapus Pasien</option>
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="container-fluid bg-dark text-white text-center p-3 mt-5">
    <p>© 2024 Programer Noob. All rights reserved.</p>
</div>
</body>
</html>
