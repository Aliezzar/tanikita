<?php
session_start();
if ($_SESSION['role'] == 1) {

    include_once("../components/connection.php");

    $id = $_GET['hapus'];
    $lokasi = $_GET['lokasi'];
    $foto = $_GET['foto'];

    $query = "DELETE FROM users WHERE UserID = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);

    if ($foto !== 'default.png' && file_exists($lokasi)) {
            unlink($lokasi);  // ini fungsi hapus file
    }

    if ($stmt->execute()) {
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
} else {
    header("Location: ../accessDenied.html");
    exit();
}
