<?php
session_start();
include_once 'upload_process.php';
include_once '../../components/connection.php';
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
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>

    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</head>

<body>

    <!-- jika post terkirim -->
    <?php
    include_once '../../components/notification.html';
    if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['update_profile'])) {
        uploadDetailProfil();

        $isFileUploaded = isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] === UPLOAD_ERR_OK;

        if ($isFileUploaded) {
            uploadImage(); 
        }

        $current_post = $_POST;
        unset($current_post['file_upload']);


        $normalisasi_current_post = array_map('trim', $current_post);

        if ($_SESSION['last_post']) {
            $last_post_normalized = array_map('trim', $_SESSION['last_post']);

            
            if ($last_post_normalized !== $normalisasi_current_post) {
                $_SESSION['last_post'] = $current_post; 
                header("Location: edit_profil.php?act=success");
                exit();
            } else {
                header("Location: edit_profil.php?act=failed");
                exit();
            }
        }

        
        $_SESSION['last_post'] = $current_post;
        header("Location: edit_profil.php?act=success");
        exit();
    }

    if (isset($_GET['act']) && $_GET['act'] === 'success') {
        echo "<script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Profil berhasil diperbarui!',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
        </script>";
    } elseif (isset($_GET['act']) && $_GET['act'] === 'failed') {
        echo "<script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Gagal memperbarui profil! Belum ada perubahan data.',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
        </script>";
    }
    ?>
    <!-- jika post terkirim end -->

    <form action="" method="POST" class="edit-profil" enctype="multipart/form-data">
        <section class="container-profile">
            <div class="profile-view1 profile-edit">
                <div class="profil-kiri-wrap">
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

                        <input type="file" id="file_upload" onchange="loadFile(event)" name="file_upload" style="display: none;" accept="image/*">
                    </div>
                </div>

                <!-- crop -->
                <div id="cropModal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <span class="close-btn" onclick="closeCropModal()">&times;</span>
                        <div class="crop-area">
                            <img src="" style="max-width: 100%;" id="cropImage">
                        </div>
                        <button type="button" onclick="cropAndUpload()">Simpan</button>
                        <input type="hidden" name="cropped_image" id="cropped_image">
                        <button type="submit" name="save_cropped_image" style="display: none;" id="saveCroppedImageButton">Submit Cropped Image</button>
                    </div>
                </div>


                <!-- detail -->

                <div class="detail-profil">
                    <h2>Edit Profil</h2>
                    <table>
                        <tr>
                            <th><i class="fas fa-user-circle"></i> Edit Profil:</th>
                            <th></th>
                        </tr>
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



    <script>
        let cropper;
        let selectedFile;

        function loadFile(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const image = document.getElementById('cropImage');
                    image.src = e.target.result;

                    // show modal
                    document.getElementById('cropModal').style.display = 'flex';

                    // Init cropper
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 1,
                    });
                };
                reader.readAsDataURL(file);
            }
        }

        function closeCropModal() {
            document.getElementById('cropModal').style.display = 'none';
            if (cropper) cropper.destroy();
        }

        function cropAndUpload() {
            const size = 300;
            const canvas = cropper.getCroppedCanvas({
                width: size,
                height: size,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            const circularCanvas = document.createElement('canvas');
            circularCanvas.width = size;
            circularCanvas.height = size;

            const ctx = circularCanvas.getContext('2d');
            ctx.clearRect(0, 0, size, size);
            ctx.save();
            ctx.beginPath();
            ctx.arc(size / 2, size / 2, size / 2, 0, Math.PI * 2);
            ctx.closePath();
            ctx.clip();

            ctx.drawImage(canvas, 0, 0, size, size);
            ctx.restore();
            const dataUrl = circularCanvas.toDataURL('image/png');
            document.getElementById('image').src = dataUrl;
            const hiddenInput = document.getElementById('cropped_image');
            if (hiddenInput) {
                hiddenInput.value = dataUrl;
            }

            closeCropModal();
        }



        // javascript untuk menampilkan gambar sebelum submit

        var showImage = function(event) {
            var output = document.getElementById('image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src);
            }
        };
    </script>
    <script>
        if (window.location.search.includes('act=')) {
            if (window.performance.navigation.type === 1) {
                window.location.href = 'edit_profil.php';
            }
        }
    </script>
</body>

</html>