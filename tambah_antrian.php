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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pasien = $_POST['nama_pasien'];
    $waktu_kedatangan = $_POST['waktu_kedatangan'];

    // Get the current maximum nomor_antrian and increment it by 1 for the new entry
    $sql_max_antrian = "SELECT MAX(nomor_antrian) AS max_antrian FROM antrian";
    $stmt_max = $conn->prepare($sql_max_antrian);
    $stmt_max->execute();
    $row = $stmt_max->fetch(PDO::FETCH_ASSOC);
    $nomor_antrian = $row['max_antrian'] + 1;

    // Insert new queue entry into the database
    $sql = "INSERT INTO antrian (nama_pasien, nomor_antrian, waktu_kedatangan) 
            VALUES (:nama_pasien, :nomor_antrian, :waktu_kedatangan)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nama_pasien', $nama_pasien);
    $stmt->bindParam(':nomor_antrian', $nomor_antrian);
    $stmt->bindParam(':waktu_kedatangan', $waktu_kedatangan);

    if ($stmt->execute()) {
        $message = "Data antrian berhasil ditambahkan!";
        $alertClass = 'alert-success';
    } else {
        $message = "Error: Gagal menambahkan data.";
        $alertClass = 'alert-danger';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Antrian</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- Header -->
<div class="container-fluid p-5 bg-primary text-white text-center">
    <h1 class="display-4">Tambah Antrian</h1>
    <p class="lead">Silakan tambahkan data antrian pasien</p>
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

<!-- Form -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title text-center mb-0">Form Tambah Antrian</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="tambah_antrian.php">
                        <div class="mb-3">
                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                            <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="Masukkan nama pasien" required>
                        </div>
                        <div class="mb-3">
                            <label for="waktu_kedatangan" class="form-label">Waktu Kedatangan</label>
                            <input type="datetime-local" name="waktu_kedatangan" id="waktu_kedatangan" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Tambah Antrian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="container-fluid bg-dark text-white text-center p-3 mt-5">
    <p>© 2024 Programer Noob. All rights reserved.</p>
</div>
</body>
</html>
