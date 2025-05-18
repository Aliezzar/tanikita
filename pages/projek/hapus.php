<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
<?php
session_start();


if ($_GET['hapus'] == 'post') {
    include_once("../../components/connection.php");

    $id = $_GET['PostID'];
    $name = $_GET['name'];
    $file = $_GET['lokasi'];
    
    $sql1 = "DELETE FROM komentar WHERE PostID = ?";
    $sql2 = "DELETE FROM suka WHERE PostID = ?";
    $sql3 = "DELETE FROM post WHERE PostID = ?";
    
    $stmt1 = $mysqli->prepare($sql1);
    $stmt2 = $mysqli->prepare($sql2);
    $stmt3 = $mysqli->prepare($sql3);
    
    $stmt1->bind_param("i", $id);
    $stmt2->bind_param("i", $id);
    $stmt3->bind_param("i", $id);
    
    if ($stmt1->execute() && $stmt2->execute() && $stmt3->execute()) {
        $aksi = 'Menghapus postingan ' . '"' . $name . '"';
        $id_user = $_SESSION['UserID'];
    
        $queryHistory = $mysqli->prepare("INSERT INTO history (UserID, aksi) VALUES (?, ?)");
        $queryHistory->bind_param('is', $id_user,  $aksi);
        $queryHistory->execute();
        $queryHistory->close();

        if (file_exists($file)) {
            unlink($file);  // ini fungsi hapus file
        }
    
        header("Location: index.php");
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
    
    header("Location:index.php");   
}

if ($_GET['hapus'] == 'comment') {
    include_once("../../components/connection.php");
    print_r($_GET);
    $comment_id = $_GET['comment_id'];

    $sql = "DELETE FROM komentar WHERE KomentarID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $stmt->close();
    $aksi = 'Menghapus komentar';

    $UserID = $_SESSION['UserID'];
    $query_history = $mysqli->prepare("INSERT INTO history (UserID, aksi) VALUES (?, ?)");
    $query_history->bind_param('is', $UserID,  $aksi);
    $query_history->execute();
    $query_history->close();
    header("Location: index.php");
}