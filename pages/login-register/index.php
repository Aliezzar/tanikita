<?php
include 'connection.php';
session_start();
include_once 'fungsi.php';

if (isset($_SESSION['username'])) {
  header("Location: berhasil_login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="css/index.css">
  <!-- Sweetalert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
</head>

<body>
  <section class="container">
    <form action="" method="POST" class="login-email">
      <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
      <div class="input-group">
        <input type="text" placeholder="Nama lengkap atau Email" name="email-username" required>
      </div>
      <div class="input-group pwd">
        <input type="password" placeholder="Password" name="password" id="pwd" required>
        <input type="checkbox" class="pwd-checkbox" onclick="pwd.type = this.checked ? 'text' : 'password'">
      </div>
      <div class="input-group">
        <button name="submit" class="btn">Login</button>
      </div>
      <p class="login-register-text">Belum punya akun? <a href="register.php">Daftar</a>.</p>
    </form>
    <?php
    checkLogin();
    ?>
  </section>
</body>

</html>