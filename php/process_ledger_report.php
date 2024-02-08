<?php
include '../php/db_connection.php';
session_start();
if (
    isset($_POST['name'], $_POST['fromDate'], $_POST['toDate'], $_SESSION['username'])
) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $loguser = $_SESSION['username'];
    if (strtotime($fromDate) === false || strtotime($toDate) === false) {
        echo "Invalid date format";
        exit;
    }
    $name = $conn->real_escape_string($name);
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS `$name` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        reason VARCHAR(255) NOT NULL,
        total_amount DECIMAL(10, 2) NOT NULL
    )";
    if ($conn->query($sqlCreateTable) === TRUE) {
        echo "Table $name created successfully<br>";
        $sqlInsertRecords = "INSERT INTO `records` (tname, from_date, to_date, user) VALUES (?, ?, ?, ?)";
        if ($stmtInsertRecords = $conn->prepare($sqlInsertRecords)) {
            $stmtInsertRecords->bind_param("ssss", $name, $fromDate, $toDate, $loguser);
            if ($stmtInsertRecords->execute() === TRUE) {
                echo "Table $name recorded successfully<br>";
            } else {
                echo "Error recording table information: " . $stmtInsertRecords->error;
            }
            $stmtInsertRecords->close();
        } else {
            echo "Error preparing table information query: " . $conn->error;
        }
        $sqlInsertData = "INSERT INTO `$name` (reason, total_amount)
                        SELECT reason, SUM(amount) AS total_amount
                        FROM ledger
                        WHERE `date` BETWEEN ? AND ?
                        GROUP BY reason";
        if ($stmtInsertData = $conn->prepare($sqlInsertData)) {
            $stmtInsertData->bind_param("ss", $fromDate, $toDate);
            if ($stmtInsertData->execute() === TRUE) {
                echo "Ledger report uploaded to `$name` successfully<br>";
                header("Location: success.php?return_url=" . urlencode($_GET['return_url']));
                exit();
            } else {
                echo "Error uploading ledger report: " . $stmtInsertData->error;
            }
            $stmtInsertData->close();
        } else {
            echo "Error preparing ledger upload query: " . $conn->error;
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
    echo "Required POST parameters or session variables not set";
}

$conn->close();
?>
