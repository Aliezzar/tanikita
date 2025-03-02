<?php
if ($_SESSION['role'] == 1) {

    $databaseHost = 'localhost';
    $databaseName = 'qualycheck';
    $databaseUsername = 'root';
    $databasePassword = '';

    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
}
