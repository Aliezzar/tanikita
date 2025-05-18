<?php
if ($_SESSION['role'] == 1) {

    $databaseHost = 'localhost';
    $databaseName = 'tanikita';
    $databaseUsername = 'root';
    $databasePassword = '';

    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
}
