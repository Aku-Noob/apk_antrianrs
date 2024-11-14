<?php
include  'lib/koneksi.php';
// Menyiapkan query untuk mengambil data antrian
$sql = "SELECT * FROM antrian";
$stmt = $conn->prepare($sql);
$stmt->execute(); // Eksekusi query
// Menampilkan hasil query
echo "<h2>Daftar Antrian Pasien</h2>"; 
echo "<table border='1'>
<tr>
<th>No</th>
<th>Nama Pasien</th>
<th>Nomor Antrian</th>
<th>Waktu Kedatangan</th>
<th>Status</th>
<th>Aksi</th>
</tr>";
// Ambil semua data hasil query
$antrian = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($antrian) > 0) {
$no = 1;
foreach ($antrian as $row) {
    echo "<tr>
    <td>".$no."</td>
    <td>".$row["nama_pasien"]."</td>
    <td>".$row["nomor_antrian"]."</td>
    <td>".$row["waktu_kedatangan"]."</td>
    <td>".$row["status"]."</td>
    <td><a href='ubah_status.php?id=".$row["id"]."'>Ubah Status</a> | <a href='hapus_antrian.php?id=".$row["id"]."'>Hapus</a></td>
    </tr>";
    $no++;
    }
    echo "</table>";
    } else {
    echo "Tidak ada antrian.";
    }
    
    $conn = null; // Menutup koneksi PDO