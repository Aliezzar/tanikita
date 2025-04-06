<?php
session_start();
include_once 'upload_proccess.php';
include_once '../../components/connection.php';
include_once '../../components/notification.html';

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['update_profile'])) {
    uploadDetailProfil();
    uploadImage();

    // cek apakah $_POST berubah
    $current_post = $_POST;

    if (isset($_SESSION['last_post'])) {
        // Cek apakah data berubah
        if ($_SESSION['last_post'] !== $current_post) {
            header("Location: edit_profil.php?act=success");
            exit();
        } else {
            header("Location: edit_profil.php?act=failed");
            exit();
        }
    }

    // nyimpen $_POST ke session 
    $_SESSION['last_post'] = $current_post;
}

if (isset($_GET['act']) && $_GET['act'] === 'success') {
    echo "<script>
    let date = new Date();
    showNotif('Sukses mengedit profil ' + date.toLocaleString(), 'success');
    </script>";
} elseif (isset($_GET['act']) && $_GET['act'] === 'failed') {
    echo "<script>
    let date = new Date();
    showNotif('Gagal mengupdate profil, belum ada pergantian ' + date.toLocaleString(), 'error');
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="css/profile-edit.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <form action="" method="POST" class="edit-profil" enctype="multipart/form-data">
        <section class="container-profile">
            <div class="profile-view1 profile-edit">
                <div class="profil-sebelah-kiri">
                    <label for="file_upload" style="width: 100%; height: 100%;">
                        <?php if ($_SESSION['profile_picture'] != null) { ?>
                            <img id="image" src="../../img/profile/<?= $_SESSION['profile_picture']; ?>" alt="Profile Picture" class="profile-picture-edit">
                        <?php } else { ?>
                            <img id="image" src="../../img/profile/default.png" alt="Profile Picture" class="profile-picture-edit">
                        <?php } ?>
                        <div class="hover-effect" style="cursor: pointer;">
                            <span class="icon-hover">
                                <i class="fas fa-camera"></i>
                            </span>
                            <span class="text-hover">Edit Foto Profil</span>
                        </div>
                    </label>

                    <input type="file" onchange="loadFile(event)" id="file_upload" name="file_upload" style="display: none;" accept="image/*">
                </div>

                <!-- detail -->

                <div class="detail-profil">
                    <h2>Edit Profil</h2>
                    <table>
                        <tr>
                            <th><i class="fas fa-user-circle"></i> Edit Profil:</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th><i class="fas fa-id-badge"></i> Id Pengguna</th>
                            <td><?= htmlspecialchars($_SESSION['UserID']); ?></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-user"></i> Nama Lengkap</th>
                            <td><input type="text" name="username" value="<?= htmlspecialchars($_SESSION['username']); ?>" required></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <td><input type="email" name="email" value="<?= htmlspecialchars($_SESSION['email']); ?>" required></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-venus-mars"></i> Jenis Kelamin</th>
                            <td>
                                <?php if ($_SESSION['jenis_kelamin'] == null) { ?>
                                    <label>
                                        <input type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki
                                    </label>
                                    <label>
                                        <input type="radio" name="jenis_kelamin" value="Perempuan" required> Perempuan
                                    </label>
                                <?php } else { ?>
                                    <label>
                                        <input type="radio" name="jenis_kelamin" value="Laki-laki" <?php if ($_SESSION['jenis_kelamin'] == "Laki-laki") {
                                                                                                        echo "checked";
                                                                                                    } ?> required> Laki-laki
                                    </label>
                                    <label>
                                        <input type="radio" name="jenis_kelamin" value="Perempuan" <?php if ($_SESSION['jenis_kelamin'] == "Perempuan") {
                                                                                                        echo "checked";
                                                                                                    } ?> required> Perempuan
                                    </label>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="index.php?uid=<?= htmlspecialchars(hash('sha256', $_SESSION['UserID'])); ?>" class="back_a">
                                    <button class="back_button" type="button">Kembali</button>
                                </a>
                            </td>
                            <td colspan="2"><button type="submit" name="update_profile" class="submit">Update Profil</button></td>
                        </tr>
    </form>
    </table>
    </div>
    </section>

    <script src="js/script.js"></script>
    <script>

        if (window.location.search.includes('act=')) {
            if (window.performance.navigation.type === 1) {
                window.location.href = 'edit_profil.php';
            }
        }
    </script>
</body>

</html>