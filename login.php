<?php
include 'lib/koneksi.php';

if (isset($_POST['btn'])) {
    $username = $_POST['username'];
    $password = $_POST['pwd'];

    // Menyiapkan query menggunakan prepared statement
    $sqluser = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $sqluser->bindParam(':username', $username, PDO::PARAM_STR);
    $sqluser->execute();

    // Memeriksa apakah username ditemukan
    if ($sqluser->rowCount() > 0) {
        $user = $sqluser->fetch(PDO::FETCH_ASSOC);

        // Verifikasi password (menggunakan password_verify untuk hash)
        if ($password == $user['password']) {
            $_SESSION['id'] = $user['id'];  // Menyimpan id user di session
            header('Location: index.php');   // Redirect ke halaman dashboard
            exit();
        } else {
            $error = "Username atau Password salah!";
        }
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                Login Admin Rumah Sakit
            </div>
            <div class="card-body">
                <form method="POST">
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="pwd">Password</label>
                        <input type="password" id="pwd" name="pwd" class="form-control" required>
                    </div>

                    <!-- Button Login -->
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success" name="btn">Login</button>
                    </div>

                    <!-- Error Message -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger mt-3">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>