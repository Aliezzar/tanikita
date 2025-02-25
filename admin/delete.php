<?php
session_start();
if ($_SESSION['role'] == 1) {

    include_once("config.php");

    $id = $_GET['hapus'];

    $result = mysqli_query($mysqli, "DELETE FROM users WHERE UserID=$id");

    header("Location:index.php");
} else {
    header("Location: ../accessDenied.html");
    exit();
}
