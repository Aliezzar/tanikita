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
</head>

<body>
        <section class="container-logout">
            <h1>Selamat Datang <?php echo $_SESSION['username']; ?>!</h1>
            <div class="input-group">
                <button class="btn"><a href="../../index.php" style="color: white; text-decoration: none;">Kembali ke mainpage</a></button>
            </div>
            <form action="logout.php" method="POST" class="login-email">
                <div class="input-group">
                    <button type="submit" class="btn">Logout</button>
                </div>
            </form>
        </section>
</body>

</html>