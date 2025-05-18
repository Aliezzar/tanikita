<?php
session_start();
if ($_SESSION['role'] == 1) {
    session_start();
    session_unset();
    session_destroy();

    header("Location: ../pages/login-register/index.php");
    exit();
} else {
    header("Location: ../accessDenied.html");
    exit();
}
