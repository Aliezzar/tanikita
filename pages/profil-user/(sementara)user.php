<?php
include_once '../../components/connection.php';
class User {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updateProfile($id, $username, $email, $jenis_kelamin) {
        $query = 'UPDATE users SET username = ?, email = ?, jenis_kelamin = ? WHERE UserID = ?';
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            
        }
    }
}

?>