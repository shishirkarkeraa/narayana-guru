<?php
include '../php/db_connection.php';

if (isset($_GET['tname'])) {
    $deleteTname = $_GET['tname'];
    $stmtDeleteRecord = $conn->prepare("DELETE FROM records WHERE tname = ?;");
    $stmtDeleteRecord->bind_param("s", $deleteTname);

    if ($stmtDeleteRecord->execute()) {
        echo "Record deleted successfully.";
        header("Location: success.php?return_url=" . urlencode($_GET['return_url']));
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $sqlDropTable = "DROP TABLE `" . $deleteTname . "`;";

    if ($conn->query($sqlDropTable) === TRUE) {
        echo "Table $deleteTname dropped successfully.";
    } else {
        echo "Error dropping table: " . $conn->error;
    }
}

$conn->close();
?>
