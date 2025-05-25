<?php
session_start();
if ($_SESSION['role'] === 0 || !isset($_SESSION['role'])) {
    header("Location: ../../accessDenied.html");
    exit();
}

include_once("../../components/connection.php");

if (isset($_GET['cancel'])) {
    $laporan_id = $_GET['LaporanID'];

    $query = "DELETE FROM laporan_pelanggaran_postingan WHERE LaporanID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $laporan_id);
    if ($stmt->execute()) {
        echo "<script>
        Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Laporan berhasil dibatalkan!',
            }).then(function() {
                window.location.href = 'index.php';
            });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            }).then(function() {
                window.location.href = 'index.php';
            });
        </script>";
    }
}

$query = '
SELECT 
l.LaporanID,
l.PostID,
l.UserID_pelapor,
l.UserID_uploader,
l.isi_laporan,
l.tanggal_waktu,
u.username,
p.post_name,
p.description,
p.image
FROM `laporan_pelanggaran_postingan` l 
INNER JOIN users u ON l.UserID_pelapor = u.UserID
INNER JOIN post p ON l.PostID = p.PostID;
';
$result = $conn->query($query);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengguna</title>
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>

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
            height: 100dvh;
            width: 100vw;
        }

        .container-all {
            display: flex;
            height: 100%;
        }

        .container-all .kanan {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 90%;
        }

        .container-controler {
            width: 1400px;
            height: 80%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            padding: 20px;
            flex: 1;
            overflow-y: auto;
        }

        .container-controler h1 {
            text-align: center;
            color: #000;
        }

        .container-controler .view-laporan-container {
            max-height: 99%;
            overflow-y: auto;
            border: solid 1px;
            width: 100%;
        }

        .container-controler table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        td.panjang {
            max-width: 120px;
            word-wrap: break-word;
            white-space: normal;
            text-align: start;
        }

        .button-cta {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            gap: 17px;
        }

        .view-laporan-container a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            border: solid 1px;
            padding: 3px;
            border-radius: 4px;
            width: 120px;
            display: flex;
            align-items: center;
        }

        .view-laporan-container a.hapus {
            background-color: red;
            color: white;
        }

        .batal-btn {
            background-color: grey;
            font-weight: bold;
            color: white;
            padding: 4px;
            height: 36px;
            width: 70px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include_once '../components/header.php'; ?>
    <main class="container-all">
        <?php include_once '../components/sidebar.php'; ?>

        <section class="kanan">
            <section class="container-controler">
                <h1 class="judul">Laporan dari User</h1>
                <div class="view-laporan-container">
                    <table border="1" cellpadding="10" cellspacing="0">
                        <tr>
                            <th>ID Laporan</th>
                            <th>ID Pelapor</th>
                            <th>ID Uploader</th>
                            <th>ID Postingan</th>
                            <th>Username Pelapor</th>
                            <th>Isi Laporan</th>
                            <th>Tanggal</th>
                            <th>Caption postingan</th>
                            <th>Deskripsi postingan</th>
                            <th>Option</th>
                        </tr>
                        <?php
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['LaporanID']; ?></td>
                                <td><?= $row['UserID_pelapor']; ?></td>
                                <td><?= $row['UserID_uploader']; ?></td>
                                <td><?= $row['PostID']; ?></td>
                                <td class="panjang"><?= $row['username']; ?></td>
                                <td class="panjang"><?= $row['isi_laporan']; ?></td>
                                <td><?= $row['tanggal_waktu']; ?></td>
                                <td class="panjang"><?= $row['post_name']; ?></td>
                                <td class="panjang"><?= $row['description']; ?></td>
                                <td>
                                    <div class="button-cta">
                                        <a href="hapus_post.php?id_post=<?= $row['PostID']; ?>&post_name=<?= $row['post_name']; ?>&id_uploader=<?= intval($row['UserID_uploader']); ?>&id_pelapor=<?= $row['UserID_pelapor']; ?>&lokasi=../../img/post/<?= $row['image'] ?>" class="hapus"><i class="fas fa-trash" style="color: white;"></i>Hapus Postingan</a>
                                        <a href="../../pages/projek/view-details.php?id=<?= $row['PostID']; ?>"><i class="fa fa-eye"></i> Lihat postingan</a>
                                        <button id="cancel" class="batal-btn">Batal</button>
                                    </div>
                                </td>
                            </tr>
                            <script>
                                const idLaporan = <?= $row['LaporanID']; ?>;
                            </script>
                        <?php } ?>
                    </table>
                </div>
            </section>
        </section>
    </main>


    <script>
        const cancelBtn = document.getElementById('cancel');
        cancelBtn.addEventListener('click', function() {
            window.location.href = `index.php?cancel=1&LaporanID=${idLaporan}`;
        });
    </script>
</body>

</html>