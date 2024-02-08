<?php
session_start(); 
include '../php/db_connection.php';
$logFilePath = "../log/loginlog.txt";
function logToFile($logFile, $logMessage)
{
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[" . $timestamp . "] " . $logMessage . "\n";
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

function containsSymbolOrUppercase($str)
{
    return preg_match('/[^a-z0-9]/', $str) || preg_match('/[A-Z]/', $str);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username) || empty($password)) {
        $error = "Username and password are required!";
        logToFile($logFilePath, "Error: " . $error);
    } elseif (containsSymbolOrUppercase($username)) {
        $error = "Username should contain only lowercase letters and numbers";
        logToFile($logFilePath, "Error: " . $error);
    } elseif (preg_match('/[^a-zA-Z0-9@#]/', $password)) {
        $error = "Password should contain only letters, numbers, @, or # symbols!";
        logToFile($logFilePath, "Error: " . $error);
    } else {     
        $stmt = $conn->prepare("SELECT id, password, login_attempt, account_status FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $user_id = $row['id'];
            $hashed_password = $row['password'];
            $login_attempt = $row['login_attempt'];
            $account_status = $row['account_status'];
            if ($account_status == 'locked') {
                $error = "Account is locked for".$username." , contact administrator!";
                logToFile($logFilePath, "Error: " . $error);
            } else {
                $hashed_password_input = hash('sha3-224', $password);
                if ($hashed_password_input === $hashed_password) {
                    $_SESSION['username'] = $username;
                    $username = $_SESSION['username'];
                    $currentTimestamp = date("Y-m-d H:i:s"); 
                    $sql = "INSERT INTO login_log (username, login_time) VALUES ('$username', '$currentTimestamp')";
                    $result = $conn->query($sql);
                    if ($result) {
                        echo "Login logged successfully!";
                        logToFile($logFilePath, "Login successfull for " . $username);
                    } else {
                        echo "Error: " . $conn->error;
                        logToFile($logFilePath, "Error: " . $conn->error);
                    }
                    if ($login_attempt > 0) {
                        $stmt = $conn->prepare("UPDATE users SET login_attempt = 0 WHERE id = ?");
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                    }
                    if ($row['is_admin'] == 1) {
                        $_SESSION['admin'] = true;
                    }
                    header("Location: adminindex.php");
                    exit();
                } else {
                    $error = "Invalid password!";
                    logToFile($logFilePath, "Invalid Password for: " . $username);
                    $login_attempt++;
                    if ($login_attempt >= 10) {
                        $stmt = $conn->prepare("UPDATE users SET login_attempt = ?, account_status = 'locked' WHERE id = ?");
                        $stmt->bind_param("ii", $login_attempt, $user_id);
                        $stmt->execute();
                        $error = "Account is locked for ".$username.", contact administrator!";
                        logToFile($logFilePath,$error);
                    } else {
                        $stmt = $conn->prepare("UPDATE users SET login_attempt = ? WHERE id = ?");
                        $stmt->bind_param("ii", $login_attempt, $user_id);
                        $stmt->execute();
                    }
                }
            }
        } else {
            $error = "User not found!";
            logToFile($logFilePath, "Error: " . $error);
        }
    }
}

$conn->close();
?>
