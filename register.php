<?php
include 'lib/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        // Periksa apakah username sudah ada
        $sql_check = "SELECT * FROM users WHERE username = :username";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':username', $username);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            $error = "Username sudah digunakan. Silakan pilih username lain.";
        } else {
            // Hash password sebelum disimpan ke database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan data pengguna baru
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashed_password);

            if ($stmt->execute()) {
                $success = "Registrasi berhasil. Silakan login.";
                header("Location: login.php");
                exit();
            } else {
                $error = "Terjadi kesalahan. Silakan coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Register</h2>
    <?php if (isset($error)): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
    <?php elseif (isset($success)): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $success; ?>
    </div>
    <?php endif; ?>
    <form method="POST" action="register.php" class="mt-4">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <p class="mt-3">Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
</div>
</body>
</html>
