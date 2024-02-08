<?php
include '../php/db_connection.php';
function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}
function containsSymbolOrUppercase($str)
{
    return preg_match('/[^a-z0-9]/', $str) || preg_match('/[A-Z]/', $str);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? sanitizeInput($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        $errorreg = "Username and password are required!";
    } elseif (containsSymbolOrUppercase($username)) {
        $error = "Username should contain only lowercase letters and numbers";
        logToFile($logFilePath, "Error: " . $error);
    } elseif (preg_match('/[^a-zA-Z0-9@#]/', $password)) {
        $error = "Password should contain only letters, numbers, @, or # symbols!";
        logToFile($logFilePath, "Error: " . $error);
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorreg = "Username already exists! Please choose a different username.";
        } else {
            $hashed_password = hash('sha3-224', $password);
            $insertStmt = $conn->prepare("INSERT INTO users (username, password, granted_access) VALUES (?, ?, ?)");
            $granted_access = false; 
            $insertStmt->bind_param("ssi", $username, $hashed_password, $granted_access);
            if ($insertStmt->execute()) {
                $errorreg = "User registered successfully!";
                if (!empty($_FILES['profile_picture']['tmp_name'])) {
                    $targetDir = "../images/account/";
                    $targetFile = $targetDir . $username . ".png";
                    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile);
                } else {
                    $targetDir = "../images/account/";
                    $defaultImage = "../images/account/default.png";
                    $newDefaultImage = $targetDir . $username . ".png";
                    copy($defaultImage, $newDefaultImage);
                }

                header("Location: login.php");
                exit();
            } else {
                $errorreg = "Error registering user: " . $conn->error;
            }
        }
    }
}

$conn->close();
?>
