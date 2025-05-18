<?php
include 'connection.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Pendaftaran</title>
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
</head>

<body>

    <section class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">
                daftar
            </p>
            <div class="input-group">
                <input type="text" placeholder="Nama Lengkap" name="username" value="<?php echo (isset($username) ? $username : ''); ?>" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo (isset($email) ? $email : ''); ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo (isset($_POST['password']) ? $_POST['password'] : ''); ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Konfirmasi Password" name="cpassword" value="<?php echo (isset($_POST['cpassword']) ? $_POST['cpassword'] : ''); ?>" required>
            </div>
            <div class="input-group-jenis-kelamin">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <label>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki
                </label>
                <label>
                    <input type="radio" name="jenis_kelamin" value="Perempuan" required> Perempuan
                </label>

            </div>
            <div class="input-group">
                <button name="submit" class="btn">Daftar</button>
            </div>
            <p class="login-register-text">Sudah punya akun? <a href="index.php">Login</a>.</p>
        </form>
        <?php
        include_once 'fungsi.php';
        checkRegister();
        ?>
    </section>

</body>

</html>