<?php
session_start();
include_once '../../components/connection.php';
if ($_SESSION['role'] != 1) {
    header("Location: ../accessDenied.html");
    exit();
}

$query = "SELECT post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture, COUNT(suka.id) AS jumlah_like FROM post INNER JOIN users ON post.UserID = users.UserID LEFT JOIN suka ON post.PostID = suka.PostID GROUP BY post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel-manajemen postingan</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
            overflow-y: hidden;
        }

        .container-all {
            display: flex;
            height: 100vh;
        }

        .container-controler {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
            flex: 1;
            overflow-y: auto;
        }

        .container-controler h1 {
            text-align: center;
            color: #000;
        }

        .label-pengurutan {
            font-weight: bold;
            font-size: 16px;
            margin-right: 10px;
            display: inline-block;
            margin-bottom: 5px;
        }

        .select-pengurutan {
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #fff;
            cursor: pointer;
        }

        .select-pengurutan:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        main table * {
            text-align: center;
        }

        main table td,
        th {
            padding: 10px;
            text-align: center;
            max-width: 490px;
            overflow-x: auto;
        }

        .cta-hapus {
            color: red;
        }
        .cta-lihat-detail {
            color: black;
        }
    </style>
</head>

<body>
    <?php include_once '../components/header.php'; ?>
    <main class="container-all">
        <?php include_once '../components/sidebar.php'; ?>
        <section class="container-controler">
            <h1 class="judul">Manajemen Postingan</h1>

            <form action="" method="get">
                <label for="pengurutan" class="label-pengurutan">Urutkan Berdasarkan:</label>
                <select name="pengurutan" class="select-pengurutan" id="pengurutan" onchange="this.form.submit()">
                    <option value="">Pilih</option>
                    <option value="tanggal_terlama" <?php if (isset($_GET['pengurutan']) && $_GET['pengurutan'] == 'tanggal_terlama') echo 'selected'; ?>>Tanggal Dibuat (Terlama)</option>
                    <option value="tanggal_dibuat_terbaru" <?php if (isset($_GET['pengurutan']) && $_GET['pengurutan'] == 'tanggal_dibuat_terbaru') echo 'selected'; ?>>Tanggal Dibuat (Terbaru)</option>
                    <option value="like_terkecil" <?php if (isset($_GET['pengurutan']) && $_GET['pengurutan'] == 'like_terkecil') echo 'selected'; ?>>Jumlah Like (Terkecil)</option>
                    <option value="like_terbanyak" <?php if (isset($_GET['pengurutan']) && $_GET['pengurutan'] == 'like_terbanyak') echo 'selected'; ?>>Jumlah Like (Terbanyak)</option>
                </select>

                <?php
                if (isset($_GET['pengurutan'])) {
                    $pengurutan = $_GET['pengurutan'];
                    switch ($pengurutan) {
                        case 'tanggal_terlama':
                            $query = "SELECT post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture, COUNT(suka.id) AS jumlah_like FROM post INNER JOIN users ON post.UserID = users.UserID LEFT JOIN suka ON post.PostID = suka.PostID GROUP BY post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture ORDER BY post.created_at ASC";
                            break;
                        case 'tanggal_dibuat_terbaru':
                            $query = "SELECT post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture, COUNT(suka.id) AS jumlah_like FROM post INNER JOIN users ON post.UserID = users.UserID LEFT JOIN suka ON post.PostID = suka.PostID GROUP BY post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture ORDER BY post.created_at DESC";
                            break;
                        case 'like_terkecil':
                            $query = "SELECT post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture, COUNT(suka.id) AS jumlah_like FROM post INNER JOIN users ON post.UserID = users.UserID LEFT JOIN suka ON post.PostID = suka.PostID GROUP BY post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture ORDER BY jumlah_like ASC";
                            break;
                        case 'like_terbanyak':
                            $query = "SELECT post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture, COUNT(suka.id) AS jumlah_like FROM post INNER JOIN users ON post.UserID = users.UserID LEFT JOIN suka ON post.PostID = suka.PostID GROUP BY post.PostID, post.UserID, post.post_name, post.image, post.description, post.created_at, users.username, users.profile_picture ORDER BY jumlah_like DESC";
                            break;
                    }
                }
                $result = $conn->query($query);
                ?>
            </form>

            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px;">
                <tr>
                    <th>Post ID</th>
                    <th>User ID</th>
                    <th>Nama Postingan</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Dibuat</th>
                    <th>Username</th>
                    <th>Foto Profil</th>
                    <th>Jumlah Like</th>
                    <th>Opsi</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['PostID']; ?></td>
                        <td><?= $row['UserID']; ?></td>
                        <td><?= $row['post_name']; ?></td>
                        <td><img src="<?= '../../img/post/' . $row['image']; ?>" alt="Gambar Postingan" style="width: 100px; height: auto;"></td>
                        <td><?= $row['description']; ?></td>
                        <td><?= $row['created_at']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><img src="<?= '../../img/profile/' . $row['profile_picture']; ?>" alt="Foto Profil" style="width: 50px; height: auto;"></td>
                        <td><?= $row['jumlah_like']; ?></td>
                        <td>
                            <a href="edit_post.php?id_post=<?= htmlspecialchars($row['PostID']); ?>&id_user=<?= htmlspecialchars($row['UserID']); ?>" class="cta-edit" ><i class="fas fa-pencil"></i></a>
                            <a href="../../pages/projek/view-details.php?id=<?= $row['PostID'] ?>" class="cta-lihat-detail" ><i class="fa fa-eye"></i></a>
                            <a href="hapus_post.php?id_post=<?= htmlspecialchars($row['PostID']); ?>&id_user=<?= htmlspecialchars($row['UserID']); ?>&lokasi=../../img/post/<?= $row['image']; ?>" class="cta-hapus" ><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </section>
    </main>
</body>

</html>