<?php
session_start();
include_once '../../components/connection.php';
include_once '../../components/wajib_login.php';


$query = 'SELECT post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.UserID, users.username, users.profile_picture, COUNT(suka.id) AS jumlah_like FROM post INNER JOIN users ON post.UserID = users.UserID LEFT JOIN suka ON post.PostID = suka.PostID GROUP BY post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture;';
$result = $conn->query($query);
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
  <!-- css -->
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
    <?php include_once '../../components/sidebar.php'; ?>
    <main class="main-content">
      <!-- Banner Section -->
      <section class="banner-section">
        <div class="banner-content">
          <div class="banner-image">
            <img src="../../img/kaca-pembesar.png" alt="Illustration">
          </div>
          <div class="banner-text">
            <h1>Cari apa <span class="highlight">yang anda cari</span><br> sekarang!</h1>
          </div>
        </div>

        <div class="search-box">
          <form action="" method="get">
            <input type="text" name="cari" placeholder="cari" <?php if (isset($_GET['cari'])) { $cari_text = htmlspecialchars($_GET['cari']);?> value="<?= $cari_text ?>" <?php } ?>/>
            <button>Temukan</button>
          </form>
          <a href="add.php"><button>Tambahkan</button></a>
        </div>
      </section>



      <div class="card-wrapper" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
        <!-- Card-->
        <?php
          if (isset($_GET['cari']) && !empty($_GET['cari'])) {
          $cari = $conn->real_escape_string($_GET['cari']);

          // Query cari data
          $query_cari = "SELECT post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.UserID, users.profile_picture, COUNT(suka.id) AS jumlah_like FROM post INNER JOIN users ON post.UserID = users.UserID LEFT JOIN suka ON post.PostID = suka.PostID WHERE post_name LIKE ? GROUP BY post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture;";
          $cari = '%' . htmlspecialchars($cari) . '%';
          $hasil_cari = $conn->prepare($query_cari);
          $hasil_cari->bind_param("s", $cari);
          $hasil_cari->execute();
          $hasil_cari = $hasil_cari->get_result();

          // Hasilkan pencarian
          if ($hasil_cari->num_rows > 0) {
            while ($row = $hasil_cari->fetch_assoc()) { ?>
              <div class="card">
                <div class="card-header">
                  <div class="card-header-content">
                    <div class="profil-kiri">
                      <img src="../../img/profile/<?= $row['profile_picture'] ?>" alt="Avatar" class="avatar">
                      <div class="username"><?= htmlspecialchars($row['username']); ?></div>
                    </div>
                    <?php if ($row['UserID'] == $_SESSION['UserID']) { ?>
                      <div class="profil-kanan" style="display: none;">
                        <i class="fas fa-exclamation-circle icon" onclick="aktif('overlay-laporan')"></i>
                      </div>
                    <?php } else { ?>
                      <div class="profil-kanan">
                        <i class="fas fa-exclamation-circle icon" onclick="aktif('overlay-laporan')"></i>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="containerImg">
                    <?php if (empty($row['image'])) { ?>
                      <img src="https://placehold.co/400x400" alt="Gambar">
                    <?php } elseif (file_exists('../../img/post/' . $row['image'])) { ?>
                      <img src="../../img/post/<?php echo $row['image']; ?>" class="upload_gambar" alt="Gambar">
                    <?php } elseif (!file_exists('../../img/post/' . $row['image'])) { ?>
                      <img src="https://placehold.co/400x400" class="upload_gambar" alt="Gambar">
                    <?php } ?>
                  </div>
                </div>
                <div class="card-body">
                  <h3><?php echo $row['post_name']; ?></h3>
                  <p><?php echo $row['description']; ?></p>
                  <a href="view-details.php?id=<?= $row['PostID']; ?>" class="btn">View Details</a>

                  <!-- like -->
                  <?php
                  // cek apakah user sudah like
                  $UserID = $_SESSION['UserID'];
                  $PostID = $row['PostID'];
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
                    <a href="./edit.php?post_id=<?= $row['PostID']; ?>" class="btn">
                      Edit Postingan
                    </a>
                    <a href="javascript:void(0);" onclick="yakin(<?= htmlspecialchars($row['PostID']); ?>, '<?= htmlspecialchars(strval($row['post_name'])); ?>', '../../img/post/<?= $row['image']; ?>')"
                      class="btn" style="background-color: red; margin-top: 10px;">
                      Hapus
                    </a>
                  <?php } ?>
                </div>
                <div class="card-footer">
                  <?= $row['created_at']; ?>
                </div>
              </div>
          <?php


            }
          } else {
            echo "Tidak ada hasil ditemukan.";
          }
        } else {
          // jika yang dicari itu kosong
          ?>



          <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="card">
              <div class="card-header">
                <div class="card-header-content">
                  <div class="profil-kiri">
                    <img src="../../img/profile/<?= $row['profile_picture'] ?>" alt="Avatar" class="avatar">
                    <div class="username"><?= htmlspecialchars($row['username']); ?></div>
                  </div>
                  <?php if ($row['UserID'] == $_SESSION['UserID']) { ?>
                    <div class="profil-kanan" style="display: none;">
                      <i class="fas fa-exclamation-circle icon" onclick="aktif('overlay-laporan')"></i>
                    </div>
                  <?php } else { ?>
                    <div class="profil-kanan">
                      <i class="fas fa-exclamation-circle icon" onclick="aktif('overlay-laporan')"></i>
                    </div>
                  <?php } ?>
                </div>
                <div class="containerImg">
                  <?php if (empty($row['image'])) { ?>
                    <img src="https://placehold.co/400x400" alt="Gambar">
                  <?php } elseif (file_exists('../../img/post/' . $row['image'])) { ?>
                    <img src="../../img/post/<?php echo $row['image']; ?>" class="upload_gambar" alt="Gambar">
                  <?php } elseif (!file_exists('../../img/post/' . $row['image'])) { ?>
                    <img src="https://placehold.co/400x400" class="upload_gambar" alt="Gambar">
                  <?php } ?>
                </div>
              </div>
              <div class="card-body">
                <h3><?php echo $row['post_name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <a href="view-details.php?id=<?= $row['PostID']; ?>" class="btn">View Details</a>

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
                  <a href="./edit.php?post_id=<?= $row['PostID']; ?>" class="btn">
                    Edit Postingan
                  </a>
                  <a href="javascript:void(0);" onclick="yakin(<?= htmlspecialchars($row['PostID']); ?>, '<?= htmlspecialchars(strval($row['post_name'])); ?>', '../../img/post/<?= $row['image']; ?>')" class="btn" style="background-color: red; margin-top: 10px;">
                    Hapus
                  </a>
                <?php } ?>
              </div>
              <div class="card-footer">
                <?= $row['created_at']; ?>
              </div>
            </div>


        <?php }
        } ?>
        <!-- Card-->
      </div>
    </main>
  </section>

  <!-- Overlay laporan -->
  <section class="overlay-laporan" id="overlay-laporan">
    <div class="laporan-container">
      <div class="laporan-header">
        <h2>Laporkan Konten</h2>
        <i class="fas fa-times" onclick="nonaktif('overlay-laporan')"></i>
      </div>
      <div class="laporan-body">
        <form action="proses.php" method="POST">
          <label for="alasan">
            <h3>Alasan:</h3>
          </label>
          <select name="alasan" id="alasanOption">
            <option value="">Pilih alasan</option>
            <option value="Spam">Spam</option>
            <option value="Konten tidak pantas">Konten Tidak Pantas</option>
            <option value="Pelanggaran hak cipta">Pelanggaran Hak Cipta</option>
            <option value="Penipuan">Penipuan</option>
            <option value="Kekerasan">Kekerasan</option>
            <option value="Lainnya">Lainnya</option>
          </select>
          <textarea name="alasan_detail" id="alasan_detail" rows="4" style="display: none;" required></textarea>
          <script>
            let alasanOpsi = document.getElementById('alasanOption').value;
            document.getElementById("alasanOption").addEventListener("change", function() {
              if (this.value === "Lainnya") {
                document.getElementById("alasan_detail").style.display = "block";
                document.getElementById("alasan_detail").setAttribute("required", "required");
              } else {
                document.getElementById("alasan_detail").style.display = "none";
                document.getElementById("alasan_detail").removeAttribute("required");
              }
            });
          </script>
          <input type="hidden" name="post_id" value="<?= $PostID ?>">
          <input type="hidden" name="user_id" value="<?= $UserID_uploader; ?>">
          <div class="button-wrapper">
            <button class="btn-submit" type="submit" name="submit" value="laporan">Kirim Laporan</button>
          </div>
        </form>
      </div>
    </div>
  </section>


  <?php

  if (isset($_GET['success']) && $_GET['success'] == strval(hash('sha256', 'laporan'))) {
    echo "<script>
        
        Swal.fire({
        icon: 'success',
        title: 'Laporan berhasil dikirim!',
        text: 'Terima kasih telah membantu kami menjaga komunitas ini.',
        showConfirmButton: true,
        confirmButtonColor: '#3085d6',
        timer: 3000,
        confirmButtonText: 'okay!'
        }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `index.php`;
        }
      })
        </script>";
  }



  ?>

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
          window.location.href = `hapus.php?hapus=post&PostID=${PostID}&name=${name}&lokasi=${location}`;
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
      fetch('proses.php', { // fetch itu fungsi untuk melakukan http request ke file like_proses.php
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