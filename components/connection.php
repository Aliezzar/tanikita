<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "qualycheck";
$conn = mysqli_connect($host, $user, $pass, $db);
$mysqli = mysqli_connect($host,  $user, $pass, $db);

mysqli_select_db($conn, $db);

?>