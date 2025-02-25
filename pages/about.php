<?php
include_once "../php/connection.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QualyCheck</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/about-page.css">
    <link rel="stylesheet" href="../css/responsive.css">

    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- navbar -->
    <nav class="nav-about" style="color: black;">
        <a href="." class="logo">Qualy<span>Check</span></a>
        <ul style="color: black;">
            <li><a href="../#home">Home</a></li>
            <li><a href="../#informasi">informasi</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="../pages/login-register/logout.php">Log out</a></li>
            <?php else: ?>
                <li><a href="../pages/login-register">Sign in / Sign up</a></li>
            <?php endif; ?>
            </ul>
        <div class="menu-toggle">
            <input type="checkbox">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- about -->
    <section class="about">
        <h2>
            Kenalan Sama <span>Yang buat website</span> Yuk!!
        </h2>

        <div class="row">
            <div class="about-img">
                <img src="/img/foto-admin.jpg" alt="foto admin">
            </div>
            <div class="content">
                <h3>Aliezzar Wijaya</h3>
                <p>
                    Perkenalkan saya Aliezzar Wijaya biasa dipanggil Ezzar, saya sangat suka pemrograman, terutama web development, dan DevSecOps, saya di web sevelopemnt suka pada bagian backend. Ini adalah projek saya dari sekolah saya di SMK Telkom Sidoarjo, namanya adalah projek UKL.
                    Web ini dibangun dengan tujuan untuk mendidik masyarakat terhadap teknologi pangan
                </p>
                <a href="https://github.com/Aliezzar" target="_blank"><button>Cek github kuuu</button></a>
            </div>
    </section>
    <!-- about end -->

    <!-- Footer -->
    <footer>
        <div class="socials">
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="twitter"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
        </div>

        <div class="links">
            <a href="#home"></a>
            <a href="#informasi">Tentang Kami</a>
            <a href="#menu">Menu</a>
            <a href="#contact">Kontak</a>
        </div>

        <div class="credit">
            <p>Creater by <a href="">aliezzarwijaya</a>. | &copy; 2024.</p>
        </div>
    </footer>
    <!-- Footer end -->




    <!-- Typing effect -->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <!-- untuk diagram -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../javascript/chart.js"></script>
    <!-- js -->
    <script src="../javascript/script.js"></script>
</body>

</html>