<?php
session_start();

if (!isset($_SESSION) || $_SESSION['role'] !== 1) {
    header('Location: ../../accessDenied.html');
}

if (isset($_GET['id_post'])) {
    include_once '../../components/connection.php';
    $id_post = $_GET['id_post'];
    $id_user = $_GET['id_user'];

    $query_check = "SELECT * FROM post WHERE PostID = ? AND UserID = ?";
    $stmt_check = $conn->prepare($query_check);
    $stmt_check->bind_param("ii", $id_post, $id_user);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if ($result_check->num_rows > 0) {
        
        $query_delete = "DELETE FROM post WHERE PostID = ? AND UserID = ?";
        $stmt_delete = $conn->prepare($query_delete);
        $stmt_delete->bind_param("ii", $id_post, $id_user);

        if ($stmt_delete->execute()) {
            echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data!'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='index.php';</script>";
    }
}