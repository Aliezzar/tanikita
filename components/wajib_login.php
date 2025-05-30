<?php
if (!isset($_SESSION['UserID']) || empty($_SESSION['UserID'])) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/tanikita/pages/login-register/index.php");
    exit();
}
?>