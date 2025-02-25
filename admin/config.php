<?php
if ($_SESSION['role'] == 1) {

    $databaseHost = 'localhost';
    $databaseName = 'qualycheck122';
    $databaseUsername = 'root';
    $databasePassword = '';

    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
}
