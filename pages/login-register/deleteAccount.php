<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['UserID'])) {
    die("Session UserID tidak ditemukan! Coba login ulang.");
}

$id = $_SESSION['UserID'];
$lokasi = '../../img/profile/' . $_SESSION['profile_picture'];
$foto = $_SESSION['profile_picture'];
if ($foto !== 'default.png' && file_exists($lokasi)) {
    unlink($lokasi);  // ini fungsi hapus file
}
// Query DELETE
$stmt = mysqli_prepare($conn, "DELETE FROM users WHERE UserID = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

// Cek apakah ada perubahan di database
if (mysqli_stmt_affected_rows($stmt) > 0) {
    session_destroy(); // Hapus session setelah akun dihapus
    echo "<script>alert('Akun berhasil dihapus.');</script>";
    header("Location: index.php"); // Redirect ke halaman login setelah delete
    exit();
} else {
    echo "<script>alert('Gagal menghapus akun.');</script>";
}
