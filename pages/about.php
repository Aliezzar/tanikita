<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/qualycheck/components/connection.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me</title>
    <style>
        nav {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
    <link rel="stylesheet" href="/qualycheck/css/style.css">
    <link rel="stylesheet" href="/qualycheck/css/about-page.css">
    <link rel="stylesheet" href="/qualycheck/css/responsive.css">

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

<body class="about-page" >
    <!-- navbar -->
         <?php include_once $_SERVER['DOCUMENT_ROOT'].'/qualycheck/components/navbar.php';?>
    <!-- navbar end -->

    <!-- about -->
    <section class="about">
        <h2>
            Kenalan Sama <span>Yang buat website</span> Yuk!!
        </h2>

        <div class="row">
            <div class="about-img">
                <img src="/qualycheck/img/foto-admin.jpg" alt="foto admin">
            </div>
            <div class="content">
                <h3>Aliezzar Wijaya</h3>
                <p>
                    Perkenalkan saya Aliezzar Wijaya biasa dipanggil Ezzar, saya sangat suka pemrograman, terutama web development, dan DevSecOps, saya di web sevelopemnt suka pada bagian backend. Ini adalah projek saya dari sekolah saya di SMK Telkom Sidoarjo, namanya adalah projek UKL.
                    Web ini dibangun dengan tujuan untuk mendidik masyarakat terhadap teknologi pangan
                </p>
                <a href="https://github.com/Aliezzar" target="_blank" class="click"><button>Cek github kuuu</button></a>
            </div>
        </div>
    </section>
    <!-- about end -->

    <!-- Footer -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/qualycheck/components/footer.php';?>
    <!-- Footer end -->
</body>

</html>