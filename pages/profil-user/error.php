<?php
session_start();
include_once '../../components/connection.php';
include_once '../../components/notification.html';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Nama atau email sudah digunakan oleh orang lain.',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
            window.location.href = 'edit_profil.php';
            }
        });
    </script>
</body>

</html>