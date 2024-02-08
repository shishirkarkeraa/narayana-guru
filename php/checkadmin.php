<?php

include '../php/db_connection.php';

$isadmin = false; 

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT is_admin FROM users WHERE username = ? AND is_admin = 1");
    $stmt->bind_param("s", $username);
    if (!$stmt) {
        echo "Prepare statement error: " . $conn->error;
        exit();
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $isadmin = true;
    }
}
$conn->close();
$_SESSION['is_admin'] = $isadmin;
?>
