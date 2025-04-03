<?php
session_start();
include_once '../../components/connection.php';
include_once '../../popupfunc.php';

if (isset($_POST['update_profile'])) {
    $target_dir = "../../img/profile/";
    $username = $_POST['username'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $id = $_SESSION['UserID'];

    $result = mysqli_query($mysqli, "UPDATE users SET username='$username', email='$email', jenis_kelamin='$jenis_kelamin' WHERE UserID=$id");
    if ($result) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['jenis_kelamin'] = $jenis_kelamin;
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }
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
    <section class="container-profile">
        <div class="profile-view1 profile-edit">
            <div class="profil-sebelah-kiri">
                <label for="upload-photo" style="width: 100%; height: 100%;">
                    <?php if ($_SESSION['profile_picture'] != null) { ?>
                        <img src="../../img/profile/<?= $_SESSION['profile_picture']; ?>" alt="Profile Picture" class="profile-picture-edit">
                    <?php } else { ?>
                        <img src="../../img/profile/default.png" alt="Profile Picture" class="profile-picture-edit">
                    <?php } ?>
                    <div class="hover-effect" style="cursor: pointer;">
                        <span class="icon-hover">
                            <i class="fas fa-camera"></i>
                        </span>
                        <span class="text-hover">Edit Foto Profil</span>
                    </div>
                </label>
                <form id="upload-form" enctype="multipart/form-data" method="POST">
                    <input type="file" id="upload-photo" name="profile_picture" style="display: none;" onchange="document.getElementById('upload-form').submit();" accept="image/*">
                </form>
            </div>

            <script>
                document.querySelector("label[for='upload-photo']").addEventListener("click", function() {
                    document.getElementById("upload-photo").click();
                });
            </script>

            <!-- detail -->

            <div class="detail-profil">
                <h2><?php print_r($_SESSION); ?></h2>
                <table>
                    <tr>
                        <th><i class="fas fa-user-circle"></i> Edit Profil:</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th><i class="fas fa-id-badge"></i> Id Pengguna</th>
                        <td><?= htmlspecialchars($_SESSION['UserID']); ?></td>
                    </tr>
                    <form action="" method="POST" class="edit-profil">
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
                            <td colspan="2"><button type="submit" name="update_profile" id="open-popup">Update Profil</button></td>
                        </tr>
                    </form>
                    <tr>
                        <td colspan="2"><a href="edit_password.php" class="btn">Ganti Password</a></td>
                    </tr>
                </table>
            </div>
    </section>
</body>

</html>


<!-- Success Pop up -->
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .center button {
            padding: 10px 20px;
            background: #fff;
            color: #222;
            border: 1px solid #222;
            outline: none;
            border-radius: 20px;
            font-size: 16px;
        }

        .popup {
            position: absolute;
            top: -150%;
            left: 50%;
            transform: translate(-50%, -50%) scale(1.2);
            opacity: 0;
            width: 450px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.15);
            transition: top 0ms ease-in-out 200ms,
                opacity 200ms ease-in-out 0ms,
                transform 200ms ease-in-out 0ms;
        }

        .popup.active {
            top: 50%;
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
            transition: top 0ms ease-in-out 0ms,
                opacity 200ms ease-in-out 0ms,
                transform 200ms ease-in-out 0ms;
        }

        .popup .head {
            padding: 30px 20px;
            background: #57af57;
            text-align: center;
        }

        .popup .head .icon .box {
            display: inline-block;
            width: 80px;
            height: 80px;
            background: #f5f5f5;
            font-size: 40px;
            line-height: 80px;
            color: #57af57;
            border-radius: 50%;
        }

        .popup .body {
            padding: 20px;
            text-align: center;
        }

        .popup .body h1 {
            font-size: 25px;
            margin-bottom: 10px;
            color: #222;
        }

        .popup .body p {
            font-size: 15px;
            color: #555;
            margin-bottom: 20px;
        }

        .popup .body .close-btn {
            padding: 10px 20px;
            border: 1px solid #888;
            color: #888;
            background: #fff;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            outline: none;
        }
    </style>

    <?php 
    $redirectURL = "index.php?uid=" . hash('sha256', $_SESSION['UserID']) . "&status=success";
    ?>

    <script>
        document.querySelector("#open-popup").addEventListener("click", function() {
            document.querySelector(".popup").classList.add("active");
        });
        document.querySelector(".popup .close-btn").addEventListener("click", function() {
            document.querySelector(".popup").classList.remove("active");
            window.location.href = "<?php echo $redirectURL; ?>";
        });
    </script>

    <div class="popup">
        <div class="head">
            <div class="icon">
                <div class="box">
                    <i class="fa fa-check"></i>
                </div>
            </div>
        </div>
        <div class="body">
            <h1>Success</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <button class="close-btn" name="close-btn">&times; Close</button>
        </div>
    </div>