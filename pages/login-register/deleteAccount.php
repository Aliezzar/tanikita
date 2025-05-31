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

// delete gambar yang sudah diposting
$query_p = "SELECT `post`.`image` FROM post WHERE UserID = $id";
$result_p = $conn->query($query_p);
$row_p = $result_p->fetch_assoc();
$foto_p = $row_p['image'];
$lokasi_file_p = '../../img/post/'. $foto_p;
if (file_exists($lokasi_file_p)) {
    unlink($lokasi_file_p);  // ini fungsi hapus file
}
// delete gambar yang sudah di posting end

// Query DELETE
$stmt = $conn->prepare("DELETE FROM users WHERE UserID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah ada perubahan di database
if ($stmt->affected_rows > 0) {
    session_destroy(); // Hapus session setelah akun dihapus
    echo "<script>alert('Akun berhasil dihapus.');</script>";
    header("Location: index.php"); // Redirect ke halaman login setelah delete
    exit();
} else {
    echo "<script>alert('Gagal menghapus akun.');</script>";
}
