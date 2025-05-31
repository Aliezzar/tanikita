<?php
session_start();
include_once('../../components/connection.php');

include_once '../../components/wajib_login.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$PostID = $_GET['id'];

$sql = "SELECT post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture, COUNT(suka.id) AS jumlah_like FROM post INNER JOIN users ON post.UserID = users.UserID LEFT JOIN suka ON post.PostID = suka.PostID WHERE post.PostID = ? GROUP BY post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture;";
$sql = $conn->prepare($sql);
$sql->bind_param('i', $PostID);
$sql->execute();
$result = $sql->get_result();
$row = $result->fetch_assoc();
$sql2 = "SELECT komentar.KomentarID, komentar.UserID,komentar.PostID, komentar.isi_komentar, komentar.tanggal, users.username, users.profile_picture FROM komentar LEFT JOIN users ON komentar.UserID = users.UserID WHERE PostID = ? ORDER BY komentar.tanggal DESC;";
$sql2 = $conn->prepare($sql2);
$sql2->bind_param('i', $PostID);
$sql2->execute();
$result2 = $sql2->get_result();
$UserID = $_SESSION['UserID'];
$PostID = $row['PostID'];
$sql3 = $conn->prepare("SELECT * FROM suka WHERE PostID = ? AND UserID = ?");
$sql3->bind_param("ii", $PostID, $UserID);
$sql3->execute();
$hasil = $sql3->get_result();
$likeRow = $hasil->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanikita-Detail</title>
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">
   <!-- css -->
    <link rel="stylesheet" href="./css/view-details.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <header>
        <a href="index.php">Kembali</a>
    </header>
    <main class="container-main">
        <div class="wrapper">
            <!-- Left side -->
            <div class="left-side">
                <img
                    src="../../img/post/<?= $row['image']; ?>"
                    alt="post image" />
            </div>
            <!-- Right side -->
            <div class="right-side">
                <!-- Header -->
                <section class="header">
                    <div class="header-left">
                        <div class="profile-border" aria-hidden="true">
                            <img src="../../img/profile/<?= htmlspecialchars($row['profile_picture']); ?>" alt="profil user" width="45px" height="45px">
                        </div>
                        <div class="header-text">
                            <b><?= htmlspecialchars($row['username']); ?></b>
                        </div>
                    </div>
                    <button class="edit-btn" type="button" aria-label="cek-username" onclick="window.location.href='../profil-user/index.php?uid=<?= $row['UserID'] ?>'">
                        Lihat Profil
                    </button>
                </section>
                <!-- Scrollable content -->
                <section class="content-scroll" tabindex="0" aria-label="Post caption and comments">
                    <!-- Post caption -->
                    <article class="post-caption">
                        <div class="caption-text">
                            <?= htmlspecialchars($row['post_name']); ?>
                            <p>
                                <?= htmlspecialchars($row['description']); ?>
                            </p>
                        </div>
                    </article>
                    <div class="comments" aria-label="Comments">
                        <span id="value_comment"></span>
                        <?php while ($row_komen = $result2->fetch_assoc()) { ?>
                            <?php if ($row_komen['UserID'] == $_SESSION['UserID'] || $_SESSION['role'] == 1) { ?>
                                <div id="comment-element-<?= $row_komen['KomentarID']; ?>" class="comment-element">
                                    <img src="../../img/profile/<?= htmlspecialchars($row_komen['profile_picture']); ?>" alt="avatar" class="avatar">
                                    <div class="comment-content">
                                        <b><?= htmlspecialchars($row_komen['username']); ?></b>
                                        <div class="isi-komen-container">
                                            <p id="isi-komentar-<?= $row_komen['KomentarID'] ?>"><?= htmlspecialchars($row_komen['isi_komentar']); ?></p>
                                            <p class="comment-date">
                                                <?= htmlspecialchars($row_komen['tanggal']); ?>
                                            </p>
                                        </div>
                                        <style>
                                            .fa-trash,
                                            .fa-pencil {
                                                cursor: pointer;
                                            }
                                        </style>
                                        <i class="fa fa-trash" onclick="hapusKomentar(<?= $row_komen['KomentarID'] ?>, <?= $row_komen['UserID']; ?>, <?= $row_komen['PostID'] ?>)" id="delete-comment" style="color: red;"></i>
                                        <i class="fa fa-pencil" id="edit-comment" onclick="munculkanOverlay('overlay-komentar-<?= $row_komen['KomentarID']; ?>')" style="color: blue;"></i>
                                    </div>

                                    <div class="overlay" id="overlay-komentar-<?= $row_komen['KomentarID']; ?>">
                                        <div class="overlay-wrapper">
                                            <h2>Edit Komentar</h2>
                                            <textarea name="isi_komentar" id="updateKomentarValue" rows="4"><?= htmlspecialchars($row_komen['isi_komentar']); ?></textarea>
                                            <button value="edit_komentar" onclick="editKomentar(<?= $row_komen['KomentarID']; ?>, <?= $row_komen['UserID']; ?>, <?= $row_komen['PostID']; ?>)">Simpan</button>
                                        </div>
                                    </div>

                                </div>
                            <?php } else { ?>
                                <div class="comment-element">
                                    <img src="../../img/profile/<?= htmlspecialchars($row_komen['profile_picture']); ?>" alt="" class="avatar" aria-hidden="true"></img>
                                    <div class="comment-content">
                                        <b><?= htmlspecialchars($row_komen['username']); ?></b>
                                        <div class="isi-komen-container">
                                            <p><?= htmlspecialchars($row_komen['isi_komentar']); ?></p>
                                            <p class="comment-date">
                                                <?= htmlspecialchars($row_komen['tanggal']); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </section>
                <!-- Footer -->
                <footer class="footer">
                    <div class="footer-icons" role="group" aria-label="Post actions">
                        <button onclick="likePost(<?= htmlspecialchars($row['PostID']); ?>)" class="like" aria-label="Like post" type="button">
                            <?php if ($likeRow) { ?>
                                <i class="fas fa-heart" aria-hidden="true"></i>
                            <?php } else { ?>
                                <i class="far fa-heart" aria-hidden="true"></i>
                            <?php } ?>
                        </button>
                        <p style="color: black;" id="like-count-<?= htmlspecialchars($row['PostID']); ?>" class="likes-count">
                            <?= htmlspecialchars($row['jumlah_like']); ?>
                        </p>
                    </div>
                </footer>
                <!-- Add comment -->
                <div class="add-comment">
                    <input
                        type="text"
                        placeholder="Add a comment..."
                        aria-required="true"
                        aria-label="Add a comment"
                        id="input-comment" />
                    <button type="submit" onclick="comment()" id="submit-comment" value="komentar" class="post-btn" aria-label="Post comment">
                        Post
                    </button>
                </div>
            </div>
        </div>
    </main>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.21.1/dist/sweetalert2.all.min.js
"></script>

    <script>
        // fungsi untuk memunculkan overlay dari id input
        function munculkanOverlay(idOverlayTarget) {
            let element = document.getElementById(idOverlayTarget);
            if (idOverlayTarget) {
                element.style.display = "flex";
            }
        }

        function nonaktifkanOverlay(idOverlayTarget) {
            let element = document.getElementById(idOverlayTarget);
            if (idOverlayTarget) {
                element.style.display = "none";
            }
        }

        // fungsi untuk mengedit komentar
        function editKomentar(KomentarID, UserID, PostID) {
            updateKomentarValue = document.getElementById('updateKomentarValue').value;
            fetch('proses.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `submit=editKomentar&KomentarID=${KomentarID}&UserID=${UserID}&PostID=${PostID}&updateKomentarValue=${updateKomentarValue}`
                })
                .then(response => response.json()) // response itu dari promise, promise itu dari si fetch nya, kemudian setelah itu kan promise menjadi response, kemudian reponse dijadikan file response.json() agar javascript bisa buka bungkusannya supaya datanya jadi objek javascript
                .then(data => { //data adalah sebuah hasil akhir dari reponse.json() yang sudah dibuka bungkusannya dan sudah jadi objek javascript
                    if (data.success) { // jika data.success bernilai true, akan memperbarui isi dari like-count
                        document.querySelector('.overlay').style.display = 'none';
                        document.getElementById(`isi-komentar-${KomentarID}`).innerText = data.message;
                    } else {
                        console.log(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Fungsi untuk menghapus komentar
        function hapusKomentar(KomentarID, UserID, PostID) {
            fetch('proses.php', { // fetch itu fungsi untuk melakukan http request ke file like_proses.php
                    method: 'POST', // melakukan method post pada like  
                    headers: { // bungasih tahu server bahwa data yang dikirim dalam format application blablabla
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `submit=hapusKomentar&KomentarID=${KomentarID}&UserID=${UserID}&PostID=${PostID}` //data yg dikirim server itu berada pada PostID kalo misal PostID = 1, maka yg dikirim itu PostID=1
                })
                .then(response => response.json()) // response itu dari promise, promise itu dari si fetch nya, kemudian setelah itu kan promise menjadi response, kemudian reponse dijadikan file response.json() agar javascript bisa buka bungkusannya supaya datanya jadi objek javascript
                .then(data => { //data adalah sebuah hasil akhir dari reponse.json() yang sudah dibuka bungkusannya dan sudah jadi objek javascript
                    if (data.success) { // jika data.success bernilai true, akan memperbarui isi dari like-count
                        document.getElementById(`comment-element-${KomentarID}`).style.display = data.style;
                    } else {
                        console.log(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // AJAX  untuk like
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

        // ajax nambah komentar
        function comment() {

            event.preventDefault();

            let commentValue = document.getElementById('input-comment').value;

            fetch('proses.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'submit=comment&commentValue=' + encodeURIComponent(commentValue) + '&PostID=<?= htmlspecialchars($row['PostID']); ?>&UserID=<?= htmlspecialchars($_SESSION['UserID']); ?>'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Tambahkan komentar ke list tanpa reload
                        document.getElementById('value_comment').innerHTML += data.new_comment;
                        document.getElementById('input-comment').value = ''; // Kosongin input 
                    } else {
                        alert(data.message);
                    }
                });
        };

        // fungsi untuk menekan enter
        document.getElementById('input-comment').addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                document.getElementById('submit-comment').click();
            }
        });
    </script>
</body>

</html>