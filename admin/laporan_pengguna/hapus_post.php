<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">
<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] === 0) {
    header("Location: ../../accessDenied.html");
    exit();
}


if (isset($_GET['id_post'])) {
    include_once("../../components/connection.php");

    $id = $_GET['id_post'];
    $post_name = $_GET['post_name'];
    $id_uploader = $_GET['id_uploader'];
    $id_pelapor = $_GET['id_pelapor'];
    
    $query = "DELETE FROM post WHERE PostID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $aksi = 'Postingan anda dengan caption "' . $post_name . '" telah dihapus oleh admin';
        $id_user = $id_pelapor;
    
        $queryHistory = $mysqli->prepare("INSERT INTO history (UserID, aksi) VALUES (?, ?)");
        $queryHistory->bind_param('is', $id_uploader,  $aksi);
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

?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>