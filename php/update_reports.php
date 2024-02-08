<?php
include '../php/db_connection.php';
$logFilePath = '../log/updatereport.txt';
try {
    $sql = "SELECT * FROM records";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (isset($row['tname'], $row['from_date'], $row['to_date'])) {
                $tableName = $row['tname'];
                $from = $row['from_date'];
                $to = $row['to_date'];

                if (!empty($tableName)) {
                    $deleteQuery = "DELETE FROM `$tableName`";
                    $deleteStmt = $conn->prepare($deleteQuery);
                    
                    if ($deleteStmt) {
                        $deleteStmt->execute();
                        $errorLogMessage = "Deleted records from table $tableName<br>".date("Y-m-d H:i:s") . "\n";
                        file_put_contents($logFilePath, $errorLogMessage, FILE_APPEND);
                    } else {
                        $errorLogMessage = "Delete query preparation failed for table $tableName<br>".  date("Y-m-d H:i:s") . "\n";
                        file_put_contents($logFilePath, $errorLogMessage, FILE_APPEND);
                    }

                    $insertQuery = "INSERT INTO `$tableName` (reason, total_amount)
                                    SELECT reason, SUM(amount) AS total_amount
                                    FROM ledger
                                    WHERE date BETWEEN ? AND ?
                                    GROUP BY reason";
                    $insertStmt = $conn->prepare($insertQuery);

                    if ($insertStmt) {
                        $insertStmt->bind_param("ss", $from, $to);
                        $insertStmt->execute();
                        $errorLogMessage = "Inserted new records into table $tableName<br>". date("Y-m-d H:i:s") . "\n";
                        file_put_contents($logFilePath, $errorLogMessage, FILE_APPEND);
                    } else {
                        $errorLogMessage = "Insert query preparation failed for table $tableName<br>" . date("Y-m-d H:i:s") . "\n";
                        file_put_contents($logFilePath, $errorLogMessage, FILE_APPEND);
                    }
                } else {
                    $errorLogMessage = "Table name is empty for row:<br>". date("Y-m-d H:i:s") . "\n";
                    file_put_contents($logFilePath, $errorLogMessage, FILE_APPEND);
                    print_r($row);
                }
            } else {
                $errorLogMessage = "One or more keys (tname, from_date, to_date) are not set for row:<br>".date("Y-m-d H:i:s") . "\n";
                file_put_contents($logFilePath, $errorLogMessage, FILE_APPEND);
                print_r($row);
            }
        }
    } else {
        $errorLogMessage = "No records found in records table" .date("Y-m-d H:i:s") . "\n";
        file_put_contents($logFilePath, $errorLogMessage, FILE_APPEND);
    }
} catch (PDOException $e) {
    $errorLogMessage = "Error: " . $e->getMessage() .date("Y-m-d H:i:s") . "\n";
    file_put_contents($logFilePath, $errorLogMessage, FILE_APPEND);
}
?>
