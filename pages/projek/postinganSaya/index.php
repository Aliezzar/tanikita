<?php
session_start();
include_once('../../../components/connection.php');

include_once '../../../components/wajib_login.php';


$user_id = $_SESSION['UserID'];

$query = 'SELECT post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture, COUNT(suka.id) AS jumlah_like FROM post INNER JOIN users ON post.UserID = users.UserID LEFT JOIN suka ON post.PostID = suka.PostID WHERE post.UserID = ? GROUP BY post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture;';
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
  <title>TaniKita-Postingan saya</title>
  <!-- css -->
  <link rel="stylesheet" href="../css/style.css">
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
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/components/navbar.php'; ?>
  <!-- navbar end -->

  <section class="containerAll">
    <!-- sidebar -->
    <?php include_once '../../../components/sidebar.php'; ?>
    <!-- sidebar end -->
    <main class="main-content">
      <!-- Banner Section -->
      <style>
        .banner-content .banner-text {
          max-width: 1000px;
        }
      </style>
      <section class="banner-section">
        <div class="banner-content">
          <div class="banner-text">
            <h1>Ini adalah postingan <span class="highlight">yang anda post</span>!</h1>
          </div>
        </div>

        <div class="search-box">
          <a href="../add.php"><button>Tambahkan</button></a>
        </div>
      </section>



      <div class="card-wrapper" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
        <!-- Card-->
        <?php while ($row = $result->fetch_assoc()) { ?>
          <div class="card">
              <div class="card-header">
                <div class="card-header-content">
                  <div class="profil-kiri">
                    <img src="../../../img/profile/<?= $row['profile_picture'] ?>" alt="Avatar" class="avatar">
                    <div class="username"><?= htmlspecialchars($row['username']); ?></div>
                  </div>
                  <div class="profil-kanan" style="display: none;">
                    <i class="fas fa-exclamation-circle icon" onclick="aktif('overlay-laporan')"></i>
                  </div>
                </div>
                <div class="containerImg">
                  <?php if (empty($row['image'])) { ?>
                    <img src="https://placehold.co/400x400" alt="Gambar">
                  <?php } elseif (file_exists('../../../img/post/' . $row['image'])) { ?>
                    <img src="../../../img/post/<?php echo $row['image']; ?>" class="upload_gambar" alt="Gambar">
                  <?php } elseif (!file_exists('../../../img/post/' . $row['image'])) { ?>
                    <img src="https://placehold.co/400x400" class="upload_gambar" alt="Gambar">
                  <?php } ?>
                </div>
              </div>
              <div class="card-body">
                <h3><?php echo $row['post_name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <a href="../view-details.php?id=<?= $row['PostID']; ?>" class="btn">View Details</a>

                <!-- like -->
                <?php
                // cek apakah user sudah like
                $UserID = $_SESSION['UserID'];
                $PostID = $row['PostID'];
                $UserID_uploader = $row['UserID'];
                $query = $conn->prepare("SELECT * FROM suka WHERE PostID = ? AND UserID = ?");
                $query->bind_param("ii", $PostID, $UserID);
                $query->execute();
                $hasil = $query->get_result();
                $likeRow = $hasil->fetch_assoc();
                if ($likeRow) { ?>
                  <button onclick="likePost(<?= $row['PostID']; ?>)" style="background: none; border: none; cursor: pointer;">
                    <i class="fas fa-heart" style="color: red;" id="like-icon-<?= $row['PostID']; ?>"></i>
                  </button>
                <?php } else { ?>
                  <button onclick="likePost(<?= $row['PostID']; ?>)" style="background: none; border: none; cursor: pointer;">
                    <i class="far fa-heart" style="color: gray;" id="like-icon-<?= $row['PostID']; ?>"></i>
                  </button>
                <?php } ?>
                <span id="like-count-<?= $row['PostID']; ?>"><?= $row['jumlah_like']; ?></span>
                <br>
                <!-- like end -->


                <?php if ($row['UserID'] ==  $_SESSION['UserID'] || $_SESSION['role'] == 1) { ?>
                  <a href="../edit.php?post_id=<?= $row['PostID']; ?>" class="btn">
                    Edit Postingan
                  </a>
                  <a href="javascript:void(0);" onclick="yakin(<?= htmlspecialchars($row['PostID']); ?>, '<?= htmlspecialchars(strval($row['post_name'])); ?>', '../../../img/post/<?= $row['image']; ?>')" class="btn" style="background-color: red; margin-top: 10px;">
                    Hapus
                  </a>
                <?php } ?>
              </div>
              <div class="card-footer">
                <?= $row['created_at']; ?>
              </div>
            </div>
        <?php } ?>
        <!-- Card-->
      </div>
    </main>
  </section>

    <!-- Overlay -->
    <section class="overlay-laporan" id="overlay-laporan">
    <div class="laporan-container">
      <div class="laporan-header">
        <h2>Laporkan Konten</h2>
        <i class="fas fa-times" onclick="nonaktif('overlay-laporan')"></i>
      </div>
      <div class="laporan-body">
        <form action="../proses.php" method="POST">
          <label for="alasan">
            <h3>Alasan:</h3>
          </label>
          <textarea name="alasan" id="alasan" rows="4" required></textarea>
          <input type="hidden" name="post_id" value="<?= $PostID ?>">
          <input type="hidden" name="user_id" value="<?= $UserID_uploader; ?>">
          <div class="button-wrapper">
            <button class="btn-batal" onclick="nonaktif('overlay-laporan')">Batal</button>
            <button class="btn-submit" type="submit" name="submit" value="laporan">Kirim Laporan</button>
          </div>
        </form>
      </div>
    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>

  <script>
    function yakin(PostID, name, location) {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data ini akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `../hapus.php?hapus=post&PostID=${PostID}&name=${name}&lokasi=${location}`;
        }
      })
    }

    document.querySelectorAll('.btn').forEach(button => {
      button.addEventListener('click', function(event) {
        const href = this.getAttribute('href');
        if (href && href !== 'javascript:void(0);') {
          window.location.href = href;
        }
      });
    });
  </script>
  <!-- AJAX untuk like -->
  <script>
    // untuk memunculkan overlay div baru
    function aktif(id) {
      let element = document.getElementById(id);
      if (id) {
        element.style.display = "flex";
      }
    }

    function nonaktif(id) {
      let element = document.getElementById(id);
      if (id) {
        element.style.display = "none";
      }
    }

    function likePost(PostID) {
      fetch('../proses.php', { // fetch itu fungsi untuk melakukan http request ke file like_proses.php
          method: 'POST', // melakukan method post pada like  
          headers: { // bungasih tahu server bahwa data yang dikirim dalam format application blablabla
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `submit=like&PostID=${PostID}` //data yg dikirim server itu berada pada PostID kalo misal PostID = 1, maka yg dikirim itu PostID=1
        })
        .then(response => response.json()) // response itu dari promise, promise itu dari si fetch nya, kemudian setelah itu kan promise menjadi response, kemudian reponse dijadikan file response.json() agar javascript bisa buka bungkusannya supaya datanya jadi objek javascript
        .then(data => { //data adalah sebuah hasil akhir dari reponse.json() yang sudah dibuka bungkusannya dan sudah jadi objek javascript
          if (data.success) { // jika data.success bernilai true, akan memperbarui isi dari like-count
            document.getElementById(`like-count-${PostID}`).innerText = data.new_like_count; //mengganti isi dari span yg kemudian diganti dengan jumlah yg baru, innertext berfungsi untuk mengganti isi dari elemen html
          } else {
            alert(data.message);
          }
        })
        .catch(error => console.error('Error:', error));
    }
  </script>
</body>

</html>