<?php
session_start();
if ($_SESSION['role'] == 1) {

    include_once("config.php");

    $id = $_GET['hapus'];

    $sql1 = "DELETE FROM suka WHERE UserID = ?;";
    $sql2 = "DELETE FROM komentar WHERE UserID = ?;";
    $sql3 = "DELETE FROM users WHERE UserID = ?;";

    $stmt1 = $mysqli->prepare($sql1);
    $stmt2 = $mysqli->prepare($sql2);
    $stmt3 = $mysqli->prepare($sql3);

    $stmt1->bind_param("i", $id);
    $stmt2->bind_param("i", $id);
    $stmt3->bind_param("i", $id);

    if ($stmt1->execute() && $stmt2->execute() && $stmt3->execute()) {
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
