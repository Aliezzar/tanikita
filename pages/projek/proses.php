<?php
session_start();

if ($_POST['submit'] == 'delete_history') {
    include_once '../../components/connection.php';
    $UserID = $_POST['id_user'];
    $HistoryID = $_POST['id_history'];

    $query = "DELETE FROM history WHERE UserID = ? AND HistoryID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $UserID, $HistoryID);
    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "none"
        ]);
        exit;
    } else {
        echo json_encode([
            "success" => false
        ]);
        exit;
    }
}

if ($_POST['submit'] == 'editKomentar') {
    include_once('../../components/connection.php');
    $id_komentar = $_POST['KomentarID']; 
    $id_user = $_POST['UserID'];
    $id_post = $_POST['PostID'];
    $isi_komentar_update = $_POST['updateKomentarValue'];

    $query_check = 'SELECT * FROM `komentar` WHERE KomentarID = ? AND UserID = ? AND PostID = ?;';
    $stmt_check = $conn->prepare($query_check);
    $stmt_check->bind_param('iii', $id_komentar, $id_user, $id_post);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $isi_komentar_asli = $row['isi_komentar'];

        $query = 'UPDATE `komentar` SET `isi_komentar` = ? WHERE `komentar`.`KomentarID` = ? AND `komentar`.`UserID` = ? AND `komentar`.`PostID` = ?;';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('siii', $isi_komentar_update, $id_komentar, $id_user, $id_post);
        $stmt->execute();
        $stmt->close();
        echo json_encode([
            "success" => true,
            "message" => $isi_komentar_update
        ]);
        $query_history = $conn->prepare("INSERT INTO history (UserID, aksi) VALUES (?, ?)");
        if ($_SESSION['role'] == 1) {
            $aksi = "Mengedit komentar $isi_komentar_asli menjadi $isi_komentar_update oleh " . $_SESSION['username'];
        } else {
            $aksi = "Anda mengedit komentar $isi_komentar_asli menjadi $isi_komentar_update ";
        }
        $query_history->bind_param('is', $id_user,  $aksi);
        $query_history->execute();
        $query_history->close();
        exit;
    } else {
        echo json_encode([
            "success" => false,
            "message" => "<script>
            Swal.fire({toast: true, position: 'top-end', icon: 'error', title: 'Komentar tidak ditemukan!', showConfirmButton: false, timer: 3000});</script>"
        ]);
        exit;
    }
}

if ($_POST['submit'] == 'hapusKomentar') {
    include_once('../../components/connection.php');
    // omentarID=${KomentarID}&UserID=${UserID}&PostID=${PostID}
    $id_komentar = $_POST['KomentarID'];
    $id_user = $_POST['UserID'];
    $id_post = $_POST['PostID'];

    $query_check = 'SELECT * FROM `komentar` WHERE KomentarID = ? AND UserID = ? AND PostID = ?;';
    $stmt_check = $conn->prepare($query_check);
    $stmt_check->bind_param('iii', $id_komentar, $id_user, $id_post);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $isi_komentar_asli = $row['isi_komentar'];

        $query = 'DELETE FROM `komentar` WHERE KomentarID = ? AND UserID = ? AND PostID = ?;';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iii', $id_komentar, $id_user, $id_post);
        $stmt->execute();
        $stmt->close();
        echo json_encode([
            "success" => true,
            "style" => "none"
        ]);
        $query_history = $conn->prepare("INSERT INTO history (UserID, aksi) VALUES (?, ?)");
        if ($_SESSION['role'] == 1) {
            $aksi = "Menghapus komentar $isi_komentar_asli oleh " . $_SESSION['username'];
        } else {
            $aksi = "Anda menghapus komentar $isi_komentar_asli";
        }
        $query_history->bind_param('is', $id_user,  $aksi);
        $query_history->execute();
        $query_history->close();
        exit;
    } else {
        echo json_encode([
            "success" => false,
            "message" => "<script>
            Swal.fire({toast: true, position: 'top-end', icon: 'error', title: 'Komentar tidak ditemukan!', showConfirmButton: false, timer: 3000});</script>"
        ]);
        exit;
    }
}

if ($_POST['submit'] == 'comment') {
    include_once '../../components/connection.php';
    $UserID = $_POST['UserID'];
    $PostID = $_POST['PostID'];
    $isi_komentar = $_POST['commentValue'];
    if (empty($isi_komentar)) {
        echo json_encode([
            "success" => false,
            "message" => "Komentar tidak boleh kosong!"
        ]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO komentar (PostID, UserID, isi_komentar, tanggal) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iis", $PostID, $UserID, $isi_komentar);
    $stmt->execute();
    $stmt->close();



    echo json_encode([
        "success" => true,
        "new_comment" =>
        '<div class="comment-element">' .
            '<img src="../../img/profile/' . $_SESSION["profile_picture"] . '" alt="" class="avatar"/>' .
            '<div class="comment-content">' .
            '<strong>' . $_SESSION["username"] . '</strong>' .
            '<div class="isi-komen-container">' .
            '<p>' . $isi_komentar . '</p>' .
            '<p class="comment-date">' . date("Y-m-d H:i:s") . '</p>' .
            '</div>' .
            '<i class="fa fa-trash" onclick="hapusKomentar(<?= $row_komen[ ' . 'KomentarID' . ' . ] ?>, <?= $_SESSION[' . 'UserID' . ']; ?>, <?= $row_komen[' . 'PostID' . '] ?>)" id="delete-comment" style="color: red;"></i>' .
            '<i class="fa fa-pencil" id="edit-comment" style="color: blue;"></i>'
            . '</div></div>'
    ]);

    $query_history = $conn->prepare("INSERT INTO history (UserID, aksi) VALUES (?, ?)");
    $aksi = 'menambahkan komentar baru dengan isi ' . '"' . $isi_komentar . '"';
    $query_history->bind_param('is', $UserID,  $aksi);
    $query_history->execute();

    exit();
}

if ($_POST['submit'] == 'like') {
    include_once('../../components/connection.php');
    $UserID = $_SESSION['UserID'];
    $PostID = $_POST['PostID'];

    // mengecek jika sudah like
    $query = $conn->prepare("SELECT * FROM suka WHERE PostID = ? AND UserID = ?");
    $query->bind_param("ii", $PostID, $UserID);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows == 0) { // jika belum ada like dari user ini
        $stmt = $conn->prepare("INSERT INTO suka (PostID, UserID, tanggal) VALUES (?, ?, NOW())");
        $stmt->bind_param("ii", $PostID, $UserID);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("DELETE FROM suka WHERE PostID = ? AND UserID = ?");
        $stmt->bind_param("ii", $PostID, $UserID);
        $stmt->execute();
    }

    // menghitung jumlah like terbaru
    $sql_query = "SELECT COUNT(*) AS total FROM suka WHERE PostID = ?";
    $count = $conn->prepare($sql_query);
    $count->bind_param("i", $PostID);
    $count->execute();
    $like = $count->get_result()->fetch_assoc();

    echo json_encode([
        "success" => true,
        "new_like_count" => $like['total']
    ]);
    $query_post = $conn->prepare("SELECT * FROM post INNER JOIN users ON post.UserID = users.UserID WHERE PostID = ? ;");
    $query_post->bind_param("i", $PostID);
    $query_post->execute();
    $result_post = $query_post->get_result();
    $row_post = $result_post->fetch_assoc();
    $query_history = $conn->prepare("INSERT INTO history (UserID, aksi) VALUES (?, ?)");
    $aksi = 'menyukai postingan dari ' . $row_post['username'] . ' pada ' . '"' . $row_post['post_name'] . '"';
    $query_history->bind_param('is', $UserID,  $aksi);
    $query_history->execute();
    exit();
}

include_once('../../components/notification.html');

if ($_POST['submit'] == 'laporan') {
    include_once '../../components/connection.php';
    $alasan = $_POST['alasan'];
    $id_post = $_POST['post_id'];
    $user_id_uploader = $_POST['user_id'];
    $id_user = $_SESSION['UserID'];

    $query = 'INSERT INTO `laporan_pelanggaran_postingan`(`PostID`, `UserID_pelapor`, `UserID_uploader`, `isi_laporan`) VALUES (?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiis', $id_post, $id_user, $user_id_uploader, $alasan);
    if ($stmt->execute()) {
        $query_history = $conn->prepare("INSERT INTO history (UserID, aksi) VALUES (?, ?)");
        $aksi = 'melaporkan postingan dengan alasan ' . '"' . $alasan . '"';
        $query_history->bind_param('is', $id_user,  $aksi);
        $query_history->execute();
        header('Location: index.php?success=' . strval(hash('sha256', 'laporan')));
        exit;
    } else {
        echo "<script>alert('gagal mengirim laporan, kami mohon maaf');window.location.href = 'index.php';</script>";
        exit;
    }
}


if ($_POST['submit'] == 'tambahkan') {
    $name = $_POST['post_name'];
    $description = $_POST['description'];
    $id_user = $_SESSION['UserID'];
    $file_name = basename($_FILES['gambar_postingan']['name']);

    include_once('../../components/connection.php');

    // upload image
    if (!isset($_FILES["gambar_postingan"]) || $_FILES["gambar_postingan"]["error"] == UPLOAD_ERR_NO_FILE) {
        return;
    }
    $target_dir = "../../img/post/";
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $file_name = str_replace(' ', '_', $file_name); // Sanitasi nama file untuk mengganti spasi jadi _
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getImageSize($_FILES["gambar_postingan"]['tmp_name']);
    if ($check == false) {
        echo "<script>showNotif('File bukan gambar, silahkan upload file', 'error');</script>";
        flush();
        sleep(3);
        exit;
    }

    if (!in_array($imageFileType, $allowed_types)) {
        echo "hanya bisa upload file JPG, JPEG, PNG & GIF";
        flush();
        sleep(3);
        exit;
    }

    if (move_uploaded_file($_FILES["gambar_postingan"]["tmp_name"], $target_file)) {

        $stmt = $mysqli->prepare('INSERT INTO post(post_name, description, image, UserID) VALUES(?, ?, ?, ?)');

        if ($stmt) {
            $stmt->bind_param('sssi', $name, $description, $file_name, $id_user);
            try {
                $stmt->execute();
            } catch (mysqli_sql_exception $e) {
                if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                    echo "<script>showNotif('Maaf, terjadi kesalahan', 'error');</script>";
                    exit();
                }
            }

            $aksi = 'menambahkan postingan baru dengan caption ' . '"' . $name . '"';

            $queryHistory = $mysqli->prepare("INSERT INTO history (UserID, aksi) VALUES (?, ?)");
            $queryHistory->bind_param('is', $id_user,  $aksi);
            $queryHistory->execute();
            $queryHistory->close();


            echo "<script>showNotif('berhasil menambahkan post', 'success');</script>";
            header('Location: index.php');
            flush();
        }
    } else {
        echo "<script>showNotif('Maaf terjadi kesalahan', 'error');</script>";
        flush();
        sleep(3);
        exit;
    }
    // masih terlalu awur awuran
}


if ($_POST['submit'] == 'submit_edit') {
    print_r($_POST);
    echo "<br>";
    $name = $_POST['post_name'];
    $description = $_POST['description'];
    $id_user = $_SESSION['UserID'];
    $id_post = $_POST['id_post'];
    $file_name = basename($_FILES['gambar_postingan']['name']);

    include_once('../../components/connection.php');

    // print_r($_FILES); echo "<br>"; print_r($_POST); echo "<br>";
    // exit;

    if ($_FILES['gambar_postingan']['error'] === UPLOAD_ERR_NO_FILE) { //jika tidak ada gambar postingan yg diedit:
        $stmt = $mysqli->prepare('UPDATE post SET post_name = ?, description = ? WHERE PostID = ? AND UserID = ?');

        if ($stmt) {
            $stmt->bind_param('ssii', $name, $description, $id_post, $id_user);
            try {
                $stmt->execute();
            } catch (mysqli_sql_exception $e) {
                if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                    echo "<script>showNotif('Maaf, terjadi kesalahan', 'error');</script>";
                    exit();
                }
            }

            echo "<script>showNotif('berhasil mengedit postingan', 'success');</script>";
            header('Location: index.php');
            exit();
        } else {
            echo "<script>showNotif('Maaf terjadi kesalahan', 'error');</script>";
            flush();
            sleep(3);
            exit;
        }
    } elseif ($_FILES["gambar_postingan"]["error"] === UPLOAD_ERR_OK) {  //jika ada gambar postingan yg diedit:
        // upload image
        $target_dir = "../../img/post/";
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = str_replace(' ', '_', $file_name); // Sanitasi nama file untuk menghindari kesalahan saat upload
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getImageSize($_FILES["gambar_postingan"]['tmp_name']);
        if ($check == false) {
            echo "<script>showNotif('File bukan gambar, silahkan upload file', 'error');</script>";
            flush();
            sleep(3);
            exit;
        }

        if (!in_array($imageFileType, $allowed_types)) {
            echo "hanya bisa upload file JPG, JPEG, PNG & GIF";
            flush();
            sleep(3);
            exit;
        }

        if (move_uploaded_file($_FILES["gambar_postingan"]["tmp_name"], $target_file)) {

            $stmt = $mysqli->prepare('UPDATE post SET post_name = ?, description = ?, image = ? WHERE PostID = ? AND UserID = ?');

            if ($stmt) {
                $stmt->bind_param('sssii', $name, $description, $file_name, $id_post, $id_user);
                try {
                    $stmt->execute();
                } catch (mysqli_sql_exception $e) {
                    if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                        echo "<script>showNotif('Maaf, terjadi kesalahan', 'error');</script>";
                        exit();
                    }
                }


                echo "<script>showNotif('berhasil mengedit postingan', 'success');</script>";
                header('Location: index.php');
                exit();
            }
        } else {
            echo "<script>showNotif('Maaf terjadi kesalahan', 'error');</script>";
            flush();
            sleep(3);
            exit;
        }
    }
}
