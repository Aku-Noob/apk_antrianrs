<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect ke halaman login jika belum login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form Antrian Pasien</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    a {
      text-decoration: none;
      color: white;
    }
    a:hover {
      color: #d4d4d4;
    }
  </style>
</head>
<body>

<!-- Header -->
<div class="container-fluid p-5 bg-success text-white text-center d-flex justify-content-between align-items-center">
  <div>
    <h1 class="display-4">Form Antrian Pasien</h1>
    <p class="lead">Selamat Datang di Website Programer Noob!</p> 
  </div>
  <div>
    <a href="logout.php" class="btn btn-danger btn-lg">Logout</a>
  </div>
</div>

<!-- Content -->
<div class="container mt-5">
  <div class="row text-center">
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h3 class="card-title mb-3 text-success"><i class="bi bi-list-ul"></i> Daftar Antrian</h3>
          <p class="card-text">Isi form untuk mendaftarkan antrian Anda.</p>
          <button class="btn btn-success">
            <a href='daftar_antrian.php'>Daftar</a>
          </button>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h3 class="card-title mb-3 text-primary"><i class="bi bi-plus-circle"></i> Tambah Antrian</h3>
          <p class="card-text">Tambahkan antrian baru ke dalam sistem.</p>
          <button class="btn btn-primary">
            <a href='tambah_antrian.php'>Tambah</a>
          </button>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h3 class="card-title mb-3 text-warning"><i class="bi bi-pencil-square"></i> Ubah Status</h3>
          <p class="card-text">Ubah status dari antrian yang telah dibuat.</p>
          <button class="btn btn-warning">
            <a href='ubah_status.php'>Ubah</a>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<div class="container-fluid bg-dark text-white text-center p-3 mt-5">
  <p>© 2024 Programer Noob. All rights reserved.</p>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
</body>
</html>
