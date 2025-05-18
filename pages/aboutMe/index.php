<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fakta</title>
    <link rel="stylesheet" href="css/pengertian.css">
</head>

<body>
    <!-- nav -->
    <?php
    include_once '../../components/navbar.php';
    ?>
    <!-- nav end -->
    <section class="fakta-container">
        <div class="fakta-wrapper">
            <img src="../../img/petani-digital.png" alt="">
            <div class="content">
                <h1>Apa tujuan dari website TaniKita?</h1>
                <p>Website ini bertujuan untuk menjadi platform sederhana yang menghubungkan petani dengan petani, maupun petani dengan masyarakat, berbagi informasi seputar pertanian, dan mempromosikan produk lokal secara lebih luas.</p>
            </div>
        </div>
        <br> <br> <br>
        <br>
        <table>
            <tr>
                <th>Fitur</th>
                <th>Deskripsi</th>
                <th>Manfaat</th>
            </tr>
            <tr>
                <td>Profil Petani</td>
                <td>Setiap petani dapat membuat profil untuk menampilkan informasi tentang diri mereka dan usaha pertanian mereka.</td>
                <td>Mempermudah masyarakat mengenal petani dan produk mereka.</td>
            </tr>
            <tr>
                <td>Forum Diskusi</td>
                <td>Tempat untuk berbagi informasi, tips, dan pengalaman seputar pertanian.</td>
                <td>Meningkatkan pengetahuan dan kolaborasi antar petani.</td>
            </tr>
        </table>
    </section>
    <!-- Footer -->
    <?php include_once '../../components/footer.php'; ?>
    <!-- Footer end -->
    <script src="../../javascript/script.js"></script>
</body>

</html>