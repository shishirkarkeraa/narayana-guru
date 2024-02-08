<?php
include '../php/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error_message = "New password and confirm password do not match.";
    }
    else{
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($current_password, $hashed_password)) {

            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);            
            $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
            $update_stmt->bind_param("ss", $hashed_new_password, $username);
            $update_stmt->execute();
            $error_message = "Password changed successfully!";
            header("Location: ../php/adminindex.php");
        } else {
            $error_message = "Incorrect current password.";
        }
    } else {
        $error_message = "User not found!";
    }
}
}

?>
