<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "tanikita";

$conn = mysqli_connect($host, $user, $pass, $db);
$mysqli = $conn;

mysqli_select_db($conn, $db);

?>