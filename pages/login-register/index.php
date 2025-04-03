<?php
include 'connection.php';
session_start();

if (isset($_SESSION['username'])) {
  header("Location: berhasil_login.php");
  exit();
}

if (isset($_POST['submit'])) {
  $emailUsername = $_POST['email-username'];
  $password = hash('sha256', $_POST['password']);

  $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE (email = ?  OR username = ?) AND password = ?");
  mysqli_stmt_bind_param($stmt, "sss", $emailUsername, $emailUsername, $password);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['UserID'] = $row['UserID'];
    $_SESSION['jenis_kelamin'] = $row['jenis_kelamin'];
    $_SESSION['profile_picture'] = $row['profile_picture'];

    session_regenerate_id(true);
    
    if ($row['role'] == 1) {
      header("Location: ../../admin");
    } else {
      header("Location: berhasil_login.php");
    }
    exit();
  } else {
    echo "<script>
     alert('Email, nama atau password salah.');
     </script>";
  }
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
</head>

<body>
  <section class="container">
    <form action="" method="POST" class="login-email">
      <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
      <div class="input-group">
        <input type="text" placeholder="Nama lengkap atau Email" name="email-username" required>
      </div>
      <div class="input-group">
        <input type="password" placeholder="Password" name="password" required>
      </div>
      <div class="input-group">
        <button name="submit" class="btn">Login</button>
      </div>
      <p class="login-register-text">Belum punya akun? <a href="register.php">Daftar</a>.</p>
    </form>
  </section>
</body>

</html>