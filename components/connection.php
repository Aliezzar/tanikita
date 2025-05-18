<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "tanikita";
$conn = mysqli_connect($host, $user, $pass, $db);
$mysqli = mysqli_connect($host,  $user, $pass, $db);

mysqli_select_db($conn, $db);

?>