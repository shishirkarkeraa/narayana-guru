<?php
include '../php/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $stmt_check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    $response = array();
    if ($result->num_rows > 0) {
        $response['exists'] = true;
    } else {
        $response['exists'] = false;
    }

    echo json_encode($response);
    exit();
}
?>
