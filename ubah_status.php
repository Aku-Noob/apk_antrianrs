<?php
include 'lib/koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE antrian SET status = 'Selesai' WHERE id= :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        echo "Status pasien berhasil diubah menjadi Selesai!";
    } else {
        echo "Error: Gagal mengubah status.";
    }
}
$conn = null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pasien Selesai</title>
</head>
<body>
    <h1>Status Pasien Telah Diubah Menjadi Selesai!</h1>
    <p>Terima kasih telah memperbarui status pasien. Anda bisa kembali ke daftar pasien atau halaman utama.</p>
    <a href="daftar_antrian.php">Kembali ke Daftar Pasien</a>
</body>
</html>