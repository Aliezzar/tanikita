<?php
session_start();
include_once '../../../components/connection.php';
$user_id = $_SESSION['UserID'];
if (!isset($user_id)) {
  header('Location: ../../login.php');
  exit();
}

$query = "SELECT * FROM `history` WHERE UserID = ? ORDER BY `history`.`tanggal` ASC";
$query = $conn->prepare($query);
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" />

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaniKita-History</title>
  <!-- css -->
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="css/history.css">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
    rel="stylesheet">
  <!-- Sweetalert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">
  <!-- boxicon css -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>

</head>

<body>
  <!-- Navbar -->
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/tanikita/components/navbar.php'; ?>
  <!-- navbar end -->

  <section class="containerAll">
    <!-- sidebar -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/tanikita/components/sidebar.php'; ?>
    <!-- sidebar end -->
    <main class="main-content" style="height: 100vh;">
      <!-- Banner Section -->
      <section class="banner-section">
        <div class="banner-content">
          <div class="banner-image">
            <img src="../../../img/history.png" alt="Illustration">
          </div>
          <div class="banner-text">
            <h1>Ini <span class="highlight">histori</span><br> anda</h1>
          </div>
        </div>
      </section>
        <!-- list history -->
        <div class="history-container">
          <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="content-history">
              <h1><?= $row['aksi']; ?></h1><p><?= $row['tanggal']; ?></p>
            </div>
          <?php } ?>
        </div>
        <!-- list history end -->
    </main>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>

  <!-- sidebar js -->
  <script>
    function ifSidebarScroll() {
      var aside = this.document.querySelector("aside.sidebar");
      aside.classList.toggle("full-sidebar", window.scrollY > 14);
    }

    window.addEventListener("scroll", ifSidebarScroll);
  </script>
</body>

</html>