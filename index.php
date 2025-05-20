<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/tanikita/components/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaniKita</title>
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/style.css">


    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet">

    <!-- Swipper JS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


</head>

<body>

    <!-- Navbar -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/tanikita/components/navbar.php'; ?>

    <section id="home" class="banner">
        <div class="content">
            <h1>Ayo! bersama, kita bisa<span class="typing-text"></span></h1>
            <p>Untuk membentuk solidaritas antar petani Indonesia</p>
            <a href="./pages/projek/index.php" class="cta">Posting sekarang!</a>
        </div>
    </section>

    <!-- informasi -->
    <section id="informasi" class="informasi">
        <h2>
            Kenapa harus <span>Tanikita</span>?
        </h2>

        <div class="row">
            <div class="informasi-img">
                <img src="img/petani-digital.png" alt="Foto petani-digital">
            </div>
            <div class="content">
                <h3>Gabung dan Temukan Komunitas Petani Digital!</h3>
                <p>
                    Bersama TaniKita, kamu bisa berbagi cerita, pengalaman, dan hasil panenmu dengan komunitas petani
                    dari seluruh Indonesia. Jadilah bagian dari gerakan untuk mendukung pertanian lokal dan membangun
                    masa depan yang lebih baik.
                </p>
                <a href="pages/aboutMe/index.php">
                    <button class="buttonP">Pelajari Lebih Lanjut</button>
                </a>
            </div>
        </div>

        <div class="funfact">
            <div class="funfact-item">
                <i class="fa-solid fa-users"></i>
                <p><span>Komunitas Petani</span><br>Bergabunglah dengan komunitas petani untuk berbagi pengalaman dan hasil panen.</p>
            </div>
            <div class="funfact-item">
                <i class="fa-solid fa-share-nodes"></i>
                <p><span>Postingan Harian</span><br>Unggah foto hasil panenmu dan temukan inspirasi dari petani lainnya.</p>
            </div>
            <div class="funfact-item">
                <i class="fa-solid fa-heart"></i>
                <p><span>Dukungan Komunitas</span><br>Dapatkan apresiasi dan dukungan dari komunitas petani digital.</p>
            </div>
        </div>
    </section>
    <!-- informasi end -->

    <!-- Footer -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/tanikita/components/footer.php'; ?>
    <!-- Footer end -->



    <!-- Typing effect -->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <!-- js -->
    <script src="javascript/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>