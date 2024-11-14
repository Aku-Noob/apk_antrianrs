<?php 
include 'lib/koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pasien = $_POST['nama_pasien'];
    $nomor_antrian = $_POST['nomor_antrian'];
    $waktu_kedatangan = $_POST['waktu_kedatangan'];
    $sql = "INSERT INTO antrian (nama_pasien, nomor_antrian, waktu_kedatangan) VALUES (:nama_pasien, :nomor_antrian, :waktu_kedatangan)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nama_pasien', $nama_pasien);
    $stmt->bindParam(':nomor_antrian', $nomor_antrian);
    $stmt->bindParam(':waktu_kedatangan', $waktu_kedatangan);

    if ($stmt->execute()) {
        echo "Data antrian berhasil ditambahkan!";
        header("Location: index.php");
    } else {
        echo "Error: Gagal .menambahkan data.";
    }
}
?>

<form    method="POST" action="tambah_antrian.php">
    Nama Pasien: <input type="text" name="nama_pasien" required><br>
    Nomor Antrian: <input type="number" name="nomor_antrian" required><br>
    Waktu Kedatangan: <input type ="datetime-local" name="waktu_kedatangan" required><br>
    <input type="submit" value="Tambah Antrian">
</form  >