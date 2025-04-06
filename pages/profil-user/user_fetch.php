<?php
include_once '../../components/connection.php';


$uid = isset($_GET['uid']) ? $_GET['uid'] : $_SESSION['UserID'];
$query = $conn->prepare("SELECT *, SHA2(CAST(UserID AS CHAR), 256) AS hashed_id FROM users WHERE SHA2(CAST(UserID AS CHAR), 256) = ? LIMIT 1;");
$query->bind_param("s", $uid);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

?>  