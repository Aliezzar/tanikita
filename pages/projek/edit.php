<?php
session_start();
include_once('../../components/connection.php');

$id_user = $_SESSION['UserID'];
$id_post = $_GET['post_id'];

$stmt = $conn->prepare('SELECT * FROM post WHERE PostID = ?');
$stmt->bind_param('i', $id_post);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$file_name = str_replace(' ', '_', $row['image']); // Sanitasi nama file untuk mengganti spasi jadi _
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Postingan</title>
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

    <h1 style="text-align: center;">Edit Postingan</h1>
    <form action="proses.php" method="POST" enctype="multipart/form-data">
        <label>Nama Postingan:</label>
        <input type="text" name="post_name" value="<?= $row['post_name']; ?>" required>

        <label>Deskripsi:</label>
        <textarea name="description" rows="4" required><?= $row['description']; ?></textarea>

        <label>Gambar:</label> <br>
        <?php if (!empty($row['image'])) { ?>
            <img src="../../img/post/<?= $file_name; ?>" alt="Gambar Postingan" width="150"><br>
        <?php } ?>
        <br>
        <label>Gambar Baru (jika ingin mengganti):</label>
        <input type="file" name="gambar_postingan" accept="image/*">

        <input type="submit" name="submit" value="submit_edit">
        <a href="index.php">← Kembali ke dashboard postingan</a>

        <!-- hiddden input -->
        <input type="hidden" name="id_post" value="<?= $id_post; ?>">
    </form>

</body>

</html>