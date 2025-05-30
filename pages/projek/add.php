<?php
session_start();
include_once('../../components/connection.php');
include_once '../../components/wajib_login.php';


$query = "SELECT * FROM post";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambahkan Postingan</title>
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
    <style>
        body {
            color: #000;
            font-family: sans-serif;
            padding: 40px;
        }

        form {
            max-width: 500px;
            margin: auto;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.8);
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            margin-top: 15px;
            color: #aaa;
            text-align: center;
        }
    </style>
</head>

<body>
    <form action="proses.php" method="POST" name="tambahkan" enctype="multipart/form-data">
        <label>caption:</label>
        <input type="text" name="post_name" required>

        <label>Deskripsi:</label>
        <textarea name="description" rows="4" required></textarea>

        <label>Foto:</label>
        <input type="file" name="gambar_postingan" accept="image/*" required>

        <input type="submit" name="submit" value="tambahkan">
        <a href="index.php">← Kembali ke dashboard</a>
    </form>

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
</body>

</html>