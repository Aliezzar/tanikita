<?php
session_start();
include_once 'user_fetch.php';
include_once '../../components/connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="profile_page">
    <?php include '../../components/navbar.php';
    $id_hash_user = hash('sha256', $_SESSION['UserID']); ?>

    <section class="container-profile">
        <?php if ($user) {
            if ($uid == $id_hash_user) { ?>
                <div class="profile-view1">
                    <div class="profilview-sebelah-kiri">
                        <div class="img">
                            <?php if ($user['profile_picture'] != null) { ?>
                                <img id="image" src="../../img/profile/<?= $user['profile_picture']; ?>" alt="Profile Picture" class="profile-picture-edit">
                            <?php } else { ?>
                                <img src="../../img/profile/default.png" alt="Profile Picture" class="profile-picture-view"> >
                            <?php } ?>
                        </div>
                        <div class="btn-edit">
                            <a href="edit_profil.php" class="cta">
                                <button class="button" role="button">Edit Profil</button>
                            </a>
                        </div>
                    </div>

                    <div class="detail-profil">
                        <h2>Profil Akun</h2>
                        <table>
                            <tr>
                                <th><i class="fas fa-user-circle"></i> Detail User:</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th><i class="fas fa-id-badge"></i> Id Pengguna</th>
                                <td><?= htmlspecialchars($user['UserID']); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-envelope"></i> Email</th>
                                <td><?= htmlspecialchars($user['email']); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-user"></i> Nama Lengkap</th>
                                <td><?= htmlspecialchars($user['username']); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-venus-mars"></i> Jenis Kelamin</th>
                                <td><?php if ($user['jenis_kelamin'] == null) {
                                        echo htmlspecialchars('Undefined');
                                    } else {
                                        echo htmlspecialchars($user['jenis_kelamin']);
                                    } ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php } elseif ($uid != $id_hash_user) { ?>
                <div class="profile-view2">
                    <div class="profilview-sebelah-kiri">
                        <div class="img">
                            <?php if ($user['profile_picture'] != null) { ?>
                                <img id="image" src="../../img/profile/<?= $user['profile_picture']; ?>" alt="Profile Picture" class="profile-picture-edit">
                            <?php } else { ?>
                                <img src="../../img/profile/default.png" alt="Profile Picture" class="profile-picture-view"> >
                            <?php } ?>
                        </div>
                    </div>

                    <div class="detail-profil">
                        <h2>Profil Akun</h2>
                        <table>
                            <tr>
                                <th><i class="fas fa-user-circle"></i> Detail User:</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th><i class="fas fa-id-badge"></i> Id Pengguna</th>
                                <td><?= htmlspecialchars($user['UserID']); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-envelope"></i> Email</th>
                                <td><?= htmlspecialchars($user['email']); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-user"></i> Nama Lengkap</th>
                                <td><?= htmlspecialchars($user['username']); ?></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-venus-mars"></i> Jenis Kelamin</th>
                                <td><?php if ($user['jenis_kelamin'] == null) {
                                        echo htmlspecialchars('Undefined');
                                    } else {
                                        echo htmlspecialchars($user['jenis_kelamin']);
                                    } ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php }
        } else { ?>
            <h2>User tidak ditemukan</h2>
        <?php } ?>
    </section>

    <!-- script -->
    <script src="js/script.js"></script>
</body>

</html>