<?php
include_once '../../components/connection.php';
include_once '../../components/notification.html';
// upload detail profil
function uploadDetailProfil() {
    global $mysqli;

    $username = $_POST['username'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $id = $_SESSION['UserID'];

    $result = "UPDATE users SET username= ?, email= ?, jenis_kelamin= ? WHERE UserID = ?";
    $stmt = $mysqli->prepare($result);
    if ($stmt) {
        $stmt->bind_param('sssi', $username, $email, $jenis_kelamin, $id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['jenis_kelamin'] = $jenis_kelamin;
        } elseif ($stmt->error) {
            echo "<script>alert('error, username/email sudah ada/duplikat dengan user lain, harap gunakan nama dan email yg beda');</script>";
        }else {
            echo "<script>alert('Error updating profile: " . mysqli_error($mysqli) . "';
            window.location.href = 'upload_proccess.php';
            </script>";
        }
    } else {
        echo "Prepare failed: " . $mysqli->error;
    }
}

function uploadImage() {
    global $mysqli;
    $id = $_SESSION['UserID'];

    
    // upload image
    if (!isset($_FILES["file_upload"]) || $_FILES["file_upload"]["error"] == UPLOAD_ERR_NO_FILE) {
        return;
    }
    $target_dir = "../../img/profile/";
    $target_file = $target_dir . basename($_FILES["file_upload"]['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $file_name = basename($_FILES['file_upload']['name']);
    $file_name = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $file_name); // Sanitasi nama file)

    $check = getImageSize($_FILES["file_upload"]['tmp_name']);
    if ($check == false) {
        echo "File bukan gambar, silahkan upload file";
        exit;
    }

    if (!in_array($imageFileType, $allowed_types)) {
        echo "hanya bisa upload file JPG, JPEG, PNG & GIF";
        exit;
    }

    if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
        $sql =  'UPDATE users SET profile_picture = ? WHERE UserID = ?';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si', $file_name, $id);
        $stmt->execute();
        $_SESSION['profile_picture'] = $file_name;
    } else {
        echo "Maaf terjadi kesalahan";
    }
}

?>

<!-- <form action="upload_proccess.php" id="upload-form" enctype="multipart/form-data" method="POST">
    <input type="file" id="upload-photo" name="file" style="display: none;" onchange="document.getElementById('upload-form').submit();" accept="image/*">
</form> -->