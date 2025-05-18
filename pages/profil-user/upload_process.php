<?php
include_once '../../components/connection.php';
include_once '../../components/notification.html';
// upload detail profil
function uploadDetailProfil()
{
    global $mysqli;

    $username = $_POST['username'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $id = $_SESSION['UserID'];

    $result = "UPDATE users SET username= ?, email= ?, jenis_kelamin= ? WHERE UserID = ?";
    $stmt = $mysqli->prepare($result);
    if ($stmt) {
        $stmt->bind_param('sssi', $username, $email, $jenis_kelamin, $id);
        try {
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                header('Location: error.php');
                exit();
            }
        }

        if ($stmt->affected_rows > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['jenis_kelamin'] = $jenis_kelamin;
        } elseif ($stmt->error) {
            echo "<script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Error: username/email sudah ada atau duplikat dengan user lain. Harap gunakan nama dan email yang berbeda.',
                showConfirmButton: false,
                timer: 3000
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Error updating profile: " . mysqli_error($mysqli) . "',
                showConfirmButton: false,
                timer: 3000
            });
            </script>";
        }
    } else {
        echo "Prepare failed: " . $mysqli->error;
    }
}

function uploadImage()
{

    global $mysqli;
    $id = $_SESSION['UserID'];
    $gambar = $_POST['cropped_image'];

    $decoding_gambar = str_replace('data:image/png;base64,', '', $gambar);
    $decoding_gambar = str_replace(' ', '+', $decoding_gambar);
    $decode_gambar = base64_decode($decoding_gambar);

    // Tentukan path untuk menyimpan gambar
    $target_dir = "../../img/profile/";
    $filename = uniqid() . '.png';
    $target_file = $target_dir . $filename;

    // Simpan gambar yang sudah didecode
    $result = file_put_contents($target_file, $decode_gambar);

    if ($result !== false) {
        // penghapusan gambar lama dari server
        $file_profil_lama = $_SESSION['profile_picture'];
        $file_profil_lama = $target_dir . $file_profil_lama;
        if (file_exists($file_profil_lama)) {
            unlink($file_profil_lama);  // ini fungsi hapus file
        }

        $sql =  'UPDATE users SET profile_picture = ? WHERE UserID = ?';
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('si', $filename, $id);
            if ($stmt->execute()) {

                $_SESSION['profile_picture'] = $filename;
                $_POST['profile_picture'] = $_SESSION['profile_picture'];
                echo "<script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Foto profil berhasil diperbarui!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>";
            } else {
                echo "<script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Gagal memperbarui foto profil.',
                    showConfirmButton: false,
                    timer: 3000
                });
            </script>";
            }
            $stmt->close();
        } else {
            echo "<script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Gagal mempersiapkan statement database.',
                showConfirmButton: false,
                timer: 3000
            });
        </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Gagal menyimpan gambar ke server.',
            showConfirmButton: false,
            timer: 3000
        });
    </script>";
    }
}
