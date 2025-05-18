<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // terminate the current script
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Success Page</title>
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <!-- Notifikasi bahwa login berhasil -->
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Login berhasil!',
            showConfirmButton: false,
            timer: 3000
        });
    </script>

    <!-- container -->
    <section class="container-logout">
        <h1>Selamat Datang <?php echo $_SESSION['username']; ?>!</h1>
        <div class="input-group">
            <a href="../../index.php" style="color: white; text-decoration: none;"><button class="btn">Kembali ke mainpage</button></a>
        </div>
        <form action="logout.php" method="POST" class="login-email">
            <div class="input-group">
                <button type="submit" class="btn">Logout</button>
            </div>
        </form>
    </section>


</body>

</html>