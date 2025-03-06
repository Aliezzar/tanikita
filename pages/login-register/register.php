<?php
include 'connection.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $sanitizeEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = hash('sha256', $_POST['password']); 
    $cpassword = hash('sha256', $_POST['cpassword']);

    if (filter_var($sanitizeEmail, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        $allowedDomains = [
            'gmail.com',
            'yahoo.com',
            'outlook.com',
            'hotmail.com',
            'aol.com',
            'icloud.com',
            'protonmail.com',
            'zoho.com',
            'yandex.com',
            'mail.com',
            'gmx.com',
            'apple.com',
            'microsoft.com',
            'amazon.com',
            'facebook.com',
            'twitter.com',
            'qq.com',
            '163.com',
            'naver.com',
            'daum.net',
            'rambler.ru',
            'rediffmail.com'
        ];
        $emailDomain = substr(strrchr($sanitizeEmail, "@"), 1);

        if (!in_array($emailDomain, $allowedDomains)) {
            echo "<script>alert('Domain email tidak diizinkan. Gunakanlah email terpercaya seperti Gmail, Yahoo, Outlook, dll.')</script>";
            exit();
        }

        if ($password == $cpassword) {
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {
                $sql = "INSERT INTO users (username, email, password)
                        VALUES ('$username', '$email', '$password')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>
                alert('User added successfully');
                window.location = 'index.php';
            </script>";
                    $username = "";
                    $email = "";
                    $_POST['password'] = "";
                    $_POST['cpassword'] = "";
                } else {
                    echo "<script>alert('Maaf, terjadi kesalahan.')</script>";
                }
            } else {
                echo "<script>alert('Ups, email Sudah Terdaftar.')</script>";
            }
        } else {
            echo "<script>alert('Password tidak sesuai.')</script>";
        }
    } else {
        echo "<script>alert('Email tidak valid atau password kosong.')</script>";
    }
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
</head>

<body>

    <section class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">
                daftar
            </p>
            <div class="input-group">
                <input type="text" placeholder="Nama Lengkap" name="username" value="<?php echo (isset($username)?$username:''); ?>" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo (isset($email)?$email:''); ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo (isset($_POST['password'])?$_POST['password']:''); ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Konfirmasi Password" name="cpassword" value="<?php echo (isset($_POST['cpassword'])?$_POST['cpassword']:''); ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Daftar</button>
            </div>
            <p class="login-register-text">Sudah punya akun? <a href="index.php">Login</a>.</p>
        </form>
    </section>

</body>

</html>