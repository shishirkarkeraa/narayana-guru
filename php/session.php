<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../php/login.php');
    exit();
}

include '../php/db_connection.php';

$username = $_SESSION['username'];
$sql = "SELECT granted_access FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $access_granted = $row['granted_access'];

    if ($access_granted == 1) {
    } else {
        header("Location: ../php/wait_for_permission.php");
        exit();
    }
}

$stmt->close();
$conn->close();

?>